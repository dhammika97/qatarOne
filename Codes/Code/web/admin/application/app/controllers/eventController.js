controllers.eventController = function($scope, eventFactory){
	$scope.events = eventFactory.getEvents();	
	$scope.deleteEvent = function(id){	
		if(id!=''){
			var r = confirm("Do you want to delete this Event!");
			if (r == true) {
				 eventFactory.deleteEvent($scope,id)
			}
		}
	}
	
}

controllers.eventAddController = function($scope, eventFactory){
	$scope.addEvent = function(){
		eventFactory.saveEvent($scope)//userList.save(user)
		

	}
}
controllers.eventDetailsController = function($scope, $routeParams, eventFactory){
	
	$scope.eventDetails = eventFactory.getEvent($routeParams.id);	
	
	$scope.updateEvent = function(id){
		eventFactory.updateEvent($scope,id);
	}
}
