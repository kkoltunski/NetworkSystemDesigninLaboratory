<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

$x = $_REQUEST ['x'];
$y = $_REQUEST ['y'];
$z = $_REQUEST ['z'];

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

if (empty($messages)) 
{
	if (!is_numeric($x) || ($x<=0)) {
		$messages [] = 'Amount is not a proper value.';
	}
	
	if (!is_numeric($y) || ($y<=0)) {
		$messages [] = 'Year count is not a proper value.';
	}	

	if (!is_numeric($z) || ($z<0)) {
		$messages [] = 'Interest rate is not a proper value.';
	}

}

if (empty ($messages))
{
	$x = floatval($x);
	$y = intval($y);
	$z = floatval($z);
	
	$result = ($x * $z) / $y ;
}

include 'creditCalcView.php';