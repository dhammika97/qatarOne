// JavaScript Document
var App = angular.module('QatartOneApp',['ngRoute','ngResource','angular.filter']) 

App.config(function($routeProvider, $httpProvider){
	//$httpProvider.defaults.headers.common.Authorization = getUser();
	$routeProvider
	.when('/portal/:name',
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
	
	.when('/pages/:pageName',
		{
			controller:'controllers.pageNavController',
			templateUrl:'app/partials/CMS/CMSPage.html'
		}
	).when('/news-details/:id',
		{
			controller:'controllers.newsDetailsController',
			templateUrl:'app/partials/newsdetails/NewsDetails.html'
		}
	).when('/events-details/:id',
			{
		controller:'controllers.eventsDetailsController',
		templateUrl:'app/partials/eventsdetails/EventsDetails.html' 
	}
)

	
	.otherwise({
		redirectTo:'/portal/classified'
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
