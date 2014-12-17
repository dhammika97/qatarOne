App.factory('advertismentFactory',function($resource, $location){
	var advertisment = $resource('../../../api/advertisment/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        save:{method: 'POST'}
    });

	var adImage = $resource('../../../api/postAdImage/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        save:{method: 'POST'}
    });
	
	var adPublish = $resource('../../../api/publishAd/:id', {}, {
        update: { method: 'PUT', params: { id: '@id' } },
    });
	
	var factory = {}
	
	factory.getAdd = function(id, ngProgress, $scope){
		return advertisment.get({'id':id}).$promise.then(
			function(e){
				$scope.mapLoad(e)
			}
		)
	}
	
	factory.adReview = function(id, ngProgress, $scope){
		return advertisment.get({'id':id}).$promise.then(function(e){
			$scope.loadDetails(e)
		})
	}
	
	factory.confirmAd = function(id){
		return adPublish.update({'id':id}).$promise.then(function(e){
			console.log(e)
		})
	}
	
	
	factory.saveAdvertisment = function($scope, ngProgress, $timeout){
		//alert($scope.imageList)			
		return advertisment.save($scope.ad)
		.$promise.catch(function(e){
			$scope.addAlert('danger',e.message)
			ngProgress.complete()
			$timeout(function(){
				$scope.closeAlert();
			}, 3000);
		}).then(
		function(e){
			var tmpId = e.insertedId
			if($scope.imageList.length > 0){
				return adImage.save($scope.imageList,e.insertedId)
				.$promise.catch(function(e){
					$scope.addAlert('danger',e.message)
					ngProgress.complete()
					$timeout(function(){
						$scope.closeAlert();
					}, 3000);
				}).then(function(e){
					$scope.advertismentAddMail();
					$scope.addAlert('success',e.message)
					ngProgress.complete()
					$scope.ad=''
					$timeout(function(){
						$scope.closeAlert();
						$location.path('/review-ad/'+tmpId)
					}, 3000);
				})	
			}else{
				//alert(e.message)
				$scope.addAlert('success','Advertisment added successfully!')
				ngProgress.complete()				
				$timeout(function(){
					$scope.closeAlert();
					$location.path('/review-ad/'+e.insertedId)
				}, 3000);
			}
		})
	}
	
	var packageDetails = $resource('../../../api/categoryuserwise', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	factory.getPackageDetails = function(){
		return tld = packageDetails.query();
	}
	
	var category = $resource('../../../api/categoryMatrixPackageBinding/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	factory.getCategoryPackage = function(){
		return tld = category.query();
	}
	
/*	var category = $resource('../../../api/categoryMatrix/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	factory.getCategory = function(){
		return tld = category.query();
	}*/
	var locationList = $resource('../../../api/locations/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	factory.getLocations = function(){
		return locationList.query();
	}
	var suburbList = $resource('../../../api/suburbs/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	factory.getSuburbs = function(id){
		return suburbList.query({"suburb_location_id":id})
	}
	var similarItems = $resource('../../../api/similarItems/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	factory.getSimilarItems = function($scope,id){

		return similarItems.query({"advertistment":id})
				.$promise.then(function(e){
					$scope.testfunction(e.items)
				});
	}
	var getComments = $resource('../../../api/getComments/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	factory.getComments = function(id){
	
		return getComments.query({"advertisment_Id":id})
	}
	var addComment = $resource('../../../api/comments/:id', {}, {
        save:{method: 'POST'}
    });
	factory.addComment = function($scope, id, $timeout){	
		var comment = $scope.comments.body;
		return addComment.save({"id":id},comment)
		.$promise.then(
		function(e){
			$scope.addAlert('success',"comment successfully added")
			$scope.comments.body = '';
			$timeout(function(){
				$scope.closeAlert();
			}, 3000);
		});	
	}
	var maildeliver = $resource('../../../api/mail/:id', {}, {
         query: { method: 'POST', params: {}, isArray: false },
    });
	factory.sendAdvertismentMail = function($scope){
		//console.log($scope.ad.advertisement_contactName);
		maildeliver.query({"fname":$scope.ad.advertisement_contactName, "to":$scope.ad.advertisement_contactEmail,"mailType":"advertismentAdd"});
	}

	return factory
})
