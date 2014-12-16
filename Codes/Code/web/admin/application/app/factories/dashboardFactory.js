App.factory('dashboadrFactory', function($resource){
	var showAdvertisments = $resource('../../../api/advertismentsAdmin/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	var factory = {}

	factory.showAdds = function(){
		return tld = showAdvertisments.query();
	}

	return factory
});