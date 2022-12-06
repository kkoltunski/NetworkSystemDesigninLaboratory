<?php

namespace app\controllers;

use app\forms\SearchForm;

use core\App;
use core\ParamUtils;
use core\Utils;
use core\Validator;

class SearchCtrl 
{
    private $vinylsData;
    private $vinylForm;
    private $searchForm;
    private $idVinyl;

	public function __construct(){
        $this->searchForm = new SearchForm();
	}

	public function action_searchShow()
    {
        $this->vinylsData = Utils::getVinylsData();
		$this->generateView();
	}

    private function generateView(){
        Utils::getDataForSearchBar($this->searchForm);

		App::getSmarty()->assign('page_title','Search...');
        App::getSmarty()->assign('genresData',$this->searchForm->genresData);
        App::getSmarty()->assign('authorsData',$this->searchForm->authorsData);
        App::getSmarty()->assign('yearsData',$this->searchForm->yearsData);
        App::getSmarty()->assign('data',$this->vinylsData);

		App::getSmarty()->display('searchView.tpl');
	}

    private function generateAddVinylView(){
		App::getSmarty()->assign('page_title','New vinyl insertion');

		App::getSmarty()->display('newVinylView.tpl');
	}

    private function getParamsForNewVinyl()
    {
        $this->vinylForm->author = ParamUtils::getFromRequest('author');
        $this->vinylForm->name = ParamUtils::getFromRequest('name');
        $this->vinylForm->year = ParamUtils::getFromRequest('year');
        $this->vinylForm->genre = ParamUtils::getFromRequest('genre');
    }

    private function getParamsForDelete()
    {
        $this->idVinyl = ParamUtils::getFromRequest('buttonValue');
    }

    private function validate() 
    {
        $authorValid = Utils::isPhraseValid($this->vinylForm->author, 'Author', 20);
        $nameValid = Utils::isPhraseValid($this->vinylForm->name, 'Name', 40);
        $genreValid = Utils::isPhraseValid($this->vinylForm->genre, 'Genre', 15);

        $yearValidator = new Validator();
        $y = $yearValidator->validate($this->vinylForm->year, [
            'required' => true,
            'required_message' => "Year is required.",
            'date_format' => 'Y',
            'validator_message' => "Year field is not in year format."
        ]);

        $isUniqe = $this->isUniqeInDB();
        if(!$isUniqe)
        {
			Utils::addErrorMessage('Vinyl with this data already exist.');
        }
		
		return ($authorValid && $nameValid && $genreValid && $yearValidator->isLastOK() && $isUniqe);
	}

    private function isUniqeInDB()
    {
        $data = App::getDB()->select("vinyl", "idVinyl", [
            "author" => $this->vinylForm->author,
            "name" => $this->vinylForm->name,
            "year" => $this->vinylForm->year,
            "genre" => $this->vinylForm->genre
        ]);

        return empty($data);
    }

    private function insertToDB()
    {
        App::getDB()->insert("vinyl", [
            "author" => $this->vinylForm->author,
            "name" => $this->vinylForm->name,
            "year" => $this->vinylForm->year,
            "genre" => $this->vinylForm->genre
        ]);
	}
}
