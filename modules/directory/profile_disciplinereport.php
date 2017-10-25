<?php

	/*
	* Copyright (C) 2016-2017 Abre.io LLC
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the Affero General Public License version 3
    * as published by the Free Software Foundation.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU Affero General Public License for more details.
	*
    * You should have received a copy of the Affero General Public License
    * version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
    */

	//Required configuration files
	require(dirname(__FILE__) . '/../../configuration.php');
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once('permissions.php');

	if($pageaccess == 1){
		if($_GET["id"] != ""){ $id = $_GET["id"]; }

			include "../../core/abre_dbconnect.php";
			$sqlcount = "SELECT * FROM directory_discipline WHERE UserID = $id AND archived = 0";
			$rowcount = 0;
			if($resultcount = mysqli_query($db, $sqlcount)){
				$rowcount = mysqli_num_rows($resultcount);
			}

			if($rowcount > 0){
				echo "<div class='col s12'>";
				echo "<table>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>Uploaded Files</th>";
							echo "<th width='30px'></th>";
							echo "<th width='30px'></th>";
						echo "</tr>";
					echo "</thead>";
				echo "<tbody>";

				include "../../core/abre_dbconnect.php";
				$sql = "SELECT * FROM directory_discipline WHERE UserID = $id AND archived = 0";
				$result = $db->query($sql);
				while($row = $result->fetch_assoc()){
					$fileid = htmlspecialchars($row["id"], ENT_QUOTES);
					$filenamereal = htmlspecialchars($row["Filename"], ENT_QUOTES);
					$filename = substr(strstr($filenamereal, '$_$'), 3);
					echo "<tr>";
					echo "<td>$filename</td>";
					echo "<td width='30px'><a href='$portal_root/modules/directory/downloadfile.php?file=$filenamereal' class='mdl-button mdl-js-button mdl-button--icon'><i class='material-icons'>file_download</i></a></td>";
					echo "<td width='30px'><button class='mdl-button mdl-js-button mdl-button--icon deletedisciplinerecord'><a href='$fileid'></a><i class='material-icons'>delete</i></button></td>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				echo "</div>";
			}else{
				echo "<div class='col s12'>No discipline reports.</div>";
			}
	}
?>