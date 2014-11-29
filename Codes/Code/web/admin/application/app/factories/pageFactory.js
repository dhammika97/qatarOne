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
	
	factory.savePage = function($scope){
		return Pages.save($scope.page)
		.$promise.catch(function(e){
				alert(e.data.message)
			}).then(
			function(value){
				alert(value.message)
				$scope.page=''
			}
		)
	}
	
	factory.deletePage = function($scope,id){
		return Pages.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.pages = Pages.query()
			}).catch(function(e){
				alert(e.data.message)
			})
	}
	
	factory.getPage = function(id){
		return tmp = Pages.get({id:id})
		tmp.$promise.catch(function(e){
			console.log(e.data.message)
			window.location.replace('#/dashboard')
		})
	}
		
	factory.updatePage = function($scope,id){
		tld = Pages.update({id:id},$scope.pageDetails.page[0])
		tld.$promise.then(function(e){
			alert(e.message)	
		}).catch(function(e){
			alert(e.message)	
		})
	}
	
	return factory
})