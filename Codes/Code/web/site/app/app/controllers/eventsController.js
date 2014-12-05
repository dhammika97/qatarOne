controllers.eventsController = function($scope, eventFactory){
		
	$scope.events = eventFactory.getEvents();	
	
}