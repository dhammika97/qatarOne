controllers.topVideoBannerController = function($scope,videoBannerFactory){
	$scope.videoBanner = videoBannerFactory.getvideoBanner();
}