controllers.jobApplyController = function($scope, $routeParams, jobApplyFactory){
	
	$scope.applyJobMail = function(){
		jobApplyFactory.applyjobAPICall($scope, $routeParams.id);
	}	
	
}

