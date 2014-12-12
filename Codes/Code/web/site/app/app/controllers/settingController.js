controllers.settingController = function($scope, settingFactory, ngProgress, $timeout){
	$scope.userSetting = settingFactory.getUser();	


	$scope.updateUserSetting=function(id){
		//alert($scope.user_id);
		settingFactory.saveUserSetting($scope, id);
	}
}
App.controller(controllers)