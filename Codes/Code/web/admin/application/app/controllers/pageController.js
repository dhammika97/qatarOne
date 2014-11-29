// JavaScript Document
controllers.pageController = function($scope, pageFactory){
	$scope.pages = pageFactory.getPages()
}