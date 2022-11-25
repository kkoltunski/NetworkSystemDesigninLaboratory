<?php

namespace app\controllers;

use PDOException;

class ResultsListCtrl
{
	private $records;

	public function __construct()
	{
	}
		
	public function action_resultsList(){		
		try{
			$this->records = getDB()->select("result", [
					"creation",
					"value",
				]);
		} catch (PDOException $e){
			getMessages()->addError('Wystąpił błąd podczas pobierania rekordów');
			if (getConf()->debug) getMessages()->addError($e->getMessage());			
		}	
		
		$this->generateView();
	}
	
	public function generateView()
	{
		getSmarty()->assign('page_title','History');
		getSmarty()->assign('page_description','Review last results');
		getSmarty()->assign('results',$this->records);
		getSmarty()->display('resultsView.tpl');
	}
}
