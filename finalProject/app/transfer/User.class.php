<?php

namespace app\transfer;

use core\App;

class User{
	public $idUser;
	public $username;
	public $role;
	
	public function __construct($date)
	{
		$this->idUser = $date[0]["idUser"];
		$this->username = $date[0]["username"];
		$this->role = $this->getRoleName();		
	}	

	private function getRoleName()
	{
		$idRole = App::getDB()->select("userrole", "idRole_fk", [
            "idUser_fk" => $this->idUser
        ]);

		$roleName = App::getDB()->select("role", "name", [
			"idRole" => $idRole
		]);

		return "$roleName[0]";
	}
}