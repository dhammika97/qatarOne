// controllers.commentsController = function($scope, commentsFactry){
// 	alert("dgdgdfd")
// 	$scope.comments = commentsFactry.showComments();	
// 	$scope.approve = function(id){
// 		commentsFactry.approve(id, $scope);
// 	}
// 	$scope.deny = function(id){
// 		if(id!=''){
// 			var r = confirm("Do you want to deny this Comment");
// 			if (r == true) {
// 				 commentsFactry.deny(id,$scope);
// 			}
// 		}
//		
// 	}

// }
controllers.commentsController = function ($scope, commentFactory) {
    
    $scope.comments = commentFactory.showComments();
    //console.log($scope.comments)
    $scope.approve = function (id) {
		if (id != '') {
            var r = confirm("Do you want to Approve this Comment");
            if (r == true) {
        		commentFactory.approve(id, $scope);
			}
		}
    }
    $scope.deny = function (id) {
        if (id != '') {
            var r = confirm("Do you want to deny this Comment");
            if (r == true) {
                commentFactory.deny(id, $scope);
            }
        }

    }
}