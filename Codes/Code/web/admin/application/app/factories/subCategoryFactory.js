// JavaScript Document
App.factory('subCategoryFactory',function($resource){
	var subCategories = $resource('../../../api/subCategory/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	var factory = {}
	factory.getSubCategories = function(params){
		return tld = subCategories.query(params);
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}
	
	factory.saveSubCategory = function($scope){
		return subCategories.save($scope.category)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.category=''
			}
		)
	}
	
	factory.deleteSubCategory = function($scope,id){
		return subCategories.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.subCategories = subCategories.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}
	
	factory.getSubCategory = function(id){
		return tmp = subCategories.get({id:id})
		tmp.$promise.catch(function(e){
			console.log(e.data.message)
			window.location.replace('#/dashboard')
		})
	}
		
	factory.updateSubCategory = function($scope,id){
		tld = subCategories.update({id:id},$scope.subCategoryDetails.subcategory[0])
		tld.$promise.then(function(e){
			alert(e.message)	
		}).catch(function(e){
			alert(e.message)	
		})
	}
	
	return factory
})