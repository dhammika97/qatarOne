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
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	
	//var imageArray = new Array
	$scope.addNews = function(){
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {
				if(response.error==false){
					$scope.news.news_image = response.image
					//imageArray.push(response.image)
					//console.log(imageArray)
					newsFactory.saveNews($scope)
				}else{
					alert('fail to upload the image!')
				}
			};
		}else{
			newsFactory.saveNews($scope)
		}
		
		
	}
	
	
}
controllers.newsDetailsController = function($scope, $routeParams, newsFactory, FileUploader){
	
	$scope.newsDetails = newsFactory.getNews($routeParams.id);
	
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	
	$scope.updateNews = function(id){
		/*uploader.uploadAll()
		uploader.onCompleteItem = function(fileItem, response, status, headers) {
			$scope.newsDetails.news[0].news_image = response.image
			newsFactory.updateNews($scope,id);
		};*/
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {
				if(response.error==false){
					$scope.newsDetails.news[0].news_image = response.image
					newsFactory.updateNews($scope,id);
				}else{
					alert('fail to upload the image!')
				}
			};
		}else{
			newsFactory.updateNews($scope,id);
		}
		
	}
}
