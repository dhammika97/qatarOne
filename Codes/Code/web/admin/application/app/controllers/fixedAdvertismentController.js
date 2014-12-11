

controllers.fixedAdvertismentController = function($scope, fixedAdvertismentFactory){
	
	$scope.fixedAds = fixedAdvertismentFactory.getFixedAdvertisments()

	$scope.deleteFixedAdvertisment = function(id){
		if(id!=''){
			var r = confirm("Do you want to delete this Fixed Advertisment!");
			if (r == true) {
				//$scope.users = usersFactory.deleteUser(id)
				fixedAdvertismentFactory.deleteFixedAdvertisment($scope,id)
			}
		}
	}

}

controllers.fixedAdvertismentAddController = function($scope, fixedAdvertismentFactory, FileUploader){
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	
	$scope.addfixedAdvertisment = function(){
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {	
				if(response.error==false){
					$scope.fixedAd.fixedads_image = response.image
					fixedAdvertismentFactory.savefixedAdvertisment($scope)
				}else{
					alert('image upload failed!')
				}
			};
		}else{
			alert('image should be selected')
		}
		
		
		
		
	}
}
controllers.fixedAdvertismentDetailsController = function($scope, $routeParams, fixedAdvertismentFactory, FileUploader){
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	
	$scope.fixedAdsDetail = fixedAdvertismentFactory.geFixedAdvertisment($routeParams.id)
	
	
	$scope.updateFixedAdvertisment = function(id){
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {	
				if(response.error==false){
					$scope.fixedAdsDetail.fixedAd[0].fixedads_image = response.image
					fixedAdvertismentFactory.updateFixedAdvertisment($scope,id)
				}else{
					alert('image upload failed!')
				}
			};
		}else{
			fixedAdvertismentFactory.updateFixedAdvertisment($scope,id)
		}
	}
}
