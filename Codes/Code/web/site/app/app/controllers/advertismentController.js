controllers.addvertismentController= function($scope,advertismentFactory, $routeParams){
	$scope.adversiment = advertismentFactory.getAdd($routeParams.id);		
	
	//$scope.temp = dd.advertisment[0].advertisement_attributes;
	//alert($scope.adversiment);
}

controllers.advertismentAddController = function($scope, advertismentFactory){
	// var uploader = $scope.uploader = new FileUploader({
	// 	url: '../../../api/include/upload.php'
	// })
	console.log($scope);
	$scope.addAdvertisment = function(){
		// if(uploader.queue.length !=0){
		// 	uploader.uploadAll()
		// 	uploader.onCompleteItem = function(fileItem, response, status, headers) {	
		// 		if(response.error==false){
		// 			$scope.fixedAd.fixedads_image = response.image

					advertismentFactory.saveAdvertisment($scope)
		// 		}else{
		// 			alert('image upload failed!')
		// 		}
		// 	};
		// }else{
		// 	alert('image should be selected')
		// }
		
		
		
		
	}
}
