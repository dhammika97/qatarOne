controllers.viewJobApplyController = function($scope, jobApplyFactory){
	$scope.jobsinfo = jobApplyFactory.getJobApplyDetails()

}