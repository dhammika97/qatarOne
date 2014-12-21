controllers.advertismentReviewController = function($scope, advertismentFactory, $routeParams, ngProgress, $timeout){
	advertismentFactory.adReview($routeParams.id, ngProgress, $scope)
	
	$scope.adId = $routeParams.id
	
	$scope.loadDetails = function(data){
		$scope.advertisementDetail = data
		$scope.attr = JSON.parse(data.advertisment[0].advertisement_attributes)
	}
	
	$scope.publishAdvertisment = function(){
		ngProgress.start()
		advertismentFactory.confirmAd($scope.adId, ngProgress, $scope, $timeout)
	}
}