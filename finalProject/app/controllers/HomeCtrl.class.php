<?php

namespace app\controllers;

use app\transfer\User;
use app\forms\LoginForm;

use core\App;
use core\Message;
use core\Utils;
use core\ParamUtils;

class HomeCtrl{
	public function __construct()
	{
		$this->form = new LoginForm();
	}

	public function action_homeShow()
	{
		$this->generateView(); 
	}

	private function generateView()
	{
		App::getSmarty()->assign('page_title','Login page');
		App::getSmarty()->assign('page_description','Log in to have access to credit calculator.');
		App::getSmarty()->display('homeView.tpl');
	}

	private function getParams()
	{
		$this->form->login = ParamUtils::getFromRequest('login');
		$this->form->pass = ParamUtils::getFromRequest('pass');
	}
}