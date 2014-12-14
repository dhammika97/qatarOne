controllers.subscriberController = function($scope, subscriberFactory){
	$scope.addSubscriber = function(){
		subscriberFactory.saveSubscriber($scope)
	}
	$scope.sendSubscribConfirmaton = function(){
		subscriberFactory.sendMail($scope);	
	}
}
App.controller(controllers)