//CategoryFactry

App.factory('sliderFactory',function($resource){
	var sliderList = $resource('../../../api/slider/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getSlider = function(){
		
		return tld = sliderList.query();
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})	
	}
	factory.deleteSlider = function($scope,id){
		return sliderList.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.slide = sliderList.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}
	factory.getSlider = function(id){
		//alert(id);
		return tmp = sliderList.get({id:id})
		tmp.$promise.catch(function(e){
			console.log(e.data.message)
			window.location.replace('#/dashboard')
		})
	}
	factory.saveSlider = function($scope){
		return sliderList.save($scope.slider)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.eventa=''
			}
		)
	}
	factory.updateEvent = function($scope,id){
		
		tld = eventsList.update({id:id},$scope.eventDetails.event[0])
		tld.$promise.then(function(e){
			alert(e.message)	
		}).catch(function(e){
			alert(e.message)	
		})
		//console.log($scope.userDetails.user)
	}

	
	
	return factory
})