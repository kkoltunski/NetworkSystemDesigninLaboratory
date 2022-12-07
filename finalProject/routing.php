<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('homeShow');
App::getRouter()->setLoginRoute('loginShow');

Utils::addRoute('homeShow', 'HomeCtrl');
Utils::addRoute('searchFromHome', 'HomeCtrl');

//logging managment
Utils::addRoute('loginShow', 'LoginCtrl');
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl', ['user', 'admin']);

// searching and filtering
Utils::addRoute('processFiltering', 'FilteringCtrl');
Utils::addRoute('searchShow', 'SearchCtrl');

// guest registration
Utils::addRoute('registrationShow', 'RegistrationCtrl');
Utils::addRoute('registration', 'RegistrationCtrl');

// user account managment
Utils::addRoute('accountShow', 'AccountCtrl', ['user']);
Utils::addRoute('accountUpdate', 'AccountCtrl', ['user']);

// admin managing accounts
Utils::addRoute('manageAccountsShow', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('addUserShow', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('addUser', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('resetPassword', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('verify', 'AccountManagmentCtrl', ['admin']);
Utils::addRoute('delete', 'AccountManagmentCtrl', ['admin']);

// admin managing products
Utils::addRoute('manageProductsShow', 'ProductManagmentCtrl', ['admin']);
Utils::addRoute('addVinylShow', 'ProductManagmentCtrl', ['admin']);
Utils::addRoute('addVinyl', 'ProductManagmentCtrl', ['admin']);
Utils::addRoute('deleteVinyl', 'ProductManagmentCtrl', ['admin']);

// reservations
Utils::addRoute('reservationsShow', 'ReservationsCtrl', ['user']);
Utils::addRoute('processBooking', 'ReservationsCtrl', ['user']);
Utils::addRoute('processReturned', 'ReservationsCtrl', ['admin']);
Utils::addRoute('reservationsProcessFiltering', 'ReservationsCtrl', ['user']);
