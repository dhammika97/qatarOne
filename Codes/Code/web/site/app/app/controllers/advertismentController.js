controllers.addvertismentController= function($scope,advertismentFactory, $routeParams){
	$scope.adversiment = advertismentFactory.getAdd($routeParams.id);
}

controllers.advertismentAddController = function($scope, advertismentFactory, advertismentCatFactory){
	$scope.catList = advertismentCatFactory.getCategory()
	
	$scope.changeTpl = function(){
		for(i=0; i<$scope.catList.catList.length; i++){
			if($scope.adversiment.advertisement_subCategoryId==i){
				console.log($scope.catList.catList[i].category_name)
			}
		}
		$scope.templatePath = "app/partials/postAd/adTemplate-"+$scope.adversiment.advertisement_subCategoryId+".html"
	}
	
	
	$scope.addAdvertisment = function(){
		advertismentFactory.saveAdvertisment($scope)
	}
}
