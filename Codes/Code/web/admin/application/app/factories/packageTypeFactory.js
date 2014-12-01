App.factory('packageTypeFactory',function($resource){

	var packageType = $resource('../../../api/packageType/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });

	var factory = {}	
	factory.getPackageTypes = function(){		
		return packageType.query()
	}


	factory.savePacakgeType = function($scope){
		return packageType.save($scope.packageType)
			.$promise.then(
				function(value){
					if(value.error!=true){
						window.location="#/packageType"
					}else{
						alert(value.message)	
					}
				}
			)
		}

	// factory.deleteFixedAdvertisment = function($scope,id){
	// 	//userList.delete({id:id})
	// 	//return userList.query()
	// 	return fixedAdvertisment.delete({id:id})
	// 	.$promise.then(function(e){
	// 			alert(e.message)
	// 			$scope.fixedAds = fixedAdvertisment.query()
	// 		}).catch(function(e){
	// 			alert(e.data.message)
	// 		})
	// }

	factory.gePackageType = function(id){		
		return packageType.get({id:id})
	}

	factory.updatePackageType = function($scope,id){		
		return packageType.update({id:id},$scope.packageTypesDetail.packageType[0])		
	}


	return factory;
})