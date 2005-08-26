<?php
/*
Copyright (c) 2005 Robert Pierce

This software is provided 'as-is', without any express or implied warranty. In no event will the authors be held liable for any damages arising from the use of this software.

Permission is granted to anyone to use this software for any purpose, including commercial applications, and to alter it and redistribute it freely, subject to the following restrictions:

    1. The origin of this software must not be misrepresented; you must not claim that you wrote the original software. If you use this software in a product, an acknowledgment in the product documentation would be appreciated but is not required.

    2. Altered source versions must be plainly marked as such, and must not be misrepresented as being the original software.

    3. This notice may not be removed or altered from any source distribution.
*/
function checkEmpty($data, $isArray = false)
{
	if(!$isArray)
	{
		if(is_null($data) || trim($data) == "")
		{
			return(true);
		}
	
		return(false);
	}
	else
	{
		foreach ($data as $name => $value)
		{
       		if(is_null($value) || trim($value) == "")
			{
				return(true);
			}
			
			return(false);
		}
	}
}

// Smarty based error page
function error($title, $text)
{
	global $tpl;

    templateAssign(array('headerTitle' => 'Error', 'outputTitle' => $title, 'outputBody' => $text), 'output.tpl');
    exit();
}

// Smarty based success page
function success($title, $text)
{
	global $tpl;

    templateAssign(array('headerTitle' => 'Success', 'outputTitle' => $title, 'outputBody' => $text), 'output.tpl');
    exit();
}

// Game interface error
function gameError($text)
{
	echo("-ERR $text");
    exit();
}

// Game interface success
function gameSuccess($text)
{
	echo("+OK $text");
    exit();
}

function validateData($array)
{
	if(checkEmpty($array, true))
	{
		error("Missing Information", "Sorry, but you are missing some information.");
	}
}

function validateGameData($array)
{
	if(checkEmpty($array, true))
	{
		gameError("Missing Information");
	}
}

function templateAssign($arrayOfAssigns, $display)
{
	global $tpl;
	
	foreach ($arrayOfAssigns as $name => $value)
	{
		$tpl->assign($name, $value);
	}
	$tpl->display($display);
}
?>