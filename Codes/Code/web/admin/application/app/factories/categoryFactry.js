//CategoryFactry

App.factory('categoryFactry',function($resource){
	var categoryList = $resource('../../../api/category/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getCategory = function(){
		
		return tld = categoryList.query();
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
	
	
	return factory
})