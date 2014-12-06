controllers.addvertismentController= function($scope,advertismentFactory, $routeParams){
	$scope.adversiment = advertismentFactory.getAdd($routeParams.id);		
	
	//$scope.temp = dd.advertisment[0].advertisement_attributes;
	//alert($scope.adversiment);
}
