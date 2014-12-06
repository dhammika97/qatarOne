// JavaScript Document
controllers.registerUser = function($scope, registerFactory){
	$scope.registerUser = function(){
		registerFactory.saveUser($scope)
	}
}
