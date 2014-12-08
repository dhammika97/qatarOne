controllers.addvertismentController= function($scope,advertismentFactory, $routeParams){
	$scope.adversiment = advertismentFactory.getAdd($routeParams.id);
}

controllers.advertismentAddController = function($scope, advertismentFactory){
	$scope.catList = advertismentFactory.getCategory()
	$scope.locationList = advertismentFactory.getLocations()
	$scope.suburbOptions = "item.suburb_id as item.suburb_name for item in list.suburbs"
	$scope.changeLoc = function(){
		 $scope.list = advertismentFactory.getSuburbs($scope.ad.advertisement_location)
	}
	
	$scope.changeTpl = function(){
		for(i=0; i<$scope.catList.categorymatrix.length; i++){
			if($scope.ad.advertisement_subCategoryId==$scope.catList.categorymatrix[i].category_sub_id){
				$scope.templatePath = "app/partials/postAd/adTemplate-"+$scope.catList.categorymatrix[i].category_sub_tplType+".html"
				$scope.ad.advertisement_attributes=""
			}
		}
	}
	
	$scope.addAdvertisment = function(){
		advertismentFactory.saveAdvertisment($scope)
	}
}
