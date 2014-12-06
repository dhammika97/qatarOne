controllers.addvertismentController= function($scope,advertismentFactory, $routeParams){
	$scope.adversiment = advertismentFactory.getAdd($routeParams.id);		
		
	//alert($scope.adversiment);
}
