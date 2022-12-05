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

Utils::addRoute('manageAccountsShow', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('addUserShow', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('addUser', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('resetPassword', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('verify', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('delete', 'AccountManagmentCtrl', ['admin']);


