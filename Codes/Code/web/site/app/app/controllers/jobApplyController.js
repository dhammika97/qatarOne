controllers.jobApplyController = function($scope, jobApplyFactory){
		
	$scope.applyJobMail = function(){
		jobApplyFactory.applyjobAPICall($scope);
	}	
	
}