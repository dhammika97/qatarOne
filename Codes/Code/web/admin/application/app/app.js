// JavaScript Document
var App = angular.module('QatartOne',['ngRoute'])

App.config(function($routeProvider){
	$routeProvider
	.when('/',
		{
			controller:'controllers.dashController',
			templateUrl:'app/partials/dashboard.html'	
		}
	)
	.otherwise({
		redirectTo:'/'
	})
})
