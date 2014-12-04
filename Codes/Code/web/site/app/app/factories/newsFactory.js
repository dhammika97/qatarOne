//newsFactry

App.factory('newsFactory',function($resource){
	var newsList = $resource('../../../api/news/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getNews = function(params){
		
		return tld = newsList.query({'news_status':1 });
		tld.$promise.catch(function(e){
			alert(e.data.message)
			
		})
	}
	
	
	return factory
})
