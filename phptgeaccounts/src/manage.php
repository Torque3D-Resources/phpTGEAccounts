<?php
/*
Copyright (c) 2005 Robert Pierce

This software is provided 'as-is', without any express or implied warranty. In no event will the authors be held liable for any damages arising from the use of this software.

Permission is granted to anyone to use this software for any purpose, including commercial applications, and to alter it and redistribute it freely, subject to the following restrictions:

    1. The origin of this software must not be misrepresented; you must not claim that you wrote the original software. If you use this software in a product, an acknowledgment in the product documentation would be appreciated but is not required.

    2. Altered source versions must be plainly marked as such, and must not be misrepresented as being the original software.

    3. This notice may not be removed or altered from any source distribution.
*/
require_once('config.php');
require_once("includes/commonFunctions.php");

if(checkEmpty($_GET['userid']) && checkEmpty($_COOKIE['userid']))
{
	$tpl->assign('title', 'Manage Your Account :: Log In');
	$tpl->display('login.tpl');
	exit();
}

if(!checkEmpty($_COOKIE['userid']))
{
	$_GET['userid'] = $_COOKIE['userid'];
}

if(checkEmpty($_GET['action'])) // Shouldn't need " || checkEmpty($_GET['valid'])", but if it does, I will need to find a new method for this part.
{
	$array = fillArray($_GET['userid']);

	templateAssign(array(
		'title' => 'Manage Your Account',
		'userid' => $array['userid'],
		'user' => $array['username'],
		'name_first' => $array['name_first'],
		'name_last' => $array['name_last'],
		'email' => $array['email']), 'manage.tpl');
	exit();
}

if($_GET['action'] == "changePass" && !($_GET['valid']))
{
	templateAssign(array(
		'title', 'Manage Your Account :: Change Password',
		'userid', $_GET['userid']), 'changePass.tpl');
	exit();
}

if($_GET['action'] == "edit" && !($_GET['valid']))
{
	$array = fillArray($_GET['userid']);

	templateAssign(array(
		'title', 'Manage Your Account :: Edit Account Information',
		'userid', $_GET['userid'],
		'user' => $array['username'],
		'name_first' => $array['name_first'],
		'name_last' => $array['name_last'],
		'email' => $array['email'],
		'userDisabled' => $account_username_editable), 'editAccount.tpl');
	exit();
}

$_action = $_GET['action']; // changePass or edit
$userid = $_GET['userid'];
$user = $_GET['user'];
$oldPass = $_GET['oldPass'];
$newPass = $_GET['newPass'];
$newPassConf = $_GET['newPassConf'];
$name_first = $_GET['name_first'];
$name_last = $_GET['name_last'];
$email = $_GET['email'];
$forGame = $_GET['forGame'];
settype($forGame, "bool");

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
				success("Password Changed", "Congratulations! Your password was changed.", $forGame);
			}
			error("Passwords Do Not Match", "Sorry, the new passwords you provided do not match.\n\n<a href=\"manage.php?action=changePass\">Go Back</a>", $forGame);
		}
		error("Invalid Password", "Sorry, the password you provided is not correct.\n\n<a href=\"manage.php?action=changePass\">Go Back</a>", $forGame);
		break;
	case "edit":
		$rs = $db->Execute("SELECT * FROM `account` WHERE `userid`='$userid'");
		if(!$rs)
		{
			error("Database Error", $db->ErrorMsg());
		}
		
		if($rs->fields['password'] == md5($oldPass))
		{
			$db->Execute("UPDATE `account` SET `username`='$user', `name_first`='$name_first', `name_last`='$name_last', `email`='$email' WHERE `userid`=$userid");
			success("Information Updated", "Congratulations! Your information has been updated.", $forGame);
		}
		error("Invalid Password", "Sorry, the password you provided is not correct.\n\n<a href=\"manage.php?action=edit\">Go Back</a>", $forGame);
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