controllers.settingController = function($scope, settingFactory){
	$scope.userSetting = settingFactory.getUser();	
}
App.controller(controllers)