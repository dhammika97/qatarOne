controllers.dashboardController = function($scope, dashboadrFactory){
	$scope.advertisments = dashboadrFactory.showAdds();
	
}
