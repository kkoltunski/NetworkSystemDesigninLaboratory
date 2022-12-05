<?php

namespace app\controllers;

use app\transfer\User;
use app\forms\LoginForm;

use core\App;
use core\Message;
use core\Utils;
use core\ParamUtils;
use core\RoleUtils;

class LoginCtrl{
	private $form;
	
	public function __construct()
	{
		$this->form = new LoginForm();
	}

	public function action_loginShow()
	{
		$this->generateView(); 
	}

	public function action_login()
	{
		$this->getParams();
		if ($this->validate()){
			$this->createUser();
			Utils::addInfoMessage('Logged in successfully. Enjoy your privileges.');
			App::getRouter()->forwardTo("homeShow");
		} else {
			$this->generateView(); 
		}
	}
	
	public function action_logout()
	{
		session_destroy();
		Utils::addInfoMessage('Logout successfuly.');
		App::getRouter()->forwardTo("homeShow");
	}

	private function generateView()
	{
		App::getSmarty()->assign('page_title','Login page');
		App::getSmarty()->assign('form',$this->form);
		App::getSmarty()->display('loginView.tpl');
	}

	private function getParams()
	{
		$this->form->login = ParamUtils::getFromRequest('login');
		$this->form->pass = ParamUtils::getFromRequest('pass');
	}
	
	private function validateWithDataBase()
	{
		$data = App::getDB()->select("user", ["password", "verified"], [
            "username" => $this->form->login
        ]);

		if(!empty($data))
		{
			if(strcmp($this->form->pass, $data[0]["password"]) !== 0)
			{
				Utils::addErrorMessage("Password does not match.");
			}

			if($data[0]["verified"] == 0)
			{
				Utils::addErrorMessage("Account is not verified yet.");
			}
		}
		else
		{
			Utils::addErrorMessage("User does not exist in data base.");
		}
	}

	private function validate() 
	{
		$loginValid = Utils::isLoginValid($this->form->login);
		$passValid = Utils::isPasswordValid($this->form->pass);

		if($loginValid && $passValid)
		{
			$this->validateWithDataBase();
		}
		

		return (!App::getMessages()->isError() && $loginValid && $passValid);
	}

	function createUser()
	{
		$data = App::getDB()->select("user", ['idUser', 'username'], [
            "username" => $this->form->login
        ]);

		$user = new User($data);
		$_SESSION['user'] = serialize($user);
		RoleUtils::addRole($user->role);
	}
}