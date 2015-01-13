controllers.contactUsController = function($scope, contactFactory){
		
	$scope.sendContactMail = function(){
		contactFactory.sendContactMail($scope);
	}	
	
}