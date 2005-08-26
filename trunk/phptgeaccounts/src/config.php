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
$cfg['adodb_dirname'] = "adodb";// Change "adodb" to the directory that was taken from the ADOdb zip file you downloaded. Remember, *nix systems are cAsE-SeNsItIvE
// Database Configuration
$cfg['db_host'] = ""; // Where is the database server? (Example: example.com, localhost or 127.0.0.1
$cfg['db_type'] = "mysql" ; // MySQL is the default. Look at the adodb (http://adodb.sourceforge.net) for a list of the database types
$cfg['db_user'] = ""; // Username to access the database server and database
$cfg['db_pass'] = ""; // Password to the above username
$cfg['db_name'] = ""; // Name of the database with the tables
// Smarty Configuration
$cfg['smarty_dirname'] = "Smarty-2.6.9"; // Change "Smarty-2.6.9" to the correct directory from what you downloaded. Remember, *nix systems are cAsE-SeNsItIvE
// Gateway Configuration
$cfg['allow_dupe_email'] = false; // If this is true, multiple people can use one e-mail, this is horribly insecure to have set to true.
$cfg['allow_username_edit'] = false; // If this is true, people can change their username.
//$cfg['system_base_dir'] = "./"; // This should be set to an absolute path, although "./" should work.
?>