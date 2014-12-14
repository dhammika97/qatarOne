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
		if(uploader.queue.length !=0){

			uploader.uploadAll();

			uploader.onCompleteItem = function(fileItem, response, status, headers) {	

				if(response.error == false){
					console.log(response);
					 $scope.video.video_filename = response.video
					 
					//alert('Video upload successfull!')
					videoFactory.saveVideo($scope);
				}else{
					console.log(response);
					alert('Video upload failed!')
				}
			};
		}else{
			alert('Video should be selected')
		}
	}
}

controllers.videoDetailsController = function($scope, $routeParams, videoFactory, FileUploader,$sce){
	$scope.videoDetails = videoFactory.getVideoByID($routeParams.id);
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	$scope.updateVideo= function(id){
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {	
				if(response.error==false){
					videoFactory.updateVideo($scope,id);
				}else{
					alert('video upload failed!')
				}
			};
		}else{
			videoFactory.updateVideo($scope,id);
		}
	}
}