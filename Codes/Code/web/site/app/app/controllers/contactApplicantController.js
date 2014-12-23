controllers.contactApplicantController = function($scope, $routeParams, contactApplicantFactory){
	
	
	$scope.notifyApplicant = function(){
		//alert($scope.employee.name)
		contactApplicantFactory.notifyApplicant2($scope, $routeParams.id);
	}	
}