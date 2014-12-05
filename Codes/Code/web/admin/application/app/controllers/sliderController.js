controllers.sliderController = function($scope, sliderFactory){	
	$scope.slider = sliderFactory.getSlider();	
	$scope.deleteSlider = function(id){	
		if(id!=''){
			var r = confirm("Do you want to delete this Image!");
			if (r == true) {
				 sliderFactory.deleteSlider($scope,id)
			}
		}
	}
	
}

controllers.sliderAddController = function($scope, sliderFactory, FileUploader){

	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	
	$scope.addSlider = function(){
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {	
				if(response.error==false){
					$scope.slider.slider_image = response.image
					sliderFactory.saveSlider($scope)
				}else{
					alert('image upload failed!')
				}
			};
		}else{
			alert('image should be selected')
		}
	}
}
controllers.sliderDetailsController = function($scope, $routeParams, sliderFactory, FileUploader){
	$scope.sliderDetails = sliderFactory.getSlider_edit($routeParams.id);	
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	$scope.updateSlider= function(id){
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {	
				if(response.error==false){
					$scope.sliderDetails.slider[0].slider_image = response.image
					sliderFactory.updateSlider($scope,id);
				}else{
					alert('image upload failed!')
				}
			};
		}else{
			sliderFactory.updateSlider($scope,id);
		}
	}
}
