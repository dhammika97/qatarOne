controllers.newsController = function($scope, newsFactory){
	$scope.news = newsFactory.getNews();	
	$scope.deleteNews = function(id){	
		if(id!=''){
			var r = confirm("Do you want to delete this Item!");
			if (r == true) {
				 newsFactory.deleteNews($scope,id)
			}
		}
	}
	
}

controllers.newsAddController = function($scope, newsFactory, FileUploader){
	$scope.addNews = function(){
		newsFactory.saveNews($scope)
	}
	
	var uploader = $scope.uploader = new FileUploader()
	
	uploader.onAfterAddingFile = function(fileItem) {
		console.info('File Name', fileItem.file.name);
	};
}
controllers.newsDetailsController = function($scope, $routeParams, newsFactory){
	
	$scope.newsDetails = newsFactory.getNews($routeParams.id);	
	
	$scope.updateNews = function(id){
		newsFactory.updateNews($scope,id);
	}
}
