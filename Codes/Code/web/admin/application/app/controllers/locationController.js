// JavaScript Document
controllers.locationsController = function($scope, locationFactory){
	$scope.locations = locationFactory.getLocations()
	
	$scope.deleteLocation = function(e){
		alert('Location should be delete' + e)
	}
}


//App.controller(controllers)
