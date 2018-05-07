<?php

	/*
	* Copyright (C) 2016-2018 Abre.io Inc.
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
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');

	//Check for Admin Authentication
	$pagerestrictions="students";
	$pagerestrictionsedit="staff, students";
	$permissionsetting=encrypt("Administrator", "");
	if($db->query("SELECT * FROM directory LIMIT 1")){
		$sql = "SELECT * FROM directory WHERE email = '".$_SESSION['useremail']."' AND permissions = '$permissionsetting'";
		$result = $db->query($sql);
		while($row = $result->fetch_assoc())
		{
			$pagerestrictionsedit="";
		}
	}

	if($_SESSION['usertype']=="staff")
	{
		$pagerestrictions="";
	}

	if(superAdmin()){
		$pagerestrictionsedit="";
	}

	if($_SESSION['usertype'] == 'parent')
	{
        $drawerhidden = 1;
    }

?>
