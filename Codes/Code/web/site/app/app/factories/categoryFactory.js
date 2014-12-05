App.factory('categoryFactory',function($resource){
	var categoryList = $resource('../../../api/category/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getCategory = function(params){
		var parent_id
		if(params == "jobs" ){
			parent_id = 2;
		}else if(params == "classified"){
			parent_id = 1;
		}
		
		
		return tld = categoryList.query({'category_parentId':parent_id, 'category_status':1 });
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}
	
	
	return factory
})

