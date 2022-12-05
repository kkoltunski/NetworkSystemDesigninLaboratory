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
		$this->form->passwordFirst = ParamUtils::getFromRequest('pass1');
		$this->form->passwordSecond = ParamUtils::getFromRequest('pass2');
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
        $emailValid = Utils::isEmailValid($this->form->email);

        $isUniqe = $this->isUniqeInDB();
        if(!$isUniqe)
        {
			Utils::addErrorMessage('Username or email exist in data base.');
        }

        $passwordsTheSame = (strcmp($this->form->passwordFirst, $this->form->passwordSecond) === 0);
        $passFirstValid = null;
        if($passwordsTheSame)
        {
            $passFirstValid = Utils::isPasswordValid($this->form->passwordFirst);
        }
        else
        {
            Utils::addErrorMessage('Passwords are not the same.');
        }

        $contactNumberValid = Utils::isContactNumberValid($this->form->contactNumber);
		
		return ($loginValid && $passFirstValid && $passwordsTheSame && $emailValid && $contactNumberValid && $isUniqe);
	}

    private function insertToDB()
    {
        App::getDB()->insert("user", [
            "username" => $this->form->login,
            "password" => $this->form->passwordFirst,
            "email" => $this->form->email,
            "contactNumber" => $this->form->contactNumber
        ]);

        App::getDB()->insert("userrole", [
            "idUser_fk" => App::getDB()->id(),
            "idRole_fk" => Utils::getIdRole("user")
        ]);
	}
}
