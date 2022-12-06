<?php

namespace app\controllers;

use app\forms\VinylForm;
use app\forms\SearchForm;

use core\App;
use core\ParamUtils;
use core\Utils;
use core\Validator;

class FilteringCtrl 
{
    private $vinylsData;
    private $vinylForm;
    private $searchForm;
    private $idVinyl;

	public function __construct(){
        $this->searchForm = new SearchForm();
	}
	
    public function action_processFiltering()
    {
        $action = ParamUtils::getFromRequest('buttonValue');

        if(strcmp($action, "reset") == 0)
        {
            $this->vinylsShow();
        }
        else
        {
            $this->filterVinylView();
        }
    }

	public function vinylsShow()
    {
        $this->vinylsData = Utils::getVinylsData();
		$this->generateProductsManagementView();
	}

    public function filterVinylView()
    {
        ParamUtils::getParamsForFiltering($this->searchForm);
        $this->vinylsData = Utils::getVinylsDataFromQuery($this->searchForm);

		$this->generateProductsManagementView();
	}

    private function generateProductsManagementView(){
        Utils::getDataForSearchBar($this->searchForm);

		App::getSmarty()->assign('page_title','Vinyls overwiev');
        App::getSmarty()->assign('genresData',$this->searchForm->genresData);
        App::getSmarty()->assign('authorsData',$this->searchForm->authorsData);
        App::getSmarty()->assign('yearsData',$this->searchForm->yearsData);
        App::getSmarty()->assign('data',$this->vinylsData);

		App::getSmarty()->display('searchView.tpl');
	}
}
