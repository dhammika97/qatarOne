controllers.subscriberController = function($scope, subscriberFactory,ngProgress, $timeout){
	$scope.addSubscriber = function(){
		subscriberFactory.saveSubscriber($scope,ngProgress, $timeout)
	}
	$scope.sendSubscribConfirmaton = function(){
		subscriberFactory.sendMail($scope);	
	}
}
App.controller(controllers)