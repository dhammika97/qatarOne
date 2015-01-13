controllers.eventsController = function($scope, eventFactory){
		
	$scope.events = eventFactory.getEvents();	
	
}
controllers.eventsDetailsController = function($scope, eventFactory, $routeParams){
	
	$scope.events = eventFactory.getEventsDetails($routeParams.id);	
	
}