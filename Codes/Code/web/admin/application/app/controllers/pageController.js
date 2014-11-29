// JavaScript Document
controllers.pageController = function($scope, pageFactory){
	$scope.pages = pageFactory.getPages()
	
	$scope.deletePage = function(id){
		if(id!=''){
			var r = confirm("Do you want to delete this page!");
			if (r == true) {
				pageFactory.deletePage($scope,id)
			}
		}	
	}
}

controllers.pageAddController = function($scope, pageFactory){
	$scope.addPage = function(){
		pageFactory.savePage($scope)
	}
}

controllers.pageContentAddController = function($scope, pageFactory){
	$scope.addPageContent = function(){
		pageFactory.savePageContent($scope)
	}
}

controllers.pageDetailController = function($scope, $routeParams,pageFactory){
	$scope.pageDetails = pageFactory.getPage($routeParams.id)
	
	$scope.updatePage = function(id){
		pageFactory.updatePage($scope,id)	
	}
}
