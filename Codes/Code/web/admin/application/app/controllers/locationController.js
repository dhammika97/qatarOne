// JavaScript Document
controllers.locationsController = function($scope, locationFactory){
	$scope.locations = locationFactory.getLocations()
	
	$scope.deleteLocation = function(id){
		if(id!=''){
			var r = confirm("Do you want to delete this Location!");
			if (r == true) {
				//$scope.users = usersFactory.deleteUser(id)
				locationFactory.deleteLocation($scope,id)
			}
		}
	}
}

controllers.locationAddController = function($scope, locationFactory){
	$scope.addLocation = function(){
		locationFactory.saveLocation($scope)
	}
}

//App.controller(controllers)
