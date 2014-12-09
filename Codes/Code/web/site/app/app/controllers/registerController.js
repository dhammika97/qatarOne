// JavaScript Document
controllers.registerUser = function($scope, registerFactory){
	$scope.registerUser = function(){
		registerFactory.saveUser($scope)
	}
}

controllers.loginController = function($scope,loginFactory){
	$scope.loginAuth = function(){
		loginFactory.userLogin($scope)
		//$scope.username = sessionStorage.getItem("username")
		//console.log(loginFactory.getUser())
	}
}