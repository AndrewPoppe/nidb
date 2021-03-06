<?
 // ------------------------------------------------------------------------------
 // NiDB UpgradeDatabase.php
 // Copyright (C) 2004 - 2016
 // Gregory A Book <gregory.book@hhchealth.org> <gbook@gbook.org>
 // Olin Neuropsychiatry Research Center, Hartford Hospital
 // ------------------------------------------------------------------------------
 // GPLv3 License:

 // This program is free software: you can redistribute it and/or modify
 // it under the terms of the GNU General Public License as published by
 // the Free Software Foundation, either version 3 of the License, or
 // (at your option) any later version.

 // This program is distributed in the hope that it will be useful,
 // but WITHOUT ANY WARRANTY; without even the implied warranty of
 // MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 // GNU General Public License for more details.

 // You should have received a copy of the GNU General Public License
 // along with this program.  If not, see <http://www.gnu.org/licenses/>.
 // ------------------------------------------------------------------------------

	/* ----- edit these variables ----- */
	
		$mysqlHostname = "localhost";
		$mysqlUsername = "username";
		$mysqlPassword = "password";
		$mysqlDatabase = "nidb";
		$newSchemaFile = "nidb.sql"; /* this .sql file should be in the same directory as this script, and be the SCHEMA ONLY. NO DATA in there */
	
	    /* this script will always create a backup of the databse, but you can configure these other options... */
		$doDropDatabase = 0;
		$doCreateNewSchema = 0;
		$doUpgradeDatabase = 0;
		
	/* ----- done editing variables ----- */
	
	date_default_timezone_set("America/New_York");
	$currentDatetime = date('YmdHis');
	$backupDatabaseName = "$mysqlDatabase"."_$currentDatetime";
	
	/* connect to DB */
	$linki = mysqli_connect($mysqlHostname, $mysqlUsername, $mysqlPassword) or die ("Could not connect to database: " . mysqli_error($linki));
	mysqli_select_db($linki, $mysqlDatabase) or die ("Could not select database [$mysqlDatabase]");

	/* ---------------------------------------------------------- */
	/* ----- Step 0 - get existing schema and row counts -------- */
	
		$originaltables = GetSchema($mysqlDatabase);
	
	/* ---------------------------------------------------------- */
	/* ----- Step 1 - rename (backup) the existing database ----- */
	
		/* dump the old database, "q" uses quick mode */
		$systemstring = "mysqldump -qv -u$mysqlUsername -p$mysqlPassword $mysqlDatabase > $backupDatabaseName.sql";
		echo "Running [$systemstring]...\n";
		echo "Output: [" . `$systemstring` . "]\n";
		
		/* create the copy of the database */
		$linki = mysqli_connect($mysqlHostname, $mysqlUsername, $mysqlPassword) or die ("Could not connect to database: " . mysqli_error($linki));
		mysqli_select_db($linki, $mysqlDatabase) or die ("Could not select database [$mysqlDatabase]");
		$sqlstring = "create database $backupDatabaseName";
		echo "SQL [$sqlstring]\n";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		
		/* import the file into the backup database */
		$systemstring = "pv $backupDatabaseName.sql | mysql -u $mysqlUsername -p$mysqlPassword $backupDatabaseName";
		echo "Running [$systemstring]...\n";
		echo "Output: [" . `$systemstring` . "]\n";

		/* verify the row counts between the old database and the backup */
		$backuptables = GetSchema($backupDatabaseName);
		$diff = array_diff($originaltables, $backuptables);
		
		/* if the row counts and schema are all the same, drop the original database */
		if (count($diff) == 0) {
			if ($doDropDatabase) {
				$linki = mysqli_connect($mysqlHostname, $mysqlUsername, $mysqlPassword) or die ("Could not connect to database: " . mysqli_error($linki));
				mysqli_select_db($linki, $mysqlDatabase) or die ("Could not select database [$mysqlDatabase] on line [" . __LINE__ . "]");
				$sqlstring = "drop database $mysqlDatabase";
				echo "SQL [$sqlstring]\n";
				$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			}
			else {
				echo "Not dropping the original database [$mysqlDatabase], based on variables set in this script\n";
			}
		}
		else {
			echo "Creation of a backup copy of the original [$mysqlDatabase] database was not successful. The backup is not identical to the original, please check by hand.";
			exit(0);
		}
	
	/* ---------------------------------------------------------- */
	/* ----- Step 2 - create the schema of the new database ----- */
	
		if ($doCreateNewSchema) {
			/* create the new database */
			$linki = mysqli_connect($mysqlHostname, $mysqlUsername, $mysqlPassword) or die ("Could not connect to database: " . mysqli_error($linki));
			$sqlstring = "create database $mysqlDatabase";
			echo "SQL [$sqlstring]\n";
			$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			mysqli_select_db($linki, $mysqlDatabase) or die ("Could not select database [$mysqlDatabase] on line [" . __LINE__ . "]");
			
			/* import the new schema */
			$systemstring = "mysql -u $mysqlUsername -p$mysqlPassword $mysqlDatabase < $mysqlDatabase.sql";
			echo "Running [$systemstring]...\n";
			echo "Output: [" . `$systemstring` . "]\n";
		}

	/* ---------------------------------------------------------- */
	/* ----- Step 3 - copy data from old database to new          */
	/* ----- This assumes columns can only be added to the new    */
	/* ----- database. So, the new schema should ALWAYS have at   */
	/* ----- least the same schema as the old database. It is     */
	/* ----- expected that the new schema will never drop columns */
	/* ----- from the old database                                */
	
		if ($doUpgradeDatabase) {
			/* make sure we're still connected to the database */
			$linki = mysqli_connect($mysqlHostname, $mysqlUsername, $mysqlPassword) or die ("Could not connect to database: " . mysqli_error($linki));
			mysqli_select_db($linki, $backupDatabaseName) or die ("Could not select database [$db] on line [" . __LINE__ . "]");
			
			/* get list of tables from the old database */
			$sqlstring = "show tables";
			$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$tablename = $row["Tables_in_$backupDatabaseName"];
				$tables[$tablename] = "";
			}
			
			/* loop through all the tables */
			foreach ($tables as $tablename => $val) {
				if ($tablename != "") {
					/* make sure we're still connected to the database */
					$linki = mysqli_connect($mysqlHostname, $mysqlUsername, $mysqlPassword) or die ("Could not connect to database: " . mysqli_error($linki));
					mysqli_select_db($linki, $backupDatabaseName) or die ("Could not select database [$db] on line [" . __LINE__ . "]");
					
					$columns = '';
					$sqlstring = "show columns from $tablename";
					$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
					/* check all the columns */
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$columns[] = "`" . $row['Field'] . "`";
					}
					$columnlist = implode(",",$columns);
					$sqlstring = "insert into $mysqlDatabase.$tablename ($columnlist) select $columnlist from $backupDatabaseName.$tablename";
					//echo "SQL [$sqlstring]\n";
					$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
				}
			}
		
			$newtables = GetSchema($mysqlDatabase);
			$diff = array_diff($originaltables, $newtables);
			
			echo "Here is the difference between the old database and new database schema\n";
			print_r($diff);
		}


	/* -------------------------------------------- */
	/* ------- GetSchema -------------------------- */
	/* -------------------------------------------- */
	function GetSchema($db) {
		echo "Getting schema for [$db]...\n";
		
		mysqli_select_db($GLOBALS['linki'], $db) or die ("Could not select database [$db] on line [" . __LINE__ . "]");
		
		/* get list of tables */
		$sqlstring = "show tables";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$tablename = $row["Tables_in_$db"];
			$tables[$tablename] = "";
		}
		
		foreach ($tables as $tablename => $val) {
			if ($tablename != "") {
				$sqlstring = "select count(*) 'count' from $tablename";
				$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$rowCount = $row['count'];
				
				$tables[$tablename]['rowcount'] = $rowCount;

				$sqlstring = "show columns from $tablename";
				$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
				$columnCount = mysqli_num_rows($result);
				$tables[$tablename]['columncount'] = $columnCount;
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//print_r($row);
					$field = $row['Field'];
					$type = $row['Type'];
					$null = $row['Null'];
					$key = $row['Key'];
					$default = $row['Default'];
					$extra = $row['Extra'];
					
					$tables[$tablename]['columns'][$field]['type'] = $type;
					$tables[$tablename]['columns'][$field]['null'] = $null;
					$tables[$tablename]['columns'][$field]['key'] = $key;
					$tables[$tablename]['columns'][$field]['default'] = $default;
					$tables[$tablename]['columns'][$field]['extra'] = $extra;
				}
				echo "Found table [$tablename] with [$columnCount] columns and [$rowCount] rows\n";
			}
		}
		
		echo "Finished getting schema for [$db]\n";
		return $tables;
	}
	

	/* -------------------------------------------- */
	/* ------- MySQLiQuery ------------------------- */
	/* -------------------------------------------- */
	function MySQLiQuery($sqlstring,$file,$line,$error="") {
		$result = mysqli_query($GLOBALS['linki'], $sqlstring);
		if ($result == false) {
			$msg = "Query failed on [$datetime]:</b> $file (line $line)\nError: " . mysqli_error($linki) . "\nSQL: $sqlstring\n\n";
			die($msg);
		}
		else {
			return $result;
		}
	}
	
?>
