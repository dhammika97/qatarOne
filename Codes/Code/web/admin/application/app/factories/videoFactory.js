App.factory('videoFactory',function($resource){
	var videoList = $resource('../../../api/video/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getVideo = function(params){
		return tld = videoList.query(params);
		tld.$promise.catch(function(e){
			alert(e.data.message)			
		})	
	}

	factory.getVideoByID = function(id){		
		return tmp = videoList.get({id:id})
		tmp.$promise.catch(function(e){
			//console.log(e.data.message)
			//window.location.replace('#/dashboard')
		})
	}

	factory.saveVideo = function($scope){		
		return videoList.save($scope.video)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.video=''
			}
		)
	}

	factory.updateVideo = function($scope,id){
	
		tld = videoList.update({id:id},$scope.videoDetails.video[0])
		tld.$promise.then(function(e){
			alert(e.message)	
		}).catch(function(e){
			alert(e.message)	
		})
		//console.log($scope.userDetails.user)
	}

	factory.deleteVideo = function($scope,id){
		return videoList.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.video = videoList.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}
	return factory;
})