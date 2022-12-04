<?php

namespace app\controllers;

use app\forms\AccountForm;

use core\App;
use core\ParamUtils;
use core\Utils;

class RegistrationCtrl 
{
	private $form;

	public function __construct(){
		$this->form = new AccountForm();
	}
	
	public function action_registrationShow()
    {
		$this->generateView();
	}

    public function action_registration()
    {
        $this->getParams();

		if ($this->validate()) 
        {	
            $this->insertToDB();
			Utils::addInfoMessage('Succesfully registered. Wait for verification.');
            App::getRouter()->forwardTo("homeShow");
		}
        else
        {
            $this->generateView();
        }
    }

	private function generateView(){
		App::getSmarty()->assign('page_title','Registration');
		App::getSmarty()->assign('form',$this->form);

		App::getSmarty()->display('registrationView.tpl');
	}

	private function getParams()
	{
		$this->form->login = ParamUtils::getFromRequest('login');
		$this->form->pass = ParamUtils::getFromRequest('pass');
		$this->form->email = ParamUtils::getFromRequest('email');
		$this->form->contactNumber = ParamUtils::getFromRequest('number');
	}

    private function isUniqeInDB()
    {
        $usernameData = App::getDB()->select("user", "idUser", [
            "username" => $this->form->login
        ]);

        $emailData = App::getDB()->select("user", "idUser", [
            "email" => $this->form->email
        ]);

        return (empty($usernameData) && empty($emailData));
    }

	private function validate() 
    {
        $loginValid = Utils::isLoginValid($this->form->login);
		$passValid = Utils::isPasswordValid($this->form->pass);
        $emailValid = Utils::isEmailValid($this->form->email);
        $contactNumberValid = Utils::isContactNumberValid($this->form->contactNumber);
		
        $isUniqe = $this->isUniqeInDB();

        if(!$isUniqe)
        {
			Utils::addErrorMessage('Username or email exist in data base.');
        }

		return ($loginValid && $passValid && $emailValid && $contactNumberValid && $isUniqe);
	}

    private function insertToDB()
    {
        App::getDB()->insert("user", [
            "username" => $this->form->login,
            "password" => $this->form->pass,
            "email" => $this->form->email,
            "contactNumber" => $this->form->contactNumber
        ]);

        App::getDB()->insert("userrole", [
            "idUser_fk" => App::getDB()->id(),
            "idRole_fk" => Utils::getIdRole("user")
        ]);
	}
}
