// JavaScript Document
var App = angular.module('QatartOneApp',['ngRoute','ngResource','angular.filter','ui.bootstrap','angularFileUpload']) 

window.routes =
{
    "/portal/:name": {
        templateUrl: 'app/partials/home/home.html', 
        controller: 'controllers.dashController', 
        requireLogin: false
	},
    "/show-list/:parent_id": {
        templateUrl: 'app/partials/resultListing/resultListing.html', 
        controller: '', 
        requireLogin: false
    },
	"/news-details/:id": {
        controller:'controllers.newsDetailsController',
		templateUrl:'app/partials/newsdetails/NewsDetails.html',
		requireLogin: false
    },
	"/events-details/:id": {
        controller:'controllers.eventsDetailsController',
		templateUrl:'app/partials/eventsdetails/EventsDetails.html',
		requireLogin: false
    },
	"/pages/:pageName": {
        controller:'controllers.pageNavController',
		templateUrl:'app/partials/CMS/CMSPage.html',
		requireLogin: false
    },
	"/post-ad": {
		controller:'controllers.advertismentAddController',
        templateUrl:'app/partials/postAd/postAdMain.html',
		requireLogin: true
    },
	'/login': {
		templateUrl:'app/partials/login/loginMain.html',
		requireLogin: false
	},
	'/details-view/:id': {
		templateUrl:'app/partials/detailsView/detailsView.html',
		requireLogin: false
	}
};

App.config(function($routeProvider, $httpProvider){
	$httpProvider.defaults.headers.common.Authorization = sessionStorage.getItem("accessKey");
	for(var path in window.routes) {
        $routeProvider.when(path, window.routes[path]);
    }
	$routeProvider.otherwise({
		redirectTo:'/portal/classified'
	});
	
})

.run( function($rootScope, $location, auth) {
    // register listener to watch route changes
    $rootScope.$on( "$locationChangeStart", function(event, next, current) {
	  
	for(var i in window.routes) {
		if(next.indexOf(i.split('/')[1]) != -1) {
			if(window.routes[i].requireLogin && sessionStorage.getItem("accessKey") == null) {
				alert("Please Login to the system to view this page!");
				event.preventDefault();
			}
		}
    }
	  
	  
    });
 })
/* 
 var getUser = function(){
	var ArrayCookies = document.cookie.split(';')
	for(i=0; i<ArrayCookies.length; i++){
		if(ArrayCookies[i].indexOf('accessKey')!=-1){
			return ArrayCookies[i].substr(ArrayCookies[i].indexOf('=')+1)
		}
	}
}
*/
