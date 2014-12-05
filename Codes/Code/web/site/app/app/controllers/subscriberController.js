controllers.subscriberController = function($scope, subscriberFactory){
	$scope.addSubscriber = function(){
		subscriberFactory.saveSubscriber($scope)
	}
}
App.controller(controllers)