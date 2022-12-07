<?php

namespace app\controllers;

use app\forms\SearchForm;

use core\App;
use core\ParamUtils;
use core\Utils;
use DateTime;

class ReservationsCtrl 
{
    public $vinylsData;
    public $searchForm;

    public function __construct(){
        $this->searchForm = new SearchForm();
	}
	
	public function action_processBooking()
    {
        $user = unserialize($_SESSION['user']);
        $idVinyl = ParamUtils::getFromRequest('buttonValue');

		$this->insertToDB($user, $idVinyl);
		Utils::addInfoMessage("Succesfully booked idVinyl $idVinyl");
		App::getRouter()->forwardTo("searchShow");
	}

    public function action_processReturned()
    {
        $idVinyl = ParamUtils::getFromRequest('buttonValue');

        $this->removeFromDB($idVinyl);
		Utils::addInfoMessage("idVinyl $idVinyl returned sucessfully.");
        App::getRouter()->forwardTo("searchShow");
    }

    public function action_reservationsShow()
    {
        $user = unserialize($_SESSION['user']);
        $this->vinylsData = Utils::getVinylsDataForUserId($user->idUser);
        Utils::getDataForSearchBarReservations($this->searchForm);
        $this->generateSearchView();
    }

    public function action_reservationsProcessFiltering()
    {
        // $user = unserialize($_SESSION['user']);
        // $this->vinylsData = Utils::getVinylsDataForUserId($user->idUser);
        // Utils::getDataForSearchBar($this->searchForm);
        // $this->generateSearchView();
        $action = ParamUtils::getFromRequest('buttonValue');

        if(strcmp($action, "reset") == 0)
        {
		    $this->action_reservationsShow();
        }
        else
        {
            $this->filterVinylView();
        }
    }

    private function insertToDB($user, $idVinyl)
    {
        $dt = new DateTime();

        App::getDB()->insert("rental", [
            // "till" => $dt,
            "idUser_fk" => $user->idUser,
            "idVinyl_fk" => $idVinyl
        ]);

        App::getDB()->update("vinyl", ['idRental'=> App::getDB()->id()], [
            "idVinyl" => $idVinyl
        ]);
	}

    private function removeFromDB($idVinyl)
    {
        App::getDB()->update("vinyl", ['idRental'=> NULL], [
            "idVinyl" => $idVinyl
        ]);

        App::getDB()->delete("rental", [
                "idVinyl_fk" => $idVinyl, 
        ]);
    }

    private function generateSearchView(){

		App::getSmarty()->assign('page_title', "Your active reservations");
        App::getSmarty()->assign('genresData',$this->searchForm->genresData);
        App::getSmarty()->assign('authorsData',$this->searchForm->authorsData);
        App::getSmarty()->assign('yearsData',$this->searchForm->yearsData);
        App::getSmarty()->assign('data', $this->vinylsData);

		App::getSmarty()->display('reservationsView.tpl');
	}

    public function filterVinylView()
    {
        ParamUtils::getParamsForFiltering($this->searchForm);
        Utils::getDataForSearchBarReservations($this->searchForm);
        $this->vinylsData = Utils::getVinylsDataFromQuery($this->searchForm);

        if(!empty($this->vinylsData))
        {
            $user = unserialize($_SESSION['user']);
            $idsUser = App::getDB()->select("rental", "idRental", [
                "idUser_fk" => $user->idUser]);
            $filteredArray = array();

            foreach($this->vinylsData as $vinyl)
            {
                if(in_array($vinyl["idRental"], $idsUser))
                {
                    array_push($filteredArray, $vinyl);
                }
            }

            $this->vinylsData = $filteredArray;
        }

		$this->generateSearchView();
	}
}
