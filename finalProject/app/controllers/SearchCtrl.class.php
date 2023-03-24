<?php

namespace app\controllers;

use app\forms\SearchForm;

use app\transfer\PaginationInfo;

use core\App;
use core\Utils;
use core\ParamUtils;

class SearchCtrl 
{
    private $vinylsData;
    private $searchForm;
    private $paginationInfo;

	public function __construct(){
        $this->searchForm = new SearchForm();
        $this->paginationInfo = new PaginationInfo();
	}

	public function action_searchShow()
    {
        $this->paginationInfo->updateSelection(0, sizeof(Utils::getWholeVinylsData()));
        $this->vinylsData = Utils::getVinylsData($this->paginationInfo->dbFrom, $this->paginationInfo->dbTo);
        $this->generateView();
	}

	public function action_selectPage()
    {
        $selected = ParamUtils::getFromRequest('selected');
        $this->paginationInfo->updateSelection($selected, sizeof(Utils::getWholeVinylsData()));
        $this->vinylsData = Utils::getVinylsData($this->paginationInfo->dbFrom, $this->paginationInfo->dbTo);
        $this->generateView();
    }

    private function generateView(){
        Utils::getDataForSearchBar($this->searchForm);

		App::getSmarty()->assign('page_title','Vinyls overview');
        App::getSmarty()->assign('genresData',$this->searchForm->genresData);
        App::getSmarty()->assign('authorsData',$this->searchForm->authorsData);
        App::getSmarty()->assign('yearsData',$this->searchForm->yearsData);
        App::getSmarty()->assign('data',$this->vinylsData);
        App::getSmarty()->assign('pagination',$this->paginationInfo);

		App::getSmarty()->display('searchView.tpl');
	}
}
