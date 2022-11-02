<?php
require_once dirname(__FILE__).'/../config.php';

require_once _ROOT_PATH.'\lib\smarty\Smarty.class.php';

function getParams(&$form)
{
	$form['x'] = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
	$form['y'] = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
	$form['z'] = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;	
}

function validate(&$form, &$infos, &$messages)
{
	if ( !(isset($form['x']) && isset($form['y']) && isset($form['z']))) return false;

	$infos [] = 'Parameters are passed';

	if ( $form['x'] == "") $messages [] = 'Amount field is empty.';
	if ( $form['y'] == "") $messages [] = 'Years count is empty.';
	if ( $form['z'] == "") $messages [] = 'Interest rate field is empty.';

	if (count($messages) == 0)
	{
		if (!is_numeric($form['x']) || ($form['x']<=0)) 
		{
			$messages [] = 'Amount is not a proper value.';
		}
		if (!is_numeric($form['y']) || ($form['y']<=0)) 
		{
			$messages [] = 'Year count is not a proper value.';
		}	
		if (!is_numeric($form['z']) || ($form['z']<0)) 
		{
			$messages [] = 'Interest rate is not a proper value.';
		}
	}

	if (count ( $messages ) > 0) return false;
	else return true;
}

function process($form,&$infos,&$msgs,&$result)
{
	global $role;

	$form['x'] = floatval($form['x']);
	$form['y'] = intval($form['y']);
	$form['z'] = floatval($form['z']);
	
	$result = ($form['x'] * $form['z']) / $form['y'] ;
}

$form = null;
$infos = array();
$messages = array();
$result = null;

getParams($form);
if (validate($form,$infos,$messages))
{
	process($form,$infos,$messages,$result);
}

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Credit calculator');
$smarty->assign('page_description','Application to credit calculation');

$smarty->assign('form',$form);
$smarty->assign('result',$result);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);

$smarty->display(_ROOT_PATH.'\app\creditCalc.html');