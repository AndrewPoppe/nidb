<?
	//error_reporting(-1);
	//ini_set('display_errors', '1');
 // ------------------------------------------------------------------------------
 // NiDB search.php
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
		<title>NiDB - Search</title>
	</head>

<body>
	<div id="wrapper">
<?
	require "functions.php";
	require "includes.php";
	require "menu.php";
	require 'kashi.php';

	/* set debugging on/off only for this page */
	$GLOBALS['cfg']['debug'] = 0;
	
	/* ----- setup variables ----- */
	$action = GetVariable("action");

	/* searching variables */
    $searchvars['s_projectid'] = GetVariable("s_projectid");
    $searchvars['s_enrollsubgroup'] = GetVariable("s_enrollsubgroup");
    $searchvars['s_subjectuid'] = GetVariable("s_subjectuid");
    $searchvars['s_subjectaltuid'] = GetVariable("s_subjectaltuid");
    $searchvars['s_subjectname'] = GetVariable("s_subjectname");
    $searchvars['s_subjectdobstart'] = GetVariable("s_subjectdobstart");
    $searchvars['s_subjectdobend'] = GetVariable("s_subjectdobend");
    $searchvars['s_subjectgender'] = GetVariable("s_subjectgender");
    $searchvars['s_subjectgroupid'] = GetVariable("s_subjectgroupid");
    $searchvars['s_measuresearch'] = GetVariable("s_measuresearch");
    $searchvars['s_measurelist'] = GetVariable("s_measurelist");
    $searchvars['s_studyinstitution'] = GetVariable("s_studyinstitution");
    $searchvars['s_studyequipment'] = GetVariable("s_studyequipment");
    $searchvars['s_studyaltscanid'] = GetVariable("s_studyaltscanid");
    $searchvars['s_studydatestart'] = GetVariable("s_studydatestart");
    $searchvars['s_studydateend'] = GetVariable("s_studydateend");
    $searchvars['s_studydesc'] = GetVariable("s_studydesc");
    $searchvars['s_studyphysician'] = GetVariable("s_studyphysician");
    $searchvars['s_studyoperator'] = GetVariable("s_studyoperator");
    $searchvars['s_studytype'] = GetVariable("s_studytype");
    $searchvars['s_studymodality'] = GetVariable("s_studymodality");
    $searchvars['s_studygroupid'] = GetVariable("s_studygroupid");
    $searchvars['s_seriesdesc'] = GetVariable("s_seriesdesc");
    $searchvars['s_usealtseriesdesc'] = GetVariable("s_usealtseriesdesc");
    $searchvars['s_seriessequence'] = GetVariable("s_seriessequence");
    $searchvars['s_seriesimagetype'] = GetVariable("s_seriesimagetype");
    $searchvars['s_seriestr'] = GetVariable("s_seriestr");
    $searchvars['s_seriesimagecomments'] = GetVariable("s_seriesimagecomments");
    $searchvars['s_seriesnum'] = GetVariable("s_seriesnum");
    $searchvars['s_seriesnumfiles'] = GetVariable("s_seriesnumfiles");
    $searchvars['s_seriesgroupid'] = GetVariable("s_seriesgroupid");
    $searchvars['s_pipelineid'] = GetVariable("s_pipelineid");
    $searchvars['s_pipelineresultname'] = GetVariable("s_pipelineresultname");
    $searchvars['s_pipelineresultunit'] = GetVariable("s_pipelineresultunit");
    $searchvars['s_pipelineresultvalue'] = GetVariable("s_pipelineresultvalue");
    $searchvars['s_pipelineresultcompare'] = GetVariable("s_pipelineresultcompare");
    $searchvars['s_pipelineresulttype'] = GetVariable("s_pipelineresulttype");
    $searchvars['s_pipelinecolorize'] = GetVariable("s_pipelinecolorize");
    $searchvars['s_pipelinecormatrix'] = GetVariable("s_pipelinecormatrix");
    $searchvars['s_pipelineresultstats'] = GetVariable("s_pipelineresultstats");
    $searchvars['s_resultorder'] = GetVariable("s_resultorder");
    $searchvars['s_formid'] = GetVariable("s_formid");
    $searchvars['s_formfieldid'] = GetVariable("s_formfieldid");
    $searchvars['s_formcriteria'] = GetVariable("s_formcriteria");
    $searchvars['s_formvalue'] = GetVariable("s_formvalue");
    $searchvars['s_audit'] = GetVariable("s_audit");
    $searchvars['s_qcbuiltinvariable'] = GetVariable("s_qcbuiltinvariable");
    $searchvars['s_qcvariableid'] = GetVariable("s_qcvariableid");
	
	/* data request variables */
	$requestvars['downloadimaging'] = GetVariable("downloadimaging");
	$requestvars['downloadbeh'] = GetVariable("downloadbeh");
	$requestvars['downloadqc'] = GetVariable("downloadqc");
	$requestvars['destination'] = GetVariable("destination");
	$requestvars['modality'] = GetVariable("modality");
	$requestvars['dirformat'] = GetVariable("dirformat");
	$requestvars['seriesid'] = GetVariable("seriesid");
	$requestvars['enrollmentid'] = GetVariable("enrollmentid");
	$requestvars['anonymize'] = GetVariable("anonymize");
	$requestvars['nfsdir'] = GetVariable("nfsdir");
	$requestvars['filetype'] = GetVariable("filetype");
	$requestvars['gzip'] = GetVariable("gzip");
	$requestvars['preserveseries'] = GetVariable("preserveseries");
	$requestvars['remoteftpserver'] = GetVariable("remoteftpserver");
	$requestvars['remoteftppath'] = GetVariable("remoteftppath");
	$requestvars['remoteftpusername'] = GetVariable("remoteftpusername");
	$requestvars['remoteftppassword'] = GetVariable("remoteftppassword");
	$requestvars['remoteftpport'] = GetVariable("remoteftpport");
	$requestvars['remoteftpsecure'] = GetVariable("remoteftpsecure");
	$requestvars['remoteconnid'] = GetVariable("remoteconnid");
	$requestvars['remotenidbserver'] = GetVariable("remotenidbserver");
	$requestvars['remotenidbusername'] = GetVariable("remotenidbusername");
	$requestvars['remotenidbpassword'] = GetVariable("remotenidbpassword");
	$requestvars['remoteinstanceid'] = GetVariable("remoteinstanceid");
	$requestvars['remotesiteid'] = GetVariable("remotesiteid");
	$requestvars['remoteprojectid'] = GetVariable("remoteprojectid");
	$requestvars['publicdownloaddesc'] = GetVariable("publicdownloaddesc");
	$requestvars['publicdownloadreleasenotes'] = GetVariable("publicdownloadreleasenotes");
	$requestvars['publicdownloadpassword'] = GetVariable("publicdownloadpassword");
	$requestvars['publicdownloadshareinternal'] = GetVariable("publicdownloadshareinternal");
	$requestvars['publicdownloadregisterrequired'] = GetVariable("publicdownloadregisterrequired");
	$requestvars['publicdownloadexpire'] = GetVariable("publicdownloadexpire");
	$requestvars['dicomtags'] = GetVariable("dicomtags");
	$requestvars['timepoints'] = GetVariable("timepoints");
	$requestvars['behformat'] = GetVariable("behformat");
	$requestvars['behdirnameroot'] = GetVariable("behdirnameroot");
	$requestvars['behdirnameseries'] = GetVariable("behdirnameseries");
    $requestvars['subjectmeta'] = GetVariable("subjectmeta");
    $requestvars['subjectdata'] = GetVariable("subjectdata");
    $requestvars['subjectphenotype'] = GetVariable("subjectphenotype");
    $requestvars['subjectforms'] = GetVariable("subjectforms");
    $requestvars['studymeta'] = GetVariable("studymeta");
    $requestvars['studydata'] = GetVariable("studydata");
    $requestvars['seriesmeta'] = GetVariable("seriesmeta");
    $requestvars['seriesdata'] = GetVariable("seriesdata");
    $requestvars['allsubject'] = GetVariable("allsubject");
	
	
	$numpostvars = count($_POST);
	$maxnumvars = ini_get('max_input_vars');
	if ($numpostvars >= $maxnumvars) {
		?>
		<div style="background-color: orange">PHP has an inherent limit [<?=$maxnumvars?>] for the number of items you can request. You have requested [<?=$numpostvars?>] items. PHP will truncate the number of items to its limit with no warning. To prevent you from receiving less data than you are expecting, this page will not process your download request. Please go back to the search page and download less than [<?=$maxnumvars?>] data items.</div>
		<?
		exit(0);
	}
	
	/* ----- determine which action to take ----- */
	switch ($action) {
		case 'searchform': DisplaySearchForm($searchvars, $action); break;
		case 'search':
			DisplaySearchForm($searchvars, $action);
			Search($searchvars);
			break;
		case 'submit': ProcessRequest($requestvars, $username); break;
		case 'anonymize': Anonymize($requestvars, $username); break;
		default:
			DisplaySearchForm($searchvars, $action);
	}

	
	/* -------------------------------------------- */
	/* ------- DisplaySearchForm ------------------ */
	/* -------------------------------------------- */
	function DisplaySearchForm($searchvars, $action) {
	
		$urllist['New Search'] = "search.php";
		NavigationBar("Search", $urllist);
		
	?>
	<script type="text/javascript">
	$(function() {
		$(".datepick").datepicker({changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd', minDate: '-130y', maxDate: '+130y'});
	});
	</script>

	<style>
		.sidelabel {
			font-weight: bold;
			font-size: 12pt;
			border-right: solid 1px #CCC;
			border-bottom: solid 1px #CCC;
			padding-right: 15px;
			padding-left: 10px;
			text-align: right;
		}
		.toplabel {
			color: white;
			font-weight: bold;
			font-size: 14pt;
			padding-top: 5px;
			padding-bottom: 5px;
			text-align: center;
			/*border-top-right-radius: 5px;*/
			background-color: #3B5998;
		}
		.tiny {
			font-size: 8pt;
			color: gray;
		}
		.fieldlabel {
			color: darkblue;
			text-align: right;
			vertical-align: middle;
		}
		.importantfield {
			border: 1pt solid darkblue;
			background-color: lightyellow;
		}
		.fakelink {
			background-color: #DDD;
			border-right: solid 2px #777
			/*border-top: 2px solid #999;
			border-left: 2px solid #444;
			border-bottom: 2px solid #444;
			border-radius:3px; */
			padding: 1px 4px;
			font-size:9pt;
			font-weight: normal;
			color: black;
			cursor: pointer;
			-moz-transform: rotate(-90deg);
			-o-transform: rotate(-90deg);
			-webkit-transform: rotate(-90deg);
		}
		.advancedhover:hover {
			max-width: 25px;
			background-color: #DDD;
			color: #000;
			border-right: 1px solid #444;
			cursor: pointer;
			align: center;
			vertical-align: middle;
			/*border-top-left-radius: 5px;
			border-bottom-left-radius: 5px;*/
		}
		.advancedhover {
			max-width: 25px;
			background-color: #EEE;
			color: #AAA;
			border-right: 1px solid #AAA;
			cursor: pointer;
			align: center;
			vertical-align: middle;
			/*border-top-left-radius: 5px;
			border-bottom-left-radius: 5px;*/
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function() {
			/* default action */
			$('tr.advanced').hide();
			
			$('#searchtoggle').click(function(){
				$('tr.advanced').toggle();
			});
		});
	</script>
	<script>
		$(function() {
			$( "#s_studyinstitution" ).autocomplete({
				source: "autocomplete_institution.php",
				minLength: 1,
				autoFocus: true
			});
		});
		
		$(document).ready(function(){
			$('#pageloading').hide();
		});
		
		/* changed the results/view output type when a search element is clicked */
		function SwitchOption(option) {
			switch (option) {
				case 'viewpipeline':
					document.getElementById('viewpipeline').checked = true;
					break;
			}
		}
		
	</script>
	
	<? if ($action == "search") { ?>
	<div id="pageloading" align="center" style="font-size:11pt; color:darkblue">
		Searching... <img src="images/loading.gif">
	</div>
	<br>
	<? } ?>
	<div style="padding-left:30px">
	<form action="search.php" method="post" name="searchform">
	<input type="hidden" name="action" value="search">
	
	<table>
		<tr>
			<td>
	<table cellspacing="0" cellpadding="3" style="border: 1px solid #ccc;">
		<tr>
			<td rowspan="9" id="searchtoggle" class="advancedhover" onMouseOver="this.classname='advancedhover';" onMouseOut="this.classname='advancednohover';">
				<span style="display: block; -webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg); writing-mode: rl-bt;">Toggle&nbsp;advanced&nbsp;search</span>
			</td>
		</tr>
		<tr>
			<td class="toplabel" colspan="2">Search</td>

		</tr>
		<tr>
			<td class="sidelabel">Subject</td>
			<td style="border-bottom: 1pt solid #CCC">
				<table width="100%" cellspacing="0" cellpadding="3">
					<tr title="<b>Subject UID(s)</b><br><br>Can be a list of UIDs, separated by commas, spaces, semi-colons, tabs, or Copy&Paste from Excel">
						<td class="fieldlabel">UID(s)</td>
						<td><input type="text" name="s_subjectuid" value="<?=$searchvars['s_subjectuid'];?>" size="50" class="importantfield"></td>
					</tr>
					<tr title="<b>Alternate Subject UID(s)</b><br><br>Can be a list of UIDs, separated by commas, spaces, semi-colons, tabs, or Copy&Paste from Excel">
						<td class="fieldlabel">Alternate UID(s)</td>
						<td><input type="text" name="s_subjectaltuid" value="<?=$searchvars['s_subjectaltuid'];?>" size="50" class="importantfield"></td>
					</tr>
					<tr>
						<td class="fieldlabel" width="150px">Name</td>
						<td><input type="text" name="s_subjectname" value="<?=$searchvars['s_subjectname'];?>" size="50" class="importantfield"></td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel">DOB</td>
						<td>
							<input type="date" name="s_subjectdobstart" value="<?=$searchvars['s_subjectdobstart'];?>" size="12"> to <input type="date" name="s_subjectdobend" value="<?=$searchvars['s_subjectdobend'];?>" size="12">
						</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel">Gender</td>
						<td>
							<input type="text" name="s_subjectgender" size="1" maxlength="1" value="<?=$searchvars['s_subjectgender']?>"> <span class="tiny">&nbsp;F, M, O, U</span>
						</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel" width="150px">Group</td>
						<td>
						<select name="s_subjectgroupid">
							<option value="">Select a group</option>
						<?
							$sqlstring = "select * from groups where group_type = 'subject' order by group_name";
							$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$groupid = $row['group_id'];
								$groupname = $row['group_name'];
								$groupowner = $row['group_owner'];
								
								echo "[[$groupid -- [" . $searchvars['s_subjectgroupid'] . "]]]";
								if ($groupid == $searchvars['s_subjectgroupid']) {
									$selected = "selected";
								}
								else {
									$selected = "";
								}
								?>
								<option value="<?=$groupid?>" <?=$selected?>><?=$groupname?></option>
								<?
							}
						?>
						</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="sidelabel">Enrollment</td>
			<td style="border-bottom: 1pt solid #CCC">
				<table width="100%" cellspacing="0" cellpadding="3">
					<tr>
						<td class="fieldlabel" width="150px">Project</td>
						<td>
						<select name="s_projectid" class="importantfield">
							<option value="all">All Projects</option>
							<?
								$sqlstring = "select * from projects where instance_id = '" . $_SESSION['instanceid'] . "' order by project_name";
								$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									$project_id = $row['project_id'];
									$project_name = $row['project_name'];
									$project_costcenter = $row['project_costcenter'];
									if ($project_id == $searchvars['s_projectid']) { $selected = "selected"; } else { $selected = ""; }
									?>
									<option value="<?=$project_id?>" <?=$selected?>><?=$project_name?> (<?=$project_costcenter?>)</option>
									<?
								}
							?>
						</select>
						</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel" width="150px">Enrollment sub-group</td>
						<td>
						<input type="text" name="s_enrollsubgroup" id="s_enrollsubgroup" list="s_enrollsubgroup" value="<?=$searchvars['s_enrollsubgroup']?>" size="50"></td>
						<datalist id="s_enrollsubgroup">
						<?
							$sqlstring = "select distinct(enroll_subgroup) from enrollment order by enroll_subgroup";
							$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								?><option value="<?=$row['enroll_subgroup']?>"><?
							}
						?>
						</datalist>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="sidelabel">Study</td>
			<td style="border-bottom: 1pt solid #CCC">
				<table width="100%" cellspacing="0" cellpadding="3">
					<tr class="advanced">
						<td class="fieldlabel" width="150px">Institution</td>
						<td>
						<input type="text" name="s_studyinstitution" id="s_studyinstitution" list="s_studyinstitution" value="<?=$searchvars['s_studyinstitution']?>" size="50"></td>
						<datalist id="s_studyinstitution">
						<?
							$sqlstring = "select distinct(study_institution) from studies order by study_institution";
							$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								?><option value="<?=$row['study_institution']?>"><?
							}
						?>
						</datalist>
						</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel" width="150px">Equipment</td>
						<td>
						<select name="s_studyequipment">
							<option value="">Select equipment</option>
						<?
							$sqlstring = "select distinct(study_site) from studies order by study_site";
							$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$study_site = $row['study_site'];
								
								if ($study_site != "") {
									if ($study_site == $searchvars['s_studyequipment']) {
										$selected = "selected";
									}
									else {
										$selected = "";
									}
									?>
									<option value="<?=$study_site?>" <?=$selected?>><?=$study_site?></option>
									<?
								}
							}
						?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="fieldlabel" width="150px">Alternate Scan ID(s)</td>
						<td><input type="text" name="s_studyaltscanid" value="<?=$searchvars['s_studyaltscanid']?>" size="50" class="importantfield"></td>
					</tr>
					<tr title="<b>Study date</b><br><br>Leave first date blank to search for anything earlier than the second date. Leave the second date blank to search for anything later than the first date">
						<td class="fieldlabel">Date</td>
						<td><input type="date" name="s_studydatestart" value="<?=$searchvars['s_studydatestart']?>" size="12" class="importantfield"> to <input type="date" name="s_studydateend" value="<?=$searchvars['s_studydateend']?>" size="12" class="importantfield"></td>
					</tr>
					<tr>
						<td class="fieldlabel">Modality</td>
						<td>
						<select name="s_studymodality" class="importantfield">
						<?
							$sqlstring = "select * from modalities order by mod_desc";
							$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$mod_code = $row['mod_code'];
								$mod_desc = $row['mod_desc'];
								
								/* check if the modality table exists */
								$sqlstring2 = "show tables from " . $GLOBALS['cfg']['mysqldatabase'] . " like '" . strtolower($mod_code) . "_series'";
								$result2 = MySQLiQuery($sqlstring2,__FILE__,__LINE__);
								if (mysqli_num_rows($result2) > 0) {
								
									/* if the table does exist, allow the user to search on it */
									if (($mod_code == "MR") && ($searchvars['s_studymodality'] == "")) {
										$selected = "selected";
									}
									else {
										if ($mod_code == $searchvars['s_studymodality']) {
											$selected = "selected";
										}
										else {
											$selected = "";
										}
									}
									?>
									<option value="<?=$mod_code?>" <?=$selected?>><?=$mod_desc?></option>
									<?
								}
							}
						?>
						</select>
						</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel">Description</td>
						<td>
							<input type="text" name="s_studydesc" list="s_studydesc" value="<?=$searchvars['s_studydesc']?>" size="50">
							<datalist id="s_studydesc">
							<?
								$sqlstring = "select distinct(study_desc) from studies where study_desc <> '' order by study_desc";
								$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									?><option value="<?=trim($row['study_desc'])?>"><?
								}
							?>
							</datalist>
						</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel">Performing&nbsp;Physician</td>
						<td>
							<input type="text" name="s_studyphysician" list="s_studyphysician" value="<?=$searchvars['s_studyphysician']?>" size="50">
							<datalist id="s_studyphysician">
							<?
								$sqlstring = "select distinct(study_performingphysician) from studies where study_performingphysician <> '' order by study_performingphysician";
								$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									?><option value="<?=trim($row['study_performingphysician'])?>"><?
								}
							?>
							</datalist>
						</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel">Operator</td>
						<td>
							<input type="text" name="s_studyoperator" list="s_studyoperator" value="<?=$searchvars['s_studyoperator']?>" size="50">
							<datalist id="s_studyoperator">
							<?
								$sqlstring = "select distinct(study_operator) from studies where study_operator <> '' order by study_operator";
								$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									?><option value="<?=trim($row['study_operator'])?>"><?
								}
							?>
							</datalist>
						</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel">Visit type</td>
						<td>
							<input type="text" name="s_studytype" list="s_studytype" value="<?=$searchvars['s_studytype']?>" size="50">
							<datalist id="s_studytype">
							<?
								$sqlstring = "select distinct(study_type) from studies where study_type <> '' order by study_type";
								$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
									?><option value="<?=trim($row['study_type'])?>"><?
								}
							?>
							</datalist>
						</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel" width="150px">Group</td>
						<td>
						<select name="s_studygroupid">
							<option value="">Select a group</option>
						<?
							$sqlstring = "select * from groups where group_type = 'study' order by group_name";
							$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$groupid = $row['group_id'];
								$groupname = $row['group_name'];
								$groupowner = $row['group_owner'];
								
								if ($groupid == $searchvars['s_studygroupid']) {
									$selected = "selected";
								}
								else {
									$selected = "";
								}
								?>
								<option value="<?=$groupid?>" <?=$selected?>><?=$groupname?></option>
								<?
							}
						?>
						</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="sidelabel">Series</td>
			<td style="border-bottom: 1pt solid #CCC">
				<table width="100%" cellspacing="0" cellpadding="3">
					<tr title="<b>Comma separated</b> protocols: search will be an AND<br><b>Semi-colon separated</b> protocols: search will be an OR">
						<td class="fieldlabel" width="150px">Protocol</td>
						<td><input type="text" name="s_seriesdesc" value="<?=$searchvars['s_seriesdesc']?>" size="50" class="importantfield"></td>
					</tr>
					<tr title="Perform the search using the alternate protocol name, and return the results using the alternate protocol name. The alternate protocol name often groups together series with similar names into one protocol. For example 'MPRAGE', 'Axial T1', and 'T1w_SPC' would all be labeled 'T1'">
						<td class="fieldlabel" width="150px"></td>
						<td><input type="checkbox" name="s_usealtseriesdesc" value="1" class="importantfield" <? if ($searchvars['s_usealtseriesdesc']) { echo "checked"; } ?>>Use alternate protocol name</td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel" width="150px">Sequence</td>
						<td><input type="text" name="s_seriessequence" value="<?=$searchvars['s_seriessequence']?>" size="50"></td>
					</tr>
					<tr class="advanced" title="Comma separated. Use * to indicate wildcards">
						<td class="fieldlabel" width="150px">Image Type</td>
						<td><input type="text" name="s_seriesimagetype" value="<?=$searchvars['s_seriesimagetype']?>" size="50"></td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel" width="150px">Image Comments</td>
						<td><input type="text" name="s_seriesimagecomments" value="<?=$searchvars['s_seriesimagecomments']?>" size="50"></td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel" width="150px">TR</td>
						<td><input type="text" name="s_seriestr" value="<?=$searchvars['s_seriestr']?>" title="Repetition time in milliseconds" size="10"> <span class="tiny">ms</span></td>
					</tr>
					<tr class="advanced" title="<b>Must be an integer or a criteria:</b><ul><li>> <i>N</i> (greater than)<li>>= <i>N</i> (greater than or equal to)<li>< <i>N</i> (less than)<li><= <i>N</i> (less than or equal to)<li>~ <i>N</i> (not)</ul>">
						<td class="fieldlabel" width="150px">Series number</td>
						<td><input type="text" name="s_seriesnum" value="<?=$searchvars['s_seriesnum']?>" size="10"></td>
					</tr>
					<tr class="advanced" title="<b>Must be an integer or a criteria:</b><ul><li>> <i>N</i> (greater than)<li>>= <i>N</i> (greater than or equal to)<li>< <i>N</i> (less than)<li><= <i>N</i> (less than or equal to)<li>~ <i>N</i> (not)</ul>">
						<td class="fieldlabel" width="150px">Number of files</td>
						<td><input type="text" name="s_seriesnumfiles" value="<?=$searchvars['s_seriesnumfiles']?>" size="10"></td>
					</tr>
					<tr class="advanced">
						<td class="fieldlabel" width="150px">Group</td>
						<td>
						<select name="s_seriesgroupid">
							<option value="">Select a group</option>
						<?
							$sqlstring = "select * from groups where group_type = 'series' order by group_name";
							$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								$groupid = $row['group_id'];
								$groupname = $row['group_name'];
								$groupowner = $row['group_owner'];
								
								if ($groupid == $searchvars['s_seriesgroupid']) {
									$selected = "selected";
								}
								else {
									$selected = "";
								}
								?>
								<option value="<?=$groupid?>" <?=$selected?>><?=$groupname?></option>
								<?
							}
						?>
						</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="sidelabel" style="color: gray">Results</td>
			<td style="border-bottom: 1pt solid #CCC">
				<table width="100%" cellspacing="0" cellpadding="3">
					<tr>
						<td>
							<script>
								$(function() {
									$( "#tabs-min" ).tabs();
								});
							</script>
							<div id="tabs-min" class="tabs-min">
								<div style="overflow:auto; width: 650px">
									<ul>
										<li><a href="#tabs-1">Download Data</a></li>
										<li><a href="#tabs-2">Assessments</a></li>
										<li><a href="#tabs-3" title="Enrollment and subject lists">Summary</a></li>
										<li><a href="#tabs-4">Analysis</a></li>
										<li><a href="#tabs-5">QC</a></li>
										<li><a href="#tabs-6">Admin</a></li>
									</ul>
									<div id="tabs-1">
										<? if (($searchvars['s_resultorder'] == "study") || ($action == "")) { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="downloadstudy" value="study" <?=$checked?>> Group by <b>study</b><br>
										
										<? if ($searchvars['s_resultorder'] == "series") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="downloadseries" value="series" <?=$checked?>> Series List<br>

										<? if ($searchvars['s_resultorder'] == "long") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="viewlong" value="long" <?=$checked?>> Longitudinal<br>
									</div>
									<div id="tabs-2">
										<table width="100%" cellspacing="0" cellpadding="3">
											<tr>
												<td class="fieldlabel" width="150px">Measure Search<br><span class="tiny">Search based on these critera</span></td>
												<td>
													<table style="font-size: 10pt" cellspacing="0" cellpadding="1">
														<tr>
															<td>
															<?
																$sqlstring = "select measure_name from measurenames order by measure_name";
																$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
																while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
																	$tags[] = '"' . $row['measure_name'] . '"';
																}
															?>
															<script>
																$(function() {
																	var availableTags = [<?=implode2(',',$tags);?>];
																	function split( val ) {
																		return val.split( /,\s*/ );
																	}
																	function extractLast( term ) {
																		return split( term ).pop();
																	}

																	$( "#s_measure1" )
																		// don't navigate away from the field on tab when selecting an item
																		.bind( "keydown", function( event ) {
																			if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "ui-autocomplete" ).menu.active ) {
																				event.preventDefault();
																			}
																	})
																	$( "#s_measure2" )
																		// don't navigate away from the field on tab when selecting an item
																		.bind( "keydown", function( event ) {
																			if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "ui-autocomplete" ).menu.active ) {
																				event.preventDefault();
																			}
																	})											.autocomplete({
																		minLength: 0,
																		source: function( request, response ) {
																			// delegate back to autocomplete, but extract the last term
																			response( $.ui.autocomplete.filter(
																			availableTags, extractLast( request.term ) ) );
																		},
																		focus: function() {
																			// prevent value inserted on focus
																			return false;
																		},
																		select: function( event, ui ) {
																			var terms = split( this.value );
																			// remove the current input
																			terms.pop();
																			// add the selected item
																			terms.push( ui.item.value );
																			// add placeholder to get the comma-and-space at the end
																			terms.push( "" );
																			this.value = terms.join( ", " );
																			return false;
																		}
																	});
																});
															</script>
																<input type="text" id="s_measure1" name="s_measuresearch" value="<?=$searchvars['s_measuresearch'];?>" size="50" maxlength="255"><br><span class="tiny">Example: meas1=4;meas*&lt;50;meas3~value</span>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td class="fieldlabel" width="150px">Measure Columns<br><span class="tiny">Show these columns in results</span></td>
												<td>
													<table style="font-size: 10pt" cellspacing="0" cellpadding="1">
														<tr>
															<td>
																<input type="text" id="s_measure2" name="s_measurelist" value="<?=$searchvars['s_measurelist'];?>" size="50" maxlength="255">
																<br><span class="tiny">Example: meas1,meas2,meas3<br>Or * for all measures</span>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<br>
										<? if ($searchvars['s_resultorder'] == "assessment") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="assessment" value="study" <?=$checked?>> Phenotypic measures<br>
									</div>
									<div id="tabs-3">
										<? if ($searchvars['s_resultorder'] == "table") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="viewtable" value="table" <?=$checked?>> Table<br>
										
										<? if ($searchvars['s_resultorder'] == "csv") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="viewcsv" value="csv" <?=$checked?>> Spreadsheet <span class="tiny">.csv</span><br>
										
										<? if ($searchvars['s_resultorder'] == "subject") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="downloadsubject" value="subject" <?=$checked?>> Enrollment List<br>
										
										<? if ($searchvars['s_resultorder'] == "uniquesubject") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="downloaduniquesubject" value="uniquesubject" <?=$checked?>> Subject List<br>
									</div>
									<div id="tabs-4">
										<table width="100%" cellspacing="0" cellpadding="3" style="font-size:11pt">
											<tr>
												<td class="fieldlabel" width="150px">Pipeline</td>
												<td>
												<select name="s_pipelineid" onClick="SwitchOption('viewpipeline')">
													<option value="">Select pipeline</option>
												<?
													$sqlstring2 = "select pipeline_id, pipeline_name from pipelines order by pipeline_name";
													$result2 = MySQLiQuery($sqlstring2,__FILE__,__LINE__);
													while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
														$pipelineid = $row2['pipeline_id'];
														$pipelinename = $row2['pipeline_name'];
														?>
														<option value="<?=$pipelineid?>" <? if ($searchvars['s_pipelineid'] == $pipelineid) { echo "selected"; } ?>><?=$pipelinename?></option>
														<?
													}
												?>
												</select>
												</td>
											</tr>
											<tr>
												<td class="fieldlabel" width="150px">Result name</td>
												<td><input type="text" name="s_pipelineresultname" onClick="SwitchOption('viewpipeline')" value="<?=$searchvars['s_pipelineresultname']?>" size="50" class="importantfield"></td>
											</tr>
											<tr>
												<td class="fieldlabel" width="150px">Result unit</td>
												<td><input type="text" name="s_pipelineresultunit" onClick="SwitchOption('viewpipeline')" value="<?=$searchvars['s_pipelineresultunit']?>" size="20" maxsize="20" class="importantfield"></td>
											</tr>
											<tr>
												<td class="fieldlabel" width="150px">Result type</td>
												<td>
													<input type="radio" name="s_pipelineresulttype" value="" onClick="SwitchOption('viewpipeline')" <? if ($searchvars['s_pipelineresulttype'] == '') { echo "checked"; } ?>>None<br>
													<input type="radio" name="s_pipelineresulttype" value="v" onClick="SwitchOption('viewpipeline')" <? if ($searchvars['s_pipelineresulttype'] == 'v') { echo "checked"; } ?>>Value<br>
													<input type="radio" name="s_pipelineresulttype" value="i" onClick="SwitchOption('viewpipeline')" <? if ($searchvars['s_pipelineresulttype'] == 'i') { echo "checked"; } ?>>Image<br>
													<input type="radio" name="s_pipelineresulttype" value="f" onClick="SwitchOption('viewpipeline')" <? if ($searchvars['s_pipelineresulttype'] == 'f') { echo "checked"; } ?>>File<br>
													<input type="radio" name="s_pipelineresulttype" value="h" onClick="SwitchOption('viewpipeline')" <? if ($searchvars['s_pipelineresulttype'] == 'h') { echo "checked"; } ?>>HTML<br>
												</td>
											</tr>
											<tr>
												<td class="fieldlabel" width="150px">Result value</td>
												<td valign="top">
													<select name="s_pipelineresultcompare" onClick="SwitchOption('viewpipeline')">
														<option value="=" <? if ($searchvars['s_pipelineresultcompare'] == '=') { echo "selected"; } ?>>=
														<option value=">" <? if ($searchvars['s_pipelineresultcompare'] == '>') { echo "selected"; } ?>>&gt;
														<option value=">=" <? if ($searchvars['s_pipelineresultcompare'] == '>=') { echo "selected"; } ?>>&gt;=
														<option value="<" <? if ($searchvars['s_pipelineresultcompare'] == '<') { echo "selected"; } ?>>&lt;
														<option value="<=" <? if ($searchvars['s_pipelineresultcompare'] == '<=') { echo "selected"; } ?>>&lt;=
													</select>
													<input type="text" name="s_pipelineresultvalue" onClick="SwitchOption('viewpipeline')" value="<?=$searchvars['s_pipelineresultvalue']?>" size="15" class="smallsearchbox"><br>
													<input type="checkbox" name="s_pipelinecolorize" onClick="SwitchOption('viewpipeline')" value="1" <? if ($searchvars['s_pipelinecolorize'] == 1) { echo "checked"; } ?>>Colorize <span class="tiny">low <img src="images/colorbar.png"> high</span>
													<br>
													<input type="checkbox" name="s_pipelinecormatrix" onClick="SwitchOption('viewpipeline')" value="1" <? if ($searchvars['s_pipelinecormatrix'] == 1) { echo "checked"; } ?>>Display correlation matrix <span class="tiny">Slow for large result sets</span>
													<br>
													<input type="checkbox" name="s_pipelineresultstats" onClick="SwitchOption('viewpipeline')" value="1" <? if ($searchvars['s_pipelineresultstats'] == 1) { echo "checked"; } ?>>Display result statistics
												</td>
											</tr>
										</table>
										<br><br>
									
										<? if ($searchvars['s_resultorder'] == "pipeline") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="viewpipeline" value="pipeline" <?=$checked?>> Pipeline results<br>
										
										<? if ($searchvars['s_resultorder'] == "pipelinecsv") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="viewpipelinecsv" value="pipelinecsv" <?=$checked?>> Pipeline results <span class="tiny">.csv</span><br>
										
										<? if ($searchvars['s_resultorder'] == "pipelinelong") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="pipelinelong" value="pipelinelong" <?=$checked?>> Longitudinal results <span class="tiny">bin by month</span><br>
										
										<? if ($searchvars['s_resultorder'] == "pipelinelongyear") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="pipelinelongyear" value="pipelinelongyear" <?=$checked?>> Longitudinal results <span class="tiny">bin by year</span><br>
									</div>
									<div id="tabs-5">
										QC variable <span class="tiny">built-in</span>&nbsp;
										<select name="s_qcbuiltinvariable">
											<option value="">(Select built-in QC variable)
											<option value="all" selected>ALL available variables
											<option value="iosnr">IO SNR
											<option value="pvsnr">PV SNR
											<option value="totaldisp">Total displacement [mm]
										</select>
										<br>
										QC variable <span class="tiny">modular</span>&nbsp;
										<select name="s_qcvariableid">
											<option value="">(Select modular QC variable)
											<option value="all">ALL available variables
											<?
												$sqlstring2 = "select * from qc_resultnames where qcresult_type = 'number' order by qcresult_name";
												$result2 = MySQLiQuery($sqlstring2,__FILE__,__LINE__);
												while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
													$qcresultnameid = $row2['qcresultname_id'];
													$qcresultname = $row2['qcresult_name'];
													$qcresultunits = $row2['qcresult_units'];
													?>
													<option value="<?=$qcresultnameid?>" <? if ($searchvars['s_qcvariableid'] == $qcresultnameid) { echo "selected"; } ?>><?=$qcresultname?> [<?=$qcresultunits?>]</option>
													<?
												}
												
											?>
										</select>
										<br><br>
										<? if ($searchvars['s_resultorder'] == "qcchart") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="qcchart" value="qcchart" <?=$checked?>> Chart<br>
										
										<? if ($searchvars['s_resultorder'] == "qctable") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="qctable" value="qctable" <?=$checked?>> Table<br>
									</div>
									<div id="tabs-6">
										<? if ($searchvars['s_resultorder'] == "debug") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="viewdebug" value="debug" <?=$checked?>> Debug <span class="tiny">SQL</span><br>
										
										<? if ($GLOBALS['isadmin']) { ?>
										<? if ($searchvars['s_resultorder'] == "operations") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="radio" name="s_resultorder" id="viewoperations" value="operations" <?=$checked?>> File operations
										<? } ?>
										<br>
										
										<? if ($searchvars['s_audit'] == "1") { $checked = "checked"; } else { $checked = ""; }?>
										<input type="checkbox" name="s_audit" value="1" <?=$checked?>> Audit <span class="tiny">files</span>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center" style="padding-top: 15px;">
				<input type="submit" value="Search">
			</td>
		</tr>
	</table>
			</td>
		</tr>
	</table>
	
	</form>
	</div>
	<br><br><br><br><br><br><br><br>
	<?
	}


	/* -------------------------------------------- */
	/* ------- Search ----------------------------- */
	/* -------------------------------------------- */
	function Search($s) {
		//print_r($s);
		
		$msg = ValidateSearchVariables($s);
		
		if ($msg != "") {
			?><div class="staticmessage"><?=$msg?></div><?
		}
		else {
		}
		
		/*
			***************** steps to searching *****************
			1) build the search string
			2) run the query
			3) depending on the query type, either...
				a) display the query, then end
				b) display the results
		*/
		
		/* --------- [1] get the SQL search string ---------- */
		$sqlstring = BuildSQLString($s);

		if ($sqlstring == "") { return; }
		
		/* escape all the variables and put them back into meaningful variable names */
		foreach ($s as $key => $value) {
			if (is_scalar($value)) { $$key = mysqli_real_escape_string($GLOBALS['linki'], $s[$key]); }
			else { $$key = $s[$key]; }
		}
		
		/* make modality lower case to conform with table names... MySQL table names are case sensitive when using the 'show tables' command */
		$s_studymodality = strtolower($s_studymodality);
		
		/* ---------- [2] run the query ----------- */
		$starttime = microtime(true);
		$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
		$querytime = microtime(true) - $starttime;
		
		if ($s_resultorder == "debug") {
			?>
			<span class="sublabel">Query returned <?=mysqli_num_rows($result)?> rows in <?=number_format($querytime, 4)?> sec</span>
			<div style="background-color: #EEEEEE"><?=$sqlstring?></div><br>
			<div style="background-color: #EEEEEE"><?=getFormattedSQL($sqlstring)?></div>
			<br><br><br><br>
			<?
			return;
		}

		/* display the results */
		if (mysqli_num_rows($result) > 0) {
		
			if ((mysqli_num_rows($result) > 100000) && ($s_resultorder != "pipelinecsv")) {
				?>
				<div style="border: 2px solid darkred; background-color: #FFEEEE; text-align: left; padding:5px; border-radius: 5px">
				<b>Your search returned <? echo number_format(mysqli_num_rows($result),0); ?> results... which is a lot</b>
				<br>
				Try changing the search criteria to return fewer results or select a .csv format
				</div>
				<?
				return;
			}

			/* generate a color gradient in an array (green to yellow to red) */
			$colors = GenerateColorGradient();
			$colors2 = GenerateColorGradient2();
			
			/* display the number of rows and the search time */
			?>
			<span class="sublabel">Query returned <? echo number_format(mysqli_num_rows($result),0); ?> rows in <?=number_format($querytime, 4)?> sec</span>
			<details>
				<summary style="font-size:9pt">View SQL query:</summary>
				<div style="background-color: #EEEEEE; font-family:courier new; font-size:10pt"><?=getFormattedSQL($sqlstring)?><br></div>
			</details>
			<style>
			#preview {
				position:absolute;
				border:1px solid #ccc;
				background:gray;
				padding:0px;
				display:none;
				color:#fff;
			}
			</style>
			<script type="text/javascript">
			// Popup window code
			function newPopup(url) {
				popupWindow = window.open(
					url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=no')
			}
			</script>
			<?
			/* ---------- pipeline results ------------ */
			if (($s_resultorder == "pipeline") || ($s_resultorder == "pipelinecsv")) {
				SearchPipeline($result, $s_resultorder, $s_pipelineresulttype, $s_pipelinecolorize, $s_pipelinecormatrix, $s_pipelineresultstats);
			}
			elseif ($s_resultorder == 'subject') {
				/* display only subject data */
				SearchStudy($result);
			}
			elseif ($s_resultorder == 'uniquesubject') {
				/* display only unique subject data */
				SearchSubject($result);
			}
			elseif ($s_resultorder == 'long') {
				/* display longitudinal data */
				SearchLongitudinal($result);
			}
			elseif (($s_resultorder == 'pipelinelong') || ($s_resultorder == 'pipelinelongyear')) {
				/* display longitudinal pipeline data */
				SearchLongitudinalPipeline($result, $s_resultorder);
			}
			elseif (($s_resultorder == 'qcchart') || ($s_resultorder == 'qctable')) {
				/* display longitudinal pipeline data */
				//PrintSQL($sqlstring);
				SearchQC($result, $s_resultorder, $s_qcbuiltinvariable, $s_qcvariableid);
			}
			else {
				/* regular old search */
				SearchDefault($result, $s, $colors, $colors2);
			}
		}
		else {
			?>
			<span class="sublabel">Query returned <? echo number_format(mysqli_num_rows($result),0); ?> rows in <?=number_format($querytime, 4)?> sec</span>
			<details>
				<summary style="font-size:9pt">View SQL query:</summary>
				<div style="background-color: #EEEEEE; font-family:courier new; font-size:10pt"><?=getFormattedSQL($sqlstring)?><br></div>
			</details>
			<br>
			<?
		}
	}
	
	
	/* -------------------------------------------- */
	/* ------- ValidateSearchVariables ------------ */
	/* -------------------------------------------- */
	function ValidateSearchVariables($s) {
		
		/* check which resultorder (type of result display) was selected */
		switch ($s['s_resultorder']) {
			case 'pipeline':
			case 'pipelinecsv':
				if (trim($s['s_pipelineid']) == "") {
					$msg = "Pipeline not selected";
				}
				break;
			default:
				break;
		}
		
		return $msg;
	}

	
	/* -------------------------------------------- */
	/* ------- SearchDefault ---------------------- */
	/* -------------------------------------------- */
	function SearchDefault(&$result, $s, $colors, $colors2) {
		error_reporting(-1);
		ini_set('display_errors', '1');
	
		/* escape all the variables and put them back into meaningful variable names */
		foreach ($s as $key => $value) {
			if (is_scalar($value)) { $$key = mysqli_real_escape_string($GLOBALS['linki'], $s[$key]); }
			else { $$key = $s[$key]; }
		}

		/* ---------------- regular search --------------- */
		$s_studymodality = strtolower($s_studymodality);
		$sqlstring3 = "select data_id, rating_value from ratings where rating_type = 'series' and data_modality = '$s_studymodality'";
		$result3 = MySQLiQuery($sqlstring3,__FILE__,__LINE__);
		while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
			$ratingseriesid = $row3['data_id'];
			$ratings[$ratingseriesid][] = $row3['rating_value'];
		}
		?>
		<br><br>
		<form name="subjectlist" method="post" action="search.php">
		<input type="hidden" name="modality" value="<?=$s_studymodality?>">
		<input type="hidden" name="action" value="submit">
		<?
		
		/* if its MRI, get the basic QC data */
		if (strtolower($s_studymodality) == "mr") {
			/* get the movement & SNR stats by sequence name */
			$sqlstring2 = "SELECT b.series_sequencename, max(a.move_maxx) 'maxx', min(a.move_minx) 'minx', max(a.move_maxy) 'maxy', min(a.move_miny) 'miny', max(a.move_maxz) 'maxz', min(a.move_minz) 'minz', avg(a.pv_snr) 'avgpvsnr', avg(a.io_snr) 'avgiosnr', std(a.pv_snr) 'stdpvsnr', std(a.io_snr) 'stdiosnr', min(a.pv_snr) 'minpvsnr', min(a.io_snr) 'miniosnr', max(a.pv_snr) 'maxpvsnr', max(a.io_snr) 'maxiosnr', min(a.motion_rsq) 'minmotion', max(a.motion_rsq) 'maxmotion', avg(a.motion_rsq) 'avgmotion', std(a.motion_rsq) 'stdmotion' FROM mr_qa a left join mr_series b on a.mrseries_id = b.mrseries_id where a.io_snr > 0 group by b.series_sequencename";
			$result2 = MySQLiQuery($sqlstring2,__FILE__,__LINE__);
			while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				$sequence = $row2['series_sequencename'];
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
		}
		
		/* get a list of previously downloaded series and their dates */
		$sqlstring3 = "select req_seriesid, req_completedate, req_destinationtype from data_requests where req_username = '" . $_SESSION['username'] ."' and req_modality = '$s_studymodality'";
		$result3 = MySQLiQuery($sqlstring3,__FILE__,__LINE__);
		while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
			$req_seriesid = $row3['req_seriesid'];
			$downloadhistory[$req_seriesid]['date'] = $row3['req_completedate'];
			$downloadhistory[$req_seriesid]['dest'] = $row3['req_destinationtype'];
		}
		
		?>
		<? if ($s_resultorder == "table") { ?>
		<table width="100%" class="searchresultssheet">
		<? } else { ?>
		<table width="100%" class="searchresults">
		<? } ?>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#seriesall").click(function() {
					var checked_status = this.checked;
					$(".allseries").find("input[type='checkbox']").each(function() {
						this.checked = checked_status;
					});
				});
			});
			</script>
		<?
		$projectids = array();
		$projectnames = array();

		/* get the users id */
		$sqlstringC = "select user_id from users where username = '" . $_SESSION['username'] ."'";
		$resultC = MySQLiQuery($sqlstringC,__FILE__,__LINE__);
		$rowC = mysqli_fetch_array($resultC, MYSQLI_ASSOC);
		$userid = $rowC['user_id'];
				
		/* check to see which projects this user has access to view */
		$sqlstringC = "select a.project_id 'projectid', b.project_name 'projectname' from user_project a left join projects b on a.project_id = b.project_id where a.user_id = '$userid' and (a.view_data = 1 or a.view_phi = 1)";
		//print "$sqlstringC<br>";
		$resultC = MySQLiQuery($sqlstringC,__FILE__,__LINE__);
		while ($rowC = mysqli_fetch_array($resultC, MYSQLI_ASSOC)) {
			$projectids[] = $rowC['projectid'];
		}
		
		/* tell the user if there are results for projects they don't have access to */
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$projectid = $row['project_id'];
			$projectname = $row['project_name'];
			$studyid = $row['study_id'];
			$subjectid = $row['subject_id'];
			$uid = $row['uid'];

			if (!in_array($projectid, $projectids)) {
				//echo "$projectid is not in projectids<br>";
				if (!in_array($projectname, $projectnames)) {
					//echo "$projectname is not in projectnames<br>";
					$projectnames[] = $projectname;
				}
			}
			
			/* BUT! while we're in this loop, count the number of unique studies ... */
			if ((!isset($studies)) || (!in_array($studyid, $studies))) {
				$studies[] = $studyid;
			}
			/* ... and # of unique subjects */
			if ((!isset($subjects)) || (!in_array($subjectid, $subjects))) {
				$subjects[] = $subjectid;
			}
			/* also a unique list of UIDs ... */
			if ((!isset($uids)) || (!in_array($uid, $uids))) {
				$uids[] = $uid;
			}
			/* ... and a unique list of SubjectIDs */
			if ((!isset($subjectids)) || (!in_array($subjectid, $subjectids))) {
				$subjectids[] = $subjectid;
			}
		}
		
		/* if a project is selected, get a list of the display IDs (the primary project ID) to be used instead of the UID */
		if (($s_projectid != "") && ($s_projectid != "all")) {
			foreach ($subjectids as $subjid) {
				$displayids[$subjid] = GetPrimaryProjectID($subjid, $s_projectid);
			}
		}
		//PrintVariable($displayids);
		
		/* get the measures, if requested */
		$measurenames = null;
		if ($s_measurelist != "") {
			$searchcriteria = ParseMeasureResultList($s_measurelist, "d.measure_name");
			
			if ($s_measurelist == "*") {
				$sqlstringD = "select a.subject_id, b.enrollment_id, c.*, d.measure_name from measures c join measurenames d on c.measurename_id = d.measurename_id left join enrollment b on c.enrollment_id = b.enrollment_id join subjects a on a.subject_id = b.subject_id where a.subject_id in (" . implode2(",", $subjects) . ")";
			}
			else {
				$sqlstringD = "select a.subject_id, b.enrollment_id, c.*, d.measure_name from measures c join measurenames d on c.measurename_id = d.measurename_id left join enrollment b on c.enrollment_id = b.enrollment_id join subjects a on a.subject_id = b.subject_id where a.subject_id in (" . implode2(",", $subjects) . ") and d.measure_name in (" . MakeSQLList($s_measurelist) . ")";
			}
			
			$resultD = MySQLiQuery($sqlstringD,__FILE__,__LINE__);
			while ($rowD = mysqli_fetch_array($resultD, MYSQLI_ASSOC)) {
				if ($rowD['measure_type'] == 's') {
					$measuredata[$rowD['subject_id']][$rowD['measure_name']]['value'] = $rowD['measure_valuestring'];
				}
				else {
					$measuredata[$rowD['subject_id']][$rowD['measure_name']]['value'] = $rowD['measure_valuenum'];
				}
				$measuredata[$rowD['subject_id']][$rowD['measure_name']]['notes'] = $rowD['measure_notes'];
				$measurenames[] = $rowD['measure_name'];
			}
			$measurenames = array_unique($measurenames);
			natcasesort($measurenames);
		}
		
		/* if there was a list of UIDs or alternate UIDs, determine which were not found */
		if ($s['s_subjectuid'] != "") {
			$uidsearchlist = preg_split('/[\^,;\-\'\s\t\n\f\r]+/', $s['s_subjectuid']);
			$missinguids = array_udiff($uidsearchlist,$uids, 'strcasecmp');
		}
		if ($s['s_subjectaltuid'] != "") {
			$altuidsearchlist = preg_split('/[\^,;\-\'\s\t\n\f\r]+/', $s['s_subjectaltuid']);

			/* get list of UIDs from the list of alternate UIDs */
			$sqlstringX = "select altuid from subject_altuid a left join subjects b on a.subject_id = b.subject_id where a.altuid in (" . MakeSQLList($s['s_subjectaltuid']) . ")";
			$resultX = MySQLiQuery($sqlstringX,__FILE__,__LINE__);
			while ($rowX = mysqli_fetch_array($resultX, MYSQLI_ASSOC)) {
				$altuids[] = $rowX['altuid'];
			}
			$missingaltuids = array_udiff($altuidsearchlist,$altuids, 'strcasecmp');
		}
		if ($s['s_subjectgroupid'] != "") {
			$subjectids = explode(',', GetIDListFromGroup($s['s_subjectgroupid']));
			$missingsubjects = array_udiff($subjectids,$subjects, 'strcasecmp');
			if (count($missingstudies) > 0) {
				$sqlstringY = "select uid from subjects where subject_id in (" . implode(',',$missingsubjects) . ")";
				$resultY = MySQLiQuery($sqlstringY,__FILE__,__LINE__);
				while ($rowY = mysqli_fetch_array($resultY, MYSQLI_ASSOC)) {
					$missinguids[] = $rowY['uid'];
				}
			}
		}
		if ($s['s_studygroupid'] != "") {
			$studyids = explode(',', GetIDListFromGroup($s['s_studygroupid']));
			$missingstudies = array_udiff($studyids,$studies, 'strcasecmp');
			if (count($missingstudies) > 0) {
				$sqlstringY = "select a.study_num, c.uid from studies a left join enrollment b on a.enrollment_id = b.enrollment_id left join subjects c on c.subject_id = b.subject_id where study_id in (" . implode(',',$missingstudies) . ")";
				$resultY = MySQLiQuery($sqlstringY,__FILE__,__LINE__);
				while ($rowY = mysqli_fetch_array($resultY, MYSQLI_ASSOC)) {
					$missingstudynums[] = $rowY['uid'] . $rowY['study_num'];
				}
			}
		}
		?>
		Found <b><?=count($subjects)?> subjects</b> in <b><?=count($studies)?> studies</b> with <b><?=mysqli_num_rows($result)?> series</b> matching your query
		<?
			if (count($missinguids) > 0) {
			?>
				<details>
				<summary style="font-size:9pt; background-color: orangered; color: white;"><?=count($missinguids)?> UIDs not found</summary>
				<span style="font-size:9pt"><?=implode('<br>',$missinguids)?></span>
				</details>
			<?
			}
			elseif ($uidsearchlist != '') {
			?>
				<br><span style="font-size:8pt">All UIDs found</span>
			<?
			}
			
			if (count($missingaltuids) > 0) {
			?>
				<details>
				<summary style="font-size:9pt; background-color: orangered; color: white;"><?=count($missingaltuids)?> alternate UIDs not found</summary>
				<span style="font-size:9pt"><?=implode('<br>',$missingaltuids)?></span>
				</details>
			<?
			}
			elseif ($altuidsearchlist != '') {
			?>
				<br><span style="font-size:8pt">All alternate UIDs found</span>
			<?
			}
			
			if (count($missingstudynums) > 0) {
			?>
				<details>
				<summary style="font-size:9pt; background-color: orangered; color: white;"><?=count($missingstudynums)?> Studies not found</summary>
				<span style="font-size:9pt"><?=implode('<br>',$missingstudynums)?></span>
				</details>
			<?
			}
		?>
		<br><br>
		<?
		if (count($projectnames) > 0) {
		?>
			<div style="border: 2px solid darkred; background-color: #FFEEEE; text-align: left; padding:5px; border-radius: 5px">
			<b>Your search results contain subjects enrolled in the following projects to which you do not have view access</b>
			<br>Contact your PI or project administrator for access
			<ul>
			<?
			natcasesort($projectnames);
			foreach ($projectnames as $projectname) {
				echo "<li>$projectname</li>\n";
			}
			?>
			</ul>
			</div>
			<?
		}
		
		/* ----- loop through the results and display them ----- */
		mysqli_data_seek($result,0); /* rewind the record pointer */
		$laststudy_id = "";
		$headeradded = 0;
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

			$project_id = $row['project_id'];
			/* if the user doesn't have view access to this project, skip to the next record */
			if (($projectids == null) || (!in_array($project_id, $projectids))) {
				continue;
			}
			$enrollment_id = $row['enrollment_id'];
			$subject_id = $row['subject_id'];
			$project_name = $row['project_name'];
			$project_costcenter = $row['project_costcenter'];
			$name = $row['name'];
			$birthdate = $row['birthdate'];
			$gender = $row['gender'];
			$uid = $row['uid'];
			$subject_id = $row['subject_id'];
			$study_id = $row['study_id'];
			$study_num = $row['study_num'];
			$study_desc = $row['study_desc'];
			$study_type = $row['study_type'];
			$study_height = $row['study_height'];
			$study_weight = $row['study_weight'];
			$study_alternateid = $row['study_alternateid'];
			$study_modality = strtolower($row['study_modality']);
			$study_datetime = $row['study_datetime'];
			$study_ageatscan = $row['study_ageatscan'];
			$study_type = $row['study_type'];
			$study_operator = $row['study_operator'];
			$study_performingphysician = $row['study_performingphysician'];
			$study_site = $row['study_site'];
			$study_institution = $row['study_institution'];
			$enrollsubgroup = $row['enroll_subgroup'];

			/* determine the displayID - in case the user wants to see the project specific IDs instead */
			$displayid = $uid;
			$displayidcolor = "";
			if (($s_projectid != "") && ($s_projectid != "all")) {
				if ($displayids[$subject_id] != "") {
					$displayid = $displayids[$subject_id];
					$displayidcolor = "";
				}
				else {
					$displayidcolor = "red";
				}
			}
			
			/* get list of alternate subject UIDs */
			$altuids = GetAlternateUIDs($subject_id);
			if (count($altuids) > 0) {
				$altuidlist = implode2(",",$altuids);
			}
			else {
				$altuidlist = "";
			}
			
			/* calculate the BMI */
			if (($study_height == 0) || ($study_weight == 0)) {
				$study_bmi = 0;
			}
			else {
				$study_bmi = $study_weight / ( $study_height * $study_height);
			}

			$newstudyid = $uid . $study_num;

			/* calculate age at scan */
			if (($study_ageatscan == '') || ($study_ageatscan == 0)) {
				list($year, $month, $day) = explode("-", $birthdate);
				$d1 = mktime(0,0,0,$month,$day,$year);
				list($year, $month, $day, $extra) = explode("-", $study_datetime);
				$d2 = mktime(0,0,0,$month,$day,$year);
				$ageatscan = floor(($d2-$d1)/31536000);
			}
			else {
				$ageatscan = $study_ageatscan;
			}

			/* fix some fields */
			list($lname, $fname) = explode("^",$name);
			$name = strtoupper(substr($fname,0,1)) . strtoupper(substr($lname,0,1));
			$study_desc = str_replace("^"," ",$study_desc);
			if (($s_resultorder == "study") || ($s_resultorder == "export")) {
				$study_datetime = date("M j, Y g:ia",strtotime($study_datetime));
			}
			else {
				$study_datetime = date("Y-m-d H:i",strtotime($study_datetime));
			}

			/* gather series specific info based on modality */
			if ($study_modality == "mr") {
				$series_id = $row['mrseries_id'];
				$series_datetime = $row['series_datetime'];
				$series_desc = $row['series_desc'];
				$series_altdesc = $row['series_altdesc'];
				$sequence = $row['series_sequencename'];
				$series_num = $row['series_num'];
				$series_tr = $row['series_tr'];
				$series_spacingx = $row['series_spacingx'];
				$series_spacingy = $row['series_spacingy'];
				$series_spacingz = $row['series_spacingz'];
				$series_fieldstrength = $row['series_fieldstrength'];
				$series_notes = $row['series_notes'];
				$img_rows = $row['img_rows'];
				$img_cols = $row['img_cols'];
				$img_slices = $row['img_slices'];
				$bold_reps = $row['bold_reps'];
				$numfiles = $row['numfiles'];
				$series_size = $row['series_size'];
				$numfiles_beh = $row['numfiles_beh'];
				$beh_size = $row['beh_size'];
				$series_status = $row['series_status'];
				$is_derived = $row['is_derived'];
				$move_minx = $row['move_minx'];
				$move_miny = $row['move_miny'];
				$move_minz = $row['move_minz'];
				$move_maxx = $row['move_maxx'];
				$move_maxy = $row['move_maxy'];
				$move_maxz = $row['move_maxz'];
				$rot_maxp = $row['rot_maxp'];
				$rot_maxr = $row['rot_maxr'];
				$rot_maxy = $row['rot_maxy'];
				$rot_minp = $row['rot_minp'];
				$rot_minr = $row['rot_minr'];
				$rot_miny = $row['rot_miny'];
				$iosnr = $row['io_snr'];
				$pvsnr = $row['pv_snr'];
				$motion_rsq = $row['motion_rsq'];
				
				$thumbpath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/thumb.png";
				$gifthumbpath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/thumb.gif";
				$realignpath = $GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/MotionCorrection.txt";
				
				$series_datetime = date("g:ia",strtotime($series_datetime));
				$series_size = HumanReadableFilesize($series_size);
				$beh_size = HumanReadableFilesize($beh_size);
				
				if (($sequence == "epfid2d1_64") && ($numfiles_beh < 1)) { $behcolor = "red"; } else { $behcolor = ""; }
				/* format the colors for realignment and SNR */
				$rangex = abs($move_minx) + abs($move_maxx);
				$rangey = abs($move_miny) + abs($move_maxy);
				$rangez = abs($move_minz) + abs($move_maxz);
				$rangePitch = abs($rot_minp) + abs($rot_maxp);
				$rangeRoll = abs($rot_minr) + abs($rot_maxr);
				$rangeYaw = abs($rot_miny) + abs($rot_maxy);
				
				/* calculate color based on voxel size... red (100) means more than 1 voxel displacement in that direction */
				if ($series_spacingx > 0) { $xindex = round(($rangex/$series_spacingx)*100); if ($xindex > 100) { $xindex = 100; } }
				if ($series_spacingy > 0) { $yindex = round(($rangey/$series_spacingy)*100); if ($yindex > 100) { $yindex = 100; } }
				if ($series_spacingz > 0) { $zindex = round(($rangez/$series_spacingz)*100); if ($zindex > 100) { $zindex = 100; } }

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
						$stdsmotion = 0;
					}
					else {
						$stdsmotion = (($motion_rsq - $pstats[$sequence]['avgmotion'])/$pstats[$sequence]['stdmotion']);
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
				
				if ($pstats[$sequence]['maxstdmotion'] == 0) { $motionindex = 100; }
				else { $motionindex = round(($stdsmotion/$pstats[$sequence]['maxstdmotion'])*100); }
				$motionindex = 100 + $motionindex;
				if ($motionindex > 100) { $motionindex = 100; }
				
				$maxpvsnrcolor = $colors[100-$pvindex];
				$maxiosnrcolor = $colors[100-$ioindex];
				$maxmotioncolor = $colors[100-$motionindex];
				if ($pvsnr <= 0.0001) { $pvsnr = "-"; $maxpvsnrcolor = "#FFFFFF"; }
				else { $pvsnr = number_format($pvsnr,2); }
				if ($iosnr <= 0.0001) { $iosnr = "-"; $maxiosnrcolor = "#FFFFFF"; }
				else { $iosnr = number_format($iosnr,2); }
				if ($motion_rsq <= 0.0001) { $motion_rsq = "-"; $maxmotioncolor = ""; }
				else { $motion_rsq = number_format($motion_rsq,5); }
				
				/* setup movement colors */
				$maxxcolor = $colors[$xindex];
				$maxycolor = $colors[$yindex];
				$maxzcolor = $colors[$zindex];
				if ($rangex <= 0.0001) { $rangex = "-"; $maxxcolor = "#FFFFFF"; }
				else { $rangex = number_format($rangex,2); }
				if ($rangey <= 0.0001) { $rangey = "-"; $maxycolor = "#FFFFFF"; }
				else { $rangey = number_format($rangey,2); }
				if ($rangez <= 0.0001) { $rangez = "-"; $maxzcolor = "#FFFFFF"; }
				else { $rangez = number_format($rangez,2); }
				
				/* check if this is real data, or unusable data based on the ratings, and get rating counts */
				$isbadseries = false;
				$istestseries = false;
				$ratingcount2 = '';
				$hasratings = false;
				$rowcolor = '';
				$ratingavg = '';
				if (isset($ratings)) {
					foreach ($ratings as $key => $ratingarray) {
						if ($key == $series_id) {
							$hasratings = true;
							if (in_array(5,$ratingarray)) {
								$isbadseries = true;
								//echo "IsBadSeries is true";
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
			}
			else {
				$series_id = $row[$study_modality . 'series_id'];
				$series_num = $row['series_num'];
				$series_datetime = $row['series_datetime'];
				$series_protocol = $row['series_protocol'];
				$series_numfiles = $row['series_numfiles'];
				$series_size = $row['series_size'];
				$series_notes = $row['series_notes'];
				
				$series_datetime = date("g:ia",strtotime($series_datetime));
				if ($series_numfiles < 1) { $series_numfiles = "-"; }
				if ($series_size > 1) { $series_size = HumanReadableFilesize($series_size); } else { $series_size = "-"; }
			}
			
			/* check if this has been downloaded before */
			if (array_key_exists($series_id, $downloadhistory)) {
				$downloadmsg = "Series downloaded on [" . $downloadhistory[$series_id]['date'] . "] to [" . $downloadhistory[$series_id]['dest'] . "]";
			}
			else {
				$downloadmsg = "";
			}
			
			/* display study header if study */
			if ($study_id != $laststudy_id) {
				if (($s_resultorder == "study") || ($s_resultorder == "export")) {
					/* display study header */
					?>
					<script type="text/javascript">
					$(document).ready(function() {
						$("#study<?=$study_id?>").click(function() {
							var checked_status = this.checked;
							$(".tr<?=$study_id?>").find("input[type='checkbox']").each(function() {
								this.checked = checked_status;
							});
						});
					});
					</script>
					<tr>
						<td colspan="19">
							<br>
							<table width="100%" class="searchresultstudy">
								<tr>
									<td class="header1"><?=$name?></td>
									<td class="header1"><a href="subjects.php?id=<?=$subject_id?>" class="header1" style="color: <?=$displayidcolor?>;"><?=$displayid?></a></td>
									<td class="header3">
										<?
										if (mb_strlen($altuidlist) > 60) {
											?><span title="<?=$altuidlist?>"><?=substr($altuidlist,0,60)?>...</span><?
										}
										else {
											echo "$altuidlist";
										}
									?></td>
									<td class="header2"><a href="studies.php?id=<?=$study_id?>">Study <?=$study_num?></a> <?=$study_type?></td>
									<td class="header2"><?=$project_name?> (<?=$project_costcenter?>)</td>
									<td class="header2"><?=$study_datetime?></td>
									<td class="header3"><?=$enrollsubgroup?></td>
									<td class="header3"><?=number_format($ageatscan,1)?>Y</td>
									<td class="header3"><?=$gender?></td>
									<td class="header3"><?=$study_alternateid?></td>
									<td class="header3"><?=$study_type?></td>
									<td class="header3"><?=$study_site?></td>
								</tr>
							</table>
						</td>
					</tr>
					<?
				}
				/* display the series header only once */
				if ($study_modality == "mr") {
					if (($laststudy_id == "") && ($s_resultorder != "study") && ($s_resultorder != "export") && ($s_resultorder != "csv")) {
						DisplayMRSeriesHeader($s_resultorder, $measurenames);
					}
					if (($s_resultorder == "study") || ($s_resultorder == "export")) {
						DisplayMRStudyHeader($study_id, true, $measurenames);
					}
					if ($s_resultorder == "csv") {
						if (!$headeradded) {
							$header = DisplayMRStudyHeader($study_id, false, $measurenames);
							$csv .= "$header";
							if (count($measurenames) > 0) {
								foreach ($measurenames as $measurename) {
									$csv .= ",$measurename";
								}
							}
							$csv .= "\n";
						}
						$headeradded = 1;
					}
				}
				else {
					if (($laststudy_id == "") && ($s_resultorder != "study") && ($s_resultorder != "export")) {
						DisplayGenericSeriesHeader($s_resultorder);
					}
					if (($s_resultorder == "study") || ($s_resultorder == "export")) {
						DisplayGenericStudyHeader($study_id);
					}
				}
			}
			/* set the css class for the rows */
			if (($s_resultorder == "series") || ($s_resultorder == "table") || ($s_resultorder == "operations")) {
				$rowstyle = "seriesrowsmall";
			}
			else {
				$rowstyle = "seriesrow";
			}
			/* and then display the series... */
			if ($study_modality == "mr") {
				if ($s_resultorder == "csv") {
					if ($s_usealtseriesdesc) {
						$csv .= "$series_num, $series_altdesc, $uid, $gender, $ageatscan, " . implode2(' ',$altuids) . ", $newstudyid, $study_alternateid, $study_type, $study_num, $study_datetime, $study_type, $project_name($project_costcenter), $study_height, $study_weight, $study_bmi, $series_datetime, $move_minx, $move_miny, $move_minz, $move_maxx, $move_maxy, $move_maxz, $rangex, $rangey, $rangez, $rangePitch, $rangeRoll, $rangeYaw, $pvsnr, $iosnr, $img_cols, $img_rows, $numfiles, $series_size, $sequence, $series_tr, $numfiles_beh, $beh_size";
					}
					else {
						$csv .= "$series_num, $series_desc, $uid, $gender, $ageatscan, " . implode2(' ',$altuids) . ", $newstudyid, $study_alternateid, $study_type, $study_num, $study_datetime, $study_type, $project_name($project_costcenter), $study_height, $study_weight, $study_bmi, $series_datetime, $move_minx, $move_miny, $move_minz, $move_maxx, $move_maxy, $move_maxz, $rangex, $rangey, $rangez, $rangePitch, $rangeRoll, $rangeYaw, $pvsnr, $iosnr, $img_cols, $img_rows, $numfiles, $series_size, $sequence, $series_tr, $numfiles_beh, $beh_size";
					}
					if (count($measurenames) > 0) {
						foreach ($measurenames as $measure) {
							$csv .= "," . $measuredata[$subject_id][$measure]['value'];
						}
					}
					$csv .= "\n";
				}
				else {
					//if ($series_num - $lastseriesnum > 1) {
					//	$firstmissing = $lastseriesnum+1;
					//	$lastmissing = $series_num-1;
					//	if ($firstmissing == $lastmissing) {
					//		$missingmsg = $firstmissing;
					//	}
					//	else {
					//		$missingmsg = "$firstmissing - $lastmissing";
					//	}
						?>
						<!--<tr>
							<td colspan="24" align="center" style="border-top: solid 1px #FF7F7F; border-bottom: solid 1px #FF7F7F; padding:3px; font-size:8pt">Non-consecutive series numbers in search results. Probably normal. Missing series <?=$missingmsg?></td>
						</tr>-->
						<?
					//}
					
				?>
					<tr class="tr<?=$study_id?> allseries" style="color: <?=$rowcolor?>; white-space: nowrap">
						<? if ($s_resultorder != "table") { ?>
							<td class="<?=$rowstyle?>"><input type="checkbox" name="seriesid[]" value="<?=$series_id?>"></td>
						<? } ?>
						<td class="<?=$rowstyle?>"><b><?=$series_num?></b><? if ($downloadmsg != "") { ?>&nbsp;&nbsp;<img src="images/downloaded.png" title="<?=$downloadmsg?>"><?} ?>
						</td>
						<td class="<?=$rowstyle?>">
							<span><? if ($s_usealtseriesdesc) { echo $series_altdesc; } else { echo $series_desc; } ?></span></a>
							&nbsp;<a href="preview.php?image=<?=$thumbpath?>" class="preview"><img src="images/preview.gif" border="0"></a>
							&nbsp;<a href="preview.php?image=<?=$gifthumbpath?>" class="preview"><img src="images/movie.png" border="0"></a>
						</td>
						<? if (($s_resultorder == "series") || ($s_resultorder == "table") || ($s_resultorder == "operations")) { ?>
							<td class="<?=$rowstyle?>"><a href="subjects.php?id=<?=$subject_id?>"><tt style="color: <?=$displayidcolor?>;"><?=$displayid?></tt></a></td>
							<td class="<?=$rowstyle?>"><?=$gender?></td>
							<td class="<?=$rowstyle?>"><?=number_format($ageatscan,1)?>Y</td>
							<td class="<?=$rowstyle?>"><a href="subjects.php?id=<?=$subject_id?>"><tt><? if (count($altuids) > 0) { echo implode2(', ',$altuids); } ?></tt></a></td>
							<td class="<?=$rowstyle?>"><a href="studies.php?id=<?=$study_id?>"><?=$newstudyid?></a></td>
							<td class="<?=$rowstyle?>"><a href="studies.php?id=<?=$study_id?>"><?=$study_alternateid?></a></td>
							<td class="<?=$rowstyle?>"><a href="studies.php?id=<?=$study_id?>"><?=$study_type?></a></td>
							<td class="<?=$rowstyle?>"><a href="studies.php?id=<?=$study_id?>"><?=$study_num?></a></td>
							<td class="<?=$rowstyle?>"><?=$study_datetime?></td>
							<td class="<?=$rowstyle?>"><?=$series_datetime?></td>
						<? } else { ?>
							<td class="<?=$rowstyle?>"><?=$series_datetime?></td>
						<? } ?>
						<td class="<?=$rowstyle?>" align="right" style="background-color: <?=$maxxcolor?>;"><?=$rangex;?></td>
						<td class="<?=$rowstyle?>" align="right" style="background-color: <?=$maxycolor?>;"><?=$rangey;?></td>
						<td class="<?=$rowstyle?>" align="right" style="background-color: <?=$maxzcolor?>;"><?=$rangez;?></td>
						<? if ($s_resultorder != "table") { ?>
						<td class="<?=$rowstyle?>" style="padding: 0px 5px;">
							<a href="JavaScript:newPopup('mrseriesqa.php?id=<?=$series_id?>');"><img src="images/chart.gif" border="0" title="View QA results, including movement correction"></a>
						</td>
						<td class="<?=$rowstyle?>" style="padding: 0px 5px;">
							<a href="JavaScript:newPopup('ratings.php?id=<?=$series_id?>&type=series&modality=mr');">
							<? if ($hasratings) { $image = "rating2.png"; } else { $image = "rating.png"; } ?>
							<img src="images/<?=$image?>" border="0" title="View/edit ratings">
							</a>
							<span style="font-size:7pt" title="Scale of 1 to 5, where<br>1 = good<br>5 = bad"><?=$ratingavg;?></span>
						</td>
						<td class="<?=$rowstyle?>">
							<? if (trim($series_notes) != "") { ?>
							<span title="<?=$series_notes?>" style="font-size:12pt">&#9998;</span>
							<? } ?>
						</td>
						<? } ?>
						<td class="<?=$rowstyle?>" align="right" style="background-color: <?=$maxpvsnrcolor?>;">
							<a href="stddevchart.php?h=40&w=450&min=<?=$pstats[$sequence]['minpvsnr']?>&max=<?=$pstats[$sequence]['maxpvsnr']?>&mean=<?=$pstats[$sequence]['avgpvsnr']?>&std=<?=$pstats[$sequence]['stdpvsnr']?>&i=<?=$pvsnr?>&b=yes" class="preview" style="color: black; text-decoration: none"><?=$pvsnr;?></a> 
						</td>
						<td class="<?=$rowstyle?>" align="right" style="background-color: <?=$maxiosnrcolor?>;">
							<a href="stddevchart.php?h=40&w=450&min=<?=$pstats[$sequence]['miniosnr']?>&max=<?=$pstats[$sequence]['maxiosnr']?>&mean=<?=$pstats[$sequence]['avgiosnr']?>&std=<?=$pstats[$sequence]['stdiosnr']?>&i=<?=$iosnr?>&b=yes" class="preview" style="color: black; text-decoration: none"><?=$iosnr;?></a>
						</td>
						<td class="<?=$rowstyle?>" align="right" style="background-color: <?=$maxmotioncolor?>; font-size:8pt">
							<a href="stddevchart.php?h=40&w=450&min=<?=$pstats[$sequence]['minmotion']?>&max=<?=$pstats[$sequence]['maxmotion']?>&mean=<?=$pstats[$sequence]['avgmotion']?>&std=<?=$pstats[$sequence]['stdmotion']?>&i=<?=$motion_rsq?>&b=yes" class="preview" style="color: black; text-decoration: none"><?=$motion_rsq;?></a>
						</td>
						<td class="<?=$rowstyle?>"><?=$img_cols?>&times;<?=$img_rows?></td>
						<td class="<?=$rowstyle?>">
							<?=$numfiles?>
							<?
								if ($s_audit) {
									$files = glob($GLOBALS['cfg']['archivedir'] . "/$uid/$study_num/$series_num/dicom/*.dcm");
									//print_r($files);
									if (count($files) != $numfiles) { ?><span style="color: white; background-color: red; padding: 1px 5px; font-weight: bold"><?=count($files)?></span> <? }
								}
							?>
						</td>
						<td class="<?=$rowstyle?>"><?=$series_size?></td>
						<td class="<?=$rowstyle?>"><?=$sequence?></td>
						<td class="<?=$rowstyle?>"><?=$series_tr?></td>
						<? if ($s_resultorder != "table") { ?>
						<td class="<?=$rowstyle?>" bgcolor="<?=$behcolor?>"><?=$numfiles_beh?> <span class="tiny">(<?=$beh_size?>)</span></td>
						<? }
							if (count($measurenames) > 0) {
								foreach ($measurenames as $measure) {
								?>
								<td class="<?=$rowstyle?>"><?=$measuredata[$subject_id][$measure]['value']?></td>
								<?
								}
							}
						?>
					</tr>
					<?
				}
			}
			else {
				?>
				<tr class="tr<?=$study_id?> allseries">
					<? if ($s_resultorder != "table") { ?>
						<td class="<?=$rowstyle?>"><input type="checkbox" name="seriesid[]" value="<?=$series_id?>"></td>
					<? } ?>
					<td class="<?=$rowstyle?>"><b><?=$series_num?></b></td>
					<td class="<?=$rowstyle?>"><?=$series_protocol;?></td>
					<? if (($s_resultorder == "series") || ($s_resultorder == "table") || ($s_resultorder == "operations")) { ?>
						<td class="<?=$rowstyle?>"><tt><?=$uid?></tt></td>
						<td class="<?=$rowstyle?>"><a href="subjects.php?id=<?=$subject_id?>"><tt><?=implode2(', ',$altuids)?></tt></a></td>
						<td class="<?=$rowstyle?>"><a href="studies.php?id=<?=$study_id?>"><?=$study_num?></a></td>
						<td class="<?=$rowstyle?>"><?=$study_datetime?></td>
						<td class="<?=$rowstyle?>"><?=$series_datetime?></td>
					<? } else { ?>
						<td class="<?=$rowstyle?>"><?=$series_datetime?></td>
					<? } ?>
					<td class="<?=$rowstyle?>"><?=$series_numfiles?></td>
					<td class="<?=$rowstyle?>"><?=$series_size?></td>
					<td class="<?=$rowstyle?>"><?=$series_notes?></td>
				</tr>
				<?
			}

			$laststudy_id = $study_id;
			$lastseriesnum = $series_num;
		}

		/* ---------- generate csv file ---------- */
		if ($s_resultorder == "csv") {
			$filename = "query" . GenerateRandomString(10) . ".csv";
			file_put_contents("/tmp/" . $filename, $csv);
			?>
			<div width="50%" align="center" style="background-color: #FAF8CC; padding: 5px;">
			Download .csv file <a href="download.php?type=file&filename=<?="/tmp/$filename";?>"><img src="images/download16.png"></a>
			</div>
			<?
		}
		?>
		</table>
		
		<?
			/* ---------- display download/group box ---------- */
			if (($s_resultorder == "study") || ($s_resultorder == "series") || ($s_resultorder == "export")) {
				DisplayDownloadBox($s_studymodality, $s_resultorder);
			}
			elseif ($s_resultorder == "operations") {
				DisplayFileIOBox();
			}
		?>
		<br><br><br>
		<?
	}

	
	/* -------------------------------------------- */
	/* ------- SearchPipeline --------------------- */
	/* -------------------------------------------- */
	function SearchPipeline($result, $s_resultorder, $s_pipelineresulttype, $s_pipelinecolorize, $s_pipelinecormatrix, $s_pipelineresultstats) {
		if ($s_pipelineresulttype == "i") {
			/* get the result names first (due to MySQL bug which prevents joining in this table in the main query) */
			$sqlstringX = "select * from analysis_resultnames where result_name like '%$s_pipelineresultname%' ";
			$resultX = MySQLiQuery($sqlstringX,__FILE__,__LINE__);
			while ($rowX = mysqli_fetch_array($resultX, MYSQLI_ASSOC)) {
				$resultnames[$rowX['resultname_id']] = $rowX['result_name'];
			}
			/* and get the result unit (due to the same MySQL bug) */
			$sqlstringX = "select * from analysis_resultunit where result_unit like '%$s_pipelineresultunit%' ";
			$resultX = MySQLiQuery($sqlstringX,__FILE__,__LINE__);
			while ($rowX = mysqli_fetch_array($resultX, MYSQLI_ASSOC)) {
				$resultunit[$rowX['resultunit_id']] = $rowX['result_unit'];
			}
			
			/* ---------------- pipeline results (images) --------------- */
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				//PrintVariable($row,'row');
			
				$step = $row['analysis_step'];
				$pipelinename = $row['pipeline_name'];
				$uid = $row['uid'];
				$subject_id = $row['subject_id'];
				$gender = $row['gender'];
				$study_id = $row['study_id'];
				$study_num = $row['study_num'];
				$visittype = $row['study_type'];
				$type = $row['result_type'];
				$size = $row['result_size'];
				$name = $resultnames[$row['result_nameid']];
				$unit = $resultunit[$row['result_unitid']];
				$filename = $row['result_filename'];
				$swversion = $row['result_softwareversion'];
				$important = $row['result_isimportant'];
				$lastupdate = $row['result_lastupdate'];
				
				switch($type) {
					case "v": $thevalue = $value; break;
					case "f": $thevalue = $filename; break;
					case "t": $thevalue = $text; break;
					case "h": $thevalue = $filename; break;
					case "i": $thevalue = $filename; break;
				}
				$tables["$uid$study_num"][$name] = $thevalue;
				$tables["$uid$study_num"]['subjectid'] = $subject_id;
				$tables["$uid$study_num"]['studyid'] = $study_id;
				$tables["$uid$study_num"]['studynum'] = $study_num;
				$tables["$uid$study_num"]['visittype'] = $visittype;
				$names[$name] = "blah";
			}
			//PrintVariable($tables,'Tables');
			?>
			<table cellspacing="0" class="multicoltable">
				<thead>
				<tr>
					<th>UID</th>
					<?
					foreach ($names as $name => $blah) {
						?>
						<th align="center" style="font-size:9pt"><?=$name?></th>
						<?
					}
				?>
				</tr>
				</thead>
				<?
					$maximgwidth = 1200/count($names);
					$maximgwidth -= ($maximgwidth*0.05); /* subtract 5% of image width to give a gap between them */
					if ($maximgwidth < 100) { $maximgwidth = 100; }
					foreach ($tables as $uid => $valuepair) {
						?>
						<tr style="font-weight: <?=$bold?>">
							<td><a href="studies.php?id=<?=$tables[$uid]['studyid']?>"><b><?=$uid?></b></a></td>
							<?
							foreach ($names as $name => $blah) {
								if ($tables[$uid][$name] == "") { $dispval = "-"; }
								else { $dispval = $tables[$uid][$name]; }
								list($width, $height, $type, $attr) = getimagesize("/mount$filename");
								$filesize = number_format(filesize("/mount$filename")/1000) . " kB";
							?>
								<td style="padding:2px"><a href="preview.php?image=/mount<?=$dispval?>" class="preview"><img src="preview.php?image=/mount<?=$dispval?>" style="max-width: <?=$maximgwidth?>px"></a></td>
								
							<?
							}
							?>
						</tr>
						<?
					}
				?>
			</table>
			<br><br><br><br><br><br><br><br>
			<?
		}
		else {
			/* ---------------- pipeline results (values) --------------- */
			/* get the result names first (due to MySQL bug which prevents joining in this table in the main query) */
			$sqlstringX = "select * from analysis_resultnames where result_name like '%$s_pipelineresultname%' ";
			$resultX = MySQLiQuery($sqlstringX,__FILE__,__LINE__);
			while ($rowX = mysqli_fetch_array($resultX, MYSQLI_ASSOC)) {
				$resultnames[$rowX['resultname_id']] = $rowX['result_name'];
			}
			/* and get the result unit (due to the same MySQL bug) */
			$sqlstringX = "select * from analysis_resultunit where result_unit like '%$s_pipelineresultunit%' ";
			$resultX = MySQLiQuery($sqlstringX,__FILE__,__LINE__);
			while ($rowX = mysqli_fetch_array($resultX, MYSQLI_ASSOC)) {
				$resultunit[$rowX['resultunit_id']] = $rowX['result_unit'];
			}

			/* load the data into a useful table */
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				
				$step = $row['analysis_step'];
				$pipelinename = $row['pipeline_name'];
				$uid = $row['uid'];
				$subject_id = $row['subject_id'];
				$study_id = $row['study_id'];
				$studynum = $row['study_num'];
				$birthdate = $row['birthdate'];
				$gender = $row['gender'];
				$study_datetime = $row['study_datetime'];
				$visittype = $row['study_type'];
				$type = $row['result_type'];
				$size = $row['result_size'];
				$name = $resultnames[$row['result_nameid']];
				$name2 = $resultnames[$row['result_nameid']];
				$unit = $resultunit[$row['result_unitid']];
				$unit2 = $resultunit[$row['result_unitid']];
				$text = $row['result_text'];
				$value = $row['result_value'];
				$filename = $row['result_filename'];
				$swversion = $row['result_softwareversion'];
				$important = $row['result_isimportant'];
				$lastupdate = $row['result_lastupdate'];
				
				/* calculate age at scan */
				list($year, $month, $day) = explode("-", $birthdate);
				$d1 = mktime(0,0,0,$month,$day,$year);
				list($year, $month, $day, $extra) = explode("-", $study_datetime);
				$d2 = mktime(0,0,0,$month,$day,$year);
				$ageatscan = number_format((($d2-$d1)/31536000),1);					
				
				if (strpos($unit,'^') !== false) {
					$unit = str_replace('^','<sup>',$unit);
					$unit .= '</sup>';
				}
				
				switch($type) {
					case "v": $thevalue = $value; break;
					case "f": $thevalue = $filename; break;
					case "t": $thevalue = $text; break;
					case "h": $thevalue = $filename; break;
					case "i":
						?>
						<a href="preview.php?image=/mount<?=$filename?>" class="preview"><img src="images/preview.gif" border="0"></a>
						<?
						break;
				}
				if (substr($name, -(strlen($unit))) != $unit) {
					$name .= " <b>$unit</b>";
					$name2 .= " " . $row['result_unit'];
				}
				$tables["$uid$studynum"][$name] = $thevalue;
				$tables["$uid$studynum"][$name2] = $thevalue;
				$tables["$uid$studynum"]['age'] = $ageatscan;
				$tables["$uid$studynum"]['gender'] = $gender;
				$tables["$uid$studynum"]['subjectid'] = $subject_id;
				$tables["$uid$studynum"]['studyid'] = $study_id;
				$tables["$uid$studynum"]['studynum'] = $studynum;
				$tables["$uid$studynum"]['visittype'] = $visittype;
				//$names[$name] = "blah";
				if (($thevalue > $names[$name]['max']) || ($names[$name]['max'] == "")) { $names[$name]['max'] = $thevalue; }
				if (($thevalue < $names[$name]['min']) || ($names[$name]['min'] == "")) { $names[$name]['min'] = $thevalue; }
				
				if (($thevalue > $names2[$name2]['max']) || ($names2[$name2]['max'] == "")) { $names2[$name2]['max'] = $thevalue; }
				if (($thevalue < $names2[$name2]['min']) || ($names2[$name2]['min'] == "")) { $names2[$name2]['min'] = $thevalue; }
			}

			if ($s_resultorder == "pipelinecsv") {
				$csv = "uid,studynum,sex,age";
				foreach ($names2 as $name2 => $blah) {
					$csv .= ",$name2";
				}
				$csv .= "\n";
				foreach ($tables as $uid => $valuepair) {
					$csv .= $uid . ',' . $tables[$uid]['studynum'] . ',' . $tables[$uid]['gender'] . ',' . $tables[$uid]['age'];
					foreach ($names2 as $name2 => $blah) {
						$csv .= ',' . $tables[$uid][$name2];
					}
					$csv .= "\n";
				}
				$filename = "query" . GenerateRandomString(10) . ".csv";
				file_put_contents("/tmp/" . $filename, $csv);
				?>
				<br><br>
				<div width="50%" align="center" style="background-color: #FAF8CC; padding: 5px;">
				Download .csv file <a href="download.php?type=file&filename=<?="/tmp/$filename";?>"><img src="images/download16.png"></a>
				</div>
				<?
			}
		else {
		?>
			<br><br><br><br><br>
			<br><br><br><br><br>
			<br><br><br><br><br>
			<style>
				tr.rowhover:hover { background-color: ffff96; }
				td.tdhover:hover { background-color: yellow; }
			</style>
			<table cellspacing="0">
				<tr>
					<td>UID</td>
					<td>Sex</td>
					<td>Age</td>
					<td>Visit</td>
					<?
					$csv = "studyid,sex,age";
					foreach ($names as $name => $blah) {
						$csv .= ",$name";
						?>
						<td style="max-width:25px;"><span style="padding-left: 8px; font-size:10pt; white-space:nowrap; display: block; -webkit-transform: rotate(-70deg) translate3d(0,0,0); -moz-transform: rotate(-70deg);"><?=$name?></span></td>
						<?
					}
					$csv .= "\n";
				?>
				</tr>
				<?
					foreach ($tables as $uid => $valuepair) {
						?>
						<tr style="font-weight: <?=$bold?>" class="rowhover">
							<td>
							<a href="studies.php?id=<?=$tables[$uid]['studyid']?>"><b><?=$uid?></b></a>
							</td>
							<td style="border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:9pt; padding:2px;"><?=$tables[$uid]['gender']?></td>
							<td style="border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:9pt; padding:2px;"><?=$tables[$uid]['age']?></td>
							<td style="border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:9pt; padding:2px;"><?=$tables[$uid]['visittype']?></td>
							<?
							$stats[0][$tables[$uid]['gender']]++;
							$stats[1][] = $tables[$uid]['age'];
							$csv .= $tables[$uid]['studyid'] . ',' . $tables[$uid]['gender'] . ',' . $tables[$uid]['age'];
							$i=2;
							foreach ($names as $name => $blah) {
								$val = $tables[$uid][$name];
								$range = $names[$name]['max'] - $names[$name]['min'];
								if (($val > 0) && ($range > 0)) {
									$cindex = round((($val - $names[$name]['min'])/$range)*100);
									//echo "[$val, $range, $cindex]<br>";
									if ($cindex > 100) { $cindex = 100; }
								}
								
								if ($tables[$uid][$name] == "") {
									$dispval = "-";
								}
								else {
									$dispval = $tables[$uid][$name];
									$stats[$i][] = $val;
									//$stats[$i]['numintotal'] ++;
								}
								$csv .= ',' . $tables[$uid][$name];
								if ($dispval != '-') {
									if (($dispval + 0) > 10000) { $dispval = number_format($dispval,0); }
									elseif (($dispval + 0) > 1000) { $dispval = number_format($dispval,2); }
									else { $dispval = number_format($dispval,4); }
								}
							?>
								<td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px; background-color: <? if ($s_pipelinecolorize) { if (trim($dispval) == '-') { echo "#EEE"; } else { echo $colors[$cindex]; } } ?>"><?=$dispval;?></td>
							<?
								$i++;
							}
							$csv .= "\n";
							?>
						</tr>
						<?
					}
					if ($s_pipelineresultstats == 1) {
						?>
						<tr class="rowhover">
							<td align="right"><b>N</b></td>
							<td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;">
							<?
								foreach ($stats[0] as $key => $value) { echo "$key -> $value<br>"; }
							?>
							</td>
							<?
							for($i=1;$i<count($stats);$i++) {
								$count = count($stats[$i]);
								?><td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"><?=$count?></td><?
							}
							?>
						</tr>
						<tr class="rowhover">
							<td align="right"><b>Min</b></td>
							<td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"></td>
							<?
							for($i=1;$i<count($stats);$i++) {
								$min = min($stats[$i]);
								?><td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"><?=$min?></td><?
							}
							?>
						</tr>
						<tr class="rowhover">
							<td align="right"><b>Max</b></td>
							<td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"></td>
							<?
							for($i=1;$i<count($stats);$i++) {
								$max = max($stats[$i]);
								?><td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"><?=$max?></td><?
							}
							?>
						</tr>
						<tr class="rowhover">
							<td align="right"><b>Mean</b></td>
							<td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"></td>
							<?
							for($i=1;$i<count($stats);$i++) {
								$avg = number_format(array_sum($stats[$i])/count($stats[$i]),2);
								?><td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"><?=$avg?></td><?
							}
							?>
						</tr>
						<tr class="rowhover">
							<td align="right"><b>Median</b></td>
							<td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"></td>
							<?
							for($i=1;$i<count($stats);$i++) {
								$median = number_format(median($stats[$i]),2);
								?><td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"><?=$median?></td><?
							}
							?>
						</tr>
						<tr class="rowhover">
							<td align="right"><b>Std Dev</b></td>
							<td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"></td>
							<?
							for($i=1;$i<count($stats);$i++) {
								$stdev = number_format(sd($stats[$i]),2);
								?><td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px;"><?=$stdev?></td><?
							}
							?>
						</tr>
						<?
					}
				?>
			</table>
			<? if ($s_pipelinecormatrix == 1) { ?>
			<br><br><br><br>
			<br><br><br><br>
			<b>Correlation Matrix (r)</b><br>
			<?
				foreach ($names as $name => $blah) {
					foreach ($tables as $uid => $valuepair) {
						$lists['age'][] = $tables[$uid]['age'];
						
						/* this loop gets the data into an array */
						foreach ($names as $name => $blah) {
							$lists[$name][] = $tables[$uid][$name];
						}
						
					}
				}
			?>
			<table cellspacing="0">
				<tr>
					<td>&nbsp;</td>
					<? foreach ($lists as $label => $vals1) { ?>
					<td style="max-width:25px;"><span style="padding-left: 8px; font-size:10pt; white-space:nowrap; display: block; -webkit-transform: rotate(-70deg) translate3d(0,0,0); -moz-transform: rotate(-70deg);"><?=$label?></span></td>
					<? } ?>
				</tr>
				<?
					$kashi = new Kashi();
					foreach ($lists as $label => $vals1) {
						for ($i=0;$i<count($vals1);$i++) {
							if ($vals1[$i] == 0) { $vals1[$i] = 0.000001; }
						}
						?>
						<tr class="rowhover">
							<td align="right" style="font-size:10pt"><?=$label?></td>
						<?
						foreach ($lists as $label => $vals2) {
							$starttime1 = microtime(true);
							/* compare vals1 to vals2 */
							//$coeff = Correlation($vals1,$vals2);
							for ($i=0;$i<count($vals2);$i++) {
								if ($vals2[$i] == 0) { $vals2[$i] = 0.000001; }
							}
							$coeff = $kashi->cor($vals1,$vals2);
							$coefftime = microtime(true) - $starttime1;
							
							$cindex = round((($coeff - (-1))/2)*100);
							//echo "[$val, $range, $cindex]<br>";
							if ($cindex > 100) { $cindex = 100; }
							/* display correlation coefficient */
							?>
							<td class="tdhover" style="text-align: right; border-left: 1px solid #AAAAAA; border-top: 1px solid #AAAAAA; font-size:8pt; padding:2px; background-color: <?=$colors2[$cindex]?>"><?=number_format($coeff,3);?></td>
							<?
							flush();
						}
						?>
						</tr>
						<?
					}
				?>
			</table>
			<?
				}
			}
		}
	}

	
	/* -------------------------------------------- */
	/* ------- SearchSubject ---------------------- */
	/* -------------------------------------------- */
	function SearchSubject(&$result) {
		//PrintSQLTable(&$result);
		?>
		<form name="subjectlist" method="post" action="search.php">
		<input type="hidden" name="modality" value="">
		<input type="hidden" name="action" value="submit">
		<table class="graydisplaytable">
			<thead>
				<tr>
					<th colspan="2" style="border-right:1px solid #444">Subject</th>
					<th colspan="2">Imaging Study</th>
				</tr>
			</thead>
		<?
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$uid = $row['uid'];
			$subject_id = $row['subject_id'];
			$study_id = $row['study_id'];
			$study_num = $row['study_num'];
			$study_alternateid = $row['study_alternateid'];

			/* get list of alternate subject UIDs */
			$altuids = GetAlternateUIDs($subject_id);

			?>
			<tr>
				<td><a href="subjects.php?id=<?=$subject_id?>"><?=$uid?></a></td>
				<td style="border-right:1px solid #444"><?=implode2(', ',$altuids)?></td>
				<td><a href="studies.php?id=<?=$study_id?>"><?=$uid?><?=$study_num?></a></td>
				<td><?=$study_alternateid?></td>
			</tr>
			<?
		}
		?>
		</table>
		<?
		DisplayDownloadBox('', 'subject');
	}
	
	
	/* -------------------------------------------- */
	/* ------- SearchStudy ------------------------ */
	/* -------------------------------------------- */
	function SearchStudy(&$result) {
		//PrintSQLTable(&$result);
		?>
		<form name="subjectlist" method="post" action="search.php">
		<input type="hidden" name="modality" value="">
		<input type="hidden" name="action" value="submit">
		<table class="graydisplaytable" width="100%">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>UID</th>
					<th>Project<br><span class="tiny">Enroll dates</span></th>
					<th>DOB</th>
					<th>Gender</th>
					<th>Ethnicities</th>
					<th>Education</th>
					<th>Handedness</th>
					<th>uuid</th>
					<th>Alt UIDs</th>
				</tr>
			</thead>
		<?
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$uid = $row['uid'];
			$subject_id = $row['subject_id'];
			$enrollment_id = $row['enrollment_id'];
			$project_name = $row['project_name'];
			$enroll_startdate = $row['enroll_startdate'];
			$enroll_enddate = $row['enroll_enddate'];
			$birthdate = $row['birthdate'];
			$gender = $row['gender'];
			$ethnicity1 = $row['ethnicity1'];
			$ethnicity2 = $row['ethnicity2'];
			$weight = $row['weight'];
			$handedness = $row['handedness'];
			$education = $row['education'];
			$uid = $row['uid'];
			$uuid = strtoupper($row['uuid']);

			/* get list of alternate subject UIDs */
			$altuids = GetAlternateUIDs($subject_id);
			
			$enroll_startdate = date("Y-m-d",strtotime($enroll_startdate));
			if ($enroll_enddate = '0000-00-00 00:00:00') {
				$enroll_enddate = 'present';
			}
			else {
				$enroll_enddate = date("Y-m-d",strtotime($enroll_enddate));
			}
			
			if ($gender == '') { $gender = '-'; }
			if (($ethnicity1 == '') && ($ethnicity2 == '')) { $ethnicity = '-'; }
			else { $ethnicity = "$ethnicity $ethnicity2"; }
			if ($gender == '') { $gender = '-'; }
			//if ($handedness == '') { $handedness = '-'; }
			?>
			<tr>
				<td><input type="checkbox" name="enrollmentid[]" value="<?=$enrollment_id?>"></td>
				<td><a href="subjects.php?id=<?=$subject_id?>"><?=$uid?></a></td>
				<td><?=$project_name?><br><span class="tiny"><?=$enroll_startdate?> - <?=$enroll_enddate?></span></td>
				<td><?=$birthdate?></td>
				<td><?=$gender?></td>
				<td><?=$ethnicity1?> <?=$ethnicity2?></td>
				<td><?=$education?></td>
				<td><?=$handedness?></td>
				<td class="tiny"><?=$uuid?></td>
				<td><?=implode2(', ',$altuids)?></td>
			</tr>
			<?
		}
		?>
		</table>
		<?
		DisplayDownloadBox('', 'subject');
	}
	
	
	/* -------------------------------------------- */
	/* ------- SearchLongitudinal ----------------- */
	/* -------------------------------------------- */
	function SearchLongitudinal(&$result) {
		//PrintSQLTable(&$result);
		
		$modality = '';
		/* gather scans into longitudinal format */
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$uid = $row['uid'];
			$studyid = $row['study_id'];
			$studynum = $row['study_num'];
			$studydate = $row['study_datetime'];
			$seriesdesc = $row['series_desc'];
			$seriesid = $row['mrseries_id'];
			$modality = strtolower($row['study_modality']);
			
			$longs[$uid][$seriesdesc][$studydate][] = "$seriesid,$studyid,$studynum";
			$subjects[$uid]++;
			$studies[$studyid]++;
			$series[$seriesid]++;
		}
		
		//echo "<pre>";
		//print_r($longs);
		//echo "</pre>";
		
		$maxcol = 0;
		/* get the counts for actual longitudinal studies: those with at least 2 studies */
		foreach ($longs as $uid => $value) {
			foreach ($longs[$uid] as $seriesdesc => $value2) {
				if (count($value2) > $maxcol) {
					$maxcol = count($value2);
				}
				if (count($value2) > 1) {
					foreach ($longs[$uid][$seriesdesc] as $studydate => $seriesids) {
						$subjects2[$uid]++;
						$studies2[$studydate]++;
						foreach ($longs[$uid][$seriesdesc][$studydate] as $seriesid) {
							$series2[$seriesid]++;
						}
					}
				}
			}
		}
		?>
		<form name="subjectlist" method="post" action="search.php">
		<input type="hidden" name="modality" value="<?=$modality?>">
		<input type="hidden" name="action" value="submit">
		<style>
			.darkblue { color: darkblue; font-weight: bold; }
			tr.rowhover:hover { background-color: ffff96; }
			td.tdhover:hover { background-color: yellow; }
		</style>
		<br>
		Of <span class="darkblue"><?=count($subjects)?> subjects</span>, <span class="darkblue"><?=count($studies)?> studies</span>, <span class="darkblue"><?=count($series)?> series</span>, longitudinal series were found in <span class="darkblue"><?=count($subjects2)?> subjects</span>, <span class="darkblue"><?=count($studies2)?> studies</span>, <span class="darkblue"><?=count($series2)?> series</span><br><br>
		<?

		$csv1 = "uid, protocol";
		$csv2 = "uid, protocol";
		
		?><table cellspacing="0" style="border-collapse:collapse;">
			<tr>
				<td style="padding: 1px 5px;"><b>UID</b><br><span class="tiny">(Alternate UIDs)</span></td>
				<td style="padding: 1px 5px; border-right: 2px solid #aaa"><b>Protocol</b></td>
				<?
					for ($col=1;$col<$maxcol;$col++) {
						$csv1 .= ", Time$col";
						$csv2 .= ", Time$col";
						?>
						<script type="text/javascript">
						$(document).ready(function() {
							$("#col<?=$col?>").click(function() {
								var checked_status = this.checked;
								$(".col<?=$col?>").find("input[type='checkbox']").each(function() {
									this.checked = checked_status;
								});
							});
						});
						</script>						
						<td align="right" style="color:darkblue"><b>Time <?=$col?> <input type="checkbox" name="col<?=$col?>" id="col<?=$col?>"> </b></td>
						<td class="tiny" align="center">&nbsp;</td>
						<?
					}
				?>
				<td align="right" style="color:darkblue"><b>Time <?=$maxcol?> <input type="checkbox" name="" onclick=""> </b></td>
			</tr>
		<?
		$csv1 .= "\n";
		$csv2 .= "\n";
		
		/* loop through the UIDs */
		foreach ($longs as $uid => $value) {
			$printeduid = false;
			$firstline = true;
			
			/* loop through the SeriesDescriptions */
			foreach ($longs[$uid] as $seriesdesc => $value2) {
				if (count($value2) > 1) {
					if ($firstline) { $borderstyle = "border-top: 2px solid #AAAAAA"; $firstline = false; }
					else { $borderstyle = ""; }
					?><tr class="rowhover" style="<?=$borderstyle?>"><?
					if ($printeduid != true) {
						/* get a list of alternate UIDs */
						$altuids = null;
						$sqlstringC = "select * from subject_altuid where subject_id in (select subject_id from subjects where uid = '$uid')";
						$resultC = MySQLiQuery($sqlstringC,__FILE__,__LINE__);
						while ($rowC = mysqli_fetch_array($resultC, MYSQLI_ASSOC)) {
							$altuids[] = $rowC['altuid'];
						}
						?>
						<td valign="top" style="border-top: solid black 1pt; padding: 1px 5px;"><b><?=$uid?></b><br>
						<span class="tiny">(<?=implode(', ', $altuids)?>)</span></td>
						<?
						$printeduid = true;
					}
					else {
						?><td></td><?
					}
					?><td valign="top" style="border-left: 1px solid #DDDDDD; border-right: 2px solid #aaa; white-space: nowrap; font-size:11pt; padding: 1px 5px"><?=$seriesdesc?></td><?
					$lastdate = "";
					$tspan = "";
					$csv1 .= "$uid,$seriesdesc";
					$csv2 .= "$uid,$seriesdesc";
					
					$numcolsdisplayed = 0;
					/* loop through the studies */
					foreach ($longs[$uid][$seriesdesc] as $studydate => $seriesids) {
						list($seriesid1,$studyid,$studynum) = explode(',',$seriesids[0]);
						//echo "seriesID $seriesid<br>";
						if ($lastdate != "") {
							$tspan = (strtotime($studydate) - strtotime($lastdate))/60/60/24/365;
							//echo $tspan;
							if ($tspan < 1) {
								$tspan = number_format($tspan * 365, 0) . " d";
							}
							else {
								$tspan = number_format($tspan,1) . " y";
							}
						}
						$csv1 .= ",$studydate";
						$csv2 .= ",$uid$studynum";
						$studydate = date("M j, Y", strtotime($studydate));
							if ($tspan != "") {
								$numcolsdisplayed++;
						?>
						<td class="tdhover" valign="top" align="center" style="font-size:8pt; white-space: nowrap; border-left: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; padding: 2px 5px;">&larr; <b><?=$tspan?></b> &rarr;</td>
						<?
							}
							$numcolsdisplayed++;
						?>
						<td class="tdhover col<?=ceil($numcolsdisplayed/2);?>" align="right" valign="top" style="font-size:8pt; white-space: nowrap; border-left: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; padding: 1px 5px;">
						<a href="studies.php?id=<?=$studyid?>"><?=$studydate?></a> [<?=$studynum?>]
						<?
						foreach ($seriesids as $ser) {
							list($seriesid,$studyid,$studynum) = explode(',',$ser);
							$sqlstring = "select * from " . strtolower($modality) . "_series where " . strtolower($modality) . "series_id = '$seriesid'";
							$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
							$seriesnum = $row['series_num'];
							$seriesdate = date("M j, Y h:m:s a", strtotime($row['series_datetime']));
							$protocol = $row['series_desc'];
							$sequence = $row['series_sequencename'];
							$series_num = $row['series_num'];
							$series_tr = $row['series_tr'];
							$series_spacingx = number_format($row['series_spacingx'],2);
							$series_spacingy = number_format($row['series_spacingy'],2);
							$series_spacingz = number_format($row['series_spacingz'],2);
							$series_fieldstrength = $row['series_fieldstrength'];
							$series_notes = $row['series_notes'];
							$img_rows = $row['img_rows'];
							$img_cols = $row['img_cols'];
							$img_slices = $row['img_slices'];
							$bold_reps = $row['bold_reps'];
							$numfiles = $row['numfiles'];
							$series_size = $row['series_size'];
							$numfiles_beh = $row['numfiles_beh'];
							$beh_size = $row['beh_size'];
							$series_status = $row['series_status'];
							$is_derived = $row['is_derived'];
							$title = "<b style='color:darkblue'><big>$protocol</big></b><br><br><b>Num files:</b> $numfiles<br><b>Date:</b> $seriesdate<br><b>Image dimensions (pixels):</b> $img_rows x $img_cols x $img_slices<br><b>Voxel Spacing (mm):</b> $series_spacingx x $series_spacingy x $series_spacingz";
							?><br><span title="<?=$title?>"><?=$seriesnum?> <input type="checkbox" name="seriesid[]" value="<?=$seriesid?>"></span>
							<input type="hidden" name="timepoints[<?=$seriesid?>]" value="<?=($numcolsdisplayed+1)/2?>"><!--<?=($numcolsdisplayed+1)/2?>--><?
						}
						?>
						</td><?
						$lastdate = $studydate;
					}
					for ($i=0;$i<(($maxcol*2)-$numcolsdisplayed-1);$i++) {
						?><td style="font-size:8pt; white-space: nowrap; border-left: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; padding: 1px 5px;"></td><?
						$csv1 .= ",";
						$csv2 .= ",";
					}
					?></tr><?
					$csv1 .= "\n";
					$csv2 .= "\n";
				}
			}
		}
		?></table>
		.csv file with scan dates<br>
		<textarea rows="8" cols="150"><?=$csv1?></textarea>
		<br><br>
		.csv file with study numbers<br>
		<textarea rows="8" cols="150"><?=$csv2?></textarea>
		<?
		DisplayDownloadBox(strtolower($modality), 'long');
	}

	
	/* -------------------------------------------- */
	/* ------- SearchLongitudinalPipeline --------- */
	/* -------------------------------------------- */
	function SearchLongitudinalPipeline(&$result, $s_resultorder) {
		//PrintSQLTable($result);
		
		if ($s_resultorder == 'pipelinelong') {
			$agebin = 'M';
			$agecutoffmin = 10*12;
			$agecutoffmax = 95*12;
		}
		else {
			$agebin = 'Y';
			$agecutoffmin = 10;
			$agecutoffmax = 95;
		}
		
		$modality = '';
		$i = 0;
		/* gather scans into longitudinal format */
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$uid = strtoupper(trim($row['uid']));
			$encuid = crc32(strtoupper(trim($row['uid'])));
			$studyid = $row['study_id'];
			#$studynum = $row['study_num'];
			$sex = $row['gender'];
			$age = $row['ageinmonths'];
			#$seriesdesc = $row['series_desc'];
			$resultname = $row['result_nameid'];
			$resultvalue = $row['result_value'];
			
			$series[] = $resultname;
			
			# exclude anyone out of the age range and not M or F
			if ( (($age >= $agecutoffmin) && ($age <= $agecutoffmax)) && (($sex == "M") || ($sex == "F")) ) {
				$longs[$age][$resultname][] = $resultvalue;
		
				$exportdata[$resultname][$encuid]['age'] = $age;
				$exportdata[$resultname][$encuid]['value'] = $resultvalue;
				$exportdata[$resultname][$encuid]['sex'] = $sex;
				
				$exportdata2[$encuid][$resultname]['age'] = $age;
				$exportdata2[$encuid][$resultname]['value'] = $resultvalue;
				$exportdata2[$encuid][$resultname]['sex'] = $sex;
				$i++;
			}
		}
		$series = array_unique($series);
		sort($series);
		
		ksort($longs);
		
		//echo "<pre>";
		//print_r($exportdata2);
		//echo "</pre>";
		//exit(0);
		
		/* get the month ranges */
		$thekeys = array_keys($longs);
		$minage = $thekeys[0];
		$maxage = end($thekeys);
		echo "Age range in months [$minage] to [$maxage]<br>";
		
		$csv1 = "uid";
		$csv2 = "uid";
		
		/* loop through the age bins and calculate stats on each bin */
		foreach ($longs as $bin => $val) {
			/* loop through the SeriesDescriptions */
			foreach ($val as $resultid => $values) {
				$mean = array_sum($values) / count($values);
				$count = count($values);
				$min = min($values);
				$max = max($values);
				$stdev = sd($values);
				
				$summary[$bin][$resultid]['mean'] = $mean;
				$summary[$bin][$resultid]['count'] = $count;
				$summary[$bin][$resultid]['min'] = $min;
				$summary[$bin][$resultid]['max'] = $max;
				$summary[$bin][$resultid]['stdev'] = $stdev;
			}
		}
		//echo "<pre>";
		//print_r($summary);
		//echo "</pre>";
		
		foreach ($series as $resultid) {
			$sqlstring = "select result_name from analysis_resultnames where resultname_id = '$resultid'";
			$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$resultname = $row['result_name'];
			?>
			<?=$resultname?> [<?=$resultid?>]<br>
			<table cellspacing="0" style="font-size: 8pt" border="1">
				<tr>
					<td>Bin (months)</td>
					<td>Count</td>
					<td>min</td>
					<td>max</td>
					<td>stdev</td>
					<td>Mean</td>
				</tr>
				<?
					foreach ($summary as $bin => $values) {
						$mean = $values[$resultid]['mean'];
						$count = $values[$resultid]['count'];
						$min = $values[$resultid]['min'];
						$max = $values[$resultid]['max'];
						$stdev = $values[$resultid]['stdev'];
						?>
						<tr>
							<td align="right" style="color:darkblue"><?=$bin?></td>
							<td align="right" style="color:darkblue"><?=$count?></td>
							<td align="right" style="color:darkblue"><?=$min?></td>
							<td align="right" style="color:darkblue"><?=$max?></td>
							<td align="right" style="color:darkblue"><?=$stdev?></td>
							<td align="right" style="color:darkblue"><?=$mean?></td>
						</tr>
						<?
						}
					?>
			</table>
			<?
		}
		
		$csv = "ID, age, sex, ROI, value\n";
		foreach ($exportdata as $resultid => $subject) {
			foreach ($subject as $uid => $values) {
				$age = $values['age'];
				$sex = strtoupper($values['sex']);
				$value = $values['value'];
				$csv .= "$uid, $age, $sex, $resultid, $value\n";
				$exportdatacombined[$uid]['age'] = $age;
				$exportdatacombined[$uid]['value'] += $value;
				$exportdatacombined[$uid]['sex'] = $sex;
			}
		}
		?>
		
		<br>
		Full table .csv (collapsed by UID)<br>
		<textarea rows="8" cols="150"><?=$csv?></textarea>
		
		
		<?
		$csv3 = "ID, age, sex";
		reset($exportdata2);
		$key = key($exportdata2);
		$rois = $exportdata2[$key];
		foreach ($rois as $roi => $val) {
			$csv3 .= ", $roi";
		}
		$csv3 .= "\n";
		foreach ($exportdata2 as $uid => $values) {
			$k = key($values);
			$age = $values[$k]['age'];
			$sex = strtoupper($values[$k]['sex']);
			$csv3 .= "$uid, $age, $sex";
			reset($values);
			foreach ($values as $vals) {
				$val = $vals['value'];
				$csv3 .= ", $val";
			}
			$csv3 .= "\n";
		}
		?>
		
		<br>
		Full table .csv (one UID per row, with ICV)<br>
		<textarea rows="8" cols="150"><?=$csv3?></textarea>

		<?
		$csv2 = "ID, age, sex, value\n";
		foreach ($exportdatacombined as $uid => $values) {
			$age = $values['age'];
			$sex = strtoupper($values['sex']);
			$value = $values['value'];
			$csv2 .= "$uid, $age, $sex, $value\n";
		}
		?>
		<br>
		Full table .csv (collapsed by UID, and combined regions: eg. right + left = total volume)<br>
		<textarea rows="8" cols="150"><?=$csv2?></textarea>
		<?
	}


	/* -------------------------------------------- */
	/* ------- SearchQC --------------------------- */
	/* -------------------------------------------- */
	function SearchQC(&$result, $s_resultorder, $s_qcbuiltinvariable, $s_qcvariableid) {
		//PrintSQLTable($result);
		
		/* gather scans into longitudinal format */
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$uid = strtoupper(trim($row['uid']));
			$studydate = trim($row['studydate']);
			$studyid = trim($row['study_id']);
			$studynum = trim($row['study_num']);
			$seriesdesc = trim($row['series_desc']);
			$qc[$seriesdesc][$studydate]['data']['IO SNR'] = trim($row['io_snr']);
			$qc[$seriesdesc][$studydate]['data']['PV SNR'] = trim($row['pv_snr']);
			$qc[$seriesdesc][$studydate]['data']['Total displacement X'] = $row['move_maxx'] - $row['move_minx'];
			$qc[$seriesdesc][$studydate]['data']['Total displacement Y'] = $row['move_maxy'] - $row['move_miny'];
			$qc[$seriesdesc][$studydate]['data']['Total displacement Z'] = $row['move_maxz'] - $row['move_minz'];
			$qc[$seriesdesc][$studydate]['data']['Motion rsq'] = trim($row['motion_rsq']);
			$qc[$seriesdesc][$studydate]['studyid'] = $studyid;
			$qc[$seriesdesc][$studydate]['studynum'] = "$uid$studynum";

			$mrseriesids[] = $row['mrseries_id'];
		}
		
		array_unique($mrseriesids);
		
		$mrserieslist = implode2(',', $mrseriesids);
		
		/* now we have a list of MR series ids, so lets get all modular QC for these seriesids */
		$sqlstring = "SELECT a.*, b.*,c.*,d.*, e.series_desc, DATE(series_datetime) 'studydate' FROM `qc_moduleseries` a LEFT JOIN `qc_results` b ON b.qcmoduleseries_id = a.qcmoduleseries_id LEFT JOIN `qc_modules` c ON c.qcmodule_id = a.qcmodule_id left join `qc_resultnames` d on d.qcresultname_id = b.qcresultname_id left join mr_series e on e.mrseries_id = a.series_id left join studies f on e.study_id = f.study_id WHERE a.series_id IN ($mrserieslist) and d.qcresult_type = 'number'";
		$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$modulename = $row['qcm_name'];
			$variable = $row['qcresult_name'];
			$value = $row['qcresults_valuenumber'];
			$units = $row['qcresult_units'];
			$seriesdesc = $row['series_desc'];
			$seriesid = $row['series_id'];
			$studydate = $row['studydate'];
			
			$qc[$seriesdesc][$studydate]['data'][$variable] = trim($value);
			
			if ($qc[$seriesdesc][$studydate]['studyid'] == "") {
				list($path, $uid, $studynum, $studyid, $subjectid) = GetDataPathFromSeriesID($seriesid, 'MR');
				$qc[$seriesdesc][$studydate]['studyid'] = $studyid;
				$qc[$seriesdesc][$studydate]['studynum'] = "$uid$studynum";
			}
		}
		
		//ksort($qc);
		
		//PrintVariable($qc);
		
		/* loop through the series */
		foreach ($qc as $series => $value) {
			$j=1;
			?>
			<br>
			<table width="100%" style="border: 1px solid #888; border-spacing: 0px;">
				<tr>
					<td style="background-color: lightblue; padding: 5px;" colspan="4">Charts for <b><?=$series?></b></td>
				</tr>
				<tr>
					<?
					//ksort($value);
					//PrintVariable($value);
					/* loop through the list of dates for this series */
					foreach ($value as $date => $vals) {
						/* loop through the list of variables for this date */
						foreach ($vals['data'] as $var => $val) {
							if ($val > 0) {
								$charts[$var][$date]['data']['value'] = $val;
								$charts[$var][$date]['studyid'] = $vals['studyid'];
								$charts[$var][$date]['studynum'] = $vals['studynum'];
							}
						}
					}
					
					//PrintVariable($charts);
					foreach ($charts as $chartname => $chart) {
						if (count($chart) > 2) {
							$i = 0;
							ksort($chart);
							foreach ($chart as $date => $val) {
								$xs[$i] = $date;
								$ys[$i] = $val['data']['value'];
								$studyids[$i] = $val['studyid'];
								$studynums[$i] = $val['studynum'];
								$i++;
							}
							$x = implode(',', $xs);
							$y = implode(',', $ys);
							
							?>
							<td valign="top">
							<img src='xygraph.php?h=200&w=420&t=<?=$chartname?>&x=<?=$x?>&y=<?=$y?>&xtype=dat&ytype=lin'>
							<details>
							<summary>Data</summary>
							<table class="tinytable">
								<tr>
									<th>Study</th>
									<th>Date</th>
									<th>Value</th>
								</tr>
								<?
								foreach ($xs as $i => $blah) {
									?>
									<tr>
										<td><a href="studies.php?id=<?=$studyids[$i]?>"><?=$studynums[$i]?></a></td>
										<td><?=$xs[$i]?></td>
										<td><?=$ys[$i]?></td>
									</tr>
									<?
								}
								?>
							</table>
							</details>
							</td>
							<?
							
							$x = "";
							$y = "";
							unset($xs);
							unset($ys);
							unset($studyids);
							unset($studynums);
							
							if ($j > 3) {
								$j = 0;
								?>
								</tr>
								<tr>
								<?
							}
							$j++;
						}
					}
					?>
				</tr>
			</table>
			<?
		}
	}

	
	/* -------------------------------------------- */
	/* ------- DisplayChart ----------------------- */
	/* -------------------------------------------- */
	function DisplayChart($data1, $data2, $data3, $title, $label1, $label2, $label3, $height, $id, $disptable) {
		$colors = GenerateColorGradient();
		ksort($data1);
		ksort($data2);
		ksort($data3);
		?>
			<table class="smallgrayrounded" width="100%">
				<tr>
					<td class="title"><?=$title?></td>
				</tr>
				<tr>
					<td class="body">
						<script>
							$(function() {
									var data1 = [<?
											foreach ($data1 as $date => $item) {
												$value = $data1[$date]['value'];
												$date = $date*1000;
												if (($date > 0) && ($value > 0)) {
													$jsonstrings[] .= "['$date', $value]";
												}
											}?><?=implode2(',',$jsonstrings)?>];
									<? if ($label2 != "") { ?>var data2 = [<?
											$jsonstrings = "";
											foreach ($data2 as $date => $item) {
												$value = $data2[$date]['value'];
												$date = $date*1000;
												if (($date > 0) && ($value > 0)) {
													$jsonstrings[] .= "['$date', $value]";
												}
											}?><?=implode2(',',$jsonstrings)?>];
									<? } ?>
									<? if ($label3 != "") { ?>var data3 = [<?
											$jsonstrings = "";
											foreach ($data3 as $date => $item) {
												$value = $data3[$date]['value'];
												$date = $date*1000;
												if (($date > 0) && ($value > 0)) {
													$jsonstrings[] .= "['$date', $value]";
												}
											}?><?=implode2(',',$jsonstrings)?>];
									<? } ?>
							
								var options = {
									series: {
										lines: { show: true, fill: false },
										points: { show: true }
									},
									grid: {
										hoverable: true,
										clickable: true
									},
									legend: { noColumns: 6 },
									xaxis: { mode: "time", timeformat: "%Y-%m-%d" },
									yaxis: { min: 0, tickDecimals: 1 },
									selection: { mode: "x" },
								};
								var placeholder = $("#placeholder<?=$id?>");
								var plot = $.plot(placeholder, [
								{ label: "<?=$label1?>", color: '#F00', data: data1}<? if ($label2 != "") { ?>, { label: "<?=$label2?>", color: '#4B4', data: data2} <? } ?><? if ($label3 != "") { ?>, { label: "<?=$label3?>", color: '#00F', data: data3} <? } ?> ],options);
							});
						</script>
						<div id="placeholder<?=$id?>" style="height:<?=$height?>px;" align="center"></div>
					</td>
				</tr>
				<? if ($disptable) { ?>
				<tr>
					<td class="body">
						<table class="tinytable">
							<thead>
								<th>Date</th>
								<th>Subject</th>
								<th>Study</th>
								<th>Value</th>
							</thead>
							<tbody>
						<?
							// get min, max
							$min = $data[0];
							$max = $data[0];
							foreach ($data as $date => $value) {
								$value = $data[$date]['value'];
								if ($value > $max) { $max = $value; }
								if ($value < $min) { $min = $value; }
							}
							$range = $max - $min;
							
							foreach ($data as $date => $value) {
								$value = $data[$date]['value'];
								$uid = $data[$date]['uid'];
								$studynum = $data[$date]['studynum'];
								$subjectid = $data[$date]['subjectid'];
								$studyid = $data[$date]['studyid'];
								if (($value > 0) && ($range > 0)) {
									$cindex = round((($value - $min)/$range)*100);
									if ($cindex > 100) { $cindex = 100; }
								}
								$date = $date;
								$date = date("D, d M Y", $date);
								?>
								<tr>
									<td><?=$date?></td>
									<td><a href="subjects.php?id=<?=$subjectid?>"><?=$uid?></a></td>
									<td><a href="subjects.php?id=<?=$studyid?>"><?=$uid?><?=$studynum?></a></td>
									<td align="right" bgcolor="<?=$colors[$cindex];?>"><tt><?=$value?><tt></td>
								</tr>
								<?
							}
						?>
							</tbody>
						</table>
					</td>
				</tr>
				<? } ?>
			</table>
		<?
	}

	
	/* -------------------------------------------- */
	/* ------- DisplayFileIOBox ------------------- */
	/* -------------------------------------------- */
	function DisplayFileIOBox() {
		?>
		<br>
		<table>
			<tr>
				<td style="color:#444">
					<b>Enter list of <i>tag=value pairs</i>.</b> <i>tag=value</i> pairs should be separated with semi-colons. No leading zeros on tags and values should be in single quotes
					<br>
					Example: <tt>10,1030='Anonymous'; 10,103E='Anon'</tt>
					<br>
					<span class="tiny">For a list of tags, click <a href="http://www.sno.phy.queensu.ca/~phil/exiftool/TagNames/DICOM.html">here</a>.</span>
					<br><br>
					<textarea name="dicomtags" rows="8" cols="70"></textarea>
				</td>
			</tr>
		</table>
		<input type="submit" value="Submit" onclick="document.subjectlist.action.value='anonymize'">
		</form>
		<?
	}
	
	
	/* -------------------------------------------- */
	/* ------- DisplayDownloadBox ----------------- */
	/* -------------------------------------------- */
	function DisplayDownloadBox($s_studymodality, $s_resultorder) {
		//PrintVariable($s_resultorder, 's_resultorder');
		?>
			<br><br>
			
			<script type="text/javascript">
				$(document).ready(function() {
					/* hide it by default */
					$('.remoteftp').hide();
					$('.remotenidb').hide();
					$('.publicdownload').hide();
					<? if ($s_resultorder != 'subject') { ?>
					$('.export').hide();
					<? } else { ?>
					$('.dirstructure').hide();
					<?} ?>
					$('.dicom').hide();

					$('input[name=filetype]').click(function() {
						//alert('hi');
						if ($('#filetype:checked').val() == 'dicom') {
							$('.dicom').show();
						}
						else {
							$('.dicom').hide();
						}
					});
					
					/* click events */
					$('input[name=destination]').click(function() {
						//alert('hi');

						if ($('#destination:checked').val() == 'export') {
							$('.export').show("highlight",{},1000);
							$('.format').slideUp();
							$('.dirstructure').slideUp();
						}
						else if ($('#destination:checked').val() == 'ndar') {
							$('.export').slideUp();
							$('.format').slideUp();
							$('.dirstructure').slideUp();
							$('.datatoexport').slideUp();
						}
						else {
							$('.export').slideUp();
							$('.format').show("highlight",{},1000);
							$('.dirstructure').show("highlight",{},1000);
						}
						
						if ($('#destination:checked').val() == 'remoteftp') {
							$('.remoteftp').show("highlight",{},1000);
						}
						else {
							$('.remoteftp').slideUp();
						}
						if ($('#destination:checked').val() == 'remotenidb') {
							$('.remotenidb').show("highlight",{},1000);
							$('.export').slideUp();
							$('.dirstructure').slideUp();
							$('.format').slideUp();
							$('.datatoexport').slideUp();
						}
						else {
							$('.remotenidb').slideUp();
						}
						if ($('#destination:checked').val() == 'publicdownload') {
							$('.publicdownload').show("highlight",{},1000);
						}
						else {
							$('.publicdownload').slideUp();
						}
					});
					
					/* types of information to download */
					$('input[name=downloadimaging]').click(function() {
						/* hide all ... */
						$('#sectionformat').hide();
						$('#sectiondirstructure').hide();
						$('.beh').hide();
						/* ... then show the appropriate sections */
						if ($('#downloadimaging:checked').val() == '1') {
							$('#sectionformat').show();
							$('#sectiondirstructure').show();
						}
						if ($('#downloadbeh:checked').val() == '1') {
							$('.beh').show();
							$('#sectiondirstructure').show();
						}
					});
					
					$('input[name=downloadbeh]').click(function() {
						/* hide all ... */
						$('#sectionformat').hide();
						$('#sectiondirstructure').hide();
						$('.beh').hide();
						/* ... then show the appropriate sections */
						if ($('#downloadimaging:checked').val() == '1') {
							$('#sectionformat').show();
							$('#sectiondirstructure').show();
						}
						if ($('#downloadbeh:checked').val() == '1') {
							$('.beh').show();
							$('#sectiondirstructure').show();
						}
					});
				});
			</script>
			
			<table class="download">
				<tr>
					<td class="title">
						Add to Group
					</td>
				</tr>
				<tr>
					<td class="section">
						<table class="subdownload" width="100%">
							<tr>
								<td class="label">
									Subject
								</td>
								<td class="main">
									<?
										$sqlstring = "select user_id from users where username = '" . $GLOBALS['username'] . "'";
										$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
										$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
										$userid = $row['user_id'];
									?>
									<select name="subjectgroupid" style="width:150px">
										<?
											$sqlstring = "select * from groups where group_type = 'subject' order by group_name";
											$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
											while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
												$groupid = $row['group_id'];
												$groupname = $row['group_name'];
												?>
												<option value="<?=$groupid?>"><?=$groupname?>
												<?
											}
										?>
									</select>
									<input type="submit" name="addtogroup" value="Add" onclick="document.subjectlist.action='groups.php';document.subjectlist.action.value='addsubjectstogroup'">
									<br>
								</td>
							</tr>
							<tr>
								<td class="label">
									Study
								</td>
								<td class="main">
									<select name="studygroupid" style="width:150px">
										<?
											$sqlstring = "select * from groups where group_type = 'study' order by group_name";
											$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
											while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
												$groupid = $row['group_id'];
												$groupname = $row['group_name'];
												?>
												<option value="<?=$groupid?>"><?=$groupname?>
												<?
											}
										?>
									</select>
									<input type="submit" name="addtogroup" value="Add" onclick="document.subjectlist.action='groups.php';document.subjectlist.action.value='addstudiestogroup'">
								</td>
							</tr>
							<tr>
								<td class="label">
									Series
								</td>
								<td class="main">
									<select name="seriesgroupid" style="width:150px">
										<?
											$sqlstring = "select * from groups where group_type = 'series' order by group_name";
											$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
											while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
												$groupid = $row['group_id'];
												$groupname = $row['group_name'];
												?>
												<option value="<?=$groupid?>"><?=$groupname?>
												<?
											}
										?>
									</select>
									<input type="submit" name="addtogroup" value="Add" onclick="document.subjectlist.action='groups.php';document.subjectlist.action.value='addseriestogroup'">
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			
			<br><br>
			
			<table class="download">
				<tr>
					<td class="title">
						Download Data
					</td>
				</tr>
				<tr>
					<td class="section">
						<table class="subdownload" width="100%">
							<tr>
								<td class="label">
									Download Type
								</td>
								<td class="main">
									<table>
										<tr>
											<td valign="top" align="right">Destination</td>
											<td valign="top">
												<input type="radio" name="destination" id="destination" value="web" <? if ($GLOBALS['cfg']['ispublic']) { echo "checked"; } ?>>Web <span class="tiny">Download zipped file via webpage</span><br>
												<? if ($GLOBALS['isadmin']) { ?>
												<input type="radio" name="destination" id="destination" value="publicdownload">Public Download
												<table class="publicdownload" style="margin-left:40px; border:1px solid #aaa; border-radius: 3px">
													<tr>
														<td align="right" valign="top" width="30%" style="font-size:10pt">Download short description</td>
														<td><input type="text" name="publicdownloaddesc" maxlength="255"><span class="tiny">Max 255 chars</span></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="30%" style="font-size:10pt">Release&nbsp;notes</td>
														<td><textarea name="publicdownloadreleasenotes"></textarea></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="30%" style="font-size:10pt">Password <img src="images/help.gif" title="Set a password for the download link, otherwise anyone with the link can download the data. Leave blank for no password"></td>
														<td><input type="password" name="publicdownloadpassword"></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="30%" style="font-size:10pt">Share download within this system<img src="images/help.gif" title="This option allows other users (users within this system, not public users) to modify or delete this public download"></td>
														<td><input type="checkbox" name="publicdownloadshareinternal" value="1"></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="30%" style="font-size:10pt">Require registration<img src="images/help.gif" title="If selected, anyone downloading the files must create an account on NiDB before downloading the file. Useful to keep track of who downloads this download"></td>
														<td><input type="checkbox" name="publicdownloadregisterrequired" value="1" checked></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="30%" style="font-size:10pt">Expiration Date<img src="images/help.gif" title="Time after creating the download when it will be deleted from the system and become unavailable for download"></td>
														<td>
															<input type="radio" name="publicdownloadexpire" value="7" checked>7 days<br>
															<input type="radio" name="publicdownloadexpire" value="30">30 days<br>
															<input type="radio" name="publicdownloadexpire" value="90">90 days<br>
															<input type="radio" name="publicdownloadexpire" value="0">No expiration<br>
														</td>
													</tr>
												</table>
												<br>
												<? } 
											if (!$GLOBALS['cfg']['ispublic']) {
												if ($s_resultorder != 'subject') {
													?>
													<input type="radio" name="destination" id="destination" value="localftp" <? if ($GLOBALS['isguest']) { echo "checked"; } ?>>Local FTP site<br>
													<?
													if (!$GLOBALS['isguest']) {
														?>
														<input type="radio" name="destination" id="destination" value="remoteftp">Remote FTP site
														<table class="remoteftp" style="margin-left:40px; border:1px solid gray">
															<tr><td align="right" width="30%" style="font-size:10pt">Remote FTP Server</td><td><input type="text" name="remoteftpserver"></td></tr>
															<tr><td align="right" width="30%" style="font-size:10pt">Remote Directory</td><td><input type="text" name="remoteftppath"></td></tr>
															<tr><td align="right" width="30%" style="font-size:10pt">Username</td><td><input type="text" name="remoteftpusername"></td></tr>
															<tr><td align="right" width="30%" style="font-size:10pt">Password</td><td><input type="text" name="remoteftppassword"></td></tr>
															<tr><td align="right" width="30%" style="font-size:10pt">Port number</td><td><input type="text" name="remoteftpport" value="21" size="5"></td></tr>
														</table>
														<br>
														<input type="radio" name="destination" id="destination" value="remotenidb">Remote NiDB site
														<select name="remoteconnid" class="remotenidb">
															<option value="">(Select connection)</option>
															<?
																$sqlstring = "select * from remote_connections where user_id = (select user_id from users where username = '" . $GLOBALS['username'] . "') order by conn_name";
																$result = MySQLiQuery($sqlstring, __FILE__, __LINE__);
																while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
																	$connid = $row['remoteconn_id'];
																	$connname = $row['conn_name'];
																	$remoteserver = $row['remote_server'];
																	$remoteusername = $row['remote_username'];
																	$remotepassword = $row['remote_password'];
																	$remoteinstanceid = $row['remote_instanceid'];
																	$remoteprojectid = $row['remote_projectid'];
																	$remotesiteid = $row['remote_siteid'];
																	?>
																	<option value="<?=$connid?>"><?=$connname?> - [<?=$remoteusername?>@<?=$remoteserver?> Project: <?=$remoteprojectid?>]
																	<?
																}
															?>
														</select>
														<?
													}
												}
												if (!$GLOBALS['isguest']) {
													if ($s_resultorder != 'subject') {
														?>
														<br>
														<input type="radio" name="destination" id="destination" value="nfs" checked>Linux NFS Mount <input type="text" name="nfsdir" size="50">
														<?
													}
												}
													?>
												<br>
											</td>
										</tr>
										<?
										}
									?>
										<tr>
											<td valign="top" align="right">Export<br><span class="tiny">Placed in local FTP</span></td>
											<td valign="top">
											<?
											if (!$GLOBALS['isguest']) {
												if ($s_resultorder != 'subject') {
													?>
												<input type="radio" name="destination" id="destination" value="export">Export package<br>
												<input type="radio" name="destination" id="destination" value="ndar">NDAR/RDoC submission</span><br>
												<?
												}
											}
											?>
											</td>
										</tr>
									</table>
								</td>
								<td class="notes">
									<details>
										<summary align="center"><b>Notes</b><br><span class="tiny">click to expand</span></summary>
										<span class="sublabel">
										<ul>
										<li>example NFS directory <tt>/prod1/allegra/fmri/go1</tt>
										<li>NFS destination directory MUST be read/write
										<li>No spaces or trailing slash in NFS directory names
										<li>NiDB FTP data accessible for 7 days
										<li><span class="sublabel" style="color: darkred">You cannot send DICOM data directly to a remote site, you must send it to a local server and ensure all PHI is removed before sending it outside of this network</span>
										</ul>
										</span>
									</details>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="datatoexport" id="sectiondatatype">
					<td class="section">
						<table class="subdownload" width="100%">
							<tr>
								<td class="label">
									Data
								</td>
								<td class="main">
									<input type="checkbox" name="downloadimaging" id="downloadimaging" value="1" checked>Imaging<br>
									<input type="checkbox" name="downloadbeh" id="downloadbeh" value="1" checked>Behavioral<br>
									<span title="Includes all QC metrics computed on the data"><input type="checkbox" name="downloadqc" id="downloadqc" value="1">QC</span>
									<br>
									<span title="Includes age at scan, sex, and other demographics. This is places in a demographics.txt file in the root of the download directory"><input type="checkbox" name="downloadqc" id="downloadqc" value="1">Demographics</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="export" id="sectionexport">
					<td class="section">
						<table class="subdownload" width="100%">
							<tr>
								<td class="label">
									Export
								</td>
								<td class="main">
									<b>Things to export</b>
									<br><br>
									<input type="checkbox" name="subjectphenotype" value="1" checked>Subject phenotypic data<br>
									<input type="checkbox" name="subjectforms" value="1" checked>Subject forms data<br>
									<input type="checkbox" name="studydata" value="1" checked>Study data <span class="tiny"><b>Only</b> for the studies selected</span><br>
									<input type="checkbox" name="seriesdata" value="1" checked>Series data <span class="tiny"><b>Only</b> for the series selected</span><br>
									<input type="checkbox" name="allsubject" value="1"><b>Everything</b> associated with the selected subjects <span class="tiny">Includes all data associated with subject, regardless of project or modality</span><br>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<? if (strtolower($s_studymodality) == "mr") { ?>
				<tr class="format" id="sectionformat">
					<td class="section">
						<table class="subdownload" width="100%">
							<tr>
								<td class="label">
									Format
								</td>
								<td class="main">
									<table cellpadding="5">
										<tr>
											<td valign="top">
												<span class="tiny">Conversion to other formats applies only to data stored originally in DICOM format</span><br>
												<input type="radio" name="filetype" id="filetype" value="nifti3d" checked>Nifti 3D<br>
												<input type="radio" name="filetype" id="filetype" value="nifti4d">Nifti 4D<br>
												<input type="radio" name="filetype" id="filetype" value="analyze3d">Analyze 3D<br>
												<input type="radio" name="filetype" id="filetype" value="analyze4d">Analyze 4D<br>
												<input type="radio" name="filetype" id="filetype" value="dicom">DICOM<br>
												<div class="dicom" style="padding-left: 15px;">
												<input type="radio" name="anonymize" value="0">No DICOM anonymization<br>
												<input type="radio" name="anonymize" value="1" checked>Anonymize DICOM - <i>light</i><br>
												<input type="radio" name="anonymize" value="2">Anonymize DICOM - <i>complete</i><br>
												</div>
											</td>
										</tr>
										<tr>
											<td valign="top">
												<input type="checkbox" name="gzip" value="1">Gzip files
											</td>
										</tr>
									</table>
								</td>
								<td class="notes">
									<details>
										<summary><b>Anonymization Notes</b><br><span class="tiny">click to expand</span></summary>
										<span class="sublabel">
										<ul>
										<li>No DICOM anonymization - not recommended
										<li>DICOM anonymization <u>light</u> removes:
											<ul>
												<li style="white-space: nowrap">(0008,0090) ReferringPhysiciansName
												<li style="white-space: nowrap">(0008,1050) PerformingPhysiciansName
												<li style="white-space: nowrap">(0008,1070) OperatorsName
												<li style="white-space: nowrap">(0010,0010) PatientName
												<li style="white-space: nowrap">(0010,0030) PatientBirthDate
											</ul>
										<li>DICOM anonymization <u>complete</u> removes all of the above and the following:
											<ul>
												<li style="white-space: nowrap">(0008,0080) InstitutionName
												<li style="white-space: nowrap">(0008,0081) InstitutionAddress
												<li style="white-space: nowrap">(0008,1010) StationName
												<li style="white-space: nowrap">(0008,1030) StudyDescription
												<li style="white-space: nowrap">(0008,0020) StudyDate
												<li style="white-space: nowrap">(0008,0021) SeriesDate
												<li style="white-space: nowrap">(0008,0022) AcquisitionDate
												<li style="white-space: nowrap">(0008,0023) ContentDate
												<li style="white-space: nowrap">(0008,0030) StudyTime
												<li style="white-space: nowrap">(0008,0031) SeriesTime
												<li style="white-space: nowrap">(0008,0032) AcquisitionTime
												<li style="white-space: nowrap">(0008,0033) ContentTime
												<li style="white-space: nowrap">(0010,0020) PatientID
												<li style="white-space: nowrap">(0010,1030) PatientWeight
											</ul>
										</span>
										</ul>
										</span>
									</details>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<? } ?>
				<tr class="dirstructure" id="sectiondirstructure">
					<td class="section">
						<table class="subdownload" width="100%">
							<tr>
								<td class="label">
									Directory<br>Structure
								</td>
								<td class="main">
									<table cellpadding="5">
										<tr>
											<td valign="top">
												<b>Directory Format</b>
												<table cellspacing="0" cellpadding="0">
													<tr>
														<td><input type="radio" name="dirformat" value="datetime">Study datetime</td>
														<td style="color:#333"><tt>20110704_123456</td>
													</tr>
													<tr>
														<td><input type="radio" name="dirformat" value="datetimeshortid" checked>Study datetime with study ID</td>
														<td style="color:#333"><tt>20110704_123456_S1234ABC1</td>
													</tr>
													<tr>
														<td><input type="radio" name="dirformat" value="datetimelongid">Study datetime with project and study ID &nbsp;</td>
														<td style="color:#333"><tt>20110704_123456_S1234ABC_999999_1</td>
													</tr>
													<tr>
														<td><input type="radio" name="dirformat" value="datetimeorigid">Study datetime with original scan ID</td>
														<td style="color:#333"><tt>20110704_123456_09037500</td>
													</tr>
													<tr>
														<td><input type="radio" name="dirformat" value="shortid">Study ID</td>
														<td style="color:#333"><tt>S1234ABC1</tt></td>
													</tr>
													<tr>
														<td><input type="radio" name="dirformat" value="longid">Project and study ID</td>
														<td style="color:#333"><tt>S1234ABC_999999_1</tt></td>
													</tr>
													<tr>
														<td><input type="radio" name="dirformat" value="altuid">Primary alternate subject ID<br><span class="tiny">With incremental study numbers</span></td>
														<td style="color:#333"><tt>M234821/1<br>M234821/2</tt></td>
													</tr>
													<? if ($s_resultorder == 'long') { ?>
													<tr>
														<td valign="top"><input type="radio" name="dirformat" value="longitudinal">Longitudinal</td>
														<td style="color:#333"><tt>S1234ABC<br>&nbsp;&nbsp;&nbsp;&#8627;&nbsp;time1<br>&nbsp;&nbsp;&nbsp;&#8627;&nbsp;time2</tt></td>
													</tr>
													<? } ?>
												</table>

												<br>
												<b>Series Directories</b><br>
												<table>
													<tr>
														<td><input type="radio" name="preserveseries" value="1">Preserve series number</td>
														<td style="color:#333"><tt>8 9 10 &rarr; 8 9 10</tt></td>
													</tr>
													<tr>
														<td><input type="radio" name="preserveseries" value="0" checked>Renumber series</td>
														<td style="color:#333"><tt>8 9 10 &rarr; 1 2 3</tt></td>
													</tr>
													<tr>
														<td><input type="radio" name="preserveseries" value="2">Use protocol name</td>
														<td style="color:#333"><tt>1 &nbsp;2 &nbsp;3 &nbsp;&rarr; &nbsp;Localizer &nbsp;Resting &nbsp;Task_A</tt><br><span class="tiny">Characters other than numbers and letters are replaced with underscores</span></td>
													</tr>
													<tr>
														<td><input type="radio" name="preserveseries" value="3">ABIDE format</td>
														<td style="color:#333"><tt>1 &nbsp;2 &nbsp;3 &nbsp;&rarr; &nbsp;anat_1 &nbsp;anat_2 &nbsp;anat_3</tt></td>
													</tr>
												</table>
												
												<? if ($s_studymodality == "mr") { ?>

												<br>
												<span class="beh">
												<b>Behavioral Data</b><br>
												<table cellspacing="0" cellpadding="0">
													<tr class="beh">
														<td><input type="radio" name="behformat" value="behroot">Place in in root</td>
														<td style="color:#333"><tt>S1234ABC/file.log</tt></td>
													</tr>
													<tr class="beh">
														<td><input type="radio" name="behformat" value="behrootdir" checked>Place in <input type="text" name="behdirnameroot" value="beh" size="6"> directory in root</td>
														<td style="color:#333"><tt>S1234ABC/beh/file.log</tt></td>
													</tr>
													<tr class="beh">
														<td><input type="radio" name="behformat" value="behseries">Place in series directories</td>
														<td style="color:#333"><tt>S1234ABC/2/file.log</tt></td>
													</tr>
													<tr class="beh">
														<td><input type="radio" name="behformat" value="behseriesdir">Place in <input type="text" name="behdirnameseries" value="beh" size="6"> directory in series &nbsp;</td>
														<td style="color:#333"><tt>S1234ABC/2/beh/file.log</tt></td>
													</tr>
												</table>
												</span>
												<? } ?>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="background-color: white; border-radius:5px; padding: 8px" align="left">
						<input type="submit" name="download" value="Download" onclick="document.subjectlist.action='search.php';document.subjectlist.action.value='submit'" style="margin-left: 300px"><br>
					</td>
				</tr>
			</table>
			</form>
		<?
	}
	

	/* -------------------------------------------- */
	/* ------- BuildSQLString --------------------- */
	/* -------------------------------------------- */
	function BuildSQLString($s) {
		
		Debug(__FILE__, __LINE__, "<pre>" . print_r($s,true) . "</pre>");
		
		/* escape all the variables and put them back into meaningful variable names */
		foreach ($s as $key => $value) {
			if (is_scalar($value)) {
				$$key = trim(mysqli_real_escape_string($GLOBALS['linki'], $s[$key]));
			}
			else {
				$$key = $s[$key];
			}
		}

		/* make modality lower case to conform with table names... MySQL table names are case sensitive when using the 'show tables' command */
		$s_studymodality = strtolower($s_studymodality);
		$modality = $s_studymodality;
		/* also make a variable for the series table */
		$modalitytable = $s_studymodality . "_series";
		
		/* check if modality_series table actually exists */
		$sqlstring = "show tables from " . $GLOBALS['cfg']['mysqldatabase'] . " like '$modalitytable'";
		$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
		if (mysqli_num_rows($result) < 1) {
			?>
			<?=$modality?>_series table does not exist. Unable to query information about <?=$modality?> series
			<?
			return "";
		}
		
		/* determine which fields have criteria, build the where clause */
		if (($s_subjectuid != "") || ($s_subjectgroupid != "")) {
			if ($s_subjectgroupid != "") {
				$ids = GetIDListFromGroup($s_subjectgroupid);
				$sqlwhere .= " and `subjects`.subject_id in (" . $ids . ")";
			}
			else {
				if (preg_match('/[\^\,;\-\'\s]/', $s_subjectuid) == 0) {
					$sqlwhere .= " and `subjects`.uid = '$s_subjectuid'";
				}
				else {
					$sqlwhere .= " and `subjects`.uid in (" . MakeSQLList($s_subjectuid) . ")";
				}
			}
		}
		if ($s_subjectaltuid != "") {
			if (preg_match('/[\^\,;\-\'\s]/', $s_subjectaltuid) == 0) {
				$sqlwhere .= "and `subject_altuid`.altuid like '%$s_subjectaltuid%'";
			}
			else {
				$sqlwhere .= "and `subject_altuid`.altuid in (" . MakeSQLList($s_subjectaltuid) . ")";
			}
		}
		if ($s_subjectname != "") { $sqlwhere .= " and `subjects`.name like '%$s_subjectname%'"; }
		if ($s_subjectdobstart != "") { $sqlwhere .= " and `subjects`.birthdate >= '$s_subjectdobstart'"; }
		if ($s_subjectdobend != "") { $sqlwhere .= " and `subjects`.birthdate <= '$s_subjectdobend'"; }
		if ($s_subjectgender != "") { $sqlwhere .= " and `subjects`.gender = '$s_subjectgender'"; }
		if ($s_projectid != "all") {
			$sqlwhere .= " and `projects`.project_id = $s_projectid";
		}
		else {
			$tmpsqlstring = "select project_id from projects where instance_id = '" . $_SESSION['instanceid'] . "'";		
			$tmpresult = MySQLiQuery($tmpsqlstring,__FILE__,__LINE__);
			while ($tmprow = mysqli_fetch_array($tmpresult, MYSQLI_ASSOC)) {
				if ($tmprow['project_id'] != "") {
					$projectids[] = $tmprow['project_id'];
				}
			}
			$projectidlist = implode(",",$projectids);
			$sqlwhere .= " and `projects`.project_id in ($projectidlist)";
		}
		if ($s_enrollsubgroup != "") { $sqlwhere .= " and `enrollment`.enroll_subgroup = '$s_enrollsubgroup'"; }
		if ($s_studygroupid != "") {
			$studyids = GetIDListFromGroup($s_studygroupid);
			$sqlwhere .= " and `studies`.study_id in (" . $studyids . ")";
		}
		if ($s_studyinstitution != "") { $sqlwhere .= " and `studies`.study_institution like '%$s_studyinstitution%'"; }
		if ($s_studyequipment != "") { $sqlwhere .= " and `studies`.study_site like '%$s_studyequipment%'"; }
		if ($s_studyaltscanid != "") {
			if (preg_match('/[\^\,;\-\'\s]/', $s_studyaltscanid) == 0) {
				$sqlwhere .= " and `studies`.study_alternateid like '%$s_studyaltscanid%'";
			}
			else {
				$sqlwhere .= " and `studies`.study_alternateid in (" . MakeSQLList($s_studyaltscanid) . ")";
			}
		}
		if ($s_studydatestart != "") { $sqlwhere .= " and `studies`.study_datetime >= '$s_studydatestart 00:00:00'"; }
		if ($s_studydateend != "") { $sqlwhere .= " and `studies`.study_datetime <= '$s_studydateend 23:59:59'"; }
		if ($s_studydesc != "") { $sqlwhere .= " and `studies`.study_desc like '%$s_studydesc%'"; }
		if ($s_studyphysician != "") { $sqlwhere .= " and `studies`.study_performingphysician like '%$s_studyphysician%'"; }
		if ($s_studyoperator != "") { $sqlwhere .= " and `studies`.study_operator like '%$s_studyoperator%'"; }
		if ($s_studytype != "") { $sqlwhere .= " and `studies`.study_type like '%$s_studytype%'"; }
		if ($s_seriesgroupid != "") {
			$seriesids = GetIDListFromGroup($s_seriesgroupid);
			$sqlwhere .= " and `$modalitytable`.$modality" . "series_id in (" . $seriesids . ")";
		}
		if (($s_seriesdesc != "") && ($s_pipelineid == "")) {
			$sqlwhere .= " and (";
			/* if it contains a comma, the search will be OR */
			//if (strpos($s_seriesdesc,',') !== false) {
				$seriesdescs = explode(',',$s_seriesdesc);
				$wheres = array();
				foreach ($seriesdescs as $seriesdesc) {
					if ($s_usealtseriesdesc) {
						$wheres[] = "(`$modalitytable`.series_altdesc like '%" . trim($seriesdesc) . "%')";
					}
					else {
						/* protocol name for MR is stored in series_desc, all other modalities is series_protocol */
						if ($modality == "mr") {
							$wheres[] = "(`$modalitytable`.series_desc like '%" . trim($seriesdesc) . "%')";
						}
						else {
							$wheres[] = "(`$modalitytable`.series_protocol like '%" . trim($seriesdesc) . "%')";
						}
					}
				}
				$sqlwhere .= implode(" or ", $wheres);
			//}
			//else {
				/* otherwise the search is an AND */
				//$seriesdescs = explode(';',$s_seriesdesc);
				//$wheres = array();
				//foreach ($seriesdescs as $seriesdesc) {
				//	$wheres[] = "(`$modalitytable`.series_desc like '%" . trim($seriesdesc) . "%')";
				//}
				//$sqlwhere .= implode(" and ", $wheres);
			//}
			
			$sqlwhere .= ")";
		}
		if ($s_seriessequence != "") { $sqlwhere .= " and `$modalitytable`.series_sequencename like '%$s_seriessequence%'"; }
		if ($s_seriesimagetype != "") {
		
			$sqlwhere .= " and (";
			$seriesimagetypes = explode(',',$s_seriesimagetype);
			$wheres = array();
			foreach ($seriesimagetypes as $seriesimagetype) {
				if (strpos($seriesimagetype,'*') !== false) {
					$seriesimagetype = str_replace('*','%',$seriesimagetype);
					$wheres[] = "(`$modalitytable`.image_type like '" . trim($seriesimagetype) . "')";
				}
				else {
					$wheres[] = "(`$modalitytable`.image_type = '" . trim($seriesimagetype) . "')";
				}
			}
			$sqlwhere .= implode(" or ", $wheres);
			$sqlwhere .= ")";
		
			//$sqlwhere .= " and `$modalitytable`.image_type like '%$s_seriesimagetype%'";
		}
		if ($s_seriesimagecomments != "") { $sqlwhere .= " and `$modalitytable`.image_comments like '%$s_seriesimagecomments%'"; }
		if ($s_seriestr != "") { $sqlwhere .= " and `$modalitytable`.series_tr = '$s_seriestr'"; }
		if ($s_seriesnum != "") {
			if (substr($s_seriesnum,0,2) == '>=') {
				$val = substr($s_seriesnum,2);
				$sqlwhere .= " and `$modalitytable`.series_num >= '$val'";
			}
			elseif (substr($s_seriesnum,0,2) == '<=') {
				$val = substr($s_seriesnum,2);
				$sqlwhere .= " and `$modalitytable`.series_num <= '$val'";
			}
			elseif (substr($s_seriesnum,0,1) == '>') {
				$val = substr($s_seriesnum,1);
				$sqlwhere .= " and `$modalitytable`.series_num > '$val'";
			}
			elseif (substr($s_seriesnum,0,1) == '<') {
				$val = substr($s_seriesnum,1);
				$sqlwhere .= " and `$modalitytable`.series_num < '$val'";
			}
			elseif (substr($s_seriesnum,0,1) == '~') {
				$val = substr($s_seriesnum,1);
				$sqlwhere .= " and `$modalitytable`.series_num <> '$val'";
			}
			else {
				$sqlwhere .= " and `$modalitytable`.series_num = '$s_seriesnum'";
			}
		}
		if ($s_seriesnumfiles != "") {
			if (substr($s_seriesnumfiles,0,2) == '>=') {
				$val = substr($s_seriesnumfiles,2);
				$sqlwhere .= " and `$modalitytable`.numfiles >= '$val'";
			}
			elseif (substr($s_seriesnumfiles,0,2) == '<=') {
				$val = substr($s_seriesnumfiles,2);
				$sqlwhere .= " and `$modalitytable`.numfiles <= '$val'";
			}
			elseif (substr($s_seriesnumfiles,0,1) == '>') {
				$val = substr($s_seriesnumfiles,1);
				$sqlwhere .= " and `$modalitytable`.numfiles > '$val'";
			}
			elseif (substr($s_seriesnumfiles,0,1) == '<') {
				$val = substr($s_seriesnumfiles,1);
				$sqlwhere .= " and `$modalitytable`.numfiles < '$val'";
			}
			elseif (substr($s_seriesnumfiles,0,1) == '~') {
				$val = substr($s_seriesnumfiles,1);
				$sqlwhere .= " and `$modalitytable`.numfiles <> '$val'";
			}
			else {
				$sqlwhere .= " and `$modalitytable`.numfiles = '$s_seriesnumfiles'";
			}
		}
		if ($s_measuresearch != "") {
			$tmpsqlstring = "select measurename_id from measurenames where measure_name = '$s_measures'";
			$tmpresult = MySQLiQuery($tmpsqlstring,__FILE__,__LINE__);
			$tmprow = mysqli_fetch_array($tmpresult, MYSQLI_ASSOC);
			$measurenameid = $tmprow['measurename_id'];
			
			if (is_numeric($measurevalue)) {
				$valtype = "measure_valuenum";
			}
			else {
				$valtype = "measure_valuestring";
			}
			switch ($s_measurecriteria) {
				case "contains": $val = " like '%$s_measurevalue%'"; break;
				case "eq": $val = " = '$s_measurevalue'"; break;
				case "gt": $val = " > '$s_measurevalue'"; break;
				case "lt": $val = " < '$s_measurevalue'"; break;
			}
			
			$measuresearch = ParseMeasureSearchList($s_measuresearch);
			if ($measuresearch != "") {
				$sqlwhere .= " and " . $measuresearch;
			}
			
		}
		if ($s_formvalue[0] != "") {
			/* get the formfield datatype to make sure we compare against the correct assessment_data value */
			$tmpsqlstring = "select * from assessment_formfields where formfield_id = $s_formfieldid[0]";
			$tmpresult = MySQLiQuery($tmpsqlstring,__FILE__,__LINE__);
			$tmprow = mysqli_fetch_array($tmpresult, MYSQLI_ASSOC);
			$datatype = $tmprow['formfield_datatype'];
			
			switch ($datatype) {
				case "string": $valtype = "value_string"; break;
				case "number": $valtype = "value_number"; break;
				case "multichoice": $valtype = "value_text"; break;
				case "singlechoice": $valtype = "value_text"; break;
				case "text": $valtype = "value_text"; break;
				case "date": $valtype = "value_binary"; break;
				case "binary": $valtype = "value_binary"; break;
				case "header": $valtype = "value_text"; break;
			}
			switch ($s_formcriteria[0]) {
				case "contains": $val = " like '%$s_formvalue[0]%'"; break;
				case "eq": $val = " = '$s_formvalue[0]'"; break;
				case "gt": $val = " > '$s_formvalue[0]'"; break;
				case "lt": $val = " < '$s_formvalue[0]'"; break;
			}
			
			$sqlwhere .= " and `assessment_formfields`.formfield_id = $s_formfieldid[0] and `assessment_data`.$valtype $val";
		}
		Debug(__FILE__, __LINE__, "Checkpoint A");
		if ($s_pipelineid != ""){
			Debug(__FILE__, __LINE__, "Checkpoint B");
			$sqlwhere .= " and `analysis`.pipeline_id = $s_pipelineid";
			if ($s_pipelineresultname != "") {
				//echo "s_pipelineresultname is not blank";
				
				/* need to do a subquery outside of the main query to get the list of result names. This is due to a bug in the 5.x series of MySQL */
				$sqlstringX = "select resultname_id from analysis_resultnames where result_name like '%$s_pipelineresultname%' ";
				$resultX = MySQLiQuery($sqlstringX, __FILE__, __LINE__);
				if (mysqli_num_rows($resultX) > 0) {
					while ($rowX = mysqli_fetch_array($resultX, MYSQLI_ASSOC)) {
						$resultnames[] = $rowX['resultname_id'];
					}
					$resultnames[] = 5429; /* hack... to always include ICV */
					$resultnamelist = implode2(',',$resultnames);
					$sqlwhere .= " and `analysis_results`.`result_nameid` in ($resultnamelist) ";
				}
				else {
					$sqlwhere .= " and `analysis_results`.`result_nameid` = '' ";
				}
			}
			Debug(__FILE__, __LINE__, "Checkpoint C");
			if ($s_pipelineresultunit != "") {
				Debug(__FILE__, __LINE__, "Checkpoint D");
				
				/* need to do a subquery outside of the main query to get the list of result names. This is due to a bug in the 5.x series of MySQL */
				$sqlstringX = "select resultunit_id from analysis_resultunit where result_unit like '%$s_pipelineresultunit%' ";
				$resultX = MySQLiQuery($sqlstringX, __FILE__, __LINE__);
				if (mysqli_num_rows($resultX) > 0) {
					while ($rowX = mysqli_fetch_array($resultX, MYSQLI_ASSOC)) {
						$resultunit[] = $rowX['resultunit_id'];
					}
					$resultunitlist = implode2(',',$resultunit);
					$sqlwhere .= " and `analysis_results`.`result_unitid` in ($resultunitlist) ";
				}
				else {
					$sqlwhere .= " and `analysis_results`.`result_unitid` = '' ";
				}
			}
			if ($s_pipelineresultvalue != "") {
				Debug(__FILE__, __LINE__, "Checkpoint E");
				//echo "s_pipelineresultvalue is not blank";
				$sqlwhere .= " and `analysis_results`.`result_value` $s_pipelineresultcompare '$s_pipelineresultvalue' ";
			}
			if ($s_pipelineresulttype != "") {
				Debug(__FILE__, __LINE__, "Checkpoint F");
				//echo "s_pipelineresulttype is not blank";
				$sqlwhere .= " and `analysis_results`.`result_type` = '$s_pipelineresulttype' ";
			}
		}
	
		/* ----- put the whole SQL query together ----- */
		/* first setup the SELECT, depending on the type of query ... */
		if ($s_resultorder == "pipeline") {
			Debug(__FILE__, __LINE__, "Checkpoint G");
			$sqlstring = "select subjects.uid, studies.study_num, studies.study_id, studies.study_datetime, studies.study_type, subjects.subject_id, subjects.birthdate, subjects.gender, timestampdiff(MONTH, subjects.birthdate, studies.study_datetime) 'ageinmonths', analysis_results.*";
		}
		elseif ($s_resultorder == "pipelinelong") {
			Debug(__FILE__, __LINE__, "Checkpoint H");
			$sqlstring = "select subjects.uid, studies.study_num, studies.study_id, studies.study_datetime, subjects.subject_id, subjects.birthdate, subjects.gender, timestampdiff(MONTH, subjects.birthdate, studies.study_datetime) 'ageinmonths', analysis_results.*";
		}
		elseif ($s_resultorder == "pipelinelongyear") {
			Debug(__FILE__, __LINE__, "Checkpoint I");
			$sqlstring = "select subjects.uid, studies.study_num, studies.study_id, studies.study_datetime, subjects.subject_id, subjects.birthdate, subjects.gender, timestampdiff(YEAR, subjects.birthdate, studies.study_datetime) 'ageinmonths', analysis_results.*";
		}
		elseif ($s_resultorder == "long") {
			if ($s_usealtseriesdesc) {
				$sqlstring = "select subjects.uid, studies.study_id, studies.study_num, studies.study_datetime, studies.study_modality, subjects.subject_id, `$modalitytable`.series_altdesc";
			}
			else {
				$sqlstring = "select subjects.uid, studies.study_id, studies.study_num, studies.study_datetime, studies.study_modality, subjects.subject_id, `$modalitytable`.series_desc";
			}
		}
		elseif (($s_resultorder == 'qctable') || ($s_resultorder == 'qcchart')) {
			/* return all custom QC variables */
			//if ($s_qcvariableid != "") {
			//	$sqlstring = "select subjects.subject_id, subjects.uid, studies.study_datetime, studies.study_num, unix_timestamp(DATE(series_datetime)) 'studydate', $modalitytable.series_desc, qc_resultnames.qcresult_name, qc_resultnames.qcresult_units, qc_results.qcresults_valuenumber";
			//}
			//else {
				$sqlstring = "select subjects.subject_id, subjects.uid, studies.study_datetime, studies.study_id, studies.study_num, DATE(series_datetime) 'studydate', $modalitytable.series_desc, $modality" . "_qa.*";
			//}
		}
		elseif ($s_resultorder == 'subject') {
			$sqlstring = "select subjects.*, projects.*, enrollment.*";
		}
		elseif ($s_resultorder == 'uniquesubject') {
			$sqlstring = "select subjects.subject_id, subjects.uid, studies.study_id, studies.study_alternateid, studies.study_num";
		}
		else {
			$sqlstring = "select *";
		}
		/* check if the measures should be returned as well */
		if ($s_measuresearch != ""){
			$sqlstring .= ", measures.*, measurenames.measure_name";
		}
		
		if ($s_pipelineid == "") {
			$sqlstring .= ", `$modalitytable`.$modality" . "series_id";
		}
		
		/* ... then add the table JOINs ... */
		$sqlstring .= " from `enrollment`
		join `projects` on `enrollment`.project_id = `projects`.project_id
		join `subjects` on `subjects`.subject_id = `enrollment`.subject_id
		join `studies` on `studies`.enrollment_id = `enrollment`.enrollment_id";
		/* join in other tables if necessary */
		if ($s_subjectaltuid != "") {
			$sqlstring .= " join `subject_altuid` on `subjects`.subject_id = `subject_altuid`.subject_id";
		}
		if ($s_pipelineid == ""){
			$sqlstring .= " join `$modalitytable` on `$modalitytable`.study_id = `studies`.study_id";
		}
		if ($s_measuresearch != ""){
			/* join in the measure table if there is a measure to search for */
			$sqlstring .= " left join `measures` on `measures`.enrollment_id = `enrollment`.enrollment_id left join `measurenames` on `measures`.measurename_id = `measurenames`.measurename_id";
		}
		if ($s_formvalue[0] != ""){
			/* join in the form tables if there is formfield criteria to search for */
			$sqlstring .= " join `assessments` on `assessments`.enrollment_id = `enrollment`.enrollment_id
			join `assessment_formfields` on `assessment_formfields`.form_id = `assessments`.form_id
			join `assessment_data` on `assessment_data`.formfield_id = `assessment_formfields`.formfield_id";
		}
		if ($s_pipelineid != ""){
			/* join in the pipeline tables if there is formfield criteria to search for */
			$sqlstring .= " join `analysis` on `analysis`.study_id = `studies`.study_id
			join `analysis_results` on `analysis_results`.analysis_id = `analysis`.analysis_id";
		}
		if (($modality == "mr") && ($s_pipelineid == "")) {
			$sqlstring .= " left join `mr_qa` on `mr_qa`.mrseries_id = `mr_series`.mrseries_id";
		}
		//if (($s_resultorder == 'qctable') || ($s_resultorder == 'qcchart')) {
		//	if ($s_qcvariableid != "") {
		//		if ($s_qcvariableid == "all") {
		//			$sqlstring .= " LEFT JOIN `qc_moduleseries` ON `qc_moduleseries`.series_id = `mr_series`.mrseries_id LEFT JOIN `qc_modules` ON `qc_modules`.qcmodule_id = `qc_moduleseries`.qcmodule_id LEFT JOIN `qc_results` ON `qc_results`.qcmoduleseries_id = `qc_moduleseries`.qcmoduleseries_id LEFT JOIN `qc_resultnames` ON `qc_results`.qcresultname_id = `qc_resultnames`.qcresult_name";
		//		}
		//	}
		//}
		
		/* ... then add the WHERE clause (created earlier) and the ORDER BY and GROUP BY clauses if necessary */
		$sqlstring .= " where `subjects`.isactive = 1 and `studies`.study_modality = '$modality' $sqlwhere ";
		if ($s_resultorder == 'subject') {
			$sqlstring .= " group by enrollment.enrollment_id order by subjects.uid, projects.project_name";
		}
		elseif ($s_resultorder == 'uniquesubject') {
			$sqlstring .= " group by studies.study_id";
		}
		else {
			if ($s_formvalue[0] != ""){
				$sqlstring .= " group by `$modalitytable`.$modality" . "series_id ";
			}
			if (($s_resultorder != "pipeline") && ($s_resultorder != "pipelinecsv") && ($s_resultorder != "pipelinelong") && ($s_resultorder != "pipelinelongyear")) {
				$sqlstring .= " group by `$modalitytable`.$modality" . "series_id order by `studies`.study_datetime, `studies`.study_id";
				if ($s_pipelineid == ""){
					$sqlstring .= ", `$modalitytable`.series_num";
				}
			}
		}
		return $sqlstring;
	}	

	/* -------------------------------------------- */
	/* ------- GetIDListFromGroup ----------------- */
	/* -------------------------------------------- */
	function GetIDListFromGroup($groupid) {
		$sqlstring = "select data_id from group_data where group_id = $groupid";
		$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$groupids[] = $row['data_id'];
		}
		return implode2(',',$groupids);
	}
	

	/* -------------------------------------------- */
	/* ------- DisplayMRStudyHeader --------------- */
	/* -------------------------------------------- */
	function DisplayMRStudyHeader($study_id, $display, $measures) {
		if ($display) {
			?>
			<tr>
				<td class="seriesheader"><input type="checkbox" id="study<?=$study_id?>"></td>
				<td class="seriesheader"><b>Series #</b></td>
				<td class="seriesheader">Protocol</td>
				<td class="seriesheader" title="Time of the start of the series acquisition">Time</td>
				<td class="seriesheader" title="Total displacement in X direction">X</td>
				<td class="seriesheader" title="Total displacement in Y direction">Y</td>
				<td class="seriesheader" title="Total displacement in Z direction">Z</td>
				<td class="seriesheader" title="View movement graph and FFT">QA</td>
				<td class="seriesheader" title="Data quality ratings">Rating</td>
				<td class="seriesheader" title="Series notes">Notes</td>
				<td class="seriesheader" title="Per Voxel SNR (timeseries) - Calculated from the fslstats command">PV SNR</td>
				<td class="seriesheader" title="Inside-Outside SNR - This calculates the brain signal (center of brain-extracted volume) compared to the average of the volume corners">IO SNR</td>
				<td class="seriesheader" title="Motion of structural image">Motion R<sup>2</sup></td>
				<td class="seriesheader">Size <span class="tiny">(x y)</span></td>
				<td class="seriesheader"># files</td>
				<td class="seriesheader">Size</td>
				<td class="seriesheader">Sequence</td>
				<td class="seriesheader">TR</td>
				<td class="seriesheader"># beh <span class="tiny">(size)</span></td>
				<?
					if (count($measures) > 0) {
						foreach ($measures as $measure) {
						?>
						<td class="seriesheader"><?=$measure?></td>
						<?
						}
					}
				?>
			</tr>
			<?
		}
		/* return a header for the csv file */
		return "Series Num, Protocol, UID, Sex, AgeAtScan, AltUIDs, StudyID, AltStudyID, Study num, Study date, study type, Project, height, weight, bmi, series time, XMoveMin, YMoveMin, ZMoveMin, XMoveMax, YMoveMax, ZMoveMax, XMoveTotal, YMoveTotal, ZMoveTotal, PitchTotal, RollTotal, YawTotal, PVSNR, IOSNR, xDim, yDim, Numiles, series size, sequence name, TR, num beh files, beh size";
	}

	
	/* -------------------------------------------- */
	/* ------- DisplayMRSeriesHeader -------------- */
	/* -------------------------------------------- */
	function DisplayMRSeriesHeader($s_resultorder, $measures) {
		?>
		<tr>
			<? if (($s_resultorder == "series") || ($s_resultorder == "operations")) { ?>
				<td class="seriesheader"><input type="checkbox" id="seriesall"></td>
			<? } ?>
			<td class="seriesheader"><b>Series #</b></td>
			<td class="seriesheader">Protocol</td>
			<td class="seriesheader">UID</td>
			<td class="seriesheader">Sex</td>
			<td class="seriesheader">Age@scan</td>
			<td class="seriesheader">AltUIDs</td>
			<td class="seriesheader">StudyID</td>
			<td class="seriesheader">Alt StudyID</td>
			<td class="seriesheader">Study #</td>
			<td class="seriesheader">Study Date</td>
			<td class="seriesheader">Series Time</td>
			<td class="seriesheader">X</td>
			<td class="seriesheader">Y</td>
			<td class="seriesheader">Z</td>
			<? if (($s_resultorder == "series") || ($s_resultorder == "operations")) { ?>
				<td class="seriesheader">QA</td>
				<td class="seriesheader" title="Scale 1-5<br>1 = good<br>5 = bad">Rating</td>
			<? } ?>
			<td class="seriesheader" title="Per Voxel SNR (timeseries) - Calculated from the fslstats command">PV SNR</td>
			<td class="seriesheader" title="Inside-Outside SNR - This calculates the brain signal (center of brain-extracted volume) compared to the average of the volume corners">IO SNR</td>
			<td class="seriesheader" title="Motion in structural images">Motion R<sup>2</sup></td>
			<td class="seriesheader">Size <span class="tiny">(x y)</span></td>
			<td class="seriesheader"># files</td>
			<td class="seriesheader">Size</td>
			<td class="seriesheader">Sequence</td>
			<td class="seriesheader">TR</td>
			<? if ($s_resultorder != "table") { ?>
			<td class="seriesheader"># beh <span class="tiny">(size)</span></td>
			<? }
				if (count($measures) > 0) {
					foreach ($measures as $measure) {
					?>
					<td class="seriesheader"><?=$measure?></td>
					<?
					}
				}
			?>
		</tr>
		<?
	}


	/* -------------------------------------------- */
	/* ------- DisplayGenericStudyHeader ---------- */
	/* -------------------------------------------- */
	function DisplayGenericStudyHeader($study_id) {
		?>
		<tr>
			<td class="seriesheader"><input type="checkbox" id="study<?=$study_id?>"></td>
			<td class="seriesheader"><b>Series #</b></td>
			<td class="seriesheader">Protocol</td>
			<td class="seriesheader">Time</td>
			<td class="seriesheader"># files</td>
			<td class="seriesheader">Size</td>
			<td class="seriesheader">Notes</td>
		</tr>
		<?
	}

	
	/* -------------------------------------------- */
	/* ------- DisplayGenericSeriesHeader --------- */
	/* -------------------------------------------- */
	function DisplayGenericSeriesHeader($s_resultorder) {
		?>
		<tr>
			<? if (($s_resultorder == "series") || ($s_resultorder == "operations")) { ?>
				<td class="seriesheader"><input type="checkbox" id="seriesall"></td>
			<? } ?>
			<td class="seriesheader"><b>Series #</b></td>
			<td class="seriesheader">Protocol</td>
			<td class="seriesheader">UID</td>
			<td class="seriesheader">Alt UID 1</td>
			<td class="seriesheader">Alt UID 2</td>
			<td class="seriesheader">Alt UID 3</td>
			<td class="seriesheader">Study #</td>
			<td class="seriesheader">Study Date</td>
			<td class="seriesheader">Series Time</td>
			<td class="seriesheader"># files</td>
			<td class="seriesheader">Size</td>
			<td class="seriesheader">Notes</td>
		</tr>
		<?
	}


	/* -------------------------------------------- */
	/* ------- Anonymize -------------------------- */
	/* -------------------------------------------- */
	function Anonymize($r, $username) {
		$seriesids = $r['seriesid'];
		$modality = $r['modality'];
		$dicomtags = mysqli_real_escape_string($GLOBALS['linki'], $r['dicomtags']);
		
		if (($seriesids == "") && ($enrollmentids == "")) {
			echo "You didn't select any series or subjects to download/export! Go back and select something<br>";
			return;
		}
		
		foreach ($seriesids as $seriesid) {
			$sqlstring = "insert into fileio_requests (fileio_operation, data_type, data_id, modality, anonymize_fields, request_status, username, requestdate) values ('anonymize','series',$seriesid,'$modality','$dicomtags','pending','$username',now())";
			PrintSQL($sqlstring);
			$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
		}
	}
	

	/* -------------------------------------------- */
	/* ------- ProcessRequest --------------------- */
	/* -------------------------------------------- */
	function ProcessRequest($r, $username) {
		$downloadimaging = $r['downloadimaging'];
		$downloadbeh = $r['downloadbeh'];
		$downloadqc = $r['downloadqc'];
		$ip = getenv('REMOTE_ADDR');
		$modality = $r['modality'];
		$destinationtype = $r['destination'];
		$nfsdir = $r['nfsdir'];
		$realnfsdir = "/mount" . $r['nfsdir'];
		$seriesids = $r['seriesid'];
		$enrollmentids = $r['enrollmentid'];
		$remoteftpusername = $r['remoteftpusername'];
		$remoteftppassword = $r['remoteftppassword'];
		$remoteftpserver = $r['remoteftpserver'];
		$remoteftpport = $r['remoteftpport'];
		$remoteftppath = $r['remoteftppath'];
		$remoteconnid = $r['remoteconnid'];
		$remotenidbserver = $r['remotenidbserver'];
		$remotenidbusername = $r['remotenidbusername'];
		$remotenidbpassword = $r['remotenidbpassword'];
		$remoteinstanceid = $r['remoteinstanceid'];
		$remotesiteid = $r['remotesiteid'];
		$remoteprojectid = $r['remoteprojectid'];
		$publicdownloaddesc = $r['publicdownloaddesc'];
		$publicdownloadreleasenotes = $r['publicdownloadreleasenotes'];
		$publicdownloadpassword = $r['publicdownloadpassword'];
		$publicdownloadshareinternal = $r['publicdownloadshareinternal'];
		$publicdownloadregisterrequired = $r['publicdownloadregisterrequired'];
		$publicdownloadexpire = $r['publicdownloadexpire'];
		$preserveseries = $r['preserveseries'];
		$filetype = $r['filetype'];
		$gzip = $r['gzip'];
		$anonymize = $r['anonymize'];
		$dirformat = $r['dirformat'];
		$timepoints = $r['timepoints'];
		$behformat = $r['behformat'];
		$behdirnameroot = $r['behdirnameroot'];
		$behdirnameseries = $r['behdirnameseries'];
		$subjectmeta = $r['subjectmeta'];
		$subjectdata = $r['subjectdata'];
		$subjectphenotype = $r['subjectphenotype'];
		$subjectforms = $r['subjectforms'];
		$studymeta = $r['studymeta'];
		$studydata = $r['studydata'];
		$seriesmeta = $r['seriesmeta'];
		$seriesdata = $r['seriesdata'];
		$allsubject = $r['allsubject'];
		$downloadimaging = $r['downloadimaging'];
		$downloadbeh = $r['downloadbeh'];
		$downloadqc = $r['downloadqc'];

		//echo "<pre>";
		//print_r($r);
		//echo "</pre>";
		
		if (!$downloadbeh) { $behformat = "behnone"; }
		
		if (($seriesids == "") && ($enrollmentids == "")) {
			echo "You didn't select any series or subjects to download/export! Go back and select something<br>";
			exit(0);
		}
		if ($destinationtype == "nfs") {
			if ($nfsdir == "") {
				echo "NFS destination directory was blank! go back and enter a destination directory<br>";
				exit(0);
			}
			if (strpos($nfsdir," ") != false) {
				echo "Destination directory cannot contain spaces. You must choose a different destination directory that does not have spaces<br>";
				exit(0);
			}
			if ((file_exists("$realnfsdir") == false) || ($nfsdir == "/")) {
				echo "Invalid NFS destination directory! go back and enter a valid destination directory<br>";
				exit(0);
			}
			clearstatcache();
			$perms = substr(sprintf('%o', fileperms($realnfsdir)),-3);
			if ($perms != "777"){
				echo "Incorrect permissions [$perms] on destination directory [$realnfsdir]. Should be 777.<br>Set permissions to read/write for everyone by typing 'chmod -R 777 $nfsdir' at the command line in the parent directory of your destination<br>";
				exit(0);
			}
		}

		$requestingip = $ip;
		//$destinationtype = $destination;
		?>
			<table>
				<tr><td align="right"><b>Your IP</b></td><td>&nbsp;<? echo $requestingip; ?></td></tr>
				<tr><td align="right"><b>Username</b></td><td>&nbsp;<? echo $username; ?></td></tr>
				<tr><td align="right"><b>Destination Type</b></td><td>&nbsp;<? echo $destinationtype; ?></td></tr>
				<? if ($destinationtype == "remoteftp") { ?>
					<tr><td align="right"><b>FTP username</b></td><td>&nbsp;<? echo $remoteftpusername; ?></td></tr>
					<tr><td align="right"><b>FTP Password</b></td><td>&nbsp;<? echo $remoteftppassword; ?></td></tr>
					<tr><td align="right"><b>FTP Server</b></td><td>&nbsp;<? echo $remoteftpserver; ?></td></tr>
					<tr><td align="right"><b>FTP Port</b></td><td>&nbsp;<? echo $remoteftpport; ?></td></tr>
					<!--<tr><td align="right"><b>Is sFTP?</b></td><td>&nbsp;<? if ($remoteftpsecure) echo "Y"; else echo "N"; ?></td></tr>-->
				<? }
				if ($destinationtype == "remotenidb") { ?>
					<tr><td align="right"><b>NiDB username</b></td><td>&nbsp;<? echo $remotenidbusername; ?></td></tr>
					<tr><td align="right"><b>NiDB Password</b></td><td>&nbsp;<? echo $remotenidbpassword; ?></td></tr>
					<tr><td align="right"><b>NiDB Server</b></td><td>&nbsp;<? echo $remotenidbserver; ?></td></tr>
					<tr><td align="right"><b>NiDB Instance ID</b></td><td>&nbsp;<? echo $remoteinstanceid; ?></td></tr>
					<tr><td align="right"><b>NiDB Site ID</b></td><td>&nbsp;<? echo $remotesiteid; ?></td></tr>
					<tr><td align="right"><b>NiDB Project ID</b></td><td>&nbsp;<? echo $remoteprojectid; ?></td></tr>
				<?
				}
				if ($filetype == "dicom") {
				?>
				<tr>
					<td align="right"><b>Anonymize?</b></td><td>
						<?
						if ($anonymize == 0) { echo "&nbsp;None"; }
						if ($anonymize == 1) { echo "&nbsp;Light"; }
						if ($anonymize == 2) { echo "&nbsp;Full"; }
						?>
					</td>
				</tr>
				<? } ?>
				<tr><td align="right"><b>Preserve series #?</b></td><td>&nbsp;<? if ($preserveseries) echo "Y"; else echo "N"; ?></td></tr>
			</table>
			<br><br>
			
			The following data will be transferred<br><br>
			<table width="100%" class="smalldisplaytable">
				<tr>
					<td><b>UID</b></td>
					<td><b>Study Date</b></td>
					<td><b>'scanid'</b></td>
					<td><b>Series #</b></td>
					<td><b>New directory/series #</b></td>
					<td><b>Format</b></td>
					<td><b>Data size (bytes)</b></td>
					<td><b>Destination</b></td>
				</tr>
		<?
		
		/* get the next group ID */
		$sqlstring  = "select max(req_groupid) 'max' from data_requests";
		$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$groupid = $row['max'] + 1;
		
		/* if this is a public download, create the row in the public_download table, and get the ID */
		if ($destinationtype == "publicdownload") {
			$sqlstring = "insert into public_downloads (pd_createdby, pd_desc, pd_notes, pd_password, pd_shareinternal, pd_registerrequired, pd_expiredays, pd_status) values ('$username', '$publicdownloaddesc', '$publicdownloadreleasenotes', sha1('$publicdownloadpassword'), '$publicdownloadshareinternal', '$publicdownloadregisterrequired', '$publicdownloadexpire', 'started')";
			$result = MySQLiQuery($sqlstring,__FILE__,__LINE__);
			$publicDownloadRowID = mysqli_insert_id($GLOBALS['linki']);
		}
		
		$i = 1;
		/* get information from the database based on the series IDs provided */
		$totalunzipsize = 0;
		$sqlstrings = array();
		$modality = strtolower($modality);
		if ($destinationtype == 'export') {
		
			if ($enrollmentids == "") {
				$seriesidlist = implode2(",", $seriesids);
				$sqlstrings[$modality] = "select a.*, b.*, d.project_name, d.project_costcenter, e.uid from " . $modality . "_series a left join studies b on a.study_id = b.study_id left join enrollment c on b.enrollment_id = c.enrollment_id left join projects d on c.project_id = d.project_id left join subjects e on e.subject_id = c.subject_id where " . $modality . "series_id in ($seriesidlist) order by uid, study_num, series_num";
			}
			else {
				/* set all of the download options */
				$preserveseries = 1;
				$filetype = 'export';
				//$dirformat = '';
				
				/* if only seriesids have been selected, thats the only data that will be exported */
				
				/* get enrollment IDs from the series IDs */
				$seriesidlist = implode2(",", $seriesids);
				$sqlstring = "select distinct(b.enrollment_id) from " . $modality . "_series a left join studies b on a.study_id = b.study_id where a.series_id in ($seriesidlist)";
				//PrintSQL($sqlstring);
				
				$enrollmentidlist = implode2(",", $enrollmentids);
				/* get modality list from studies table */
				$sqlstring = "select distinct(study_modality) 'study_modality' from studies where enrollment_id in ($enrollmentidlist)";
				$result = MySQLiQuery($sqlstring, __FILE__ , __LINE__);
				$numseries = mysqli_num_rows($result);
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$modalities[] = strtolower($row['study_modality']);
				}
				//print_r($modalities);
				
				/* loop through all modalities and do the following: */
				foreach ($modalities as $modality) {
					$sqlstrings[$modality] = "select a.*, b.*, d.project_name, d.project_costcenter, e.uid from " . $modality . "_series a left join studies b on a.study_id = b.study_id left join enrollment c on b.enrollment_id = c.enrollment_id left join projects d on c.project_id = d.project_id left join subjects e on e.subject_id = c.subject_id where b.enrollment_id in ($enrollmentidlist) order by uid, study_num, series_num";
				}
			}
		}
		else {
			$seriesidlist = implode2(",", $seriesids);
			$sqlstrings[$modality] = "select a.*, b.*, d.project_name, d.project_costcenter, e.uid from " . $modality . "_series a left join studies b on a.study_id = b.study_id left join enrollment c on b.enrollment_id = c.enrollment_id left join projects d on c.project_id = d.project_id left join subjects e on e.subject_id = c.subject_id where " . $modality . "series_id in ($seriesidlist) order by uid, study_num, series_num";
		}
		
		$numseries = 0;
		foreach ($sqlstrings as $modality => $sqlstring) {
			//PrintSQL($sqlstring);
			
			//echo "(A) $remotenidbserver, $remotenidbusername, $remotenidbpassword, $remoteinstanceid, $remotesiteid, $remoteprojectid<br>";
			
			$result = MySQLiQuery($sqlstring, __FILE__ , __LINE__);
			//PrintSQLTable($result);
			
			$numseries += mysqli_num_rows($result);
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

				//echo "(B) $remotenidbserver, $remotenidbusername, $remotenidbpassword, $remoteinstanceid, $remotesiteid, $remoteprojectid<br>";
				$safe = true;
				
				/* go through the list and populate the request table */
				$series_id = $row[$modality . 'series_id'];
				$series_desc = $row['series_desc'];
				$series_altdesc = $row['series_altdesc'];
				$series_num = $row['series_num'];
				$study_id = $row['study_id'];
				$study_num = $row['study_num'];
				$study_datetime = $row['study_datetime'];
				$uid = $row['uid'];
				$series_size = $row['series_size'];
				$project_name = $row['project_name'];
				$project_costcenter = $row['project_costcenter'];
			
				if (($img_format == "dicom") && ($destinationtype == "remoteftp")) {
					$safe = false;
				}
				
				$currentstudyid = $study_id;
				
				if ($preserveseries) {
					$run = $series_num;
				}
				else {
					//echo "current: $currentstudyid... last: $laststudyid<br>";
					if ($laststudyid != $currentstudyid) {
						$run = 1;
					}
					else {
						$run++;
					}
				}
				
				$remoteftpport = 21;
				$remoteftpsecure = 0;
				
				switch ($dirformat) {
					case "datetime": $newdir = date("Ymd_His",strtotime($study_datetime)); break;
					case "datetimeshortid": $newdir = date("Ymd_His",strtotime($study_datetime)) . "_$uid" . $study_num; break;
					case "datetimelongid": $newdir = date("Ymd_His",strtotime($study_datetime)) . "_$uid" . "_$project_costcenter" . "_$study_num"; break;
					case "shortid": $newdir = $uid . $study_num; break;
					case "longid": $newdir = $uid . "_$project_costcenter" . "_$study_num"; break;
				}
				
				$timepoint = $timepoints[$series_id];
				if ($safe) {
					$totalseriessize += $series_size;
					
					if (trim($remoteconnid) != "") {
						$sqlstringC = "select * from remote_connections where remoteconn_id = $remoteconnid";
						$resultC = MySQLiQuery($sqlstringC, __FILE__ , __LINE__);
						$rowC = mysqli_fetch_array($resultC, MYSQLI_ASSOC);
						$remotenidbserver = $rowC['remote_server'];
						$remotenidbusername = $rowC['remote_username'];
						$remotenidbpassword = $rowC['remote_password'];
						$remoteinstanceid = $rowC['remote_instanceid'];
						$remoteprojectid = $rowC['remote_projectid'];
						$remotesiteid = $rowC['remote_siteid'];
					}
					
					$sqlstringA = "insert into data_requests (req_username, req_ip, req_groupid, req_modality, req_downloadimaging, req_downloadbeh, req_downloadqc, req_destinationtype, req_nfsdir, req_seriesid, req_filetype, req_gzip, req_anonymize, req_preserveseries, req_dirformat, req_timepoint, req_ftpusername, req_ftppassword, req_ftpserver, req_ftpport, req_ftppath, req_nidbserver, req_nidbusername, req_nidbpassword, req_nidbinstanceid, req_nidbsiteid, req_nidbprojectid, req_downloadid, req_behonly, req_behformat, req_behdirrootname, req_behdirseriesname, req_date) values ('$username', '$ip', $groupid, '$modality', '$downloadimaging', '$downloadbeh', '$downloadqc', '$destinationtype', '$nfsdir', $series_id, '$filetype', '$gzip', '$anonymize', '$preserveseries', '$dirformat', '$timepoint', '$remoteftpusername', '$remoteftppassword', '$remoteftpserver', '$remoteftpport', '$remoteftppath', '$remotenidbserver', '$remotenidbusername', '$remotenidbpassword', '$remoteinstanceid' , '$remotesiteid', '$remoteprojectid', '$publicDownloadRowID', '$behonly', '$behformat', '$behdirnameroot','$behdirnameseries', now())";
					//PrintSQL($sqlstringA);
					$resultA = MySQLiQuery($sqlstringA, __FILE__ , __LINE__);
					
					?>
						<tr>
							<td><?=$uid?></td>
							<td><?=$study_datetime?></td>
							<td><?=$uid?><?=$study_num?></td>
							<td><?=$series_num?></td>
							<td><?=$newdir?>/<?=$run?></td>
							<td><?=$filetype?></td>
							<td align="right"><?=number_format($series_size)?></td>
							<td><?=$nfsdir;?></td>
						</tr>
					<?
				}
				else {
					?>
						<tr style="background-color: lightyellow">
							<td style="color: red"><? echo $studyscanid; ?></td>
							<td style="color: red"><? echo $studyscannerid; ?></td>
							<td style="color: red"><? echo $seriesnumber; ?></td>
							<td colspan="4" align="center" style="color: red">Can not send DICOM data directly to a remote FTP site</td>
						</tr>
					<?
				}
				$laststudyid = $currentstudyid;

				//echo "(C) $remotenidbserver, $remotenidbusername, $remotenidbpassword, $remoteinstanceid, $remotesiteid, $remoteprojectid<br>";
				
			}
		}
		?>
			<tr>
				<td colspan="6" style="border-top: 1px solid #AAAAAA"><?=$numseries?> series</td>
				<td colspan="3" style="border-top: 1px solid #AAAAAA"><?=number_format($totalseriessize)?> bytes</td>
			</tr>
		</table>
		<br><br>
		Your batch job has been queued, expect the data to be copied within half an hour. Copying may take longer due to network traffic, server load, or file size
		<?
		if (($destinationtype == "localftp") || ($destinationtype == "export")) {
			?>
			Your data has been queued for FTP download.<br><br>
			<div align="center">
			<table><tr><td style="border: solid yellow 1pt; background-color:lightyellow">
			Use the following information to login to the FTP server and download your data:<br>
			<pre>
		Server/Host: <?=$GLOBALS['cfg']['localftphostname'];?>
		Login: <?=$GLOBALS['cfg']['localftpusername'];?>
		Password: <?=$GLOBALS['cfg']['localftppassword'];?>
		Port: 21
			</pre>
			</td></tr></table></div>
			<?
		}
		echo "<br><br>";
	}
	
	
	/* -------------------------------------------- */
	/* ------- MakeSQLList ------------------------ */
	/* -------------------------------------------- */
	function MakeSQLList($str) {
		#preg_replace('/[\^\,\-\'\s+]/', $s_subjectuid);
	
		//$str = str_ireplace(array('^',',','-',"'"), " ", $str);
		$parts = preg_split('/[\^,;\-\'\s\t\n\f\r]+/', $str);
		foreach ($parts as $part) {
			$newparts[] = "'" . trim($part) . "'";
		}
		return implode2(",", $newparts);
	}
	
	
	/* -------------------------------------------- */
	/* ------- ParseMeasureSearchList ------------- */
	/* -------------------------------------------- */
	function ParseMeasureSearchList($str) {

		$parts = explode(',',$str);
		foreach ($parts as $part) {
			if (strpos($part,'=') !== false) {
				$subparts = explode('=',$part);
				$measurename = $subparts[0];
				$measurevalue = $subparts[1];
				$part = "(measurenames.measure_name = '$measurename' and (measures.measure_valuestring = '$measurevalue' or measures.measure_valuenum = '$measurevalue'))";
				$newparts[] = $part;
			}
			if (strpos($part,'>') !== false) {
				$subparts = explode('>',$part);
				$measurename = $subparts[0];
				$measurevalue = $subparts[1];
				$part = "(measurenames.measure_name = '$measurename' and (measures.measure_valuestring > '$measurevalue' or measures.measure_valuenum > '$measurevalue'))";
				$newparts[] = $part;
			}
			if (strpos($part,'<') !== false) {
				$subparts = explode('<',$part);
				$measurename = $subparts[0];
				$measurevalue = $subparts[1];
				$part = "(measurenames.measure_name = '$measurename' and (measures.measure_valuestring < '$measurevalue' or measures.measure_valuenum < '$measurevalue'))";
				$newparts[] = $part;
			}
			if (strpos($part,'~') !== false) {
				$subparts = explode('~',$part);
				$measurename = $subparts[0];
				$measurevalue = $subparts[1];
				$part = "(measurenames.measure_name = '$measurename' and (measures.measure_valuestring like '%$measurevalue%' or measures.measure_valuenum like '%$measurevalue%'))";
				$newparts[] = $part;
			}
		}
		print_r($newparts);
		if ($newparts == "") {
			return "";
		}
		else {
			return implode2(" and ", $newparts);
		}
	}

	
	/* -------------------------------------------- */
	/* ------- ParseMeasureResultList ------------- */
	/* -------------------------------------------- */
	function ParseMeasureResultList($str, $field) {

		$parts = explode(',',$str);
		foreach ($parts as $part) {
			if (strpos($part,'*') !== false) {
				$part = str_replace('*','%',$part);
				$part = "$field like '$part'";
			}
			else {
				$part = "$field = '$part'";
			}
			$newparts[] = $part;
		}
		return implode2(" or ", $newparts);
	}

	
	/* -------------------------------------------- */
	/* ------- remove_outliers -------------------- */
	/* -------------------------------------------- */
	/* Function to remove outliers more than X stdev from the mean
	   X default of 1 */
	function remove_outliers($dataset, $magnitude = 1) {
		$count = count($dataset);
		$mean = array_sum($dataset) / $count; // Calculate the mean
		$deviation = sqrt(array_sum(array_map("sd_square", $dataset, array_fill(0, $count, $mean))) / $count) * $magnitude; // Calculate standard deviation and times by magnitude

		return array_filter($dataset, function($x) use ($mean, $deviation) { return ($x <= $mean + $deviation && $x >= $mean - $deviation); }); // Return filtered array of values that lie within $mean +- $deviation.
	}
	
?>

<? include("footer.php") ?>
