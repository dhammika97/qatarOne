controllers.contactUsController = function($scope, categoryFactory){
		
	$scope.sendContactMail = function(){
		categoryFactory.sendContactMail($scope);
	}	
	
}