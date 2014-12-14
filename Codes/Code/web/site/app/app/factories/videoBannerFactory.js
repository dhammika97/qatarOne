
App.factory('videoBannerFactory',function($resource){
	var videoBanner = $resource('../../../api/video/:id', {}, {	
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}

	factory.getvideoBanner = function(){
		return videoBanner.query()
	}	
	return factory
})