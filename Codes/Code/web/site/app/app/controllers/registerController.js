// JavaScript Document
controllers.registerUser = function($scope, registerFactory, ngProgress, $timeout){
	$scope.registerUser = function(){

		registerFactory.saveUser($scope, ngProgress, $timeout)

	}
	$scope.sendmail = function(){
		registerFactory.sendRegConfirmation($scope);
	}
}

controllers.loginController = function($scope,loginFactory,ngProgress, $timeout, $routeParams){
	$scope.loginAuth = function(){
		loginFactory.userLogin($scope, ngProgress, $timeout);
		
		//$scope.username = sessionStorage.getItem("username")
		//console.log(loginFactory.getUser())
	}
}