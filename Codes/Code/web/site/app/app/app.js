// JavaScript Document
var App = angular.module('QatartOneApp',['ngRoute','ngResource'])

App.config(function($routeProvider, $httpProvider){
	//$httpProvider.defaults.headers.common.Authorization = getUser();
	$routeProvider
	.when('/portal/:id',
		{
			controller:'controllers.dashController',
			templateUrl:'app/partials/home/home.html'
		}
	)
	.when('/show-list/:parent_id',
		{
			templateUrl:'app/partials/resultListing/resultListing.html'
		}
	)
	.when('/details-view/:id',
		{
			templateUrl:'app/partials/detailsView/detailsView.html'
		}
	)
	
	.when('/login',
		{
			templateUrl:'app/partials/login/loginMain.html'
		}
	)
	
	.when('/post-ad',
		{
			templateUrl:'app/partials/postAd/postAdMain.html'
		}
	)
	
	.otherwise({
		redirectTo:'/portal/classifieds'
	});
	
})

/*.run( function($rootScope, $location, User) {
    // register listener to watch route changes
    $rootScope.$on( "$routeChangeStart", function(event, next, current) {
      if ( $rootScope.accessToken == null ) {
          window.location.replace('../')
      }
    });
 })
 
 var getUser = function(){
	var ArrayCookies = document.cookie.split(';')
	for(i=0; i<ArrayCookies.length; i++){
		if(ArrayCookies[i].indexOf('accessKey')!=-1){
			return ArrayCookies[i].substr(ArrayCookies[i].indexOf('=')+1)
		}
	}
}
*/