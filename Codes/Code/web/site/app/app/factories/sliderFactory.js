//slider

App.factory('sliderFactory',function($resource){
	var slides = $resource('../../../api/slider/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getSlides = function(params){
		
		return tld = slides.query({'slider_status':1});
		tld.$promise.catch(function(e){
			alert(e.data.message)
				
		})
	}
	
	
	return factory
})
