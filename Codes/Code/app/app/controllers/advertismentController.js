controllers.addvertismentController= function($scope, advertismentFactory, $routeParams, ngProgress, $timeout, $location){
	//ngProgress.start()
	advertismentFactory.getAdd($routeParams.id, ngProgress, $scope);
	
	advertismentFactory.getSimilarItems($scope,$routeParams.id); 
	
	$scope.testfunction = function(data){
	 	$scope.item1	= data[0];
	 	$scope.item2	= data[1];
	 	$scope.item3	= data[2];
	 	$scope.item4	= data[3];
	 	$scope.item5	= data[4];
	 	$scope.item6	= data[5];
	 	$scope.item7	= data[6];
	 	$scope.item8	= data[7];
	 	$scope.item9	= data[8];
	 	$scope.item10	= data[9];
	 	$scope.item11	= data[10];
	 	$scope.item12	= data[11];
	 }
	
	$scope.ratingMax = 5;

//-------------------------------------------------------------------------//
	$scope.comments = advertismentFactory.getComments($routeParams.id);
	$scope.addComment = function(){
		advertismentFactory.addComment($scope, $routeParams.id, $timeout);
	}
	$scope.url = $location.path()
	$scope.mapLoad = function(e){
		$scope.rate = e.rating;
		$scope.isReadonly = true;
		
		$scope.adversiment = e
		$scope.attributes = e.advertisment[0].advertisement_attributes
		$scope.latlang = $scope.adversiment['advertisment'][0].suburb_cordinates
		var cordinates = $scope.latlang.split(',')
		var myLatlng = new google.maps.LatLng(cordinates[0],cordinates[1])
		var mapOptions = {
			center:  myLatlng,
			disableDefaultUI: true,
			zoom: 14
		}
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		new google.maps.Marker({
			position: myLatlng,
			map: map,
			animation: google.maps.Animation.DROP
		});
		$scope.attr = JSON.parse(e.advertisment[0].advertisement_attributes)
	}
	
	$scope.Addrate = function(){
		if(typeof $scope.rateAdd != 'undefined'){
			advertismentFactory.saveRating($routeParams.id, $scope.rateAdd, ngProgress, $scope, $timeout)
		}
	}
	
}

controllers.advertismentAddController = function($scope, advertismentFactory, FileUploader, ngProgress, $timeout){
	$scope.packageList = advertismentFactory.getPackageDetails()
	//$scope.catList = advertismentFactory.getCategoryPackage()
	$scope.catList = advertismentFactory.getMainCategoryPackage()
	$scope.locationList = advertismentFactory.getLocations()
	$scope.suburbOptions = "item.suburb_id as item.suburb_name for item in list.suburbs"
	$scope.subCatOptions= "value.category_sub_id as value.category_sub_name for (key,value) in subcatList.categorymatrix"
	$scope.changeLoc = function(){
		 $scope.list = advertismentFactory.getSuburbs($scope.ad.advertisement_location)
	}

	$scope.changesubCategory = function($catId){
		$scope.templatePath = ""
		$scope.catTemplatePath =""
		$scope.subcatList = advertismentFactory.getSubCategoryPackage($scope.ad.advertisement_CategoryId)
		$scope.catTemplatePath = "app/partials/postAd/subCategory.html"
	}
	
	$scope.changeTpl = function(){
		for(i=0; i<$scope.subcatList.categorymatrix.length; i++){
			if($scope.ad.advertisement_subCategoryId==$scope.subcatList.categorymatrix[i].category_sub_id){
				$scope.templatePath = "app/partials/postAd/adTemplate-"+$scope.subcatList.categorymatrix[i].category_sub_tplType+".html"
				$scope.ad.advertisement_attributes=""
			}
		}
	}
	
	var uploader = $scope.uploader = new FileUploader({
		url: '../api/include/upload.php'
	})
	
	$scope.addAdvertisment = function(isValid){
		$scope.submitted = true
		if(isValid){
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
	$scope.advertismentAddMail = function(){
		
		advertismentFactory.sendAdvertismentMail($scope);
	}
}
