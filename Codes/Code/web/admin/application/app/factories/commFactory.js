//CategoryFactry

App.factory('commentFactory',function($resource){
	var comments = $resource('../../../api/CommentsAdmin/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false },
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		delete:{method:'DELETE',params:{ id:'@id' }}
    });
	
	var factory = {}
	factory.showComments = function(){
		return tld = comments.query();
	}
	factory.approve = function(id,$scope){

		return comments.update({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.comments = comments.query()
			}).catch(function(e){
				alert(e.message)
			})
	}
	factory.deny = function(id,$scope){

		return comments.delete({id:id})
		.$promise.then(function(e){
				alert(e.message)
				$scope.comments = comments.query()
			}).catch(function(e){
				alert(e.message)
			})
	}

	
	
	return factory
})