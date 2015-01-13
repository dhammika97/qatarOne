controllers.topVideoBannerController = function($scope,videoBannerFactory, ngDialog){
	$scope.videoBanner = videoBannerFactory.getvideoBanner();
}