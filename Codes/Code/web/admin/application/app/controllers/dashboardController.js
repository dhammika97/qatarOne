controllers.dashboardController = function($scope, dashboadrFactory, $routeParams){
	$scope.advertisments = dashboadrFactory.showAdds();
        $scope.advertismentDetails = dashboadrFactory.showAddDetails($routeParams.id);
        //console.log($scope.advertismentDetails.a);
	$scope.approve = function(id){
		
		dashboadrFactory.approve(id, $scope);
	}
	$scope.deny = function(id){
		if(id!=''){
			var r = confirm("Do you want to deny this advertisments");
			if (r == true) {
				 dashboadrFactory.deny(id,$scope);
			}
		}
		
	}
        
        
}