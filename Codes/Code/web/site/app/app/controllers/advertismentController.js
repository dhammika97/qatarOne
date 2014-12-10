controllers.addvertismentController= function($scope,advertismentFactory, $routeParams, ngProgress){
	//ngProgress.start()
	var tmp = $scope.adversiment = advertismentFactory.getAdd($routeParams.id, ngProgress);
	$scope.similarItems = advertismentFactory.getSimilarItems($routeParams.id); 
	$scope.attributes = ['one','two','three','four','five']
	//setTimeout(function(){ngProgress.complete()},500)
}

controllers.advertismentAddController = function($scope, advertismentFactory, FileUploader, ngProgress, $timeout){
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
	
	var uploader = $scope.uploader = new FileUploader({
		url: '../../../api/include/upload.php'
	})
	
	$scope.addAdvertisment = function(){
		ngProgress.start()
		var imageArray = new Array
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {
				if(response.error==false){
					imageArray.push(response.image)
				}else{
					$scope.addAlert('danger','fail to upload the images!')
					$timeout(function(){
						$scope.closeAlert();
					}, 3000);
				}
			};
			uploader.onCompleteAll = function() {
				$scope.imageList = imageArray
				advertismentFactory.saveAdvertisment($scope, ngProgress, $timeout)
			};
		}else{
			advertismentFactory.saveAdvertisment($scope)
		}
	}
}
