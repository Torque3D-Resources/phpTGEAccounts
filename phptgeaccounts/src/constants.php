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

if(!$dirprefix) // If it is not explicityly stated in a script, we will assume it is in the current directory.
{
    $dirprefix = "."; 
}
define('ADODB_DIR', $dirprefix.'/'.$cfg['adodb_dirname'].'/'); 
define('SMARTY_DIR', $dirprefix.'/'.$cfg['smarty_dirname'].'/libs/');
define('TEMPLATES_DIR', $dirprefix.'/templates/');
define('TEMPLATES_C_DIR', TEMPLATES_DIR . 'compiled/');
define('CONFIGS_DIR', TEMPLATES_DIR . 'configs/');
define('CACHE_DIR', TEMPLATES_DIR . 'cache/');

if(!$nosmarty) // If the "nosmarty" variable is set in script, we know that we will not be using Smarty, so we don't initialize it.
{
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
}
?>