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
		return tld = advertisment.get({'id':id});
		tld.$promise.catch(function(e){
			alert(e.data.message)
		})
	}
	
	
	factory.saveAdvertisment = function($scope){
		//alert($scope.imageList)			
		return advertisment.save($scope.ad)
		.$promise.catch(function(e){
			alert(e.data.message)
		}).then(
		function(e){
			if($scope.imageList.length > 0){
				return adImage.save($scope.imageList,e.insertedId)
				.$promise.catch(function(e){
					alert(e.message)
				}).then(function(e){
					alert(e.message)
				})	
			}else{
				alert(e.message)
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
	
	return factory
})
