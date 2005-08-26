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
	$tpl->assign('title', 'Log In');
	checkEmpty($_GET["user"]) ? $tpl->assign('user', '') : $tpl->assign('user', $_GET["user"]);
	$tpl->display('login.tpl');
	exit();
}

$user = $_GET["user"];
$pass = $_GET["pass"];

validateData(array($user, $pass));

// Check password and username match
$db = &ADONewConnection('mysql');
$db->Connect($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);

$rs = $db->Execute("SELECT * FROM `account` WHERE `username`='$user'");

if(!$rs)
{
    error("Database Error", $db->ErrorMsg());
}

$dbpass = $rs->fields['password'];
$userid = $rs->fields['userid'];

$md5pass = md5($pass);

if($md5pass != $dbpass)
{
	error("Incorrect Username or Password", "Sorry, either you username or password is incorrect.\n\n<a href=\"".$_SERVER['PHP_SELF']."?user=".$_GET["user"]."\">Go Back</a>");
}

// Advise Server of verified data
$nextHour = time() + (60 * 60); // 60 Minutes, 60 Seconds
setcookie('userid', $userid, $nextHour);
success("Verified Account", "Congratulations! The account information provided is correct.");
?>