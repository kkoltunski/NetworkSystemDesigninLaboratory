<?php
require_once 'init.php';

switch ($action) {
	default :
		$ctrl = new app\controllers\CreditCalcCtrl();
		$ctrl->generateView ();
	break;
	case 'calcCompute' :
		$ctrl = new app\controllers\CreditCalcCtrl();
		$ctrl->process ();
	break;
}
