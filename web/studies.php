<?
 // ------------------------------------------------------------------------------
 // NiDB studies.php
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

	session_start();
?>
<html>
	<head>
		<link rel="icon" type="image/png" href="images/squirrel.png">
		<title>NiDB - Studies</title>
	</head>

<body>
	<div id="wrapper">
<?
	require "functions.php";
	require "includes.php";
	require "menu.php";
	require "nanodicom.php";

	//PrintVariable($_POST);
	//PrintVariable($_GET);
	
	/* ----- setup variables ----- */
	$action = GetVariable("action");
	$id = GetVariable("id");
	$studyid = GetVariable("studyid");
	$subjectid = GetVariable("subjectid");
	$enrollmentid = GetVariable("enrollmentid");
	$newuid = GetVariable("newuid");
	$newprojectid = GetVariable("newprojectid");
	$seriesid = GetVariable("seriesid");
	$modality = GetVariable("modality");
	$series_num = GetVariable("series_num");
	$notes = GetVariable("notes");
	$protocol = GetVariable("protocol");
	$series_datetime = GetVariable("series_datetime");
	$studydatetime = GetVariable("studydatetime");
	$studyageatscan = GetVariable("studyageatscan");
	$studyheight = GetVariable("studyheight");
	$studyweight = GetVariable("studyweight");
	$studytype = GetVariable("studytype");
	$studyoperator = GetVariable("studyoperator");
	$studyphysician = GetVariable("studyphysician");
	$studysite = GetVariable("studysite");
	$studynotes = GetVariable("studynotes");
	$studydoradread = GetVariable("studydoradread");
	$studyradreaddate = GetVariable("studyradreaddate");
	$studyradreadfindings = GetVariable("studyradreadfindings");
	$studyetsnellchart = GetVariable("studyetsnellchart");
	$studyetvergence = GetVariable("studyetvergence");
	$studyettracking = GetVariable("studyettracking");
	$studysnpchip = GetVariable("studysnpchip");
	$studyaltid = GetVariable("studyaltid");
	$studyexperimenter = GetVariable("studyexperimenter");
	$files = GetVariable("files");
	$audit = GetVariable("audit");
	$fix = GetVariable("fix");
	$value = GetVariable("value");
	$search_pipelineid = GetVariable("search_pipelineid");
	$search_name = GetVariable("search_name");
	$search_compare = GetVariable("search_compare");
	$search_value = GetVariable("search_value");
	$search_type = GetVariable("search_type");
	$search_swversion = GetVariable("search_swversion");
	$imgperline = GetVariable("imgperline");
	$studyids = GetVariable("studyids");

	/* determine action */
	switch($action) {
		case 'editform':
			DisplayStudyForm($id);
			break;
		case 'update':
			UpdateStudy($id, $modality, $studydatetime, $studyageatscan, $studyheight, $studyweight, $studytype, $studyoperator, $studyphysician, $studysite, $studynotes, $studydoradread, $studyradreaddate, $studyradreadfindings, $studyetsnellchart, $studyetvergence, $studyettracking, $studysnpchip, $studyaltid, $studyexperimenter);
			DisplayStudy($id, 0, 0, '', '', '', '','','','', false);
			break;
		case 'mergestudies':
			MergeStudies($subjectid, $studyids);
			break;
		case 'movestudytosubject':
			MoveStudyToSubject($studyid, $newuid);
			break;
		case 'movestudytoproject':
			MoveStudyToProject($subjectid, $studyid, $newprojectid);
			break;
		case 'upload':
			Upload($modality, $studyid, $seriesid);
			DisplayStudy($studyid, 0, 0, '', '', '', '','','','', false);
			break;
		case 'deleteconfirm':
			DeleteConfirm($id);
			break;
		case 'delete':
			Delete($id);
			break;
		case 'deleteseries':
			//if (strtoupper($modality) != "MR") {
			DeleteSeries($id, $seriesid, $modality);
			DisplayStudy($id, 0, 0, '', '', '', '','','','', false);
			//}
			break;
		case 'editseries':
			if (strtoupper($modality) != "MR") {
				EditGenericSeries($seriesid, $modality);
			}
			break;
		case 'updateseries':
			if (strtoupper($modality) != "MR") {
				UpdateGenericSeries($seriesid, $modality, $protocol, $series_datetime, $notes);
			}
			break;
		case 'addseries':
			if (strtoupper($modality) != "MR") {
				AddGenericSeries($id, $modality, $series_num, $protocol, $series_datetime, $notes);
			}
			elseif ($modality == "MR") {
				AddMRSeries($id);
			}
			DisplayStudy($id, $audit, $fix, $search_pipelineid, $search_name, $search_compare, $search_value, $search_type, $search_swversion, $imgperline, false);
			break;
		case 'rateseries':
			AddRating($seriesid, $modality, $value, $username);
			DisplayStudy($id, "", "", "", "", "", '','','','', false);
			break;
		case 'hidemrseries':
			HideMRSeries($seriesid);
			DisplayStudy($id, "", "", "", "", "", '','','','', false);
			break;
		case 'unhidemrseries':
			UnhideMRSeries($seriesid);
			DisplayStudy($id, "", "", "", "", "", '','','','', false);
			break;
		case 'resetqa':
			ResetQA($seriesid);
			DisplayStudy($id, "", "", "", "", "", '','','','', false);
			break;
		case 'displayfiles':
			DisplayStudy($id, $audit, $fix, $search_pipelineid, $search_name, $search_compare, $search_value, $search_type, $search_swversion, $imgperline, true);
			break;
		default:
			DisplayStudy($id, $audit, $fix, $search_pipelineid, $search_name, $search_compare, $search_value, $search_type, $search_swversion, $imgperline, false);
	}
	
	
	/* ------------------------------------ functions ------------------------------------ */

	
	/* -------------------------------------------- */
	/* ------- AddGenericSeries ------------------- */
	/* -------------------------------------------- */
	function AddRating($seriesid, $modality, $value, $username) {
		$sqlstring = "select user_id from users where username = '$username'";
		//PrintSQL($sqlstring);
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$user_id = $row['user_id'];
		
		$sqlstring = "insert into manual_qa (series_id, modality, rater_id, value) values ($seriesid, '$modality', $user_id, $value) on duplicate key update value = $value";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
	}


	/* -------------------------------------------- */
	/* ------- UpdateStudy ------------------------ */
	/* -------------------------------------------- */
	function UpdateStudy($id, $modality, $studydatetime, $studyageatscan, $studyheight, $studyweight, $studytype, $studyoperator, $studyphysician, $studysite, $studynotes, $studydoradread, $studyradreaddate, $studyradreadfindings, $studyetsnellchart, $studyetvergence, $studyettracking, $studysnpchip, $studyaltid, $studyexperimenter) {
		/* perform data checks */
		$modality = mysqli_real_escape_string($GLOBALS['linki'], $modality);
		$studydatetime = mysqli_real_escape_string($GLOBALS['linki'], $studydatetime);
		$studyageatscan = mysqli_real_escape_string($GLOBALS['linki'], $studyageatscan);
		$studyheight = mysqli_real_escape_string($GLOBALS['linki'], $studyheight);
		$studyweight = mysqli_real_escape_string($GLOBALS['linki'], $studyweight);
		$studytype = mysqli_real_escape_string($GLOBALS['linki'], $studytype);
		$studyoperator = mysqli_real_escape_string($GLOBALS['linki'], $studyoperator);
		$studyphysician = mysqli_real_escape_string($GLOBALS['linki'], $studyphysician);
		$studysite = mysqli_real_escape_string($GLOBALS['linki'], $studysite);
		$studynotes = mysqli_real_escape_string($GLOBALS['linki'], $studynotes);
		$studyradreaddate = mysqli_real_escape_string($GLOBALS['linki'], $studyradreaddate);
		$studyradreadfindings = mysqli_real_escape_string($GLOBALS['linki'], $studyradreadfindings);
		$studyetsnellchart = mysqli_real_escape_string($GLOBALS['linki'], $studyetsnellchart);
		$studyetvergence = mysqli_real_escape_string($GLOBALS['linki'], $studyetvergence);
		$studyettracking = mysqli_real_escape_string($GLOBALS['linki'], $studyettracking);
		$studysnpchip = mysqli_real_escape_string($GLOBALS['linki'], $studysnpchip);
		$studyaltid = mysqli_real_escape_string($GLOBALS['linki'], $studyaltid);
		$studyexperimenter = mysqli_real_escape_string($GLOBALS['linki'], $studyexperimenter);
		
		/* update the user */
		$sqlstring = "update studies set study_experimenter = '$studyexperimenter', study_alternateid = '$studyaltid', study_modality = '$modality', study_datetime = '$studydatetime', study_ageatscan = '$studyageatscan', study_height = '$studyheight', study_weight = '$studyweight', study_type = '$studytype', study_operator = '$studyoperator', study_performingphysician = '$studyphysician', study_site = '$studysite', study_notes = '$studynotes', study_doradread = '$studydoradread', study_radreaddate = '$studyradreaddate', study_radreadfindings = '$studyradreadfindings', study_etsnellenchart = '$studyetsnellchart', study_etvergence = '$studyetvergence', study_ettracking = '$studyettracking', study_snpchip = '$studysnpchp', study_status = 'complete' where study_id = $id";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		
		?><div align="center"><span class="message">Study updated</span></div><br><br><?
	}


	/* -------------------------------------------- */
	/* ------- AddGenericSeries ------------------- */
	/* -------------------------------------------- */
	function AddGenericSeries($id, $modality, $series_num, $protocol, $series_datetime, $notes) {
		$protocol = mysqli_real_escape_string($GLOBALS['linki'], $protocol);
		$notes = mysqli_real_escape_string($GLOBALS['linki'], $notes);
		$series_datetime = mysqli_real_escape_string($GLOBALS['linki'], $series_datetime);

		$sqlstring = "insert into " . strtolower($modality) . "_series (study_id, series_num, series_datetime, series_protocol, series_notes, series_createdby) values ($id, '$series_num', '$series_datetime', '$protocol', '$notes', '$username')";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		
		?><div align="center"><span class="message">Series Added</span></div><br><br><?
	}

	
	/* -------------------------------------------- */
	/* ------- AddGenericSeries ------------------- */
	/* -------------------------------------------- */
	function MergeStudies($subjectid, $studyids) {
		$subjectid = mysqli_real_escape_string($GLOBALS['linki'], $subjectid);
		$studyids = mysqli_real_escape_array($studyids);

		$sqlstring = "select uid from subjects where subject_id = $subjectid";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$uid = $row['uid'];
		
		$urllist[$uid] = "subjects.php?id=$subjectid";
		NavigationBar("$uid", $urllist);
		
		if (!is_numeric($subjectid)) {
			echo "Invalid subject ID [$subjectid]";
		}
		
		$lowestStudyNum = 0;
		$newstudyid = 0;
		$basemodality = "";
		foreach ($studyids as $studyid) {
			if (is_numeric($studyid)) {
				list($path, $uid, $studynum, $studyid, $subjectid, $modality) = GetDataPathFromStudyID($studyid);
				
				/* get the lowest study number */
				if ($lowestStudyNum == 0) {
					$lowestStudyNum = $studynum;
					$newstudyid = $studyid;
				}
				else {
					if ($studynum < $lowestStudyNum) {
						$lowestStudyNum = $studynum;
						$newstudyid = $studyid;
					}
				}
				
				/* check if the modalities are the same */
				if ($basemodality == "") {
					$basemodality = $modality;
				}
				if ($basemodality != $modality) {
					echo "Study modalities do not all match. You can't merge studies with different modalities<br>";
					return;
				}
				
			}
		}
		
		$basemodality = strtolower($basemodality);
		
		if ($basemodality == "") {
			echo "Modality is blank. Can't merge studies with blank modalities<br>";
			return;
		}
		/* get largest series number from the new study */
		$sqlstring = "select max(series_num) 'maxseries' from $basemodality"."_series where study_id = $newstudyid";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$maxseries = $row['maxseries'];
		
		echo "<b>Moving all studies to study ID [$newstudyid] Num [$lowestStudyNum]. Moving data into [" . $GLOBALS['cfg']['archivedir'] . "/$uid/$lowestStudyNum]</b><br>";
		
		echo "<ol>";
		/* step 2 - Move all database series to the new study */
		$newseries = $maxseries + 1;
		foreach ($studyids as $studyid) {
			if ((is_numeric($studyid)) && ($studyid != $newstudyid)) {
				list($studypath, $uid, $studynum, $studyid, $subjectid, $modality) = GetDataPathFromStudyID($studyid);
				$modality = strtolower($modality);

				$sqlstring = "select * from $modality"."_series where study_id = $studyid";
				$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$seriesid = $row[$modality."series_id"];
				
					list($seriespath, $seriesuid, $seriesstudynum, $seriesstudyid, $seriessubjectid) = GetDataPathFromSeriesID($seriesid, $modality);
					$systemstring = "mkdir -p " . $GLOBALS['cfg']['archivedir'] . "/$uid/$lowestStudyNum/$newseries; mv -v $seriespath/* " . $GLOBALS['cfg']['archivedir'] . "/$uid/$lowestStudyNum/$newseries/";
					echo "<li>Moving data [<tt style='color:darkred'>$systemstring</tt>]";
					echo shell_exec($systemstring);

					$sqlstring = "update $modality"."_series set study_id = $newstudyid, series_num = $newseries where $modality"."series_id = $seriesid";
					echo "<li>Changing database entry for <b>series</b> [$sqlstring]";
					$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
					$newseries++;
				}
				$sqlstring = "delete from studies where study_id = $studyid";
				echo "<li>Deleting database entry for <b>study</b> [$sqlstring]";
				$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			}
		}
		echo "</ol>";
	}
	
	
	/* -------------------------------------------- */
	/* ------- HideMRSeries ----------------------- */
	/* -------------------------------------------- */
	function HideMRSeries($seriesid) {
		$seriesid = mysqli_real_escape_string($GLOBALS['linki'], $seriesid);
		
		if ((is_numeric($seriesid)) && ($seriesid != "")) {
			$sqlstring = "update mr_series set ishidden = 1 where mrseries_id = $seriesid";
			$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			?><div align="center"><span class="message">Series hidden</span></div><br><br><?
		}
		else {
			?><div align="center"><span class="message">Invalid MR series</span></div><br><br><?
		}
	}

	
	/* -------------------------------------------- */
	/* ------- UnhideMRSeries ----------------------- */
	/* -------------------------------------------- */
	function UnhideMRSeries($seriesid) {
		$seriesid = mysqli_real_escape_string($GLOBALS['linki'], $seriesid);
		
		if ((is_numeric($seriesid)) && ($seriesid != "")) {
			$sqlstring = "update mr_series set ishidden = 0 where mrseries_id = $seriesid";
			$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			?><div align="center"><span class="message">Series unhidden</span></div><br><br><?
		}
		else {
			?><div align="center"><span class="message">Invalid MR series</span></div><br><br><?
		}
	}


	/* -------------------------------------------- */
	/* ------- UpdateGenericSeries ---------------- */
	/* -------------------------------------------- */
	function UpdateGenericSeries($seriesid, $modality, $protocol, $series_datetime, $notes) {
		$protocol = mysqli_real_escape_string($GLOBALS['linki'], $protocol);
		$notes = mysqli_real_escape_string($GLOBALS['linki'], $notes);
		$series_datetime = mysqli_real_escape_string($GLOBALS['linki'], $series_datetime);
		//echo "hello!";
		$sqlstring = "update " . strtolower($modality) . "_series set series_datetime = '$series_datetime', series_protocol = '$protocol', series_notes  = '$notes' where " . strtolower($modality) . "series_id = $seriesid";
		//echo "$sqlstring<br>";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		
		?><div align="center"><span class="message">Series Updated</span></div><br><br><?
	}
	
	
	/* -------------------------------------------- */
	/* ------- DeleteConfirm ---------------------- */
	/* -------------------------------------------- */
	function DeleteConfirm($id) {
		$sqlstring = "select a.study_num, a.study_datetime, c.uid from studies a left join enrollment b on a.enrollment_id = b.enrollment_id left join subjects c on b.subject_id = c.subject_id where a.study_id = $id";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$study_num = $row['study_num'];
		$study_datetime = $row['study_datetime'];
		$uid = $row['uid'];
		
		?>
		<div align="center" class="message">
		<b>Are you absolutely sure you want to delete this study?</b><img src="images/chili24.png">
		<br><br>
		<span class="uid"><?=$uid?><?=$study_num?></span> collected on <?=$study_datetime?>
		<br><br>
		<table width="100%">
			<tr>
				<td align="center" width="50%"><FORM><INPUT TYPE="BUTTON" VALUE="Back" ONCLICK="history.go(-1)"></FORM></td>
				<form method="post" action="studies.php">
				<input type="hidden" name="action" value="delete">
				<input type="hidden" name="id" value="<?=$id?>">
				<td align="center"><input type="submit" value="Yes, delete it"</td>
				</form>
			</tr>
		</table>		
		</div>
		<br><br>
		<?
	}
	
	
	/* -------------------------------------------- */
	/* ------- Delete ----------------------------- */
	/* -------------------------------------------- */
	function Delete($id) {
		$sqlstring = "select a.study_num, a.study_datetime, c.uid from studies a left join enrollment b on a.enrollment_id = b.enrollment_id left join subjects c on b.subject_id = c.subject_id where a.study_id = $id";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$study_num = $row['study_num'];
		$study_datetime = $row['study_datetime'];
		$uid = $row['uid'];
		
		$archivepath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num";
		
		if (is_dir($archivepath)) {
			$datetime = time();
			rename($archivepath, $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num-$datetime");
		}
		
		/* get all existing info about this subject */
		$sqlstring = "delete from studies where study_id = $id";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		?>
		<div align="center" class="message">Study deleted</div>
		<?
	}


	/* -------------------------------------------- */
	/* ------- MoveStudyToProject ----------------- */
	/* -------------------------------------------- */
	function MoveStudyToProject($subjectid, $studyid, $newprojectid) {
		/* get the subject project id which has this subject and the new projectid */
		$sqlstring = "select * from enrollment where project_id = $newprojectid and subject_id = $subjectid";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$enrollmentid = $row['enrollment_id'];
		
		$sqlstring = "update studies set enrollment_id = $enrollmentid where study_id = $studyid";
		echo $sqlstring;
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		?><div align="center"><span class="message">Study moved to project <?=$newprojectid?></span></div><br><br><?
	}


	/* -------------------------------------------- */
	/* ------- Upload ----------------------------- */
	/* -------------------------------------------- */
	function Upload($modality, $studyid, $seriesid) {
		$modality = strtolower($modality);
		
		$sqlstring = "select a.uid, c.study_num, d.series_num from subjects a left join enrollment b on a.subject_id = b.subject_id left join studies c on c.enrollment_id = b.enrollment_id left join $modality" . "_series d on d.study_id = c.study_id where d.$modality" . "series_id = $seriesid";
		//echo "[[$sqlstring]]";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$uid = $row['uid'];
		$studynum = $row['study_num'];
		$seriesnum = $row['series_num'];
		
		$savepath = $GLOBALS['cfg']['archivedir'] . "/$uid/$studynum/$seriesnum/$modality";
		
		if (!file_exists($savepath)) {
			mkdir($savepath,0777,true);
			$systemstring = "chmod -R 777 " . $GLOBALS['cfg']['archivedir'] . "/$uid";
			echo shell_exec($systemstring);
		}
		
		/* go through all the files and save them */
		foreach ($_FILES['files']['name'] as $i => $name) {
			if (move_uploaded_file($_FILES['files']['tmp_name'][$i], "$savepath/$name")) {
				//echo "Received [" . $_FILES['files']['tmp_name'][$i] ." --> $savepath/$name] " . $_FILES['files']['size'][$i] . " bytes<br>";
				chmod("$savepath/$name", 0777);
			}
			else {
				echo "<br>An error occured moving " . $_FILES['files']['tmp_name'][$i] . " to [" . $_FILES['files']['error'][$i] . "]<br>";
			}
		}
		
		/* update the DB with the files that were uploaded */
		$filecount = count(glob("$savepath/*"));
		$filesize = GetDirectorySize($savepath);
		
		$sqlstring = "update $modality" . "_series set series_numfiles = $filecount, series_size = $filesize where $modality" . "series_id = $seriesid";
		//echo "$sqlstring";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
	}

	
	/* -------------------------------------------- */
	/* ------- GetDirectoySize -------------------- */
	/* -------------------------------------------- */
	/* functions must be at the end of the script, classes at the beginning, eh? */
	function GetDirectorySize($dirname) {
		// open the directory, if the script cannot open the directory then return folderSize = 0
		$dir_handle = opendir($dirname);
		if (!$dir_handle)
			return 0;

		$folderSize = 0;
		
		// traversal for every entry in the directory
		while ($file = readdir($dir_handle)){
			// ignore '.' and '..' directory
			if  ($file  !=  "."  &&  $file  !=  "..")  {
				/* if this is a directory then go recursive! */
				if (is_dir($dirname."/".$file)) {
					$folderSize += GetDirectorySize($dirname.'/'.$file);
				} else {
					$folderSize += filesize($dirname."/".$file);
				}
			}
		}
		// close the directory
		closedir($dir_handle);
		// return $dirname folder size
		return $folderSize ;
	}

	
	/* -------------------------------------------- */
	/* ------- DisplayStudyForm ------------------- */
	/* -------------------------------------------- */
	function DisplayStudyForm($id) {
		if ($id == "") {
			?><div class="staticmessage">Invalid or blank study ID [<?=$id?>]</div><?
		}

		$sqlstring = "select a.*, c.uid, c.subject_id, d.project_id, d.project_name from studies a left join enrollment b on a.enrollment_id = b.enrollment_id left join subjects c on b.subject_id = c.subject_id left join projects d on b.project_id = d.project_id where study_id = $id";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$enrollmentid = $row['enrollment_id'];
		$equipmentid = $row['equipment_id'];
		$study_num = $row['study_num'];
		$study_alternateid = $row['study_alternateid'];
		$study_modality = $row['study_modality'];
		$study_datetime = $row['study_datetime'];
		$study_ageatscan = $row['study_ageatscan'];
		$study_height = $row['study_height'];
		$study_weight = $row['study_weight'];
		$study_type = $row['study_type'];
		$study_operator = $row['study_operator'];
		$study_physician = $row['study_performingphysician'];
		$study_site = $row['study_site'];
		$study_notes = $row['study_notes'];
		$study_doradread = $row['study_doradread'];
		$study_radreaddate = $row['study_radreaddate'];
		$study_radreadfindings = $row['study_radreadfindings'];
		$study_etsnellenchart = $row['study_etsnellenchart'];
		$study_etvergence = $row['study_etvergence'];
		$study_ettracking = $row['study_ettracking'];
		$study_snpchip = $row['study_snpchip'];
		$study_experimenter = $row['study_experimenter'];
		$uid = $row['uid'];
		$subjectid = $row['subject_id'];
		$projectid = $row['project_id'];
		$projectname = $row['project_name'];

		$urllist[$projectname] = "projects.php?id=$projectid";
		$urllist[$uid] = "subjects.php?id=$subjectid";
		$urllist[$study_num] = "studies.php?id=$id";
		NavigationBar("$uid$study_num", $urllist);
		
		$formaction = "update";
		$formtitle = "Updating study $study_num";
		$submitbuttonlabel = "Update";
		
		if (($study_radreaddate == "") || ($study_radreaddate == "0000-00-00 00:00:00")) { $study_radreaddate = date('Y-m-d h:i:s a'); }
		
	?>
		<div align="center">
		<table class="entrytable">
			<form method="post" action="studies.php">
			<input type="hidden" name="action" value="<?=$formaction?>">
			<input type="hidden" name="id" value="<?=$id?>">
			<tr>
				<td class="heading" colspan="2" align="center">
					<b><?=$formtitle?></b>
				</td>
			</tr>
			<tr>
				<td class="label">Modality</td>
				<td>
					<!--<input type="text" name="modality" value="<?=$study_modality?>">-->
					<select name="modality">
					<?
						$sqlstring = "select * from modalities order by mod_desc";
						$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$mod_code = $row['mod_code'];
							$mod_desc = $row['mod_desc'];
							if ($mod_code == $study_modality) { $selected = "selected"; } else { $selected = ""; }
							?>
							<option value="<?=$mod_code?>" <?=$selected?>><?=$mod_desc?></option>
							<?
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">Date/time</td>
				<td><input type="text" name="studydatetime" value="<?=$study_datetime?>" required></td>
			</tr>
			<tr>
				<td class="label">Age at scan</td>
				<td><input type="text" name="studyageatscan" value="<?=$study_ageatscan?>"> <span class="tiny">years, with decimals</span></td>
			</tr>
			<tr>
				<td class="label">Height</td>
				<td><input type="text" name="studyheight" value="<?=$study_height?>" size="4"> <span class="tiny">m</span></td>
			</tr>
			<tr>
				<td class="label">Weight</td>
				<td><input type="text" name="studyweight" value="<?=$study_weight?>" size="4"> <span class="tiny">kg</span></td>
			</tr>
			<tr>
				<td class="label">Visit type</td>
				<td><input type="text" name="studytype" value="<?=$study_type?>"></td>
			</tr>
			<tr>
				<td class="label">Operator</td>
				<td><input type="text" name="studyoperator" value="<?=$study_operator?>"></td>
			</tr>
			<tr>
				<td class="label">Performing physician</td>
				<td><input type="text" name="studyphysician" value="<?=$study_physician?>"></td>
			</tr>
			<tr>
				<td class="label">Site</td>
				<td><input type="text" name="studysite" value="<?=$study_site?>"></td>
			</tr>
			<tr>
				<td class="label">Notes</td>
				<td><textarea name="studynotes" cols="30" rows="5"><?=$study_notes?></textarea></td>
			</tr>
			<? if (strtolower($study_modality) == "mr") { ?>
				<tr>
					<td class="label">Radiological read done?</td>
					<td><input type="checkbox" name="studydoradread" value="1" <? if ($study_doradread) {echo "checked";} ?>></td>
				</tr>
				<tr>
					<td class="label">Radiological read date</td>
					<td><input type="text" name="studyradreaddate" value="<?=$study_radreaddate?>"></td>
				</tr>
				<tr>
					<td class="label">Radiological read findings</td>
					<td><input type="text" name="studyradreadfindings" value="<?=$study_radreadfindings?>"></td>
				</tr>
			<? } elseif (strtolower($study_modality) == "et") { ?>
				<tr>
					<td class="label">Snellen chart</td>
					<td><input type="text" size="8" name="studyetsnellchart" value="<?=$study_etsnellenchart?>"></td>
				</tr>
				<tr>
					<td class="label">Vergence</td>
					<td><input type="text" name="studyetvergence" value="<?=$study_etvergence?>"></td>
				</tr>
				<tr>
					<td class="label">Tracking</td>
					<td><input type="text" name="studyettracking" value="<?=$study_ettracking?>"></td>
				</tr>
			<? } elseif (strtolower($study_modality) == "snp") { ?>
				<tr>
					<td class="label">SNP chip</td>
					<td><input type="text" size="35" name="studysnpchip" value="<?=$study_snpchip?>"></td>
				</tr>
			<? } ?>
			<tr>
				<td class="label">Alternate ID</td>
				<td><input type="text" name="studyaltid" value="<?=$study_alternateid?>"></td>
			</tr>
			<tr>
				<td class="label">Experimenter</td>
				<td><input type="text" name="studyexperimenter" <? if ($study_experimenter == "") {echo "style='color:red'"; } ?> value="<? if ($study_experimenter != "") { echo $study_experimenter; } else { echo $GLOBALS['username']; } ?>"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="<?=$submitbuttonlabel?>">
				</td>
			</tr>
			</form>
		</table>
		</div>
	<?
	}

	/* -------------------------------------------- */
	/* ------- DisplayStudy ----------------------- */
	/* -------------------------------------------- */
	function DisplayStudy($id, $audit, $fix, $search_pipelineid, $search_name, $search_compare, $search_value, $search_type, $search_swversion, $imgperline, $displayfiles) {
		
		if ($id == "") {
			?><div class="staticmessage">Invalid or blank study ID [<?=$id?>]</div><?
		}
	
		$id = mysqli_real_escape_string($GLOBALS['linki'], $id);
		
		$sqlstring = "select a.*, c.uid, d.project_costcenter, d.project_id, d.project_name, c.subject_id from studies a left join enrollment b on a.enrollment_id = b.enrollment_id left join subjects c on b.subject_id = c.subject_id left join projects d on b.project_id = d.project_id where a.study_id = '$id'";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$study_id = $row['study_id'];
			$enrollmentid = $row['enrollment_id'];
			//$equipmentid = $row['equipment_id'];
			$study_num = $row['study_num'];
			$study_alternateid = $row['study_alternateid'];
			$study_modality = $row['study_modality'];
			$study_datetime = $row['study_datetime'];
			$study_ageatscan = $row['study_ageatscan'];
			$study_height = $row['study_height'];
			$study_weight = $row['study_weight'];
			$study_type = $row['study_type'];
			$study_operator = $row['study_operator'];
			$study_physician = $row['study_performingphysician'];
			$study_site = $row['study_site'];
			$study_notes = $row['study_notes'];
			$study_doradread = $row['study_doradread'];
			$study_radreaddate = $row['study_radreaddate'];
			$study_radreadfindings = $row['study_radreadfindings'];
			$study_etsnellenchart = $row['study_etsnellenchart'];
			$study_etvergence = $row['study_etvergence'];
			$study_ettracking = $row['study_ettracking'];
			$study_snpchip = $row['study_snpchip'];
			$study_status = $row['study_status'];
			$study_alternateid = $row['study_alternateid'];
			$study_experimenter = $row['study_experimenter'];
			$study_desc = $row['study_desc'];
			$study_createdby = $row['study_createdby'];
			$study_createdate = $row['study_createdate'];
			$uid = $row['uid'];
			$subjectid = trim($row['subject_id']);
			$costcenter = $row['project_costcenter'];
			$projectid = $row['project_id'];
			$project_name = $row['project_name'];
			
			$ft1 = floor($study_height/0.3048);
			$ft2 = (($study_height/0.3048)-$ft1)*12;
			$in = number_format($ft2,1);
			
			if (($study_height == 0) || ($study_weight == 0)) {
				$bmi = 0;
			}
			else {
				$bmi = $study_weight / ( $study_height * $study_height);
			}
			
			$study_heightft = "$ft1' $in\"";
		}
		else {
			?>
			Study [<?=$id?>] does not exist
			<?
			return;
		}
		
		if (($subjectid == 0) || ($subjectid == "")) {
			?>
			<span class="staticmessage">Subject ID is not found... unable to display this study because the subject could not be found</span>
			<?
		}

		if ($study_modality == "") {
			$study_modality = "Missing modality"; $class="missing";
		}
		else {
			$sqlstringA = "show tables like '" . strtolower($study_modality) . "_series'";
			$resultA = MySQLiQuery($sqlstringA, __FILE__, __LINE__);
			if (mysqli_num_rows($resultA) > 0) {
				$class = "value";
			}
			else {
				$study_modality = "Invalid modality [$study_modality]"; $class="missing";
			}
		}

		$study_datetime = date("F j, Y g:ia",strtotime($study_datetime));
		$study_radreaddate = date("F j, Y g:ia",strtotime($study_radreaddate));

		/* get privacy information */
		$username = $_SESSION['username'];
		$sqlstring = "select user_id from users where username = '$username'";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$userid = $row['user_id'];

		$sqlstring = "select b.* from user_project a left join projects b on a.project_id = b.project_id where a.project_id = $projectid and a.view_data = 1 and a.user_id = '$userid'";
		//PrintSQL($sqlstring);
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$projectname = $row['project_name'];
				$projectcostcenter = $row['project_costcenter'];
				$dataprojectlist[] = "$projectname ($projectcostcenter)";
			}
			$dataaccess = 1;
		}
		else {
			$dataaccess = 0;
		}
		
		$urllist[$project_name] = "projects.php?id=$projectid";
		$urllist[$uid] = "subjects.php?action=display&id=$subjectid";
		$urllist["Study " . $study_num] = "studies.php?id=$id";
		NavigationBar("$uid$study_num", $urllist, 1, null, $dataaccess, null, $dataprojectlist);

		if (!$dataaccess) {
			echo "You do not have data access to this project. Consult your NiDB administrator";
			return;
		}
		
		/* update the mostrecent table */
		UpdateMostRecent($userid, '', $id);

		?>
		
		<style>
		#preview{
			position:absolute;
			border:1px solid #ccc;
			background:gray;
			padding:0px;
			display:none;
			color:#fff;
			}
		</style>

		<table class="bluerounded">
			<tr>
				<td class="title"><span style="margin-left:15px">Study Information</span>
				</td>
			</tr>
			<tr>
				<td class="body">
					<table class="reviewtable" width="100%">
						<tr>
							<td colspan="2" align="center">
							</td>
						</tr>
						<tr>
							<td class="label">Study number</td>
							<td class="value"><?=$study_num?></td>
						</tr>
						<tr>
							<td class="label">Study ID</td>
							<td class="value"><tt><?=$uid?><?=$study_num?></tt></td>
						</tr>
						<tr>
							<td class="label">Alternate Study ID</td>
							<td class="value"><tt><?=$study_alternateid?></tt></td>
						</tr>
						<tr>
							<td class="label">Modality</td>
							<td class="<?=$class?>"><?=$study_modality?></td>
						</tr>
						<tr>
							<td class="label">Date/time</td>
							<td class="value"><?=$study_datetime?></td>
						</tr>
						<tr>
							<td class="label">Age at scan</td>
							<td class="value"><?=number_format($study_ageatscan,1)?> y</td>
						</tr>
						<tr>
							<td class="label">Height</td>
							<td class="value"><?=number_format($study_height,2)?> m <span class="tiny">(<?=$study_heightft?>)</span></td>
						</tr>
						<tr>
							<td class="label">Weight</td>
							<td class="value"><?=number_format($study_weight,1)?> kg <span class="tiny">(<?=number_format($study_weight*2.20462,1)?> lbs)</span></td>
						</tr>
						<tr>
							<td class="label">BMI</td>
							<td class="value"><?=number_format($bmi,1)?> <span class="tiny">kg/m<sup>2</sup></span></td>
						</tr>
						<tr>
							<td class="label">Visit type</td>
							<td class="value"><?=$study_type?></td>
						</tr>
						<tr>
							<td class="label">Description</td>
							<td class="value"><?=$study_desc?></td>
						</tr>
						<tr>
							<td class="label">Operator</td>
							<td class="value"><?=$study_operator?></td>
						</tr>
						<tr>
							<td class="label">Performing physician</td>
							<td class="value"><?=$study_physician?></td>
						</tr>
						<tr>
							<td class="label">Site</td>
							<td class="value"><?=$study_site?></td>
						</tr>
						<tr>
							<td class="label">Notes</td>
							<td class="value"><?=$study_notes?></td>
						</tr>
						<? if (strtolower($study_modality) == "mr") { ?>
							<tr>
								<td class="label">Radiological read?</td>
								<td class="value"><? if ($study_doradread) { echo "Yes"; } else { echo "No"; } ?></td>
							</tr>
							<tr>
								<td class="label">Rad. read date</td>
								<td class="value"><?=$study_radreaddate?></td>
							</tr>
							<tr>
								<td class="label">Rad. read findings</td>
								<td class="value"><?=$study_radreadfindings?></td>
							</tr>
						<? } elseif (strtolower($study_modality) == "et") { ?>
							<tr>
								<td class="label">Snellen chart</td>
								<td class="value"><?=$study_etsnellenchart?></td>
							</tr>
							<tr>
								<td class="label">Vergence</td>
								<td class="value"><?=$study_etvergence?></td>
							</tr>
							<tr>
								<td class="label">Tracking</td>
								<td class="value"><?=$study_ettracking?></td>
							</tr>
						<? } elseif (strtolower($study_modality) == "snp") { ?>
							<tr>
								<td class="label">SNP chip</td>
								<td class="value"><?=$study_snpchip?></td>
							</tr>
						<? } ?>
						<tr>
							<td class="label">Status</td>
							<td class="value"><?=$study_status?></td>
						</tr>
						<tr>
							<td class="label">Created by</td>
							<td class="value"><?=$study_createdby?></td>
						</tr>
						<tr>
							<td class="label">Import/upload date</td>
							<td class="value"><?=$study_createdate?></td>
						</tr>
						<tr>
							<td class="label">Experimenter</td>
							<td class="value"><?=$study_experimenter?></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<br>
								<a href="studies.php?action=editform&id=<?=$id?>" class="linkbutton">Edit</a>
							</td>
						</tr>
					</table>

					<? if ($GLOBALS['isadmin']) { ?>
						<details>
							<summary style="color:darkred" class="tiny">Admin Functions</summary>
							<div style="border: solid 1px #aaa; border-radius: 5px; padding: 5px">
						
							<a href="studies.php?action=deleteconfirm&id=<?=$id?>" class="redlinkbutton">Delete</a>
							<form action="studies.php" method="post">
							<input type="hidden" name="studyid" value="<?=$study_id?>">
							<input type="hidden" name="action" value="movestudytosubject">
							<input type="hidden" name="enrollmentid" value="<?=$enrollmentid?>">
							<br>
							<span align="center">Move study to <b>subject</b></span> <input type="text" size="10" name="newuid" id="newuid" placeholder="New UID">
							<input type="submit" value="Move" style="background-color: #FF552A; color: white; border: 1px solid #000;">
							</form>
							<form action="studies.php" method="post">
							<input type="hidden" name="studyid" value="<?=$study_id?>">
							<input type="hidden" name="action" value="movestudytoproject">
							<input type="hidden" name="enrollmentid" value="<?=$enrollmentid?>">
							<input type="hidden" name="subjectid" value="<?=$subjectid?>">
							<br>
							<span align="center">Move study to <b>project</b></span>
							<select name="newprojectid">
							<?
								$sqlstringB = "select a.project_id, b.project_name, b.project_costcenter from enrollment a left join projects b on a.project_id = b.project_id where a.subject_id = $subjectid";
								echo $sqlstringB;
								$resultB = MySQLiQuery($sqlstringB, __FILE__, __LINE__);
								while ($rowB = mysqli_fetch_array($resultB, MYSQLI_ASSOC)) {
									$project_id = $rowB['project_id'];
									$project_name = $rowB['project_name'];
									$project_costcenter = $rowB['project_costcenter'];
									?>
									<option value="<?=$project_id?>"><?=$project_name?> (<?=$project_costcenter?>)</option>
									<?
								}
							?>
							</select>
							<input type="submit" value="Move" style="background-color: #FF552A; color: white; border: 1px solid #000;">
							</form>
							
							<br>
							
							<? if (!$audit) { ?>
							<a href="studies.php?id=<?=$id?>&audit=1">Perform file audit</a> - Compares all dicom files to the nidb database entries. Can be very slow<br><br>
							<? } else { ?>
							<a href="studies.php?id=<?=$id?>&audit=1&fix=1">Fix file errors</a> - Removes duplicates and errant files, resets file count in nidb database. Can be very slow<br><br>
							</div>
						</details>
					<? } ?>
					
					<? } ?>				
				</td>
			</tr>
		</table>

		<br>
		<?
		if ($displayfiles == true) {
			?><a href="studies.php?id=<?=$id?>">Normal View</a><br><br><?
			$studypath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num";
			DisplayFileSeries($studypath);
		}
		else {
			?><a href="studies.php?id=<?=$id?>&action=displayfiles" style="font-size:8pt">View files</a><?
			if ($study_modality == "MR") {
				DisplayMRSeries($id, $study_num, $uid, $audit, $fix);
			}
			elseif ($study_modality == "CT") {
				DisplayCTSeries($id, $study_num, $uid, $audit, $fix);
			}
			else {
				DisplayGenericSeries($id, $study_modality);
			}
			?>
			<br><br><br><br><br><br>
			<?
				DisplayAnalyses($id, $search_pipelineid, $search_name, $search_compare, $search_value, $search_type, $search_swversion, $imgperline);
			?>
			<br><br><br><br><br><br>
			<?
		}
	}


	/* -------------------------------------------- */
	/* ------- DisplayMRSeries -------------------- */
	/* -------------------------------------------- */
	function DisplayMRSeries($id, $study_num, $uid, $audit, $fix) {
		if ($id == "") {
			?><div class="staticmessage">Invalid or blank series ID [<?=$id?>]</div><?
		}
	
		$colors = GenerateColorGradient();

		/* get the subject information */
		$sqlstring = "select * from subjects a left join enrollment b on a.subject_id = b.subject_id left join studies c on b.enrollment_id = c.enrollment_id where c.study_id = $id";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$dbsubjectname = $row['name'];
			$dbsubjectdob = $row['birthdate'];
			$dbsubjectsex = $row['gender'];
			$dbstudydatetime = $row['study_datetime'];
		}
		else {
			echo "$sqlstring<br>";
		}

		/* get the movement & SNR stats by sequence name */
		$sqlstring2 = "SELECT b.series_sequencename, max(a.move_maxx) 'maxx', min(a.move_minx) 'minx', max(a.move_maxy) 'maxy', min(a.move_miny) 'miny', max(a.move_maxz) 'maxz', min(a.move_minz) 'minz', avg(a.pv_snr) 'avgpvsnr', avg(a.io_snr) 'avgiosnr', std(a.pv_snr) 'stdpvsnr', std(a.io_snr) 'stdiosnr', min(a.pv_snr) 'minpvsnr', min(a.io_snr) 'miniosnr', max(a.pv_snr) 'maxpvsnr', max(a.io_snr) 'maxiosnr', min(a.motion_rsq) 'minmotion', max(a.motion_rsq) 'maxmotion', avg(a.motion_rsq) 'avgmotion', std(a.motion_rsq) 'stdmotion' FROM mr_qa a left join mr_series b on a.mrseries_id = b.mrseries_id where a.io_snr > 0 group by b.series_sequencename";
		//echo "$sqlstring2<br>";
		$result2 = MySQLiQuery($sqlstring2, __FILE__, __LINE__);
		while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
			$sequence = $row2['series_sequencename'];
			$pstats[$sequence]['rangex'] = abs($row2['minx']) + abs($row2['maxx']);
			$pstats[$sequence]['rangey'] = abs($row2['miny']) + abs($row2['maxy']);
			$pstats[$sequence]['rangez'] = abs($row2['minz']) + abs($row2['maxz']);
			$pstats[$sequence]['avgpvsnr'] = $row2['avgpvsnr'];
			$pstats[$sequence]['stdpvsnr'] = $row2['stdpvsnr'];
			$pstats[$sequence]['minpvsnr'] = $row2['minpvsnr'];
			$pstats[$sequence]['maxpvsnr'] = $row2['maxpvsnr'];
			
			$pstats[$sequence]['avgiosnr'] = $row2['avgiosnr'];
			$pstats[$sequence]['stdiosnr'] = $row2['stdiosnr'];
			$pstats[$sequence]['miniosnr'] = $row2['miniosnr'];
			$pstats[$sequence]['maxiosnr'] = $row2['maxiosnr'];

			$pstats[$sequence]['avgmotion'] = $row2['avgmotion'];
			$pstats[$sequence]['stdmotion'] = $row2['stdmotion'];
			$pstats[$sequence]['minmotion'] = $row2['minmotion'];
			$pstats[$sequence]['maxmotion'] = $row2['maxmotion'];
			
			if ($row2['stdiosnr'] != 0) {
				$pstats[$sequence]['maxstdiosnr'] = ($row2['avgiosnr'] - $row2['miniosnr'])/$row2['stdiosnr'];
			} else { $pstats[$sequence]['maxstdiosnr'] = 0; }
			if ($row2['stdpvsnr'] != 0) {
				$pstats[$sequence]['maxstdpvsnr'] = ($row2['avgpvsnr'] - $row2['minpvsnr'])/$row2['stdpvsnr'];
			} else { $pstats[$sequence]['maxstdpvsnr'] = 0; }
			if ($row2['stdmotion'] != 0) {
				$pstats[$sequence]['maxstdmotion'] = ($row2['avgmotion'] - $row2['minmotion'])/$row2['stdmotion'];
			} else { $pstats[$sequence]['maxstdmotion'] = 0; }
		}
		?>
		
		<script>
			$(function() {
				$( document ).tooltip({show:{effect:'appear'}, hide:{duration:0}});
			});
		</script>
		
		<style type="text/css">
            .edit_inline { background-color: lightyellow; padding-left: 2pt; padding-right: 2pt; }
            .edit_textarea { background-color: lightyellow; }
			textarea.inplace_field { background-color: white; font-family: courier new; font-size: 8pt; border: 1pt solid gray; width: 800px;  }
			input.inplace_field { background-color: white; font-size: 8pt; border: 1pt solid gray; width: 200px;  }
		</style>

		<table class="smallgraydisplaytable" width="100%">
			<thead>
				<tr>
					<th>Series</th>
					<th>Upload Beh</th>
					<th>Protocol</th>
					<th title="Time of the start of the series acquisition">Time</th>
					<th>Notes</th>
					<th title="View movement graph and FFT">QA</th>
					<th title="Analyst ratings and notes">Ratings</th>
					<th title="Total displacement in X direction">X</th>
					<th title="Total displacement in Y direction">Y</th>
					<th title="Total displacement in Z direction">Z</th>
					<th title="Per Voxel SNR (timeseries) - Calculated from the fslstats command">PV<br>SNR</th>
					<th title="Inside-Outside SNR - This calculates the brain signal (center of brain-extracted volume) compared to the average of the volume corners">IO<br>SNR</th>
					<th>Motion R<sup>2</sup></th>
					<!--<th>Sequence</th>-->
					<th>Length<br><span class="tiny">approx.</span></th>
					<th>TR<br><span class="tiny">ms</span></th>
					<th>Voxel size <br><span class="tiny">(x y z)</span></th>
					<th title="Image dimensions in voxels. If 4D image, <i>t</i> dimension will be the number of BOLD reps">Image dims <br><span class="tiny">(x y z t) in voxels</span></th>
					<th>Files</th>
					<th>Beh</th>
					<? if ($GLOBALS['issiteadmin']) { ?>
					<th>Hide</th>
					<th>Reset QA</th>
					<th>Delete series</th>
					<? } ?>
				</tr>
			</thead>
			<tbody>
				<?
					/* just get a list of MR series ids */
					$sqlstring = "select mrseries_id from mr_series where study_id = $id order by series_num";
					$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$mrseriesids[] = $row['mrseries_id'];
					}
				
					/* get the rating information */
					if (count($mrseriesids) < 1) {
						?>
						<tr>
							<td colspan="22" align="center">No series found for this study</td>
						</tr>
						<?
					}
					else {
						$sqlstring3 = "select * from ratings where rating_type = 'series' and data_modality = 'MR' and data_id in (" . implode(',',$mrseriesids) . ")";
						
						$result3 = MySQLiQuery($sqlstring3, __FILE__, __LINE__);
						while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
							$ratingseriesid = $row3['data_id'];
							$ratings[$ratingseriesid][] = $row3['rating_value'];
						}
						//print_r($ratings);
					
						/* get the actual MR series info */
						mysqli_data_seek($result,0);
						$sqlstring = "select * from mr_series where study_id = $id order by series_num";
						$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$mrseries_id = $row['mrseries_id'];
							$series_datetime = date('g:ia',strtotime($row['series_datetime']));
							$protocol = $row['series_protocol'];
							$series_desc = $row['series_desc'];
							$sequence = $row['series_sequencename'];
							$series_num = $row['series_num'];
							$series_tr = $row['series_tr'];
							$series_te = $row['series_te'];
							$series_flip = $row['series_flip'];
							$phasedir = $row['phaseencodedir'];
							$phaseangle = $row['phaseencodeangle'];
							$series_spacingx = $row['series_spacingx'];
							$series_spacingy = $row['series_spacingy'];
							$series_spacingz = $row['series_spacingz'];
							$series_fieldstrength = $row['series_fieldstrength'];
							$img_rows = $row['img_rows'];
							$img_cols = $row['img_cols'];
							$img_slices = $row['img_slices'];
							$bold_reps = $row['bold_reps'];
							$dimN = $row['dimN'];
							$dimX = $row['dimX'];
							$dimY = $row['dimY'];
							$dimZ = $row['dimZ'];
							$dimT = $row['dimT'];
							$numfiles = $row['numfiles'];
							$series_size = $row['series_size'];
							$series_status = $row['series_status'];
							$series_notes = $row['series_notes'];
							$beh_size = $row['beh_size'];
							$numfiles_beh = $row['numfiles_beh'];
							$data_type = $row['data_type'];
							$lastupdate = $row['lastupdate'];
							$image_type = $row['image_type'];
							$image_comments = $row['image_comments'];
							$ishidden = $row['ishidden'];
							
							if ($series_num - $lastseriesnum > 1) {
								$firstmissing = $lastseriesnum+1;
								$lastmissing = $series_num-1;
								if ($firstmissing == $lastmissing) {
									$missingmsg = $firstmissing;
								}
								else {
									$missingmsg = "$firstmissing - $lastmissing";
								}
								?>
								<tr>
									<td colspan="24" align="center" style="border-top: double 3px #FF7F7F; border-bottom: double 3px #FF7F7F; padding:5px">Non-consecutive series numbers. Missing series <?=$missingmsg?></td>
								</tr>
								<?
							}
							
							if (($numfiles_beh == '') || ($numfiles_beh == 0)) {
								/* get the number and size of the beh files */
								$behs = glob($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/beh/*");
								//print_r($behs);
								$numfiles_beh = count($behs);
								$totalsize = 0;
								foreach ($behs as $behfile) {
									$beh_size += filesize($behfile);
								}
								if ($numfiles_beh > 0) {
									$sqlstring5 = "update mr_series set beh_size = '$beh_size', numfiles_beh = '$numfiles_beh' where mrseries_id = $mrseries_id";
									$result5 = MySQLiQuery($sqlstring5, __FILE__, __LINE__);
								}
							}
							
							if ($phasedir == "COL") {
								// A>>P or P>>A
								if ($phaseangle == 0) {
									$phase = "A >> P";
								}
								elseif ((abs($phaseangle) > 3.1) && (abs($phaseangle) < 3.2)) {
									$phase = "P >> A";
								}
								else {
									$phase = "COL";
								}
							}
							else {
								// R>>L or L>>R
								if (($phaseangle > 1.5) && ($phaseangle < 1.6)) {
									$phase = "R >> L";
								}
								elseif (($phaseangle < -1.5) && ($phaseangle > -1.6)) {
									$phase = "L >> R";
								}
								else {
									$phase = "ROW";
								}
							}
							
							$behdir = "";
							if (trim($protocol) == "") {
								$protocol = "(blank)";
							}
							if (($bold_reps > 1) || ($dimT > 1)) {
								$scanlengthsec = ($series_tr * max($bold_reps, $dimT))/1000.0;
							}
							else {
								$scanlengthsec = ($series_tr * $numfiles)/1000.0;
							}
							if (floor($scanlengthsec/60.0) > 0) {
								$scanlength = floor($scanlengthsec/60.0) . "m " . sprintf("%02d",round(fmod($scanlengthsec,60.0))) . "s";
							}
							else {
								$scanlength = sprintf("%0.2f",fmod($scanlengthsec,60.0)) . "s";
							}
							
							if ( (($dimT > 1) || ($bold_reps > 1)) && ($numfiles_beh < 1)) { $behcolor = "#FFAA7F"; } else { $behcolor = ""; }
							if ($numfiles_beh < 1) { $numfiles_beh = "-"; }

							$thumbpath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/thumb.png";
							$gifthumbpath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/thumb.gif";
							$realignpath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/MotionCorrection.txt";

							$sqlstring2 = "select * from mr_qa where mrseries_id = $mrseries_id";
							$result2 = MySQLiQuery($sqlstring2, __FILE__, __LINE__);
							$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
							$iosnr = $row2['io_snr'];
							$pvsnr = $row2['pv_snr'];
							$move_minx = $row2['move_minx'];
							$move_miny = $row2['move_miny'];
							$move_minz = $row2['move_minz'];
							$move_maxx = $row2['move_maxx'];
							$move_maxy = $row2['move_maxy'];
							$move_maxz = $row2['move_maxz'];
							$acc_minx = $row2['acc_minx'];
							$acc_miny = $row2['acc_miny'];
							$acc_minz = $row2['acc_minz'];
							$acc_maxx = $row2['acc_maxx'];
							$acc_maxy = $row2['acc_maxy'];
							$acc_maxz = $row2['acc_maxz'];
							$motion_rsq = $row2['motion_rsq'];
							$rangex = abs($move_minx) + abs($move_maxx);
							$rangey = abs($move_miny) + abs($move_maxy);
							$rangez = abs($move_minz) + abs($move_maxz);
							$rangex2 = abs($acc_minx) + abs($acc_maxx);
							$rangey2 = abs($acc_miny) + abs($acc_maxy);
							$rangez2 = abs($acc_minz) + abs($acc_maxz);
							$stdsmotion = 0;

							/* calculate color based on voxel size... red (100) means more than 1 voxel displacement in that direction */
							if ($series_spacingx > 0) {
								$xindex = round(($rangex/$series_spacingx)*100); if ($xindex > 100) { $xindex = 100; }
								$xindex2 = round(($rangex2/$series_spacingx)*100); if ($xindex2 > 100) { $xindex2 = 100; }
							}
							if ($series_spacingy > 0) {
								$yindex = round(($rangey/$series_spacingy)*100); if ($yindex > 100) { $yindex = 100; }
								$yindex2 = round(($rangey2/$series_spacingy)*100); if ($yindex2 > 100) { $yindex2 = 100; }
							}
							if ($series_spacingz > 0) {
								$zindex = round(($rangez/$series_spacingz)*100); if ($zindex > 100) { $zindex = 100; }
								$zindex2 = round(($rangez2/$series_spacingz)*100); if ($zindex2 > 100) { $zindex2 = 100; }
							}
							
							/* get standard deviations from the mean for SNR */
							if ($pstats[$sequence]['stdiosnr'] != 0) {
								if ($iosnr > $pstats[$sequence]['avgiosnr']) {
									$stdsiosnr = 0;
								}
								else {
									$stdsiosnr = (($iosnr - $pstats[$sequence]['avgiosnr'])/$pstats[$sequence]['stdiosnr']);
								}
							}
							if ($pstats[$sequence]['stdpvsnr'] != 0) {
								if ($pvsnr > $pstats[$sequence]['avgpvsnr']) {
									$stdspvsnr = 0;
								}
								else {
									$stdspvsnr = (($pvsnr - $pstats[$sequence]['avgpvsnr'])/$pstats[$sequence]['stdpvsnr']);
								}
							}
							if ($pstats[$sequence]['stdmotion'] != 0) {
								if ($motion_rsq > $pstats[$sequence]['avgmotion']) {
									$stdmotion = 0;
								}
								else {
									$stdmotion = (($motion_rsq - $pstats[$sequence]['avgmotion'])/$pstats[$sequence]['stdmotion']);
								}
							}
							
							if ($pstats[$sequence]['maxstdpvsnr'] == 0) { $pvindex = 100; }
							else { $pvindex = round(($stdspvsnr/$pstats[$sequence]['maxstdpvsnr'])*100); }
							$pvindex = 100 + $pvindex;
							if ($pvindex > 100) { $pvindex = 100; }
							
							if ($pstats[$sequence]['maxstdiosnr'] == 0) { $ioindex = 100; }
							else { $ioindex = round(($stdsiosnr/$pstats[$sequence]['maxstdiosnr'])*100); }
							$ioindex = 100 + $ioindex;
							if ($ioindex > 100) { $ioindex = 100; }
							if ($ioindex < 0) { $ioindex = 0; }
							
							if ($pstats[$sequence]['maxstdmotion'] == 0) { $motionindex = 100; }
							else { $motionindex = round(($stdmotion/$pstats[$sequence]['maxstdmotion'])*100); }
							$motionindex = 100 + $motionindex;
							if ($motionindex > 100) { $motionindex = 100; }
							if ($motionindex < 0) { $motionindex = 0; }
							
							//echo "[ioindex: $ioindex]";
							$maxpvsnrcolor = $colors[100-$pvindex];
							$maxiosnrcolor = $colors[100-$ioindex];
							$maxmotioncolor = $colors[100-$motionindex];
							if ($pvsnr <= 0.0001) { $pvsnr = "-"; $maxpvsnrcolor = ""; }
							else { $pvsnr = number_format($pvsnr,2); }
							if ($iosnr <= 0.0001) { $iosnr = "-"; $maxiosnrcolor = ""; }
							else { $iosnr = number_format($iosnr,2); }
							//if ($motion_rsq <= 0.0001) { $motion_rsq = "-"; $maxmotioncolor = ""; }
							//else { $motion_rsq = number_format($motion_rsq,2); }
							
							/* setup movement colors */
							$maxxcolor = $colors[$xindex];
							$maxycolor = $colors[$yindex];
							$maxzcolor = $colors[$zindex];
							if ($rangex <= 0.0001) { $rangex = "-"; $maxxcolor = ""; }
							else { $rangex = number_format($rangex,2); }
							if ($rangey <= 0.0001) { $rangey = "-"; $maxycolor = ""; }
							else { $rangey = number_format($rangey,2); }
							if ($rangez <= 0.0001) { $rangez = "-"; $maxzcolor = ""; }
							else { $rangez = number_format($rangez,2); }

							/* setup acceleration colors */
							$maxxcolor2 = $colors[$xindex2];
							$maxycolor2 = $colors[$yindex2];
							$maxzcolor2 = $colors[$zindex2];
							if ($rangex2 <= 0.0001) { $rangex2 = "-"; $maxxcolor2 = ""; }
							else { $rangex2 = number_format($rangex2,2); }
							if ($rangey2 <= 0.0001) { $rangey2 = "-"; $maxycolor2 = ""; }
							else { $rangey2 = number_format($rangey2,2); }
							if ($rangez2 <= 0.0001) { $rangez2 = "-"; $maxzcolor2 = ""; }
							else { $rangez2 = number_format($rangez2,2); }
							
							/* format the motion r^2 value */
							if ($motion_rsq == 0) {
								$motion_rsq = '-';
								 $maxmotioncolor = "";
							}
							else {
								$motion_rsq = number_format($motion_rsq,5);
							}
							/* get manually entered QA info */
							$sqlstringC = "select avg(value) 'avgrating', count(value) 'count' from manual_qa where series_id = $mrseries_id and modality = 'MR'";
							//PrintSQL($sqlstringC);
							$resultC = MySQLiQuery($sqlstringC, __FILE__, __LINE__);
							$rowC = mysqli_fetch_array($resultC, MYSQLI_ASSOC);
							$avgrating = $rowC['avgrating'];
							$ratingcount = $rowC['count'];
							if ($avgrating < 0.5) { $manualqacolor = "black"; }
							if (($avgrating >= 0.5) && ($avgrating < 1.5)) { $manualqacolor = "#FF0000"; }
							if (($avgrating >= 1.5) && ($avgrating <= 3.0)) { $manualqacolor = "#00FF00"; }
							if ($ratingcount < 1) { $manualqacolor = "#EFEFEF"; }
							
							/* check if this is real data, or unusable data based on the ratings, and get rating counts */
							$isbadseries = false;
							$istestseries = false;
							$ratingcount2 = '';
							$hasratings = false;
							$rowcolor = '';
							//print_r($ratings);
							if (isset($ratings)) {
								foreach ($ratings as $key => $ratingarray) {
									if ($key == $mrseries_id) {
										$hasratings = true;
										if (in_array(5,$ratingarray)) {
											$isbadseries = true;
										}
										if (in_array(6,$ratingarray)) {
											$istestseries = true;
										}
										$ratingcount2 = count($ratingarray);
										$ratingavg = array_sum($ratingarray) / count($ratingarray);
										break;
									}
								}
							}
							if ($isbadseries) { $rowcolor = "red"; }
							if ($istestseries) { $rowcolor = "#AAAAAA"; }
							if ($ishidden) { $rowcolor = "AAA"; }
							
							/* -------- audit the dicom files -------- */
							$dupes = null;
							$dcmcount = 0;
							if ($audit) {
								$dicoms = glob($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/*.dcm");
								//print_r($dicoms);
								$dcmcount = count($dicoms);
								if ($dcmcount > 0) {
									//$filename = $dicoms[0];
									$mergeddcms = null;
									foreach ($dicoms as $dcmfile) {
										$dicom = Nanodicom::factory($dcmfile, 'simple');
										$dicom->parse(array(array(0x0010, 0x0010), array(0x0010, 0x0030), array(0x0010, 0x0040), array(0x0018, 0x1030), array(0x0008, 0x103E), array(0x0010, 0x0020), array(0x0020, 0x0012), array(0x0020, 0x0013), array(0x0008, 0x0020), array(0x0008, 0x0030), array(0x0008, 0x0032)));
										$dicom->profiler_diff('parse');
										$filesubjectname = trim($dicom->value(0x0010, 0x0010));
										$filesubjectdob = trim($dicom->value(0x0010, 0x0030));
										$filesubjectsex = trim($dicom->value(0x0010, 0x0040));
										$fileprotocol = trim($dicom->value(0x0018, 0x1030));
										$fileseriesdesc = trim($dicom->value(0x0008, 0x103E));
										$fileseriesnum = trim($dicom->value(0x0020, 0x0011));
										$filescanid = trim($dicom->value(0x0010, 0x0020));
										$fileinstancenumber = trim($dicom->value(0x0020, 0x0013));
										$fileslicenumber = trim($dicom->value(0x0020, 0x0012));
										$fileacquisitiontime = trim($dicom->value(0x0008, 0x0032));
										$filecontenttime = trim($dicom->value(0x0008, 0x0033));
										$filestudydate = trim($dicom->value(0x0008, 0x0020));
										$filestudytime = trim($dicom->value(0x0008, 0x0030));
										unset($dicom);
										
										//echo "<pre>$fileprotocol, $protocol -- $fileslicenumber, $fileinstancenumber - [$filestudydate $filestudytime] - [$dbstudydatetime]</pre><br>";
										$filestudydatetime = $filestudydate . substr($filestudytime,0,6);
										$dbstudydatetime = str_replace(array(":","-"," "),"",$dbstudydatetime);
										$dbsubjectdob = str_replace(array(":","-"," "),"",$dbsubjectdob);
										if (
											($fileprotocol != $protocol) ||
											($dbsubjectname != $filesubjectname) ||
											($dbsubjectdob != $filesubjectdob) ||
											($dbsubjectsex != $filesubjectsex) ||
											($series_num != $fileseriesnum) ||
											($filestudydatetime != $dbstudydatetime)
											)
											{
											
											if ($fileprotocol != $protocol) {
												//echo "Protocol does not match (File: $fileprotocol DB: $protocol)<br>";
												//echo "files don't match DB<br>";
												$errantdcms[]{'filename'} = $dcmfile;
												$errantdcms[]{'error'} = "Protocol does not match (File: $fileprotocol DB: $protocol)";
											}
											if (strcasecmp($dbsubjectname,$filesubjectname) != 0) {
												if (($dbsubjectname == "") && ($filesubjectname) != "") {
													//echo "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)<br>";
													$errantdcms[]{'filename'} = $dcmfile;
													$errantdcms[]{'error'} = "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)";
												}
												elseif (($filesubjectname == "") && ($dbsubjectname) != "") {
													//echo "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)<br>";
													$errantdcms[]{'filename'} = $dcmfile;
													$errantdcms[]{'error'} = "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)";
												}
												else {
													if ((stristr($dbsubjectname, $filesubjectname) === false) && (stristr($filesubjectname, $dbsubjectname) === false)) {
														//echo "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)<br>";
														$errantdcms[]{'filename'} = $dcmfile;
														$errantdcms[]{'error'} = "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)";
													}
												}
											}
											
											if ($dbsubjectdob != $filesubjectdob) {
												//echo "Patient DOB does not match (File: $filesubjectdob DB: $dbsubjectdob)<br>";
												$errantdcms[]{'filename'} = $dcmfile;
												$errantdcms[]{'error'} = "Patient DOB does not match (File: $filesubjectdob DB: $dbsubjectdob)";
											}
											if ($dbsubjectsex != $filesubjectsex) {
												//echo "Patient sex does not match (File: $filesubjectsex DB: $dbsubjectsex)<br>";
												$errantdcms[]{'filename'} = $dcmfile;
												$errantdcms[]{'error'} = "Patient sex does not match (File: $filesubjectsex DB: $dbsubjectsex)";
											}
											if ($series_num != $fileseriesnum) {
												//echo "Series number does not match (File: $fileseriesnum DB: $series_num)<br>";
												$errantdcms[]{'filename'} = $dcmfile;
												$errantdcms[]{'error'} = "Series number does not match (File: $fileseriesnum DB: $series_num)";
											}
											if ($filestudydatetime != $dbstudydatetime) {
												//echo "Study datetime does not match (File: $filestudydatetime DB: $dbstudydatetime)<br>";
												$errantdcms[]{'filename'} = $dcmfile;
												$errantdcms[]{'error'} = "Study datetime does not match (File: $filestudydatetime DB: $dbstudydatetime)";
											}
											
										}
										$mergeddcms{$filesubjectname}{$filesubjectdob}{$filesubjectsex}{$filestudydate}{$filestudytime}{$fileseriesnum}{$fileslicenumber}{$fileinstancenumber}{$fileacquisitiontime}{$filecontenttime}[] = $dcmfile;
										
										if (count($mergeddcms{$filesubjectname}{$filesubjectdob}{$filesubjectsex}{$filestudydate}{$filestudytime}{$fileseriesnum}{$fileslicenumber}{$fileinstancenumber}{$fileacquisitiontime}{$filecontenttime}) > 1) {
											/* check the MD5 hash to see if the files really are the same */
											//$hash1 = md5_file(
											//echo "Series $fileseriesnum contains duplicate files<br>";
											$dupes[$series_num] = 1;
											
											if ($fix) {
												/* move the duplicate file to the dicom/extra directory */
												if (!file_exists($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/duplicates")) {
													mkdir($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/duplicates");
												}
												echo "Moving [$dcmfile] -> [" . $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/duplicates/" . GenerateRandomString(20) . ".dcm]<br>";
												rename($dcmfile, $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/duplicates/" . GenerateRandomString(20) . ".dcm");
											}
										}
									}
								}
								
								/* move the errant files */
								if ($fix) {
									for($i=0;$i<count($errantdcms);$i++) {
										echo "Moving [$errantdcms[$i]{'filename'}] -> [" . $GLOBALS['dicomincomingpath'] . "/" . GenerateRandomString(20) . ".dcm]<br>";
										rename($errantdcms[$i]{'filename'},$GLOBALS['dicomincomingpath'] . "/" . GenerateRandomString(20) . ".dcm");
									}
								
									/* rename the files in the directory */
									$dicoms = glob($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/*.dcm");
									//print_r($dicoms);
									$dcmcount = count($dicoms);
									if ($dcmcount > 0) {
										$dcmsize = 0;
										foreach ($dicoms as $dcmfile) {
											$dicom = Nanodicom::factory($dcmfile, 'simple');
											$dicom->parse(array(array(0x0010, 0x0010), array(0x0010, 0x0030), array(0x0010, 0x0040), array(0x0018, 0x1030), array(0x0008, 0x103E), array(0x0010, 0x0020), array(0x0020, 0x0012), array(0x0020, 0x0013), array(0x0008, 0x0020), array(0x0008, 0x0030), array(0x0008, 0x0032)));
											$dicom->profiler_diff('parse');
											$fileseriesnum = trim($dicom->value(0x0020, 0x0011));
											$fileinstancenumber = trim($dicom->value(0x0020, 0x0013));
											$fileslicenumber = trim($dicom->value(0x0020, 0x0012));
											$fileacquisitiontime = trim($dicom->value(0x0008, 0x0032));
											unset($dicom);
											
											$dcmsize += filesize($dcmfile);
											
											$newdcmfile = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/$uid" . "_$study_num" . "_$series_num" . "_" . sprintf("%05d",$fileslicenumber) . "_" . sprintf("%05d",$fileinstancenumber) . "_$fileacquisitiontime.dcm";
											//if (file_exists($newdcmfile)) {
												/* some DTI files are weird, so we'll append the aquisition time */
											//}
											echo "$dcmfile --> $newdcmfile<br>";
											rename($dcmfile, $newdcmfile);
										}
										
										/* update the database with the new info */
										$sqlstring5 = "update mr_series set series_size = $dcmsize, numfiles = $dcmcount where mrseries_id = $mrseries_id";
										$result5 = MySQLiQuery($sqlstring5, __FILE__, __LINE__);
									}
								}
							}
							
							?>
							<script type="text/javascript">
								$(document).ready(function(){
									$(".edit_inline<? echo $mrseries_id; ?>").editInPlace({
										url: "series_inlineupdate.php",
										params: "action=editinplace&modality=MR&id=<? echo $mrseries_id; ?>",
										default_text: "<i style='color:#AAAAAA'>Add notes...</i>",
										bg_over: "white",
										bg_out: "lightyellow",
									});
								});
							</script>
							<script type="text/javascript">
							// Popup window code
							function newPopup(url) {
								popupWindow = window.open(
									url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
							}
							</script>
							<style>
								.ui-tooltip {
									padding: 7px 7px;
									border-radius: 5px;
									font-size: 10px;
									border: 1px solid black;
								}
							</style>
							<tr style="color: <?=$rowcolor?>">
								<td><?=$series_num?>
								<?
									if ($dupes[$series_num] == 1) {
										?><span style="color: white; background-color: red; padding: 1px 5px; font-weight: bold; font-size: 8pt">Contains duplicates</span> <?
									}
								?>
								</td>
								<td><span id="uploader<?=$mrseries_id?>"></span></td>
								<td title="<b>Series Description</b> <?=$series_desc?><br><b>Protocol</b> <?=$protocol?><br><b>Sequence Description</b> <?=$sequence?><br><b>TE</b> <?=$series_te?>ms<br><b>Magnet</b> <?=$series_fieldstrength?>T<br><b>Flip angle</b> <?=$series_flip?>&deg;<br><b>Image type</b> <?=$image_type?><br><b>Image comment</b> <?=$image_comments?><br><b>Phase encoding</b> <?=$phase?>">
								<?
								if ($data_type == "dicom") {
									$dicoms = glob($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/*.dcm");
									$filespath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/";
									$dcmfile = $dicoms[0];
									if (file_exists($dcmfile)) {
										?><a href="series.php?action=scanparams&dcmfile=<?=$dcmfile?>"><?=$series_desc?></a><?
									}
									else {
										?><span style="color: red" title="Files missing from disk [<?=$filespath?>]"><?=$series_desc?></span><?
									}
								} else {
									echo $series_desc;
								}
								?>
								<br>
								<? if (file_exists($thumbpath)) { ?>
								<a href="preview.php?image=<?=$thumbpath?>" class="preview"><img src="images/preview.gif" border="0"></a>
								&nbsp;
								<? } ?>
								<? if (file_exists($gifthumbpath)) { ?>
								<a href="preview.php?image=<?=$gifthumbpath?>" class="preview"><img src="images/movie.png" border="0"></a>
								<? } ?>
								<? if ($bold_reps < 2) { ?>
								&nbsp;<a href="viewimage.php?modality=mr&type=dicom&seriesid=<?=$mrseries_id?>"><img src="images/colors.png" border="0"></a>
								<? } ?>
								</td>
								<td style="font-size:8pt"><?=$series_datetime?></td>
								<td><span id="series_notes" class="edit_inline<? echo $mrseries_id; ?>" style="background-color: lightyellow; padding: 1px 3px; font-size: 8pt;"><? echo $series_notes; ?></span></td>
								<td class="seriesrow" style="padding: 0px 5px;">
									<a href="JavaScript:newPopup('mrseriesqa.php?id=<?=$mrseries_id?>');"><img src="images/chart.gif" border="0" title="View QA results, including movement correction"></a>
								</td>
								<td class="seriesrow" style="padding: 0px 5px;">
									<span style="font-size:7pt"><?=$ratingavg;?></span>
									<div id="popup" style="display:none; min-width:800px; min-height:400px"></div>
									<? if ($hasratings) { $image = "rating2.png"; } else { $image = "rating.png"; } ?>
									<a href="JavaScript:newPopup('ratings.php?id=<?=$mrseries_id?>&type=series&modality=mr');"><img src="images/<?=$image?>" border="0" title="View ratings"></a>
								</td>
								<td class="seriesrow" align="right" style="padding:0px">
									<table cellspacing="0" cellpadding="1" height="100%" width="100%" class="movementsubtable" style="border-radius:0px">
										<tr><td title="Total X displacement" class="mainval" style="background-color: <?=$maxxcolor?>;"><?=$rangex;?></td></tr>
										<tr><td title="Total X velocity" class="subval" style="background-color: <?=$maxxcolor2?>;"><?=$rangex2;?></td></tr>
									</table>
								</td>
								<td class="seriesrow" align="right" style="padding:0px;margin:0px;height:100%">
									<table cellspacing="0" cellpadding="0" height="100%" width="100%" class="movementsubtable">
										<tr><td title="Total Y displacement" class="mainval" style="background-color: <?=$maxycolor?>;height:100%"><?=$rangey;?></td></tr>
										<tr><td title="Total Y velocity" class="subval" style="background-color: <?=$maxycolor2?>;height:100%"><?=$rangey2;?></td></tr>
									</table>
								</td>
								<td class="seriesrow" align="right" style="padding:0px">
									<table cellspacing="0" cellpadding="1" height="100%" width="100%" class="movementsubtable">
										<tr><td title="Total Z displacement" class="mainval" style="background-color: <?=$maxzcolor?>;"><?=$rangez;?></td></tr>
										<tr><td title="Total Z velocity" class="subval" style="background-color: <?=$maxzcolor2?>;"><?=$rangez2;?></td></tr>
									</table>
								</td>
								<td class="seriesrow" align="right" style="background-color: <?=$maxpvsnrcolor?>; font-size:8pt">
									<a href="stddevchart.php?h=40&w=450&min=<?=$pstats[$sequence]['minpvsnr']?>&max=<?=$pstats[$sequence]['maxpvsnr']?>&mean=<?=$pstats[$sequence]['avgpvsnr']?>&std=<?=$pstats[$sequence]['stdpvsnr']?>&i=<?=$pvsnr?>&b=yes" class="preview" style="color: black; text-decoration: none"><?=$pvsnr;?></a> 
								</td>
								<td class="seriesrow" align="right" style="background-color: <?=$maxiosnrcolor?>; font-size:8pt">
									<a href="stddevchart.php?h=40&w=450&min=<?=$pstats[$sequence]['miniosnr']?>&max=<?=$pstats[$sequence]['maxiosnr']?>&mean=<?=$pstats[$sequence]['avgiosnr']?>&std=<?=$pstats[$sequence]['stdiosnr']?>&i=<?=$iosnr?>&b=yes" class="preview" style="color: black; text-decoration: none"><?=$iosnr;?></a>
								</td>
								<td class="seriesrow" align="right" style="background-color: <?=$maxmotioncolor?>; font-size:8pt">
									<a href="stddevchart.php?h=40&w=450&min=<?=$pstats[$sequence]['minmotion']?>&max=<?=$pstats[$sequence]['maxmotion']?>&mean=<?=$pstats[$sequence]['avgmotion']?>&std=<?=$pstats[$sequence]['stdmotion']?>&i=<?=$motion_rsq?>&b=yes" class="preview" style="color: black; text-decoration: none"><?=$motion_rsq;?></a>
								</td>
								<!--<td><?=$sequence?></td>-->
								<td style="font-size:8pt"><?=$scanlength?></td>
								<td align="right" style="font-size:8pt"><?=$series_tr?></td>
								<td style="font-size:8pt;white-space: nowrap;">(<?=number_format($series_spacingx,1)?>, <?=number_format($series_spacingy,1)?>, <?=number_format($series_spacingz,1)?>)</td>
								<td style="font-size:8pt;white-space: nowrap;">(<?=$dimX?>, <?=$dimY?>, <?=$dimZ?><? if ($dimT > 1) { echo ", <big><b>$dimT</b></big>"; } ?>)</td>
								<td nowrap style="font-size:8pt">
									<?=$numfiles?>
									<? if (($dcmcount != $numfiles) && ($audit)) { ?><span style="color: white; background-color: red; padding: 1px 5px; font-weight: bold"><?=$dcmcount?></span> <? } ?> (<?=HumanReadableFilesize($series_size)?>)
									<a href="download.php?modality=mr&type=dicom&seriesid=<?=$mrseries_id?>" border="0"><img src="images/download16.png" title="Download <?=$data_type?> data"></a>
								</td>
								<td nowrap bgcolor="<?=$behcolor?>" align="center">
									<? if ($numfiles_beh != "-") { ?>
									<a href="managefiles.php?seriesid=<?=$mrseries_id?>&modality=mr&datatype=beh"><?=$numfiles_beh?></a>
									<? } else { ?>
									<?=$numfiles_beh?>
									<? } ?>
									<span class="tiny">
									<?
										if ($numfiles_beh > 0) {
											echo "(" . HumanReadableFilesize($beh_size) . ")";
											?>
											&nbsp;<a href="download.php?modality=mr&type=beh&seriesid=<?=$mrseries_id?>" border="0"><img src="images/download16.png" title="Download behavioral data"></a>
											<?
										}
									?>
									</span>
								</td>
								<? if ($GLOBALS['issiteadmin']) {
									if ($ishidden) { ?>
									<td><a class="linkbutton" href="studies.php?action=unhidemrseries&id=<?=$id?>&seriesid=<?=$mrseries_id?>" title="Un-hide this series from search results.">Unhide</a></td>
									<? } else { ?>
									<td><a class="linkbutton" href="studies.php?action=hidemrseries&id=<?=$id?>&seriesid=<?=$mrseries_id?>" title="Hide this series from search results. It will be visible on this page, but nowhere else on NiDB">Hide</a></td>
									<?
									}
									?>
									<td align="center"><a class="redlinkbutton" href="studies.php?action=resetqa&seriesid=<?=$mrseries_id?>&id=<?=$id?>" color="red">X</a></td>
									<td align="center"><a class="redlinkbutton" href="studies.php?action=deleteseries&modality=mr&seriesid=<?=$mrseries_id?>&id=<?=$id?>" color="red">X</a></td>
									<?
								}
								?>
							</tr>
							<?
							$lastseriesnum = $series_num;
						}
					?>
					<!-- uploader script for this series -->
					<script>
						function createUploaders(){
							/* window.onload can only be called once, so make 1 function to create all uploaders */
							<?
							mysqli_data_seek($result,0); /* reset the sql result, so we can loop through it again */
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$mrseries_id = $row['mrseries_id'];
								?>
								var uploader<?=$mrseries_id?> = new qq.FileUploader({
									element: document.getElementById('uploader<?=$mrseries_id?>'),
									action: 'upload.php',
									params: {modality: 'MRBEH', studyid: '<?=$id?>', seriesid: <?=$mrseries_id?>},
									debug: true
								});
								<?
							}
							?>
						}
						// in your app create uploader as soon as the DOM is ready
						// don't wait for the window to load  
						window.onload = createUploaders;
					</script>
				<?
				}
				?>
			</tbody>
		</table>
		<?
	}


	/* -------------------------------------------- */
	/* ------- DisplayCTSeries -------------------- */
	/* -------------------------------------------- */
	function DisplayCTSeries($id, $study_num, $uid, $audit, $fix) {

		/* get the subject information */
		$sqlstring = "select * from subjects a left join enrollment b on a.subject_id = b.subject_id left join studies c on b.enrollment_id = c.enrollment_id where c.study_id = $id";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$dbsubjectname = $row['name'];
			$dbsubjectdob = $row['birthdate'];
			$dbsubjectsex = $row['gender'];
			$dbstudydatetime = $row['study_datetime'];
		}
		else {
			echo "$sqlstring<br>";
		}
	
		?>
		<!--<a href="studies.php?id=<?$id?>&action=addseries&modality=CT">Add Series</a>-->
		<style type="text/css">
            .edit_inline { background-color: lightyellow; padding-left: 2pt; padding-right: 2pt; }
            .edit_textarea { background-color: lightyellow; }
			textarea.inplace_field { background-color: white; font-family: courier new; font-size: 8pt; border: 1pt solid gray; width: 800px;  }
			input.inplace_field { background-color: white; font-size: 8pt; border: 1pt solid gray; width: 200px;  }
		</style>
		
		<span class="smallnote"><b>Upload file(s) by clicking the button or drag-and-drop (Firefox and Chrome only)</b><br>
		DICOM files will only be associated with the study under which they were originally run... If you upload files from a different study, they won't show up here.</span>
		<br><br>
		<div id="file-uploader-demo1">		
			<noscript>			
				<p>Please enable JavaScript to use file uploader.</p>
				<!-- or put a simple form for upload here -->
			</noscript>         
		</div>
		<br>
		<table class="smalldisplaytable" width="100%">
			<thead>
				<tr>
					<th>Series</th>
					<th>Desc</th>
					<th>Protocol</th>
					<th>Time</th>
					<th>Notes</th>
					<th>Contrast</th>
					<th>Body part</th>
					<th>Options</th>
					<th>KVP</th>
					<th>Collection Dia</th>
					<th>Contrast Route</th>
					<th>Rotation Dir</th>
					<th>Exposure</th>
					<th>Tube current</th>
					<th>Filter type</th>
					<th>Power</th>
					<th>Kernel</th>
					<th>Spacing</th>
					<th>Image size</th>
					<th># files</th>
					<th>Size</th>
				</tr>
			</thead>
			<tbody>
				<?
					$sqlstring = "select * from ct_series where study_id = $id order by series_num";
					$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$ctseries_id = $row['ctseries_id'];
						$series_datetime = date('g:ia',strtotime($row['series_datetime']));
						$series_desc = $row['series_desc'];
						$protocol = $row['series_protocol'];
						$sequence = $row['series_sequencename'];
						$series_num = $row['series_num'];
						$series_contrastbolusagent = $row['series_contrastbolusagent'];
						$series_bodypartexamined = $row['series_bodypartexamined'];
						$series_scanoptions = $row['series_scanoptions'];
						$series_kvp = $row['series_kvp'];
						$series_datacollectiondiameter = $row['series_datacollectiondiameter'];
						$series_contrastbolusroute = $row['series_contrastbolusroute'];
						$series_rotationdirection = $row['series_rotationdirection'];
						$series_exposuretime = $row['series_exposuretime'];
						$series_xraytubecurrent = $row['series_xraytubecurrent'];
						$series_filtertype = $row['series_filtertype'];
						$series_generatorpower = $row['series_generatorpower'];
						$series_convolutionkernel = $row['series_convolutionkernel'];
						$series_spacingx = $row['series_spacingx'];
						$series_spacingy = $row['series_spacingy'];
						$series_spacingz = $row['series_spacingz'];
						$img_rows = $row['series_imgrows'];
						$img_cols = $row['series_imgcols'];
						$img_slices = $row['series_imgslices'];
						$numfiles = $row['numfiles'];
						$series_size = $row['series_size'];
						$series_status = $row['series_status'];
						$series_notes = $row['series_notes'];
						$data_type = $row['data_type'];
						$lastupdate = $row['lastupdate'];
						
						if ( (preg_match("/epfid2d1/i",$sequence)) && ($numfiles_beh < 1)) { $behcolor = "red"; } else { $behcolor = ""; }
						if ($numfiles_beh < 1) { $numfiles_beh = "-"; }

						$thumbpath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/thumb.png";
						$realignpath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/MotionCorrection.txt";

						/* --- audit the dicom files --- */
						if ($audit) {
							$dicoms = glob($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/*.dcm");
							//print_r($dicoms);
							$dcmcount = count($dicoms);
							$dupes = null;
							if ($dcmcount > 0) {
								//$filename = $dicoms[0];
								$mergeddcms = null;
								foreach ($dicoms as $dcmfile) {
									$dicom = Nanodicom::factory($dcmfile, 'simple');
									$dicom->parse(array(array(0x0010, 0x0010), array(0x0010, 0x0030), array(0x0010, 0x0040), array(0x0018, 0x1030), array(0x0008, 0x103E), array(0x0010, 0x0020), array(0x0020, 0x0012), array(0x0020, 0x0013), array(0x0008, 0x0020), array(0x0008, 0x0030), array(0x0008, 0x0032)));
									$dicom->profiler_diff('parse');
									$filesubjectname = trim($dicom->value(0x0010, 0x0010));
									$filesubjectdob = trim($dicom->value(0x0010, 0x0030));
									$filesubjectsex = trim($dicom->value(0x0010, 0x0040));
									$fileprotocol = trim($dicom->value(0x0018, 0x1030));
									$fileseriesdesc = trim($dicom->value(0x0008, 0x103E));
									$fileseriesnum = trim($dicom->value(0x0020, 0x0011));
									$filescanid = trim($dicom->value(0x0010, 0x0020));
									$fileinstancenumber = trim($dicom->value(0x0020, 0x0013));
									$fileslicenumber = trim($dicom->value(0x0020, 0x0012));
									$fileacquisitiontime = trim($dicom->value(0x0008, 0x0032));
									$filestudydate = trim($dicom->value(0x0008, 0x0020));
									$filestudytime = trim($dicom->value(0x0008, 0x0030));
									unset($dicom);
									
									//echo "<pre>$fileprotocol, $protocol -- $fileslicenumber, $fileinstancenumber - [$filestudydate $filestudytime] - [$dbstudydatetime]</pre><br>";
									$filestudydatetime = $filestudydate . substr($filestudytime,0,6);
									$dbstudydatetime = str_replace(array(":","-"," "),"",$dbstudydatetime);
									$dbsubjectdob = str_replace(array(":","-"," "),"",$dbsubjectdob);
									if (
										($fileprotocol != $protocol) ||
										($dbsubjectname != $filesubjectname) ||
										($dbsubjectdob != $filesubjectdob) ||
										($dbsubjectsex != $filesubjectsex) ||
										($series_num != $fileseriesnum) ||
										($filestudydatetime != $dbstudydatetime)
										)
										{
										
										if ($fileprotocol != $protocol) {
											//echo "Protocol does not match (File: $fileprotocol DB: $protocol)<br>";
											//echo "files don't match DB<br>";
											$errantdcms[]{'filename'} = $dcmfile;
											$errantdcms[]{'error'} = "Protocol does not match (File: $fileprotocol DB: $protocol)";
										}
										if (strcasecmp($dbsubjectname,$filesubjectname) != 0) {
											if (($dbsubjectname == "") && ($filesubjectname) != "") {
												//echo "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)<br>";
												$errantdcms[]{'filename'} = $dcmfile;
												$errantdcms[]{'error'} = "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)";
											}
											elseif (($filesubjectname == "") && ($dbsubjectname) != "") {
												//echo "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)<br>";
												$errantdcms[]{'filename'} = $dcmfile;
												$errantdcms[]{'error'} = "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)";
											}
											else {
												if ((stristr($dbsubjectname, $filesubjectname) === false) && (stristr($filesubjectname, $dbsubjectname) === false)) {
													//echo "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)<br>";
													$errantdcms[]{'filename'} = $dcmfile;
													$errantdcms[]{'error'} = "Patient name does not match (File: $filesubjectname DB: $dbsubjectname)";
												}
											}
										}
										
										if ($dbsubjectdob != $filesubjectdob) {
											//echo "Patient DOB does not match (File: $filesubjectdob DB: $dbsubjectdob)<br>";
											$errantdcms[]{'filename'} = $dcmfile;
											$errantdcms[]{'error'} = "Patient DOB does not match (File: $filesubjectdob DB: $dbsubjectdob)";
										}
										if ($dbsubjectsex != $filesubjectsex) {
											//echo "Patient sex does not match (File: $filesubjectsex DB: $dbsubjectsex)<br>";
											$errantdcms[]{'filename'} = $dcmfile;
											$errantdcms[]{'error'} = "Patient sex does not match (File: $filesubjectsex DB: $dbsubjectsex)";
										}
										if ($series_num != $fileseriesnum) {
											//echo "Series number does not match (File: $fileseriesnum DB: $series_num)<br>";
											$errantdcms[]{'filename'} = $dcmfile;
											$errantdcms[]{'error'} = "Series number does not match (File: $fileseriesnum DB: $series_num)";
										}
										if ($filestudydatetime != $dbstudydatetime) {
											//echo "Study datetime does not match (File: $filestudydatetime DB: $dbstudydatetime)<br>";
											$errantdcms[]{'filename'} = $dcmfile;
											$errantdcms[]{'error'} = "Study datetime does not match (File: $filestudydatetime DB: $dbstudydatetime)";
										}
										
									}
									//$mergeddcms{$filesubjectname}{$filesubjectdob}{$filesubjectsex}{$filestudydate}{$filestudytime}{$fileseriesnum}{$fileslicenumber}{$fileinstancenumber} = $dcmfile;
									$mergeddcms{$filesubjectname}{$filesubjectdob}{$filesubjectsex}{$filestudydate}{$filestudytime}{$fileseriesnum}{$fileslicenumber}{$fileinstancenumber}{$fileacquisitiontime}++;
									if ($mergeddcms{$filesubjectname}{$filesubjectdob}{$filesubjectsex}{$filestudydate}{$filestudytime}{$fileseriesnum}{$fileslicenumber}{$fileinstancenumber}{$fileacquisitiontime} > 1) {
										/* check the MD5 hash to see if the files really are the same */
										//$hash1 = md5_file(
										echo "Series $fileseriesnum contains duplicate files<br>";
										$dupes[$series_num] = 1;
										
										if ($fix) {
											/* move the duplicate file to the dicom/extra directory */
											if (!file_exists($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/duplicates")) {
												mkdir($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/duplicates");
											}
											echo "Moving [$dcmfile] -> [" . $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/duplicates/" . GenerateRandomString(20) . ".dcm]<br>";
											rename($dcmfile, $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/duplicates/" . GenerateRandomString(20) . ".dcm");
										}
									}
								}
							}
							echo "<pre>";
							//print_r($mergeddcms);
							print_r($errantdcms);
							echo "</pre>";
							
							/* move the errant files */
							if ($fix) {
								for($i=0;$i<count($errantdcms);$i++) {
									echo "Moving [$errantdcms[$i]{'filename'}] -> [" . $GLOBALS['dicomincomingpath'] . "/" . GenerateRandomString(20) . ".dcm]<br>";
									rename($errantdcms[$i]{'filename'},$GLOBALS['dicomincomingpath'] . "/" . GenerateRandomString(20) . ".dcm");
								}
							
								/* rename the files in the directory */
								$dicoms = glob($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/*.dcm");
								//print_r($dicoms);
								$dcmcount = count($dicoms);
								if ($dcmcount > 0) {
									$dcmsize = 0;
									foreach ($dicoms as $dcmfile) {
										$dicom = Nanodicom::factory($dcmfile, 'simple');
										$dicom->parse(array(array(0x0010, 0x0010), array(0x0010, 0x0030), array(0x0010, 0x0040), array(0x0018, 0x1030), array(0x0008, 0x103E), array(0x0010, 0x0020), array(0x0020, 0x0012), array(0x0020, 0x0013), array(0x0008, 0x0020), array(0x0008, 0x0030), array(0x0008, 0x0032)));
										$dicom->profiler_diff('parse');
										$fileseriesnum = trim($dicom->value(0x0020, 0x0011));
										$fileinstancenumber = trim($dicom->value(0x0020, 0x0013));
										$fileslicenumber = trim($dicom->value(0x0020, 0x0012));
										$fileacquisitiontime = trim($dicom->value(0x0008, 0x0032));
										unset($dicom);
										
										$dcmsize += filesize($dcmfile);
										
										$newdcmfile = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/$uid" . "_$study_num" . "_$series_num" . "_" . sprintf("%05d",$fileslicenumber) . "_" . sprintf("%05d",$fileinstancenumber) . "_$fileacquisitiontime.dcm";
										//if (file_exists($newdcmfile)) {
											/* some DTI files are weird, so we'll append the aquisition time */
										//}
										echo "$dcmfile --> $newdcmfile<br>";
										rename($dcmfile, $newdcmfile);
									}
									
									/* update the database with the new info */
									$sqlstring5 = "update ct_series set series_size = $dcmsize, numfiles = $dcmcount where ctseries_id = $ctseries_id";
									$result5 = MySQLiQuery($sqlstring5, __FILE__, __LINE__);
								}
							}
						}
						
						?>
						<script type="text/javascript">
							$(document).ready(function(){
								$(".edit_inline<? echo $ctseries_id; ?>").editInPlace({
									url: "series_inlineupdate.php",
									params: "action=editinplace&modality=CT&id=<? echo $ctseries_id; ?>",
									default_text: "<i style='color:#AAAAAA'>Add notes...</i>",
									bg_over: "white",
									bg_out: "lightyellow",
								});
							});
						</script>
						<tr>
							<td><?=$series_num?>
							<?
								if ($dupes[$series_num] == 1) {
									?><span style="color: white; background-color: red; padding: 1px 5px; font-weight: bold; font-size: 8pt">Contains duplicates</span> <?
								}
							?>
							</td>
							<td><?=$series_desc?></td>
							<td><?=$protocol?> <a href="preview.php?image=<?=$thumbpath?>" class="preview"><img src="images/preview.gif" border="0"></a></td>
							<td><?=$series_datetime?></td>
							<td><span id="series_notes" class="edit_inline<? echo $ctseries_id; ?>" style="background-color: lightyellow; padding: 1px 3px; font-size: 8pt;"><? echo $series_notes; ?></span></td>
							<td><?=$series_contrastbolusagent?></td>
							<td><?=$series_bodypartexamined?></td>
							<td><?=$series_scanoptions?></td>
							<td><?=$series_kvp?><span class="tiny">V</span></td>
							<td><?=$series_datacollectiondiameter?><span class="tiny">mm</span></td>
							<td><?=$series_contrastbolusroute?></td>
							<td><?=$series_rotationdirection?></td>
							<td><?=$series_exposuretime?><span class="tiny">ms</span></td>
							<td><?=$series_xraytubecurrent?><span class="tiny">mA</span></td>
							<td><?=$series_filtertype?></td>
							<td><?=$series_generatorpower?><span class="tiny">V</span></td>
							<td><?=$series_convolutionkernel?></td>
							<td><?=number_format($series_spacingx,1)?> &times; <?=number_format($series_spacingy,1)?> &times; <?=number_format($series_spacingz,1)?></td>
							<td><?=$img_cols?> &times; <?=$img_rows?> &times; <?=$img_slices?></td>
							<td>
								<?=$numfiles?>
								<? if (($dcmcount != $numfiles) && ($audit)) { ?><span style="color: white; background-color: red; padding: 1px 5px; font-weight: bold"><?=$dcmcount?></span> <? } ?>
							</td>
							<td nowrap><?=HumanReadableFilesize($series_size)?> <a href="download.php?modality=ct&type=dicom&seriesid=<?=$ctseries_id?>" border="0"><img src="images/download16.png" title="Download <?=$data_type?> data"></a></td>
						</tr>
						<?
					}
				?>
			</tbody>
		</table>
		<?
	}
	
	
	/* -------------------------------------------- */
	/* ------- DeleteSeries ----------------------- */
	/* -------------------------------------------- */
	function DeleteSeries($id, $series_id, $modality) {
		$modality = strtolower($modality);
		
		if ($modality == "mr") {
			$sqlstring = "insert into fileio_requests (fileio_operation, data_type, data_id, modality, requestdate) values ('delete','series','$series_id', '$modality', now())";
			$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			
			?><div align="center"><span class="message">Series queued for deletion</span></div><br><br><?
		}
		else {
			/* get information to figure out the path */
			$sqlstring = "select a.*, c.uid, d.project_costcenter, c.subject_id from studies a left join enrollment b on a.enrollment_id = b.enrollment_id left join subjects c on b.subject_id = c.subject_id left join projects d on b.project_id = d.project_id where a.study_id = $id";
			$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$study_num = $row['study_num'];
			$uid = $row['uid'];
			
			/* get series number */
			$sqlstring = "select * from $modality" . "_series where $modality" . "series_id = $series_id";
			$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$series_num = $row['series_num'];

			/* reconstruct the series path and delete */
			$seriespath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num";
			echo "[$seriespath]";
			if (is_dir($seriespath)) {
				$datetime = time();
				rename($seriespath, $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num-$datetime");
			}
			
			$sqlstring = "delete from " . strtolower($modality) . "_series where " . strtolower($modality) . "series_id = $series_id";
			echo "[$sqlstring]";
			$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			
			?><div align="center"><span class="message">Series deleted</span></div><br><br><?
		}
	}

	
	/* -------------------------------------------- */
	/* ------- EditGenericSeries ------------------ */
	/* -------------------------------------------- */
	function EditGenericSeries($id, $modality) {
		$sqlstring = "select * from " . strtolower($modality) . "_series where " . strtolower($modality) . "series_id = $id";
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$series_id = $row[strtolower($modality) . "series_id"];
		$series_num = $row['series_num'];
		$series_datetime = $row['series_datetime'];
		$protocolA = trim($row['series_protocol']);
		$notes = $row['series_notes'];
		?>
		<div align="center">
		<table class="entrytable">
			<form method="post" action="studies.php">
			<input type="hidden" name="action" value="updateseries">
			<input type="hidden" name="seriesid" value="<?=$id?>">
			<input type="hidden" name="modality" value="<?=$modality?>">
			<tr>
				<td class="heading" colspan="2" align="center">
					<b>Series <?=$series_num?></b>
				</td>
			</tr>
			<tr>
				<td class="label">Protocol</td>
				<td>
					<select name="protocol">
					<?
						unset($protocols);
						
						$sqlstring = "select protocol from modality_protocol where modality = '$modality'";
						$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							if (trim($row['protocol']) != "") {
								$protocols[] = trim($row['protocol']);
							}
						}
						$sqlstring = "select distinct(series_protocol) from " . strtolower($modality) . "_series";
						$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							if (trim($row['series_protocol']) != "") {
								$protocols[] = trim($row['series_protocol']);
							}
						}
						//PrintVariable($protocols);
						$protocols = array_unique($protocols, SORT_STRING);
						sort($protocols);
						//PrintVariable($protocols);
						
						foreach ($protocols as $protocolB) {
							?>
							<option value="<?=$protocolB?>" <? if ($protocolA == $protocolB) { echo "selected"; } ?>><?=$protocolB?></option>
							<?
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">Date/time<br><span class="tiny">24 hour clock</span></td>
				<td><input type="text" name="series_datetime" value="<?=$series_datetime?>"></td>
			</tr>
			<tr>
				<td class="label">Notes</td>
				<td><input type="text" size="70" name="notes" value="<?=$notes?>"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Update">
				</td>
			</tr>
			</form>
		</table>
		</div>
		<br><br><br>
		
		<?
	}
	

	/* -------------------------------------------- */
	/* ------- DisplayGenericSeries --------------- */
	/* -------------------------------------------- */
	function DisplayGenericSeries($id, $modality) {
		if ((trim($modality) == "") || (strtolower($modality) == "missing modality")) {
			?><div align="center" color="red">Modality was blank, unable to display data</div><?
			return;
		}
		?>
		<SCRIPT LANGUAGE="Javascript">
		<!---
			function decision(message, url){
				if(confirm(message)) location.href = url;
			}
		// --->
		</SCRIPT>
		
		<table class="smalldisplaytable">
			<thead>
				<tr>
					<th>Series #</th>
					<th>Protocol</th>
					<th>Date</th>
					<th>Notes</th>
					<th># files</th>
					<th>Size</th>
					<th>Upload <?=strtoupper($modality)?> file(s)<br><span class="tiny">Click button or Drag & Drop</span></th>
					<th>Download</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?
					$sqlstringA = "show tables like '" . strtolower($modality) . "_series'";
					$resultA = MySQLiQuery($sqlstringA, __FILE__, __LINE__);
					if (mysqli_num_rows($resultA) > 0) {
						$max_seriesnum = 0;
						$sqlstring = "select * from `" . strtolower($modality) . "_series` where study_id = $id order by series_num";
						$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$series_id = $row[strtolower($modality) . "series_id"];
							$series_num = $row['series_num'];
							if ($series_num > $max_seriesnum) { $max_seriesnum = $series_num; }
							//$series_datetime = date('M j, Y g:ia',strtotime($row['series_datetime']));
							$series_datetime = $row['series_datetime'];
							$protocol = $row['series_protocol'];
							$notes = $row['series_notes'];
							$numfiles = $row['series_numfiles'];
							$series_size = $row['series_size'];
							$lastupdate = $row['lastupdate'];

							if ($numfiles < 1) { $numfiles = "-"; }
							if ($series_size > 1) { $series_size = HumanReadableFilesize($series_size); } else { $series_size = "-"; }
							?>
							<script type="text/javascript">
								$(document).ready(function(){
									$(".edit_inline<? echo $series_id; ?>").editInPlace({
										url: "series_inlineupdate.php",
										params: "action=editinplace&modality=<?=$modality?>&id=<? echo $series_id; ?>",
										default_text: "<i style='color:#AAAAAA'>Add notes...</i>",
										bg_over: "white",
										bg_out: "lightyellow",
									});
								});
							</script>
							<tr>
								<td><a href="studies.php?action=editseries&seriesid=<?=$series_id?>&modality=<?=strtolower($modality)?>"><?=$series_num?></a></td>
								<td><span id="series_protocol" class="edit_inline<? echo $series_id; ?>" style="background-color: lightyellow; padding: 1px 3px; font-size: 8pt;"><? echo $protocol; ?></span></td>
								<td><span id="series_datetime" class="edit_inline<? echo $series_id; ?>" style="background-color: lightyellow; padding: 1px 3px; font-size: 8pt;"><? echo $series_datetime; ?></span></td>
								<td><span id="series_notes" class="edit_inline<? echo $series_id; ?>" style="background-color: lightyellow; padding: 1px 3px; font-size: 8pt;"><? echo $notes; ?></span></td>
								<td><a href="managefiles.php?seriesid=<?=$series_id?>&modality=<?=$modality?>&datatype=<?=$modality?>"><?=$numfiles?></a></td>
								<td><?=$series_size?></td>
								<td>
								<!--<form action="studies.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="action" value="upload">
								<input type="hidden" name="modality" value="<?=$modality?>">
								<input type="hidden" name="studyid" value="<?=$id?>">
								<input type="hidden" name="seriesid" value="<?=$series_id?>">
								<input type="file" name="files[]" multiple><input type="submit" value="Upload">-->
								<span id="uploader<?=$series_id?>"></span>
								</form>
								</td>
								<td nowrap><?=$series_size?> <a href="download.php?modality=<?=$modality?>&seriesid=<?=$series_id?>" border="0"><img src="images/download16.png" title="Download <?=$modality?> data"></a></td>
								<td align="right">
									<a href="javascript:decision('Are you sure you want to delete this series?', 'studies.php?action=deleteseries&modality=<?=$modality?>&id=<?=$id?>&seriesid=<?=$series_id?>')" style="color: red">X</a>
								</td>
							</tr>
						<?
						}
					}
					else {
						?>
						<tr>
							<td colspan="9">
								<span style="color: red">Invalid modality [<?=$modality?>]</span>
							</td>
						</tr>
						<?
					}
					?>
					<!-- uploader script for this series -->
					<script>
						function createUploaders(){
							/* window.onload can only be called once, so make 1 function to create all uploaders */
					<?
					mysqli_data_seek($result,0); /* reset the sql result, so we can loop through it again */
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$series_id = $row[strtolower($modality) . "series_id"];
						?>
								var uploader<?=$series_id?> = new qq.FileUploader({
									element: document.getElementById('uploader<?=$series_id?>'),
									action: 'upload.php',
									params: {modality: '<?=strtoupper($modality)?>', studyid: '<?=$id?>', seriesid: <?=$series_id?>},
									debug: true
								});
					<?
					}
					?>
						}
						// in your app create uploader as soon as the DOM is ready
						// don't wait for the window to load  
						window.onload = createUploaders;
					</script>
				<form action="studies.php" method="post">
				<input type="hidden" name="action" value="addseries">
				<input type="hidden" name="modality" value="<?=strtoupper($modality)?>">
				<input type="hidden" name="id" value="<?=$id?>">
				<tr>
					<td><input type="text" name="series_num" size="3" maxlength="10" value="<?=($max_seriesnum + 1)?>"></td>
					<td>
						<!-- <select name="protocol">
						?
							$sqlstring = "select * from modality_protocol where modality = '$modality'";
							$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$protocol = $row['protocol'];
								?>
								<option value=" ?=$protocol?>">?=$protocol?></option>
								?
							}
						?>
						</select> -->

                                                <input type="text" name="protocol" list="protocols">
                                                <datalist id="protocols">
                                                <?
                                                        $sqlstring = "select * from modality_protocol where modality = '$modality'";
                                                        $result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
                                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                                $protocol = $row['protocol'];
                                                                ?>
                                                                        <option value=" <?=$protocol?>"><?=$protocol?></option>
                                                                <?
                                                        }
                                                ?>
                                                </datalist>


					</td>
					<td><input type="text" name="series_datetime" value="<?=date('Y-m-d h:i:s a')?>"></td>
					<td><input type="text" name="notes"></td>
					<td></td>
					<td></td>
					<td><input type="submit" value="Create"></td>
					<td></td>
				</tr>
				</form>
			</tbody>
		</table>

		<?
	}
	
	/* -------------------------------------------- */
	/* ------- DisplayFileSeries ------------------ */
	/* -------------------------------------------- */
	function DisplayFileSeries($path) {
	
		if (file_exists($path)) {
			$dir = scandir($path);
			$files = find_all_files($path);

			?>
			Showing files from <b><?=$path?></b> (<?=count($files)?> files)
			<br><br>
			<table cellspacing="0" cellpadding="2" width="100%">
				<tr>
					<td style="font-weight: bold; border-bottom:2px solid #999999">File</td>
					<td style="font-weight: bold; border-bottom:2px solid #999999">Timestamp</td>
					<td style="font-weight: bold; border-bottom:2px solid #999999">Permissions</td>
					<td style="font-weight: bold; border-bottom:2px solid #999999">Size <span class="tiny">bytes</span></td>
				</tr>
			<?
			foreach ($files as $line) {
				
				$timestamp2 = "N/A";
				$perm2 = 'N/A';
				$islink2 = '';
				$isdir2 = '';
				$size2 = 0;
				list($file,$timestamp1,$perm1,$isdir1,$islink1,$size1) = explode("\t",$line);
				
				if (is_link($file)) { $islink2 = 1; }
				if (is_dir($file)) { $isdir2 = 1; }
				if (file_exists($file)) {
					$timestamp2 = filemtime($file);
					$perm2 = substr(sprintf('%o', fileperms($file)), -4);
					$size2 = filesize($file);

					$filetype = "";
					if (stristr(strtolower($file),'.nii') !== FALSE) { $filetype = 'nifti'; }
					if (stristr(strtolower($file),'.nii.gz') !== FALSE) { $filetype = 'nifti'; }
					if (stristr(strtolower($file),'.inflated') !== FALSE) { $filetype = 'mesh'; }
					if (stristr(strtolower($file),'.smoothwm') !== FALSE) { $filetype = 'mesh'; }
					if (stristr(strtolower($file),'.sphere') !== FALSE) { $filetype = 'mesh'; }
					if (stristr(strtolower($file),'.pial') !== FALSE) { $filetype = 'mesh'; }
					if (stristr(strtolower($file),'.fsm') !== FALSE) { $filetype = 'mesh'; }
					if (stristr(strtolower($file),'.orig') !== FALSE) { $filetype = 'mesh'; }
					if (stristr(strtolower($file),'.png') !== FALSE) { $filetype = 'image'; }
					if (stristr(strtolower($file),'.ppm') !== FALSE) { $filetype = 'image'; }
					if (stristr(strtolower($file),'.jpg') !== FALSE) { $filetype = 'image'; }
					if (stristr(strtolower($file),'.jpeg') !== FALSE) { $filetype = 'image'; }
					if (stristr(strtolower($file),'.gif') !== FALSE) { $filetype = 'image'; }
					if (stristr(strtolower($file),'.txt') !== FALSE) { $filetype = 'text'; }
					if (stristr(strtolower($file),'.log') !== FALSE) { $filetype = 'text'; }
					if (stristr(strtolower($file),'.sh') !== FALSE) { $filetype = 'text'; }
					if (stristr(strtolower($file),'.job') !== FALSE) { $filetype = 'text'; }
					if (stristr(strtolower($file),".o") !== FALSE) { $filetype = 'text'; }
					if (stristr(strtolower($file),".e") !== FALSE) { $filetype = 'text'; }
					if (stristr(strtolower($file),".par") !== FALSE) { $filetype = 'text'; }
					if (stristr(strtolower($file),".mat") !== FALSE) { $filetype = 'text'; }
					if ($istext) { $filetype = "text"; }
					//echo "[$file $filetype]";
				}
				$filecolor = "black";
				if ($islink2) { $filecolor = "red"; } else { $filecolor = ''; }
				if ($isdir1) { $filecolor = "darkblue"; $fileweight = ''; } else { $filecolor = ''; $fileweight = ''; }
				
				$clusterpath = str_replace('/mount','',$path);
				$displayfile = str_replace($clusterpath,'',$file);
				$lastslash = strrpos($displayfile,'/');
				$displayfile = substr($displayfile,0,$lastslash) . '<b>' . substr($displayfile,$lastslash) . '</b>';
				
				$displayperms = '';
				for ($i=1;$i<=3;$i++) {
					switch (substr($perm2,$i,1)) {
						case 0: $displayperms .= '---'; break;
						case 1: $displayperms .= '--x'; break;
						case 2: $displayperms .= '-w-'; break;
						case 3: $displayperms .= '-wx'; break;
						case 4: $displayperms .= 'r--'; break;
						case 5: $displayperms .= 'r-x'; break;
						case 6: $displayperms .= 'rw-'; break;
						case 7: $displayperms .= 'rwx'; break;
					}
				}
				?>
				<tr>
					<td style="font-size:10pt; border-bottom: solid 1px #DDDDDD; color:<?=$filecolor?>; font-weight: <?=$fileweight?>">
					<?
						switch ($filetype) {
							case 'text':
					?>
					<a href="viewfile.php?file=<?="$file"?>" target="_blank"><span style="color:<?=$filecolor?>; font-weight: <?=$fileweight?>"><?=$displayfile?></span></a>
					<?
								break;
							case 'image':
					?>
					<a href="viewimagefile.php?file=<?="$file"?>" target="_blank"><span style="color:<?=$filecolor?>; font-weight: <?=$fileweight?>"><?=$displayfile?></span></a>
					<?
								break;
							case 'nifti':
							case 'mesh':
					?>
					<a href="viewimage.php?type=<?=$filetype?>&filename=<?="$file"?>" target="_blank"><span style="color:<?=$filecolor?>; font-weight: <?=$fileweight?>"><?=$displayfile?></span></a>
					<?
								break;
							default:
					?>
					<?=$displayfile?>
					<? } ?>
					</td>
					<td style="font-size:10pt; border-bottom: solid 1px #DDDDDD"><?=date("M j, Y H:i:s",$timestamp2)?></span></td>
					<td style="font-size:10pt; border-bottom: solid 1px #DDDDDD"><?=$displayperms?></td>
					<td style="font-size:10pt; border-bottom: solid 1px #DDDDDD"><?=number_format($size2)?></td>
				</tr>
				<?
			}
		}
		else {
			?>
			No data exists for this study
			<?
		}
	}
	
	
	/* -------------------------------------------- */
	/* ------- DisplayAnalyses -------------------- */
	/* -------------------------------------------- */
	function DisplayAnalyses($studyid, $search_pipelineid, $search_name, $search_compare, $search_value, $search_type, $search_swversion, $imgperline) {

		if ($imgperline == "") { $imgperline = 4; }
		
		//echo "DisplayAnalyses($studyid, $search_name, $search_compare, $search_value, $search_swversion)<br>";
		if (($search_pipelineid != "") || ($search_name != "") || ($search_value != "") || ($search_type != "") || ($search_swversion != "")) {
			$sqlstring = "select a.*, c.pipeline_name, d.result_name from analysis_results a left join analysis b on a.analysis_id = b.analysis_id left join pipelines c on b.pipeline_id = c.pipeline_id left join analysis_resultnames d on d.resultname_id = a.result_nameid where b.study_id = $studyid ";
			$sqlstring2 = "select distinct(c.pipeline_id), c.pipeline_name, d.result_name from analysis_results a left join analysis b on a.analysis_id = b.analysis_id left join pipelines c on b.pipeline_id = c.pipeline_id where b.study_id = $studyid ";
			if ($search_pipelineid != "") {
				$sqlstring .= " and c.pipeline_id = $search_pipelineid ";
				$sqlstring2 .= " and c.pipeline_id = $search_pipelineid ";
			}
			if ($search_name != "") {
				$sqlstring .= " and d.result_name like '%$search_name%' ";
				$sqlstring2 .= " and d.result_name like '%$search_name%' ";
			}
			if ($search_value != "") {
				$sqlstring .= " and a.result_value $search_compare '$search_value' ";
				$sqlstring2 .= " and a.result_value $search_compare '$search_value' ";
			}
			if ($search_type != "") {
				$sqlstring .= " and a.result_type = '$search_type' ";
				$sqlstring2 .= " and a.result_type = '$search_type' ";
			}
			if ($search_swversion != "") {
				$sqlstring .= "and a.result_swversion like '%$search_swversion%' ";
				$sqlstring2 .= "and a.result_swversion like '%$search_swversion%' ";
			}
			$sqlstring .= " order by d.result_name";
			$sqlstring2 .= " order by d.result_name";
		}
		else {
			$sqlstring = "select a.*, c.pipeline_name, d.result_name from analysis_results a left join analysis b on a.analysis_id = b.analysis_id left join pipelines c on b.pipeline_id = c.pipeline_id left join analysis_resultnames d on d.resultname_id = a.result_nameid where b.study_id = $studyid order by c.pipeline_name, d.result_name";
			$sqlstring2 = "select distinct(c.pipeline_id), c.pipeline_name, d.result_name from analysis_results a left join analysis b on a.analysis_id = b.analysis_id left join pipelines c on b.pipeline_id = c.pipeline_id left join analysis_resultnames d on d.resultname_id = a.result_nameid where b.study_id = $studyid order by d.result_name";
		}
		
		?>
		Analyses for this study<br><br>
		<?
		$sqlstring = "select * from analysis a left join pipelines b on a.pipeline_id = b.pipeline_id where a.study_id = $studyid and analysis_statusdatetime is not null";
		
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		if (mysqli_num_rows($result) > 0) {
			$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$pipelinename = $row['pipeline_name'];
				$pipelineversion = $row['pipeline_version'];
				$analysis_id = $row['analysis_id'];
				$analysis_status = $row['analysis_status'];
				$analysis_statusmessage = $row['analysis_statusmessage'];
				$analysis_statusdatetime = $row['analysis_statusdatetime'];
				$analysis_iscomplete = $row['analysis_iscomplete'];
				?>
				<details>
				<summary><?=$pipelinename?> v<?=$pipelineversion?> <span class="tiny"><?=$analysis_statusmessage?></style> &nbsp; <span style="color: darkred;"><?=$analysis_statusdatetime?></span></span></summary>
				<?
					$sqlstring2 = "select a.*, d.result_name from analysis_results a left join analysis b on a.analysis_id = b.analysis_id left join pipelines c on b.pipeline_id = c.pipeline_id left join analysis_resultnames d on d.resultname_id = a.result_nameid where b.study_id = $studyid and a.analysis_id = $analysis_id order by d.result_name";
				?>
				<table class="smalldisplaytable">
					<?
						$result2 = MySQLiQuery($sqlstring2, __FILE__, __LINE__);
						while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
							//$step = $row['analysis_step'];
							$pipelinename = $row2['pipeline_name'];
							$type = $row2['result_type'];
							$size = $row2['result_size'];
							$name = $row2['result_name'];
							$text = $row2['result_text'];
							$value = $row2['result_value'];
							$units = $row2['result_units'];
							$filename = $row2['result_filename'];
							$swversion = $row2['result_softwareversion'];
							$important = $row2['result_isimportant'];
							$lastupdate = $row2['result_lastupdate'];
							
							if (strpos($units,'^') !== false) {
								$units = str_replace('^','<sup>',$units);
								$units .= '</sup>';
							}
							if ($important) { $bold = 'bold'; } else { $bold = 'normal'; }
							?>
							<tr style="font-weight: <?=$bold?>">
								<td><b><?=$pipelinename?></b></td>
								<td><?=$name?></td>
								<td align="right">
									<?
										switch($type) {
											case "v":
												echo "$value";
												break;
											case "f":
												echo $filename;
												break;
											case "t":
												echo $text;
												break;
											case "h":
												echo $filename;
												break;
											case "i":
												?>
												<a href="preview.php?image=/mount<?=$filename?>" class="preview"><img src="images/preview.gif" border="0"></a>
												<?
												break;
										}
									?>
								</td>
								<td style="padding-left:0px"><?=$units?></td>
								<!--<td><?=$size?></td>-->
								<td><?=$swversion?></td>
								<td nowrap><?=$lastupdate?></td>
							</tr>
							<?
						}
					?>
				</table>
				</details>
				<?
			}
		}
		
		return
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		if (mysqli_num_rows($result) > 0) {
		?>
		<style>
			.smallsearchbox { border: 1px solid #BBBBBB; font-size:9pt}
		</style>
		<b>Analyses</b><br><br>
		<table class="smalldisplaytable">
			<form method="post" action="studies.php">
			<input type="hidden" name="id" value="<?=$studyid?>">
			<thead>
				<tr>
					<th valign="top" align="left">
						Pipeline<br>
						<select name="search_pipelineid">
							<option value="">Select pipeline</option>
						<?
							$result2 = MySQLiQuery($sqlstring2, __FILE__, __LINE__);
							while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
								$pipelineid = $row2['pipeline_id'];
								$pipelinename = $row2['pipeline_name'];
								?>
								<option value="<?=$pipelineid?>" <? if ($search_pipelineid == $pipelineid) { echo "selected"; } ?>><?=$pipelinename?></option>
								<?
							}
						?>
						</select>
					</th>
					<th valign="top" align="left">Name<br><input type="text" name="search_name" value="<?=$search_name?>" class="smallsearchbox">
					</th>
					<th colspan="2" valign="top" align="left">Result<br>
					<select name="search_compare">
						<option value="=" <? if ($search_compare == '=') { echo "selected"; } ?>>=
						<option value=">" <? if ($search_compare == '>') { echo "selected"; } ?>>&gt;
						<option value=">=" <? if ($search_compare == '>=') { echo "selected"; } ?>>&gt;=
						<option value="<" <? if ($search_compare == '<') { echo "selected"; } ?>>&lt;
						<option value="<=" <? if ($search_compare == '<=') { echo "selected"; } ?>>&lt;=
					</select>
					<input type="text" name="search_value" value="<?=$search_value?>" size="15" class="smallsearchbox"><br>
					<select name="search_type">
						<option value="" <? if ($search_type == '') { echo "selected"; } ?>>Select type
						<option value="v" <? if ($search_type == 'v') { echo "selected"; } ?>>value
						<option value="f" <? if ($search_type == 'f') { echo "selected"; } ?>>file
						<option value="i" <? if ($search_type == 'i') { echo "selected"; } ?>>image
						<option value="h" <? if ($search_type == 'h') { echo "selected"; } ?>>html
					</select>
					<br>
					Num img per line:
					<select name="imgperline">
						<?
						for($i=1;$i<=20;$i++) {
							?>
							<option value="<?=$i?>" <? if ($imgperline == $i) { echo "selected"; } ?>><?=$i?>
						<? } ?>
					</select>

					</th>
					<!--<th valign="top" align="left">Size</th>-->
					<th valign="top" align="left">SW version<br><input type="text" name="search_swversion" value="<?=$search_swversion?>" class="smallsearchbox"></th>
					<th valign="top" align="left">Date added<br><input type="submit" value="Search" style="font-size:9pt"></th>
				</tr>
			</thead>
			</form>
			
			<? if ($search_type == "i") { ?>
			</table>
			<table width="100%">
				<?
					$pagewidth = 1000;
					$maximgwidth = $pagewidth/$imgperline;
					$maximgwidth -= ($maximgwidth*0.05); /* subtract 5% of image width to give a gap between them */
					$i = 0;
					$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$pipelinename = $row['pipeline_name'];
						$name = $row['result_name'];
						$filename = $row['result_filename'];
						$swversion = $row['result_softwareversion'];
						$important = $row['result_isimportant'];
						$lastupdate = $row['result_lastupdate'];
						$i++;
						
						if ($important) { $bold = 'bold'; } else { $bold = 'normal'; }
						
						list($width, $height, $type, $attr) = getimagesize("/mount$filename");
						$filesize = number_format(filesize("/mount$filename")/1000) . " kB";
						?>
							<td>
								<a href="preview.php?image=/mount<?=$filename?>"><img src="preview.php?image=/mount<?=$filename?>" width="<?=$maximgwidth?>px"></a>
								<table width="<?=$maximgwidth?>px">
									<tr>
										<td style="font-size:9pt">
											<b><?=$name?></b><br>
											<?=$swversion?><br>
											<?=$lastupdate?>
										</td>
										<td align="right" valign="top">
											<span class="tiny"><?=$width?>x<?=$height?><br><?=$filesize?></span>
										</td>
									</tr>
								</table>
							</td>
						<?
						if ($i>=$imgperline) {
							$i=0;
							?>
								</tr>
								<tr>
							<?
						}
					}
				?></table><?
			}
			else { ?>
			<tbody>
				<?
					$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						//$step = $row['analysis_step'];
						$pipelinename = $row['pipeline_name'];
						$type = $row['result_type'];
						$size = $row['result_size'];
						$name = $row['result_name'];
						$text = $row['result_text'];
						$value = $row['result_value'];
						$units = $row['result_units'];
						$filename = $row['result_filename'];
						$swversion = $row['result_softwareversion'];
						$important = $row['result_isimportant'];
						$lastupdate = $row['result_lastupdate'];
						
						if (strpos($units,'^') !== false) {
							$units = str_replace('^','<sup>',$units);
							$units .= '</sup>';
						}
						if ($important) { $bold = 'bold'; } else { $bold = 'normal'; }
						?>
						<tr style="font-weight: <?=$bold?>">
							<td><b><?=$pipelinename?></b></td>
							<td><?=$name?></td>
							<td align="right">
								<?
									switch($type) {
										case "v":
											echo "$value";
											break;
										case "f":
											echo $filename;
											break;
										case "t":
											echo $text;
											break;
										case "h":
											echo $filename;
											break;
										case "i":
											?>
											<a href="preview.php?image=/mount<?=$filename?>" class="preview"><img src="images/preview.gif" border="0"></a>
											<?
											break;
									}
								?>
							</td>
							<td style="padding-left:0px"><?=$units?></td>
							<!--<td><?=$size?></td>-->
							<td><?=$swversion?></td>
							<td nowrap><?=$lastupdate?></td>
						</tr>
						<?
					}
				?>
			</tbody>
		</table>
			<? }
		}
		else {
			?>
			No analyses for this study
			<?
		}
	}
	
?>


<? include("footer.php") ?>
