<?php

namespace app\controllers;

use app\forms\AccountForm;

use core\App;
use core\ParamUtils;
use core\Utils;

class AccountManagmentCtrl 
{
    private $data;
    private $idUser;
    private $form;

	public function __construct(){
        $this->form = new AccountForm();
	}
	
	public function action_manageAccountsShow()
    {
        $this->getData();
		$this->generateAccountsManagementView();
	}

    public function action_addUserShow()
    {
		$this->generateAddUserView();
	}

    public function action_addUser()
    {
        $this->getParamsForNewUser();

		if ($this->validate()) 
        {	
            $this->insertToDB();
			Utils::addInfoMessage('Succesfully added.');
            $this->action_manageAccountsShow();
		}
        else
        {
            $this->generateAddUserView();
        }
	}

    public function action_resetPassword()
    {
        $this->getParamsForModification();

        App::getDB()->update("user", [
            "password" => 'xxxxxx',
        ], ["idUser" => $this->idUser]);

		$this->action_manageAccountsShow();
	}

    public function action_verify()
    {
        $this->getParamsForModification();

        App::getDB()->update("user", [
            "verified" => '1',
        ], ["idUser" => $this->idUser]);

		$this->action_manageAccountsShow();
	}

    public function action_delete()
    {
        $this->getParamsForModification();

        App::getDB()->delete("user", ["idUser" => $this->idUser]);

		$this->action_manageAccountsShow();
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

    private function getData(){
        $ids = App::getDB()->select("userrole", 'idUser_fk', 
            [
                "idRole_fk[!]" => '1'
            ]
        );

		$this->data = App::getDB()->select("user", 
            ['idUser', 'username', 'password', 'email', 'verified', 'contactNumber'], 
            [
                'idUser' => $ids
            ]
        );
	}

    private function getParamsForModification()
	{
		$this->idUser = ParamUtils::getFromRequest('buttonValue');
	}

    private function getParamsForNewUser()
	{
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->passwordFirst = ParamUtils::getFromRequest('pass1');
        $this->form->passwordSecond = ParamUtils::getFromRequest('pass2');
        $this->form->email = ParamUtils::getFromRequest('email');
        $this->form->contactNumber = ParamUtils::getFromRequest('number');
	}

    private function generateAccountsManagementView(){
		App::getSmarty()->assign('page_title','Accounts management');
        App::getSmarty()->assign('data',$this->data);

		App::getSmarty()->display('manageAccounts.tpl');
	}

    private function generateAddUserView(){
		App::getSmarty()->assign('page_title','New user insertion');

		App::getSmarty()->display('newUserView.tpl');
	}

    private function insertToDB()
    {
        App::getDB()->insert("user", [
            "username" => $this->form->login,
            "password" => $this->form->passwordFirst,
            "email" => $this->form->email,
            "verified" => '1',
            "contactNumber" => $this->form->contactNumber
        ]);

        App::getDB()->insert("userrole", [
            "idUser_fk" => App::getDB()->id(),
            "idRole_fk" => Utils::getIdRole("user")
        ]);
	}
}
