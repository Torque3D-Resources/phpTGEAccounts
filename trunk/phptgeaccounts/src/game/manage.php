<?php
/*
Copyright (c) 2005 Robert Pierce

This software is provided 'as-is', without any express or implied warranty. In no event will the authors be held liable for any damages arising from the use of this software.

Permission is granted to anyone to use this software for any purpose, including commercial applications, and to alter it and redistribute it freely, subject to the following restrictions:

    1. The origin of this software must not be misrepresented; you must not claim that you wrote the original software. If you use this software in a product, an acknowledgment in the product documentation would be appreciated but is not required.

    2. Altered source versions must be plainly marked as such, and must not be misrepresented as being the original software.

    3. This notice may not be removed or altered from any source distribution.
*/
require_once('../config.php');
require_once("../includes/commonFunctions.php");

$_action = $_GET['action']; // changePass or edit
$userid = $_GET['userid'];
$user = $_GET['user'];
$oldPass = $_GET['oldPass'];
$newPass = $_GET['newPass'];
$newPassConf = $_GET['newPassConf'];
$name_first = $_GET['name_first'];
$name_last = $_GET['name_last'];
$email = $_GET['email'];

$db = &ADONewConnection('mysql');
$db->Connect($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);

switch($_action)
{
	case "changePass":
		$rs = $db->Execute("SELECT * FROM `account` WHERE `userid`='$userid'");
		if(!$rs)
		{
			error("Database Error", $db->ErrorMsg());
		}
		
		if($rs->fields['password'] == md5($oldPass))
		{
			if($newPass == $newPassConf)
			{
				$md5newPass = md5($newPass);
				$db->Execute("UPDATE `account` SET `password`='$md5newPass' WHERE `userid`=$userid");
				setcookie('userid', '', (time() - 3600));
				success("Password Changed");
			}
			error("Passwords Do Not Match");
		}
		error("Invalid Password");
		break;
	case "edit":
		$rs = $db->Execute("SELECT * FROM `account` WHERE `userid`='$userid'");
		if(!$rs)
		{
			error("Database Error [$db->ErrorMsg()]");
		}
		
		if($rs->fields['password'] == md5($oldPass))
		{
			$db->Execute("UPDATE `account` SET `username`='$user', `name_first`='$name_first', `name_last`='$name_last', `email`='$email' WHERE `userid`=$userid");
			success("Information Updated");
		}
		error("Invalid Password");
		break;
	default:
		break;
}

function fillArray($id)
{
	global $cfg;
	$db = &ADONewConnection('mysql');
	$db->Connect($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);
	
	$rs = $db->Execute("SELECT * FROM `account` WHERE `userid`='$id';");
	
	return $rs->fields;
}
?>