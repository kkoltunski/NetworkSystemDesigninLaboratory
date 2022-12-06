<?php

namespace core;

/**
 * Wrapper class for basic utility functions
 *
 * @author Przemysław Kudłacik
 */
class Utils {

    public static function addRoute($action, $controller, $roles = null) {
        App::getRouter()->addRoute($action, $controller, $roles);
    }

    public static function addRouteEx($action, $path, $controller, $method, $roles = null) {
        App::getRouter()->addRouteEx($action, $path, $controller, $method, $roles);
    }

    public static function addErrorMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::ERROR), $index);
    }

    public static function addInfoMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::INFO), $index);
    }

    public static function addWarningMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::WARNING), $index);
    }

    private static function _url_maker($action, $params = null) {
        $url = $action;
        if ($params != null && is_array($params)) {
            foreach ($params as $key => $value) {
                if (App::getConf()->clean_urls) {
                    $url .= '/';
                } else {
                    $url .= '&' . $key . '=';
                }
                $url .= $value;
            }
        }
        return $url;
    }

    private static function _url_maker_noclean($action, $params = null) {
        $url = $action;
        if (App::getConf()->clean_urls) {
            $url .= '?';
        }
        if ($params != null && is_array($params)) {
            $first = true;
            foreach ($params as $key => $value) {
                if ($first && App::getConf()->clean_urls){
                    $url .= $key . '=' . $value;
                    $first = false;
                } else {
                    $url .= '&' . $key . '=' . $value;
                }
            }
        }
        return $url;
    }
    public static function URL($action, $params = null) {       
        return App::getConf()->action_url . self::_url_maker($action, $params);
    }

    public static function relURL($action, $params = null) {       
        return App::getConf()->action_root . self::_url_maker($action, $params);
    }

    public static function URL_noclean($action, $params = null) {       
        return App::getConf()->action_url . self::_url_maker_noclean($action, $params);
    }

    public static function relURL_noclean($action, $params = null) {       
        return App::getConf()->action_root . self::_url_maker_noclean($action, $params);
    }

//user defined
    public static function isLoginValid($login)
    {
        $loginValidator = new Validator();
	    $login = $loginValidator->validate($login, [
  	    	'trim' => true,
  	    	'required' => true,
  	    	'required_message' => 'Login is required.',
  	    	'min_length' => 3,
  	    	'max_length' => 15,
  	    	'validator_message' => 'Login should have 3 - 15 characters.'
	    ]);

        return $loginValidator->isLastOK();
    }

    public static function isPasswordValid($password)
    {
        $passValidator = new Validator();
        $pass = $passValidator->validate($password, [
            'required' => true,
            'required_message' => 'Password is required.',
            'min_length' => 5,
            'max_length' => 15,
            'validator_message' => 'Password should have 5 - 15 characters.'
        ]);

        return $passValidator->isLastOK();
    }

    public static function isEmailValid($email)
    {
        $emailValidator = new Validator();
        $email = $emailValidator->validate($email, [
            'required' => true,
            'email' => true,
            'required_message' => 'Email is required.',
            'validator_message' => 'Email does not look legit.'
        ]);

        return $emailValidator->isLastOK();
    }

    public static function isContactNumberValid($contactNumber)
    {
        $contactNumberValidator = new Validator();
        $contactNumber = $contactNumberValidator->validate($contactNumber, [
            'max_length' => 12,
            'validator_message' => 'Contact number too long.'
        ]);

        return $contactNumberValidator->isLastOK();
    }

    public static function isPhraseValid($phrase, $type, $maxLength)
    {
        $phraseValidator = new Validator();
        $p = $phraseValidator->validate($phrase, [
            'required' => true,
            'required_message' => "$type is required.",
            'max_length' => $maxLength,
            'validator_message' => "$type should have up to $maxLength characters."
        ]);

        return $phraseValidator->isLastOK();
    }

    public static function getIdRole($name)
    {
	    $idRole = App::getDB()->select("role", "idRole", [
	    	"name" => $name
	    ]);

	    return "$idRole[0]";
    }

    public static function getVinylsData(){
        return App::getDB()->select("vinyl", "*");
	}

    public static function getVinylsDataForUserId($idUser)
    {
        $vinylsIds = App::getDB()->select("rental", "idVinyl_fk", [
            "idUser_fk" => $idUser]);
        
        if(!empty($vinylsIds))
        {
            $vinylsData = App::getDB()->select("vinyl", "*", ["idVinyl" => $vinylsIds]);
            return $vinylsData;
        }
        else
        {
            return array();
        }
    }

    public static function getGenreList()
    {
        $genres = App::getDB()->select("vinyl", "genre");
        $uniqueGenres = array_unique($genres);
        sort($uniqueGenres);
        return $uniqueGenres;
    }

    public static function getAuthorList()
    {
        $authors = App::getDB()->select("vinyl", "author");
        $uniqueAuthors = array_unique($authors);
        sort($uniqueAuthors);
        return $uniqueAuthors;
    }

    public static function getYearList()
    {
        $years = App::getDB()->select("vinyl", "year");
        $uniqueYears = array_unique($years);
        sort($uniqueYears);
        return $uniqueYears;
    }

    public static function getDataForSearchBar($searchForm)
    {
        $searchForm->genresData = Utils::getGenreList();
        $searchForm->authorsData = Utils::getAuthorList();
        $searchForm->yearsData = Utils::getYearList();
    }

    public static function getGenreListForIds($idVinyls)
    {
        $genres = App::getDB()->select("vinyl", "genre", ["idVinyl" => $idVinyls]);
        $uniqueGenres = array_unique($genres);
        sort($uniqueGenres);
        return $uniqueGenres;
    }

    public static function getAuthorListForIds($idVinyls)
    {
        $authors = App::getDB()->select("vinyl", "author", ["idVinyl" => $idVinyls]);
        $uniqueAuthors = array_unique($authors);
        sort($uniqueAuthors);
        return $uniqueAuthors;
    }

    public static function getYearListForIds($idVinyls)
    {
        $years = App::getDB()->select("vinyl", "year", ["idVinyl" => $idVinyls]);
        $uniqueYears = array_unique($years);
        sort($uniqueYears);
        return $uniqueYears;
    }

    public static function getDataForSearchBarReservations($searchForm)
    {
        $user = unserialize($_SESSION['user']);
        $idVinyls = App::getDB()->select("rental", "idVinyl_fk", [
            "idUser_fk" => $user->idUser]);

        $searchForm->genresData = Utils::getGenreListForIds($idVinyls);
        $searchForm->authorsData = Utils::getAuthorListForIds($idVinyls);
        $searchForm->yearsData = Utils::getYearListForIds($idVinyls);
    }

    public static function getVinylsDataFromQuery($searchForm)
    {
        $genreSelected = (strcmp($searchForm->selectedGenre, "0") !== 0);
        $authorSelected = (strcmp($searchForm->selectedAuthor, "0") !== 0);
        $yearSelected = (strcmp($searchForm->selectedYear, "0") !== 0);

        if($genreSelected or $authorSelected or $yearSelected)
        {
            $where = ' WHERE';
            $and = '';

            if($genreSelected){
                $and .= " `genre` = '$searchForm->selectedGenre'";
            }
            if($authorSelected)
            {
                if(!empty($and)){
                    $and .= " AND";
                }
                $and .= " `author` = '$searchForm->selectedAuthor'";
            }
            if($yearSelected)
            {
                if(!empty($and)){
                    $and .= " AND";
                }
                $and .= " `year` = '$searchForm->selectedYear'";
            }

            $query = 'SELECT * FROM `vinyl`'.$where.$and;
            return App::getDB()->query($query)->fetchAll();
        }
        else
        {
            return Utils::getVinylsData();
        }

        // $sql = "SELECT * FROM `vinyl` WHERE `genre` = 'metal'";
        // return App::getDB()->query($query)->fetchAll();
    }

    public static function getVinylsDataFromQueryReservations($searchForm)
    {
        $genreSelected = (strcmp($searchForm->selectedGenre, "0") !== 0);
        $authorSelected = (strcmp($searchForm->selectedAuthor, "0") !== 0);
        $yearSelected = (strcmp($searchForm->selectedYear, "0") !== 0);

        if($genreSelected or $authorSelected or $yearSelected)
        {
            $user = unserialize($_SESSION['user']);
            $idVinyls = App::getDB()->select("rental", "idVinyl_fk", [
                "idUser_fk" => $user->idUser]);

            $where = " WHERE `idVinyl` = '$idVinyls'";
            $and = '';

            if($genreSelected){
                $and .= " `genre` = '$searchForm->selectedGenre'";
            }
            if($authorSelected)
            {
                if(!empty($and)){
                    $and .= " AND";
                }
                $and .= " `author` = '$searchForm->selectedAuthor'";
            }
            if($yearSelected)
            {
                if(!empty($and)){
                    $and .= " AND";
                }
                $and .= " `year` = '$searchForm->selectedYear'";
            }

            // $query = null;
            $query = 'SELECT * FROM `vinyl`'.$where.$and;
            // if(strcmp($user->role, "admin") == 0)
            // {
            //     $query = 'SELECT * FROM `vinyl`'.$where.$and;
            // }
            // else
            // {
            //     // $query = 'SELECT `author`, `name`, `year`, `genre`, `idRental` FROM `vinyl`'.$where.$and;
            //     $query = 'SELECT * FROM `vinyl`'.$where.$and;
            // }
            return App::getDB()->query($query)->fetchAll();
        }
        else
        {
            return Utils::getVinylsData();
        }
    }
}
