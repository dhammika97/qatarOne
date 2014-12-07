controllers.addvertismentController= function($scope,advertismentFactory, $routeParams){
	$scope.adversiment = advertismentFactory.getAdd($routeParams.id);
}

controllers.advertismentAddController = function($scope, advertismentFactory, advertismentCatFactory){
	$scope.catList = advertismentCatFactory.getCategory()
	
	$scope.changeTpl = function(){
		for(i=0; i<$scope.catList.categorymatrix.length; i++){
			if($scope.adversiment.advertisement_subCategoryId==i){
				$scope.templatePath = "app/partials/postAd/adTemplate-"+$scope.catList.categorymatrix[i].category_sub_tplType+".html"
				//console.log($scope.catList.categorymatrix[i].category_sub_tplType)
			}
		}
		//$scope.templatePath = "app/partials/postAd/adTemplate-"+$scope.catList.categorymatrix[i].category_sub_tplType+".html"
	}
	
	
	$scope.addAdvertisment = function(){
		advertismentFactory.saveAdvertisment($scope)
	}
}
