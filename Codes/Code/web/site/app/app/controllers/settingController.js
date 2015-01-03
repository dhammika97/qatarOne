controllers.settingController = function($scope, settingFactory, ngProgress, $timeout){
	$scope.userSetting = settingFactory.getUser();	


	$scope.updateUserSetting=function(id){
	settingFactory.saveUserSetting($scope, id,ngProgress,$timeout);
	}
	
	$scope.updateUserName=function(id){
		settingFactory.updateUserNameInfo($scope, id,ngProgress,$timeout);
	}
	
	$scope.updateUserPw=function(id){
		settingFactory.updatePassWordInfo($scope, id,ngProgress,$timeout);
	}
	
	$scope.sendforgotPSWDLink=function(id){
		settingFactory.verifyAndsendforgotPSWDLink($scope, id,ngProgress,$timeout);
		
	}
	$scope.updateNewForgotpassword=function(){
		//alert($scope.userforgotPWD.newPassword);
		settingFactory.updateNewForgotpassword($scope, $scope.userEncrypedID,ngProgress,$timeout);
	}
}

controllers.myAdsController = function($scope, myAdsFactory){
	myAdsFactory.getMyAds($scope)
	
	$scope.myAds = function(data){
		$scope.advertisments = data;
	}
}

App.controller(controllers)