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
		uploader.uploadAll()
		uploader.onCompleteItem = function(fileItem, response, status, headers) {
			
            $scope.slider.slider_image = response.image
			sliderFactory.saveSlider($scope)
        };
	}
}
controllers.sliderDetailsController = function($scope, $routeParams, sliderFactory){
	$scope.sliderDetails = sliderFactory.getSlider_edit($routeParams.id);	
	
	$scope.updateSlider= function(id){
		
		sliderFactory.updateSlider($scope,id);
	}
}
