App.factory('advertismentFactory',function($resource){
	var advertisment = $resource('../../../api/advertisment/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
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
		
		return advertisment.save($scope.adversiment)
			.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.adversiment=''
			})
		}
	return factory
})

App.factory('advertismentCatFactory',function($resource){
	var category = $resource('../../../api/categoryMatrix/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false }
        });

	var factory = {}
	factory.getCategory = function(){
		return tld = category.query();
		//tld.$promise.catch(function(e){
		//	alert(e.data.message)
		//})
	}


	return factory
})
