controllers.addvertismentController= function($scope,advertismentFactory, $routeParams, ngProgress, $timeout){
	//ngProgress.start()
	advertismentFactory.getAdd($routeParams.id, ngProgress, $scope);
	
	advertismentFactory.getSimilarItems($scope,$routeParams.id); 

	 // $scope.similarItems2 = advertismentFactory.getSimilarItems($routeParams.id); 
	 // $scope.similarItems3 = advertismentFactory.getSimilarItems($routeParams.id); 
	 // $scope.similarItems4 = advertismentFactory.getSimilarItems($routeParams.id); 
	
	 $scope.testfunction = function(data){
	 	//$scope.similarItems = [{'items':data[0]},{'items':data[1]},{'items':data[2]},{'items':data[3]}]; 
	 	//$scope.similarItems2 = [{'items':data[4]},{'items':data[5]},{'items':data[6]},{'items':data[7]}]; 
	 //	$scope.similarItems = [{'items':data[0]},{'items':data[1]},{'items':data[2]},{'items':data[2]}]; 
	 	
	 	//console.log(data);
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
		

	$scope.attributes = ['one','two','three','four','five']
	$scope.comments = advertismentFactory.getComments($routeParams.id);
	//setTimeout(function(){ngProgress.complete()},500)
	$scope.addComment = function(){
		advertismentFactory.addComment($scope, $routeParams.id);
	}
	
	$scope.mapLoad = function(e){
		$scope.adversiment = e
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
	}
	
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
	$scope.advertismentAddMail = function(){
		
		advertismentFactory.sendAdvertismentMail($scope);
	}
}
