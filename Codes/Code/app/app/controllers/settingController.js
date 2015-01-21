controllers.settingController = function($scope, settingFactory, ngProgress, $timeout){
	$scope.userSetting = settingFactory.getUser();	


	$scope.updateUserSetting=function(id){
	settingFactory.saveUserSetting($scope, id, ngProgress,$timeout);
	}
	
	$scope.updateUserName=function(id){
		settingFactory.updateUserNameInfo($scope, id,ngProgress,$timeout);
	}
	
	$scope.updateUserPw=function(id){
		settingFactory.updatePassWordInfo($scope, id, ngProgress,$timeout);
	}
	
	$scope.sendforgotPSWDLink=function(id){
		settingFactory.verifyAndsendforgotPSWDLink($scope, id,ngProgress,$timeout);
		
	}
	$scope.updateNewForgotpassword=function(){
		//alert($scope.userforgotPWD.newPassword);
		settingFactory.updateNewForgotpassword($scope, $scope.userEncrypedID,ngProgress,$timeout);
	}
}

controllers.myAdsController = function($scope, myAdsFactory, ngProgress, $timeout ){
	myAdsFactory.getMyAds($scope)
	
	$scope.myAds = function(data){
		$scope.advertisments = data;
	}
	
	$scope.deleteMyad = function(id){
		if(id!=null){
			var r = confirm("Do you want to delete this Advertisement? \n\Note: this action cannot be undo");
			if (r == true) {
				ngProgress.start()
				myAdsFactory.deleteMyAd($scope, id, ngProgress, $timeout)
			}
		}
	}
	$scope.refreshMyad = function(id){
		if(id!=null){
			var r = confirm("Do you want to refresh this Advertisement? \n\Note: this action cannot be undo");
			if (r == true) {
				ngProgress.start()
				myAdsFactory.refreshMyad($scope, id, ngProgress, $timeout)
			}
		}
	}
	
}

controllers.myAdsUpdateController = function($scope, $routeParams, FileUploader, advertismentFactory, ngProgress , $timeout){
	
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	$scope.catList = advertismentFactory.getCategoryPackage()
	$scope.locationList = advertismentFactory.getLocations()
	$scope.suburbOptions = "item.suburb_id as item.suburb_name for item in list.suburbs"
	$scope.changeLoc = function(){
		 $scope.list = advertismentFactory.getSuburbs($scope.ad.advertisement_location)
	}
	
	advertismentFactory.getAdd($routeParams.id, ngProgress, $scope);
	
	
	$scope.mapLoad = function(e){
		$scope.ad = e.advertisment[0]
		//alert(e.images)
		$scope.imagesList = e.images
		$scope.changeLoc()
	}
	
	$scope.deleteImage = function(image, $scope){
		if(image!=null){
			var r = confirm("Do you want to delete this Image? \n\Note: this action cannot be undo");
			if (r == true) {
				advertismentFactory.deleteImage(image)
			}
		}
	}
	
	$scope.updateAd = function(){
		advertismentFactory.updateAd($scope, $routeParams.id)
	}
	
	$scope.updateAd = function(){
		ngProgress.start()
		var imageArray = new Array
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {
				if(response.error==false){
					imageArray.push(response.image)
				}else{
					$scope.addAlert('danger','fail to upload the images!')
					$timeout(function(){
						$scope.closeAlert();
					}, 3000);
				}
			};
			uploader.onCompleteAll = function() {
				$scope.imageList = imageArray
				advertismentFactory.updateAd($scope, $routeParams.id, ngProgress, $timeout)
			};
		}else{
			advertismentFactory.updateAd($scope, $routeParams.id, ngProgress, $timeout)
		}
	}
	
	
	$scope.adId = $routeParams.id
}

App.controller(controllers)