//CategoryFactry

App.factory('eventFactory',function($resource){
	var eventsList = $resource('../../../api/event/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getEvents = function(){
		
		return tld = eventsList.query();
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}
	factory.deleteCategory = function($scope,id){
		return categoryList.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.categories = categoryList.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}
	factory.saveCategory = function($scope,category){
		return categoryList.save(category)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.user=''
			}
		)
	}

	
	
	return factory
})