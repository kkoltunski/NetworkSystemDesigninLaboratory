<?php

namespace app\controllers;

use app\forms\AccountForm;

use core\App;
use core\ParamUtils;
use core\Utils;

class AccountCtrl 
{
	private $form;

	public function __construct(){
		$this->form = new AccountForm();
	}
	
	public function action_accountShow()
    {
		$this->generateView();
	}

    public function action_accountUpdate()
    {
        $this->getParams();

		if ($this->validate()) 
        {	
            if($this->updateDB())
            {
                Utils::addInfoMessage('Account succesfully updated.');
            }
		}
        $this->generateView();
    }

	private function generateView(){
		App::getSmarty()->assign('page_title','Registration');
		App::getSmarty()->assign('form',$this->form);

		App::getSmarty()->display('accountView.tpl');
	}

	private function getParams()
	{
        $user = unserialize($_SESSION['user']);
        $this->form->login = $user->username;
		$this->form->passwordFirst = ParamUtils::getFromRequest('pass1');
		$this->form->passwordSecond = ParamUtils::getFromRequest('pass2');
		$this->form->email = ParamUtils::getFromRequest('email');
		$this->form->contactNumber = ParamUtils::getFromRequest('number');
	}

    private function isUniqeInDB()
    {
        $emailData = App::getDB()->select("user", "idUser", [
            "email" => $this->form->email
        ]);

        return empty($emailData);
    }

    private function isPasswordValid()
    {
        if(!empty($this->form->passwordFirst))
        {
            $passwordsTheSame = (strcmp($this->form->passwordFirst, $this->form->passwordSecond) === 0);
            if($passwordsTheSame)
            {
                return Utils::isPasswordValid($this->form->passwordFirst);
            }
            else
            {
                Utils::addErrorMessage('Passwords are not the same.');
                return false;
            }
            
        }
        else
        {
            return true;
        }
    }

    private function isEmailValid()
    {
        if(!empty($this->form->email))
        {
            if(Utils::isEmailValid($this->form->email))
            {
                if($this->isUniqeInDB())
                {
                    return true;
                }
                else
                {
                    Utils::addErrorMessage('Email exist in data base.');
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return true;
        }
    }

    private function isContactNumberValid()
    {
        if(!empty($this->form->contactNumber))
        {
            return Utils::isContactNumberValid($this->form->contactNumber);
        }
        else
        {
            return true;
        }
    }

	private function validate() 
    {
        $passValid = $this->isPasswordValid();
        $emailValid = $this->isEmailValid();
        $numberValid = $this->isContactNumberValid();

		return ($passValid && $emailValid && $numberValid);
	}

    private function updateDB()
    {
        $updated = false;
        if(!empty($this->form->passwordFirst))
        {
            App::getDB()->update("user", [
                "password" => $this->form->passwordFirst,
            ], ["username" => $this->form->login]);

            $updated = true;
        }

        if(!empty($this->form->email))
        {
            App::getDB()->update("user", [
                "email" => $this->form->email,
            ], ["username" => $this->form->login]);

            $updated = true;
        }

        if(!empty($this->form->contactNumber))
        {
            App::getDB()->update("user", [
                "contactNumber" => $this->form->contactNumber,
            ], ["username" => $this->form->login]);

            $updated = true;
        }

        return $updated;
	}
}
