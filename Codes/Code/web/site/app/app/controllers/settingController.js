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
}
App.controller(controllers)