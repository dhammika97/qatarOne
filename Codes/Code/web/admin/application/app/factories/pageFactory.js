// JavaScript Document
App.factory('pageFactory',function($resource){
	var Pages = $resource('../../../api/page/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	var factory = {}
	factory.getPages = function(){
		return tld = Pages.query();
		tld.$promise.catch(function(e){
			alert(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}
	/*factory.deleteLocation = function($scope,id){
		return locationList.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.locations = locationList.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}
	
	factory.saveLocation = function($scope){
		return locationList.save($scope.location)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.location=''
			}
		)
	}
	
	factory.getLocation = function(id){
		return tmp = locationList.get({id:id})
		tmp.$promise.catch(function(e){
			console.log(e.data.message)
			window.location.replace('#/dashboard')
		})
	}
	
	factory.updateLocation = function($scope,id){
		tld = locationList.update({id:id},$scope.locationDetails.location[0])
		tld.$promise.then(function(e){
			alert(e.message)	
		}).catch(function(e){
			alert(e.message)	
		})
	}*/
	
	return factory
})