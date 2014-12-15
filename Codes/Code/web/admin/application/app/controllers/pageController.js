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
	
	//$scope.orightml = '<h2>Try me!</h2><p>textAngular is a super cool WYSIWYG Text Editor directive for AngularJS</p><p><b>Features:</b></p><ol><li>Automatic Seamless Two-Way-Binding</li><li>Super Easy <b>Theming</b> Options</li><li style="color: green;">Simple Editor Instance Creation</li><li>Safely Parses Html for Custom Toolbar Icons</li><li class="text-danger">Doesn&apos;t Use an iFrame</li><li>Works with Firefox, Chrome, and IE8+</li></ol><p><b>Code at GitHub:</b> <a href="https://github.com/fraywing/textAngular">Here</a> </p>';
		//$scope.htmlcontent = $scope.orightml;
		//$scope.disabled = false;
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

/*controllers.pageContentAddController = function($scope, pageFactory){
	$scope.pageTitle = 	pageFactory.getPages()
	
	$scope.addPageContent = function(){
		pageFactory.savePageContent($scope)	
	}
}

controllers.pageContentDetailController = function($scope, pageFactory, $routeParams){
	$scope.pageContent = pageFactory.getPageContent($routeParams.id)
}*/