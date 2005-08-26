<?php
/*
Copyright (c) 2005 Robert Pierce

This software is provided 'as-is', without any express or implied warranty. In no event will the authors be held liable for any damages arising from the use of this software.

Permission is granted to anyone to use this software for any purpose, including commercial applications, and to alter it and redistribute it freely, subject to the following restrictions:

    1. The origin of this software must not be misrepresented; you must not claim that you wrote the original software. If you use this software in a product, an acknowledgment in the product documentation would be appreciated but is not required.

    2. Altered source versions must be plainly marked as such, and must not be misrepresented as being the original software.

    3. This notice may not be removed or altered from any source distribution.
*/
require('config.php');
require('constants.php');
require('includes/commonFunctions.php');
require(ADODB_DIR . 'adodb.inc.php');

if(checkEmpty($_GET["valid"]))
{
	$tpl->assign('title', 'Create Your Account');
	checkEmpty($_GET["user"]) ? $tpl->assign('user', '') : $tpl->assign('user', $_GET["user"]);
	checkEmpty($_GET["name_first"]) ? $tpl->assign('name_first', '') : $tpl->assign('name_first', $_GET["name_first"]);
	checkEmpty($_GET["name_last"]) ? $tpl->assign('name_last', '') : $tpl->assign('name_last', $_GET["name_last"]);
	checkEmpty($_GET["email"]) ? $tpl->assign('email', '') : $tpl->assign('email', $_GET["email"]);
	$tpl->display('register.tpl');
	exit();
}

$user = $_GET["user"];
$pass = $_GET["pass"];
$passConf = $_GET["passConf"];
$name_first = $_GET["name_first"];
$name_last = $_GET["name_last"];
$email = $_GET["email"];

validateData(array($user, $pass, $name_first, $name_last, $email));
validatePass($pass, $passConf);
validateEmail($email);

// Check password and username match
$db = &ADONewConnection($cfg['db_type']);
$db->Connect($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);

// Check to see if the username is already in the database
$rs = $db->Execute("SELECT * FROM `account` WHERE `username`='$user';");
checkForDouble($rs, "username");
// Check to see if the e-mail is already in the database (config.php controlled)
if(!$register_email_double)
{
	$rs = $db->Execute("SELECT * FROM `account` WHERE `email`='$email';");
	checkForDouble($rs, "email");
}

$md5pass = md5($pass);
$rs = $db->Execute("INSERT INTO account(`username`, `password`, `name_first`, `name_last`, `email`) VALUES('$user', '$md5pass', '$name_first', '$name_last', '$email');");
if (!$rs)
{
	error("Database Error", $db->ErrorMsg());
}
success("Registration Successful", "Congratulations! Your account (".$user.") is ready to be used with the password provided.");

function validatePass($password, $password_conf)
{
	if($password != $password_conf)
	{
		error("Passwords Do Not Match", "Sorry, but the passwords you entered do not match.\n\n<a href=\"".$_SERVER['PHP_SELF']."?user=".$_GET["user"]."&name_first=".$_GET["name_first"]."&name_last=".$_GET["name_last"]."&email=".$_GET["email"]."\">Go Back</a>");
	}
}

function validateEmail($e_mail)
{
	if(!(strstr($e_mail, "@") && strstr($e_mail, "."))) // Just make sure the email address has a "@" and a ".". A RegExp parse would be better...
	{
		error("E-Mail Is Not Valid", "Sorry, but the e-mail you provided is invalid.\n\n<a href=\"".$_SERVER['PHP_SELF']."?user=".$_GET["user"]."&name_first=".$_GET["name_first"]."&name_last=".$_GET["name_last"]."&email=".$_GET["email"]."\">Go Back</a>");
	}
}

function checkForDouble($row, $type = "username")
{
	switch($type)
	{
		case "username":
			if($row->fields['username'])
			{
				error("Username Is Already In Use", "Sorry, but the username you chose is already being used.\n\n<a href=\"".$_SERVER['PHP_SELF']."?name_first=".$_GET["name_first"]."&name_last=".$_GET["name_last"]."&email=".$_GET["email"]."\">Go Back</a>");
			}
		case "email":
			if($row->fields['email'])
			{
				error("E-Mail Is Already In Use", "Sorry, but the e-mail you chose is already being used.\n\n<a href=\"".$_SERVER['PHP_SELF']."?user=".$_GET["user"]."&name_first=".$_GET["name_first"]."&name_last=".$_GET["name_last"]."\">Go Back</a>");
			}
	}
}
?>