// JavaScript Document
App.directive('helloWorld', function(ngDialog) {
  return {
    restrict: 'AE',
    replace: true,
	scope:{
		videoT: '='
	},
    templateUrl: "app/directives/templates/sliderTemplate.html",
    link: function(scope, elem, attrs) {
		setTimeout(function(){
			$('.crsl-items').carousel({ autoRotate: 3000, visible: 4});
		},100)
		
		scope.openWindow = function(id){
			ngDialog.open({ template: '<iframe id="player" type="text/html" width="480" height="320" src="http://www.youtube.com/embed/'+id+'" frameborder="0"></iframe>',
    		plain: true,
			className: 'ngdialog-theme-default' });	
		}
	}
  };
});
