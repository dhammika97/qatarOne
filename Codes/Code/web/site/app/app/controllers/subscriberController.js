controllers.subscriberController = function($scope, subscriberFactory){
	$scope.addSubscriber = function(){
		alert('i am here');
		subscriberFactory.saveSubscriber($scope)
	}
}


App.controller(controllers)