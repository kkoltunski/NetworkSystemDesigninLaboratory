<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('homeShow');
App::getRouter()->setLoginRoute('loginShow');

Utils::addRoute('homeShow', 'HomeCtrl');

Utils::addRoute('loginShow', 'LoginCtrl');
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl', ['user', 'admin']);

Utils::addRoute('registrationShow', 'RegistrationCtrl');
Utils::addRoute('registration', 'RegistrationCtrl');

Utils::addRoute('accountShow', 'AccountCtrl', ['user']);
Utils::addRoute('accountUpdate', 'AccountCtrl', ['user']);
