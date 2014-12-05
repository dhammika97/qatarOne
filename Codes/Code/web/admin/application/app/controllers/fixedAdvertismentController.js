

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
		fixedAdvertismentFactory.savefixedAdvertisment($scope)//userList.save(user)
	}
}
controllers.fixedAdvertismentDetailsController = function($scope, $routeParams, fixedAdvertismentFactory){
	$scope.fixedAdsDetail = fixedAdvertismentFactory.geFixedAdvertisment($routeParams.id)
	
	
	$scope.updateFixedAdvertisment = function(id){
		fixedAdvertismentFactory.updateFixedAdvertisment($scope,id)
	}
}
