controllers.jobApplyController = function ($scope, $routeParams, jobApplyFactory, FileUploader, ngProgress) {
     var uploader = $scope.uploader = new FileUploader({
            url: '../../../api/include/upload.php'
        })
    $scope.applyJobMail = function () {
        if (uploader.queue.length != 0) {
            uploader.uploadAll()
            uploader.onCompleteItem = function (fileItem, response, status, headers) {
               // console.log(response.file);
                $scope.resume = response.file;
                if (response.error == false) {
                    jobApplyFactory.applyjobAPICall($scope, $routeParams.id, ngProgress);
                } else {
                    alert('File upload failed!')
                }
            };
        } else {
            alert('Error')
        }

    }

}

