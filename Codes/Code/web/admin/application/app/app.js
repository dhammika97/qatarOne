// JavaScript Document
var App = angular.module('QatartOne',['ngRoute','ngResource'])

App.config(function($routeProvider, $httpProvider){
	$routeProvider
	.when('/',
		{
			controller:'controllers.dashController',
			templateUrl:'app/partials/dashboard.html'	
		}
	)
	.when('/users',
		{
			controller:'controllers.userController',
			templateUrl:'app/partials/usersList.html'	
		}
	)
	.when('/addUser',
		{
			controller:'controllers.userController',
			templateUrl:'app/partials/addUser.html'	
		}
	)
	
	.otherwise({
		redirectTo:'/'
	})
	//$httpProvider.defaults.headers.put['Content-Type'] = 'application/json';
    //$httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    //$httpProvider.defaults.Authorization = 'kjsjjdfshdfhsdbfjhsbdfsdfsf';
})
