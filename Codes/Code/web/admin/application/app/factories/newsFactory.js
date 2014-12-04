//CategoryFactry

App.factory('newsFactory',function($resource){
	var newsList = $resource('../../../api/news/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST'},
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.getNews = function(){
		
		return tld = newsList.query();
		tld.$promise.catch(function(e){
			
		})	
	}
	factory.deleteNews = function($scope,id){
		return newsList.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.news = newsList.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}
	factory.getNews = function(id){
		return tmp = newsList.get({id:id})
		tmp.$promise.catch(function(e){
			console.log(e.data.message)
			window.location.replace('#/dashboard')
		})
	}
	factory.saveNews = function($scope){
		
		return newsList.save($scope.news)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.news=''
			}
		)
	}
	factory.updateNews = function($scope,id){
		
		tld = newsList.update({id:id},$scope.newsDetails.news[0])
		tld.$promise.then(function(e){
			alert(e.message)	
		}).catch(function(e){
			alert(e.message)	
		})
		//console.log($scope.userDetails.user)
	}

	
	
	return factory
})