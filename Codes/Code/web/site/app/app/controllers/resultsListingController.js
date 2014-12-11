var params = new Array;
controllers.resultsListingController = function($scope,resultsListingFactory,resultsListingByLocation, $routeParams){
	params = {'advertisement_categoryId':$routeParams.parent_id}
	
	$scope.searchProduct = function(){
	///	alert($scope.searchproduct.category)
		params = {'advertisement_categoryId' :$routeParams.parent_id, 
		'advertisement_subCategoryId' :$scope.searchproduct.category, 'location_id':$scope.searchproduct.location}
		results(params)
	}
	$scope.resultList = resultsListingFactory.getResultList(params);
	
	$scope.setParamsCat = function(paramVal){
		var prid = $routeParams.parent_id;
		params = {'advertisement_categoryId' :$routeParams.parent_id, 'advertisement_subCategoryId' :paramVal}
		results(params)
	}
	$scope.setParamsLocation = function(paramVal){
		var prid = $routeParams.parent_id;
		params = {'advertisement_categoryId' :$routeParams.parent_id, 'location_id' :paramVal}
		//$scope.resultList = resultsListingByLocation.getResultList(params);
		results(params)
	}
	
	
	
	var results = function(params){
		$scope.resultList = resultsListingFactory.getResultList(params);
	}
}
