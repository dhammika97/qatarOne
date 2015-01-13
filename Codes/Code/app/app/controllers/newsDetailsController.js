controllers.newsDetailsController = function($scope, newsFactory, $routeParams){
	
	$scope.news = newsFactory.getNewsDetails($routeParams.id);			
	
}
