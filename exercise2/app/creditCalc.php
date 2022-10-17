<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'\app\security\check.php';

function getParams(&$x,&$y,&$z)
{
	$x = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
	$y = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
	$z = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;	
}

function validate(&$x,&$y,&$z,&$messages)
{
	if ( !(isset($x) && isset($y) && isset($z))) 
	{
		$messages [] = 'At least one argument is missing.';
	}

	if ( $x == "") 
	{
		$messages [] = 'Amount field is empty.';
	}
	if ( $y == "") 
	{
		$messages [] = 'Years count is empty.';
	}
	if ( $z == "") 
	{
		$messages [] = 'Interest rate field is empty.';
	}

	if (count($messages) != 0)
	{
		return false;
	}

	if (!is_numeric($x) || ($x<=0)) 
	{
		$messages [] = 'Amount is not a proper value.';
	}
	if (!is_numeric($y) || ($y<=0)) 
	{
		$messages [] = 'Year count is not a proper value.';
	}	
	if (!is_numeric($z) || ($z<0)) 
	{
		$messages [] = 'Interest rate is not a proper value.';
	}

	if (count ( $messages ) != 0)
	{
		return false;
	}

	return true;
}

function process(&$x,&$y,&$z,&$messages,&$result)
{
	global $role;

	$x = floatval($x);
	$y = intval($y);
	$z = floatval($z);
	
	if($role == 'admin')
	{
		$result = ($x * $z) / $y ;
	}
	else
	{
		$messages [] = 'Only administrator can calculate.';
	}
}

$x = null;
$y = null;
$operation = null;
$result = null;
$messages = array();

getParams($x,$y,$z);
if (validate($x,$y,$z,$messages))
{
	process($x,$y,$z,$messages,$result);
}

include 'creditCalcView.php';