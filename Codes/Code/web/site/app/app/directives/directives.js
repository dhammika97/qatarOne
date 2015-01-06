// JavaScript Document
App.directive('helloWorld', function() {
  return {
    restrict: 'AE',
    replace: true,
	//template:'<div>Hello World!</div>',
    templateUrl: "app/directives/templates/sliderTemplate.html",
    link: function(scope, elem, attrs) {
		scope.test = function(){
			$('.carousel[data-type="multi"] .item').each(function(){
			  var next = $(this).next();
			  if (!next.length) {
				next = $(this).siblings(':first');
			  }
			  next.children(':first-child').clone().appendTo($(this));
			  
			  for (var i=0;i<2;i++) {
				next=next.next();
				if (!next.length) {
					next = $(this).siblings(':first');
				}
				
				next.children(':first-child').clone().appendTo($(this));
			  }
			});
		}
		scope.test()
	}
  };
});
