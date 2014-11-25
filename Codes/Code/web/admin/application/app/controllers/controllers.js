// JavaScript Document
var controllers = {};
///ng-controller="masterController"
controllers.masterController = function($scope, $routeParams){
	$scope.loggedInUser = "Dhammika97"
	
}

controllers.userController = function($scope, $routeParams, $resource){
	var userList = $resource('../../../api/user/:id', {}, {
        query: { method: 'GET', params: {}, isArray: false , headers: { 'Authorization': 'kjsjjdfshdfhsdbfjhsbdfsdfsf' }},
        get: { method: 'GET', params: { id: '@id' } },
        update: { method: 'PUT', params: { id: '@id' } },
		save:{method: 'POST', headers: { 'Authorization': 'kjsjjdfshdfhsdbfjhsbdfsdfsf' }}
    });
	$scope.users = userList.query()
	
	$scope.addUser = function(user){
		userList.save(user)
	}
	
}

App.controller(controllers)