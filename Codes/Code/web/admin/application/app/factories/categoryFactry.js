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
	factory.getCategory = function(params){
		return tld = categoryList.query(params);
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
	factory.saveCategory = function($scope){
		//console.log($scope.category)
		return categoryList.save($scope.category)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.category=''
			}
		)
	}

	factory.getCategoryDetails = function(id){
		return tmp = categoryList.get({id:id})
			tmp.$promise.catch(function(e){
			//console.log(e.data.message)
			window.location.replace('#/dashboard')
		})
	}
	
	factory.updateCategory = function($scope,id){
		
		tld = categoryList.update({id:id},$scope.categoryDetails.category[0])
		tld.$promise.then(function(e){
			alert(e.message)	
		}).catch(function(e){
			alert(e.message)	
		})
		//console.log($scope.userDetails.user)
	}
	return factory
})