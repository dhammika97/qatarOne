App.factory('fixedAdvertismentFactory',function($resource){

	var fixedAdvertisment = $resource('../../../api/fixedAds/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });

	var factory = {}	
	factory.getFixedAdvertisments = function(){
		return fixedAdvertisment.query()
	}

	factory.savefixedAdvertisment = function($scope){
		return fixedAdvertisment.save($scope.fixedAdvertisment)
			.$promise.then(
				function(value){
					if(value.error!=true){
						window.location="#/fixedAdvertisment"
					}else{
						alert(value.message)	
					}
				}
			)
		}

	factory.deleteFixedAdvertisment = function($scope,id){
		//userList.delete({id:id})
		//return userList.query()
		return fixedAdvertisment.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.fixedAds = fixedAdvertisment.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}

	factory.geFixedAdvertisment = function(id){		
		return fixedAdvertisment.get({id:id})
	}

	factory.updateFixedAdvertisment = function($scope,id){		
		return fixedAdvertisment.update({id:id},$scope.fixedAdsDetail.fixedAd[0])		
	}


	return factory;
})