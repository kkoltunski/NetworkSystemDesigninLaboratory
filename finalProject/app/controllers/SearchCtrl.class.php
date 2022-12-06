<?php

namespace app\controllers;

use app\forms\SearchForm;

use core\App;
use core\Utils;

class SearchCtrl 
{
    private $vinylsData;
    private $searchForm;

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

		App::getSmarty()->assign('page_title','Vinyls overview');
        App::getSmarty()->assign('genresData',$this->searchForm->genresData);
        App::getSmarty()->assign('authorsData',$this->searchForm->authorsData);
        App::getSmarty()->assign('yearsData',$this->searchForm->yearsData);
        App::getSmarty()->assign('data',$this->vinylsData);

		App::getSmarty()->display('searchView.tpl');
	}
}
