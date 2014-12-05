controllers.categoryController = function($scope, categoryFactory, $routeParams){
	$scope.categories = categoryFactory.getCategory($routeParams.name);		
	
}
