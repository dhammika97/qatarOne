//CategoryFactry

App.factory('dashFactory',function($resource){
	var categoryList = $resource('../../../api/category/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getCategory = function(params){
		
		return tld = categoryList.query({'category_parentId':1, 'category_status':1 });
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}
	
	
	return factory
})

App.factory('auth',function($rootScope){
	var getUser = function(){
		return sessionStorage.getItem("accessKey")
	}
	$rootScope.accessToken = getUser()
})
