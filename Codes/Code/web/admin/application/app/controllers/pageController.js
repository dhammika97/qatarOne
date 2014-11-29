// JavaScript Document
controllers.pageController = function($scope, pageFactory){
	$scope.pages = pageFactory.getPages()
}

controllers.pageAddController = function($scope, pageFactory){
	$scope.addPage = function(){
		pageFactory.savePage($scope)
	}
}

controllers.locationDetailController = function($scope, $routeParams,locationFactory){
	$scope.locationDetails = locationFactory.getLocation($routeParams.id)
	
	$scope.updateLocation = function(id){
		locationFactory.updateLocation($scope,id)	
	}
}
