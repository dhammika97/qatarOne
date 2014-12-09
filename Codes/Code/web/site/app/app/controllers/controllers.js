// JavaScript Document
var controllers = {};
///ng-controller="masterController"
controllers.masterController = function($scope, $location){
	$scope.username = sessionStorage.getItem("username")
	
	$scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
	
	$scope.alerts = []
	//{ type: 'danger', msg: 'Oh snap! Change a few things up and try submitting again.' }
	
	$scope.addAlert = function(massage) {
    	$scope.alerts.push({msg: massage});
  	};

	$scope.closeAlert = function(index) {
		$scope.alerts.splice(index, 1);
	};
	
	$scope.go = function(path){
		$location.path(path)
	}
}

controllers.dashController = function($scope, dashFactory){
	//$scope.categories = dashFactory.getCategory();
}

App.controller(controllers)