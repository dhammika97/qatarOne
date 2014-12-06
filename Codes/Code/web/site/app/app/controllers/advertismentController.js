controllers.addvertismentController= function($scope,advertismentFactory, $routeParams){
	$scope.categories = advertismentFactory.getAdd($routeParams.id);		
}
