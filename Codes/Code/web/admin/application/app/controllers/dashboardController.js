controllers.dashboardController = function($scope, dashboadrFactory){
	$scope.advertisments = dashboadrFactory.showAdds();

	$scope.approve = function(id, $scope){
		dashboadrFactory.approve(id, $scope);
	}
	$scope.deny = function(id, $scope){
		if(id!=''){
			var r = confirm("Do you want to deny this advertisments");
			if (r == true) {
				 dashboadrFactory.deny(id);
			}
		}
		
	}
}