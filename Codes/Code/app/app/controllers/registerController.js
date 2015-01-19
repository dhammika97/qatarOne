// JavaScript Document
controllers.registerUser = function($scope, registerFactory, ngProgress, $timeout){
	$scope.registerUser = function(isValid){
		$scope.submitted = true
		if(isValid){
			registerFactory.saveUser($scope, ngProgress, $timeout)
		}

	}
	$scope.sendmail = function(){
		registerFactory.sendRegConfirmation($scope);
	}
}

controllers.loginController = function($scope,loginFactory,ngProgress, $timeout, $routeParams){
	$scope.loginAuth = function(isValid){
		$scope.submitted = true
		if (isValid) {
			loginFactory.userLogin($scope, ngProgress, $timeout);
		}
		
		//$scope.username = sessionStorage.getItem("username")
		//console.log(loginFactory.getUser())
	}
}