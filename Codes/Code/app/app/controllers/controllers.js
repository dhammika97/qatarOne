// JavaScript Document
var controllers = {};
///ng-controller="masterController"
controllers.masterController = function($scope, $location, ngProgress, $timeout, $window){
	$scope.username = ''
	$scope.username = sessionStorage.getItem("username")
	$scope.isCollapsed = true;
	
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
	
	$scope.setUser = function(data){
		$scope.username = data.username
	}
	
	$scope.$on('$viewContentLoaded', function(){
		ngProgress.complete()//Here your view content is fully loaded !!
		//$scope.isCollapsed = true;
	});
	
	$scope.logout = function(){
		sessionStorage.removeItem('username')
		sessionStorage.removeItem('accessKey')
		$scope.username = ''
		$scope.go('/login')
	}
	$scope.$on('$viewContentLoaded', function(event) {
		//$window._gaq.push(['_trackPageview', $location.path()]);
		$window.ga('send', 'pageview', { page: $location.path() });
	});
}

controllers.dashController = function($scope, dashFactory){
	//$scope.categories = dashFactory.getCategory();
}

App.controller(controllers)