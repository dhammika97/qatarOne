controllers.newsController = function($scope, newsFactory){
	
	$scope.news = newsFactory.getNews();		
	
}
