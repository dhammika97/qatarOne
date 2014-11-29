controllers.eventController = function($scope, eventFactory){
	$scope.test = "test";
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