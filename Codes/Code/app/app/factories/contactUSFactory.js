App.factory('contactFactory',function($resource){
	var contactusMail = $resource('../api/mail/:id', {}, {
        query: { method: 'POST', params: {}, isArray: false },
    });
	var contactusMailTeam = $resource('../api/mail/:id', {}, {
        query: { method: 'POST', params: {}, isArray: false },
    });
	var factory = {}
	factory.sendContactMail = function($scope){
		
		return tld = contactusMail.query({"fname":$scope.contact.name,"customerMessage":$scope.contact.message, "to":$scope.contact.email, "mailType" :"contactUs"});
		tld.$promise.catch(function(e){
			
		}).then(function(){
			alert("done");
		})
	}
	
	
	return factory
})

