App.factory('advertismentFactory',function($resource){
	var advertisment = $resource('../../../api/advertisment/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        save:{method: 'POST'}
    });

	var adImage = $resource('../../../api/postAdImage/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        save:{method: 'POST'}
    });
	
	var factory = {}
	
	factory.getAdd = function(id){
		return advertisment.get({'id':id})
	}
	
	
	factory.saveAdvertisment = function($scope,ngProgress, $timeout){
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
			if($scope.imageList.length > 0){
				return adImage.save($scope.imageList,e.insertedId)
				.$promise.catch(function(e){
					$scope.addAlert('danger',e.message)
					ngProgress.complete()
					$timeout(function(){
						$scope.closeAlert();
					}, 3000);
				}).then(function(e){
					$scope.addAlert('success',e.message)
					ngProgress.complete()
					$timeout(function(){
						$scope.closeAlert;
					}, 3000);
				})	
			}else{
				//alert(e.message)
				$scope.addAlert('success',e.message)
				ngProgress.complete()
				$timeout(function(){
					$scope.closeAlert;
				}, 3000);
			}
		})
	}
	var category = $resource('../../../api/categoryMatrix/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
    });
	factory.getCategory = function(){
		return tld = category.query();
	}
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
	factory.getSimilarItems = function(id){

		return similarItems.query({"advertistment":id})
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
	factory.addComment = function($scope, id){
		var comment = $scope.comment.body;
		
		return addComment.save($scope.comment, {"advertisment_Id":id, "body":comment})
	}
	
	return factory
})
