controllers.videoController = function($scope, videoFactory){	
	$scope.video = videoFactory.getVideo();

	$scope.deleteVideo = function(id){	
		if(id!=''){
			var r = confirm("Do you want to delete this video!");
			if (r == true) {
				
				 videoFactory.deleteVideo($scope,id)
			}
		}
	}
}

controllers.videoAddController = function($scope, videoFactory, FileUploader){

	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	
	$scope.addVideo = function(){
		videoFactory.saveVideo($scope);
	}
}

controllers.videoDetailsController = function($scope, $routeParams, videoFactory, FileUploader,$sce){
	$scope.videoDetails = videoFactory.getVideoByID($routeParams.id);
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	$scope.updateVideo= function(id){
		videoFactory.updateVideo($scope,id);
	}
}