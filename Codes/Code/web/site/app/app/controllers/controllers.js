// JavaScript Document
var controllers = {};
///ng-controller="masterController"
controllers.masterController = function($scope, $location){
	//$scope.loggedInUser = "Usama"
	$scope.go = function(path){
		$location.path(path)
	}
}

App.controller(controllers)