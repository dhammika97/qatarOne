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
			.$promise.catch(function(e){
				alert(e.data.message)
			}).then(function(value){
				alert(value.message)
				$scope.packageType=''
			})
		}

	factory.deletePackageType = function($scope,id){
		return packageType.delete({id:id})
		.$promise.then(function(e){
			alert(e.message)
			$scope.packageTypes = packageType.query()
		}).catch(function(e){
			alert(e.data.message)
		})
	}

	factory.gePackageType = function(id){		
		return packageType.get({id:id})
	}

	factory.updatePackageType = function($scope,id){		
		tld =  packageType.update({id:id},$scope.packageTypesDetail.packageType[0])
		tld.$promise.then(function(e){
			alert(e.message)
		}).catch(function(e){
			alert(e.message)
		})	
	}


	return factory;
})