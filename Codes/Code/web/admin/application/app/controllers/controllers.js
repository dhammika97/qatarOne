// JavaScript Document
var controllers = {};
///ng-controller="masterController"
controllers.masterController = function($scope){
	$scope.loggedInUser = "Usama"
	
}

controllers.userController = function($scope, usersFactory){
	$scope.users = usersFactory.getUsers()
	
	$scope.deleteUser = function(id){
		if(id!=''){
			var r = confirm("Do you want to delete this user!");
			if (r == true) {
				//$scope.users = usersFactory.deleteUser(id)
				usersFactory.deleteUser($scope,id)
			}
		}
	}
	
}

controllers.userAddController = function($scope, usersFactory){
	$scope.addUser = function(){
		usersFactory.saveUser($scope,$scope.user)//userList.save(user)
	}
}

controllers.userDetailsController = function($scope, $routeParams, usersFactory){
	$scope.userDetails = usersFactory.getUser($routeParams.id)
	
	$scope.updateUser = function(id){
		usersFactory.updateUser($scope,id)
	}
}


controllers.newsController = function($scope, $routeParams, $resource){
	
	$scope.addNews = function(news){
		News.save(news)
	}
}

App.controller(controllers)