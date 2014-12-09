controllers.addvertismentController= function($scope,advertismentFactory, $routeParams){
	var tmp = $scope.adversiment = advertismentFactory.getAdd($routeParams.id);
	//console.log(tmp)
	//var values = {"make":"tata","model":"Corolla 110","year":"2000","bodyType":"MVP","condition":"Recondition","transmission":"Manual","fuelType":"Diesel"};
//	var log = [];
//	angular.forEach(values, function(value, key) {
//		this.push(key + ': ' + value);
//	}, log);
//	console.log(log)
	//expect(log).toEqual(['name: misko', 'gender: male']);
}

controllers.advertismentAddController = function($scope, advertismentFactory, FileUploader){
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
		var imageArray = new Array
		if(uploader.queue.length !=0){
			uploader.uploadAll()
			uploader.onCompleteItem = function(fileItem, response, status, headers) {
				if(response.error==false){
					imageArray.push(response.image)
				}else{
					alert('fail to upload the images!')
				}
			};
			uploader.onCompleteAll = function() {
				$scope.imageList = imageArray
				advertismentFactory.saveAdvertisment($scope)
			};
		}else{
			advertismentFactory.saveAdvertisment($scope)
		}
	}
}
