// JavaScript Document
var controllers = {};
///ng-controller="masterController"
controllers.masterController = function($scope, $location, ngProgress, $timeout){
	$scope.username = ''
	$scope.username = sessionStorage.getItem("username")
	
	$scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
	
	$scope.alerts = []
	//{ type: 'danger', msg: 'Oh snap! Change a few things up and try submitting again.' }
	
	$scope.addAlert = function(typ, massage) {
    	$scope.alerts.push({type:typ, msg: massage});
  	};

	$scope.closeAlert = function(index) {
		$scope.alerts.splice(index, 1);
	};
	
	$scope.go = function(path){
		$location.path(path)
	}
	
	
	
	$scope.$on('$viewContentLoaded', function(){
		ngProgress.complete()//Here your view content is fully loaded !!
	});
}

controllers.dashController = function($scope, dashFactory){
	//$scope.categories = dashFactory.getCategory();
}

App.controller(controllers)