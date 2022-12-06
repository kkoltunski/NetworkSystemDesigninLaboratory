<?php

namespace app\controllers;

use app\forms\VinylForm;
use app\forms\SearchForm;

use core\App;
use core\ParamUtils;
use core\Utils;
use core\Validator;

class ProductManagmentCtrl 
{
    private $vinylsData;
    private $vinylForm;
    private $searchForm;
    private $idVinyl;

	public function __construct(){
        $this->vinylForm = new VinylForm();
        $this->searchForm = new SearchForm();
	}
	
	public function action_manageProductsShow()
    {
        $this->getData();
		$this->generateProductsManagementView();
	}

    public function action_addVinylShow()
    {
		$this->generateAddVinylView();
	}

    public function action_addVinyl()
    {
        $this->getParamsForNewVinyl();

        if($this->validate())
        {
            $this->insertToDB();
			Utils::addInfoMessage('Succesfully added.');
		    $this->action_manageProductsShow();
        }
        else
        {
            $this->generateAddVinylView();
        }
	}

    public function action_deleteVinyl()
    {
        $this->getParamsForDelete();

        App::getDB()->delete("vinyl", ["idVinyl" => $this->idVinyl]);
		Utils::addInfoMessage("Succesfully deleted idVinyl $this->idVinyl");

		$this->action_manageProductsShow();
	}

    public function action_processFiltering()
    {
        $action = ParamUtils::getFromRequest('buttonValue');

        if(strcmp($action, "reset") == 0)
        {
            $this->action_manageProductsShow();
        }
        else
        {
            $this->filterVinylView();
        }
    }

    public function filterVinylView()
    {
        ParamUtils::getParamsForFiltering($this->searchForm);
        $this->vinylsData = Utils::getVinylsDataFromQuery($this->searchForm);

		$this->generateProductsManagementView();
	}

    private function getDataForSearchBar()
    {
        $this->searchForm->genresData = Utils::getGenreList();
        $this->searchForm->authorsData = Utils::getAuthorList();
        $this->searchForm->yearsData = Utils::getYearList();
    }

    private function getData(){
		$this->vinylsData = App::getDB()->select("vinyl", "*");
	}

    private function generateProductsManagementView(){
        $this->getDataForSearchBar();

		App::getSmarty()->assign('page_title','Products management');
        App::getSmarty()->assign('genresData',$this->searchForm->genresData);
        App::getSmarty()->assign('authorsData',$this->searchForm->authorsData);
        App::getSmarty()->assign('yearsData',$this->searchForm->yearsData);
        App::getSmarty()->assign('data',$this->vinylsData);

		App::getSmarty()->display('manageProductsView.tpl');
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
