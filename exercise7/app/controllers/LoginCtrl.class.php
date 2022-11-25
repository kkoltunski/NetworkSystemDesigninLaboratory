<?php

namespace app\controllers;

use app\transfer\User;
use app\forms\LoginForm;

class LoginCtrl{
	private $form;
	
	public function __construct()
	{
		$this->form = new LoginForm();
	}
	
	public function getParams()
	{
		$this->form->login = getFromRequest('login');
		$this->form->pass = getFromRequest('pass');
	}
	
	public function validate() 
	{
		if (! (isset($this->form->login) && isset($this->form->pass))) 
		{
			return false;
		}
			
		if (!getMessages()->isError()) 
		{
			if ($this->form->login == "") 
			{
				getMessages()->addError ("Login is missing.");
			}
			if ($this->form->pass == "") 
			{
				getMessages()->addError ("Password is missing.");
			}
		}

		if (!getMessages()->isError()) 
		{
			if ($this->form->login == "admin" && $this->form->pass == "admin") 
			{
				$user = new User($this->form->login, 'admin');
				$_SESSION['user'] = serialize($user);
				addRole($user->role);
			} 
			else if ($this->form->login == "user" && $this->form->pass == "user") 
			{
				$user = new User($this->form->login, 'user');
				$_SESSION['user'] = serialize($user);
				addRole($user->role);
			} 
			else 
			{
				getMessages()->addError('Incorrect login or password.');
			}
		}
		
		return !getMessages()->isError();
	}
	
	public function action_login(){

		$this->getParams();
		if ($this->validate()){
			header("Location: ".getConf()->app_url."/");
		} else {
			$this->generateView(); 
		}
		
	}
	
	public function action_logout(){
		session_destroy();
		getMessages()->addInfo('Logout successfuly.');
		$this->generateView();		 
	}
	
	public function generateView()
	{
		getSmarty()->assign('page_title','Login page');
		getSmarty()->assign('page_description','Log in to have access to credit calculator.');
		getSmarty()->assign('form',$this->form);
		getSmarty()->display('loginView.tpl');
	}
}