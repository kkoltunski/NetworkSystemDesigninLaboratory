<?php
require_once dirname(__FILE__).'/../config.php';

require_once $conf->root_path.'/app/CreditCalcCtrl.class.php';

$ctrl = new CreditCalcCtrl();
$ctrl->process();
