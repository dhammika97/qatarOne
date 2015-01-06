controllers.topVideoBannerController = function($scope,videoBannerFactory, ngDialog){
	$scope.videoBanner = videoBannerFactory.getvideoBanner();
	$scope.openWindow = function(id){
		ngDialog.open({ template: '<iframe id="player" type="text/html" width="480" height="320" src="http://www.youtube.com/embed/'+id+'" frameborder="0"></iframe>',
    plain: true,
	className: 'ngdialog-theme-default' });	
	}
}