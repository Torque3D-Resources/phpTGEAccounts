<?php
/*
Copyright (c) 2005 Robert Pierce

This software is provided 'as-is', without any express or implied warranty. In no event will the authors be held liable for any damages arising from the use of this software.

Permission is granted to anyone to use this software for any purpose, including commercial applications, and to alter it and redistribute it freely, subject to the following restrictions:

    1. The origin of this software must not be misrepresented; you must not claim that you wrote the original software. If you use this software in a product, an acknowledgment in the product documentation would be appreciated but is not required.

    2. Altered source versions must be plainly marked as such, and must not be misrepresented as being the original software.

    3. This notice may not be removed or altered from any source distribution.
*/
// ADOdb Configuration
define('ADODB_DIR', './db/');
$cfg['db_host'] = ""; // Where is the database server? (Example: example.com, localhost or 127.0.0.1
$cfg['db_type'] = "mysql" ; // MySQL is the default. Look at the adodb (http://adodb.sourceforge.net) for a list of the database types
$cfg['db_user'] = ""; // Username to access the database server and database
$cfg['db_pass'] = ""; // Password to the above username
$cfg['db_name'] = ""; // Name of the database with the tables

// Smarty Configuration
define('SMARTY_DIR', './smarty/'); // This is where the Smarty library is, you should not need to change this.
define('TEMPLATES_DIR', './templates/'); // You should not need to change this.
define('TEMPLATES_C_DIR', TEMPLATES_DIR . 'compiled/'); // You should not need to change this.
define('CONFIGS_DIR', TEMPLATES_DIR . 'configs/'); // You should not need to change this.
define('CACHE_DIR', TEMPLATES_DIR . 'cache/'); // By default, cache-ing is not used, but this is here just in case. Also, you should not need to change this.

// Gateway Configuration
$cfg['allow_dupe_email'] = false; // If this is true, multiple people can use one e-mail, this is horribly insecure to have set to true.
$cfg['allow_username_edit'] = false; // If this is true, people can change their username.

//-----------------------------------------------------------------------------//
// DO NOT MESS WITH ANYTHING BELOW THIS BAR UNLESS YOU KNOW WHAT YOU ARE DOING //
//-----------------------------------------------------------------------------//
include_once(SMARTY_DIR . 'Smarty.class.php');

class authSmarty extends Smarty
{
    function authSmarty() 
	{
        $this->template_dir = TEMPLATES_DIR;
        $this->compile_dir = TEMPLATES_C_DIR;
        $this->config_dir = CONFIGS_DIR;
        $this->cache_dir = CACHE_DIR;
    }
} 
$tpl = new authSmarty();

include_once(ADODB_DIR . 'adodb.inc.php'); // Database functions
?>