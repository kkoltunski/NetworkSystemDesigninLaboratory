<?php

namespace app\controllers;

use app\forms\SearchForm;

use core\App;
use core\Utils;
use core\ParamUtils;

class HomeCtrl{
    private $searchForm;
    private $vinylsData;
	
	public function __construct()
	{
        $this->searchForm = new SearchForm();
	}

	public function action_homeShow()
	{
		$this->generateView(); 
	}

	public function action_searchFromHome()
	{
		$this->prepareForSearch(); 
		$this->generateSearchView();
	}

    public function prepareForSearch()
    {
		$string = ParamUtils::getFromRequest('buttonValue');
		$explodedString = explode('.', $string);

		if(strcmp($explodedString[0], '0') == 0)
		{
			$this->vinylsData = Utils::getVinylsDataFromQueryForTable("genre", $explodedString[1]);
		}
		else if(strcmp($explodedString[0], '1') == 0)
		{
			$this->vinylsData = Utils::getVinylsDataFromQueryForTable("author", $explodedString[1]);
		}
		else if(strcmp($explodedString[0], '2') == 0)
		{
			$this->vinylsData = Utils::getVinylsDataFromQueryForTable("year", $explodedString[1]);
		}
		else
		{
			$this->vinylsData = Utils::getVinylsDataFromQuery($this->searchForm);
		}
	}

	private function generateView()
	{
		Utils::getDataForSearchBar($this->searchForm);

		App::getSmarty()->assign('page_title','Home page');
		App::getSmarty()->assign('genresData',$this->searchForm->genresData);
        App::getSmarty()->assign('authorsData',$this->searchForm->authorsData);
        App::getSmarty()->assign('yearsData',$this->searchForm->yearsData);
		
		App::getSmarty()->display('homeView.tpl');
	}

	private function generateSearchView()
	{
		Utils::getDataForSearchBar($this->searchForm);

		App::getSmarty()->assign('page_title','Vinyls overview');
		App::getSmarty()->assign('genresData',$this->searchForm->genresData);
        App::getSmarty()->assign('authorsData',$this->searchForm->authorsData);
        App::getSmarty()->assign('yearsData',$this->searchForm->yearsData);
        App::getSmarty()->assign('data',$this->vinylsData);

		App::getSmarty()->display('searchView.tpl');
	}
}