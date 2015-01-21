<?php

function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');
    
    echo json_encode($response);
        
}



function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}

function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = true;
        $response["message"] = 'Email address is not valid';
        echoRespnse(400, $response);
        $app->stop();
    }
}


function sendMail($content, $headers){


    switch ($content['mailType']) {
         case 'advertismentAdd':
             $subject ='Qatar One - Addvertisment successfully added';
             $message = '
    
                            <html>
                            <body>
                                <p>
                                Hi,'.$content['fname'].'
                                </p>
                                <p>
                                Your advertisment is successfully added, You will recive an Email once <br>
                                it is published by an administrator<br> 
                                Thank you for connecting with Qatar One<br>
                                </p>
                                <p>
                                    Best Regards!<br>
                                    Team Qatar One
                                </p>
                                  
                            </body>
                            </html>';
             break;
         case 'advertismentStatusUpdate':
             $subject ='Qatar One - Addvertisment published';
             $message = '
    
                            <html>
                            <body>
                                <p>
                                Hi,'.$content['fname'].'<br>
                                Congratulations!, Your advertisment is published on Qatar One website
                                </p>
                                <p>
                                Best Regards!<br>
                                Team Qatar One
                                </p>
                                  
                            </body>
                            </html>';
             
             break;
        case 'registrationActivation':
             $subject ='Qatar One - Please confirm your email account';
             $message = '
    
                            <html>
                            <body>
                                <p>
                                Hi,'.$content['fname'].'<br>
                                
                                </p> 
                                You have successfully registred to Qatar One, Please clck the link below in order to 
                                complete registration<br>
                                '.$content['url'].'
                                <p>
                                Best Regards!<br>
                                Team Qatar One
                                </p>
                                  
                            </body>
                            </html>';
             
             break;
        case 'registrationactivated':
             $subject ='Qatar One - You have registred successfully';
             $message = '
    
                            <html>
                            <body>
                                <p>
                                Hi,'.$content['fname'].'<br>
                                </p> 
                                Congratulations! You have successfully registred to Qatar One<br>
                                
                                <p>
                                Best Regards!<br>
                                Team Qatar One
                                </p>
                                  
                            </body>
                            </html>';
             
             break;
             case 'changePassword':
             $subject ='Qatar One - Change password';
             $message = '
                            <html>
                            <body>
                                <p>
                                Hi,'.$content['fname'].'<br>
                                </p> 
                                please use the link below to reset you password, if you did not request to change your
                                password please inform the administrator<br>
                                http://kasunengineers.com/qone/web/site/app/#/login <br>
                                Thank You!<br>
                                 
                                <p>
                                Best Regards!<br>
                                Team Qatar One
                                </p>
                                  
                            </body>
                            </html>';
             
             break;
             case 'changedPassword':
             $subject ='Qatar One - Password successfully changed';
             $message = '
                            <html>
                            <body>
                                <p>
                                Hi,'.$content['fname'].'<br>
                                </p> 
                                Your password successfully changed<br>
                                Thank you!
                                <p>
                                Best Regards!<br>
                                Team Qatar One
                                </p>
                                  
                            </body>
                            </html>';
             
             break;
            case 'forgotPasswordActivation':
             $subject ='Qatar One - Forgot Password E-mail';
             $message = '
    
                            <html>
                            <body>
                                <p>
                                Hi,'.$content['fname'].'<br>
                                </p> 
                                <a href="http://qatarone1.com/app/#/confirm-forgot-password/'.$content['key'].'"> Click here to change your password.</a>                               
                                
                                <p>
                                Best Regards!<br>
                                Team Qatar One
                                </p>
                                  
                            </body>
                            </html>';
             
             break;
             case 'subscribe':
             $subject ='Qatar One - You have successfully subscribed';
             $message = '
                            <html>
                            <body>
                                <p>
                                Hi,'.$content['fname'].'<br>
                                </p> 
                                You have successfully subscribed to qatar one news letter, You will recive news letter now on<br>
                                Thank you</br>
                                <p>
                                Best Regards!<br>
                                Team Qatar One
                                </p>
                                  
                            </body>
                            </html>';
             
             break;
             case 'contactUs':
             $subject ='Qatar One - Thank you for contacting us';
             $message = '
                            <html>
                            <body>
                                <p>
                                Hi,'.$content['fname'].'<br>
                                </p>                                
                                <p>
                                Thank You for contacting team Qatar one, your message has being recived
                                </p>
                                <p>
                                Best Regards!
                                Team Qatar one
                                </p>
                            </body>
                            </html>';
             $subject2 ='Qatar One - message from customer';
             $message2= '
                            <html>
                            <body>
                                <p>
                                Name :'.$content['fname'].'<br>
                                </p>                                
                                <p>
                                '.$content['customerMessage'].'
                                </p>
                            </body>
                            </html>';
             mail('info@qatarone.com', $subject2, $message2, $headers);
             break;
             case 'contactApplicant':
             	$DbHandler = new DbHandler();
             	$emailAdd = $DbHandler->getApplicantEmail($content['epmluserid']);
             	$content['to'] =$emailAdd[0];
             	//$content['to'] ='kolin.wj@gmail.com';
             	$subject ='Qatar One - Job Notification';
             	$message = '
                            <html>
                            <body>
                                <p>
                                Hi, <br>
                                </p>
                                '.$content['customerMessage'].'<br>
                                Thank you</br>
                                <p>
                                Best Regards!<br>
                                '.$content['name'].'<br>
                                '.$content['telephone'].'
                                </p>
       
                            </body>
                            </html>';
             	 
             	break;
             	case 'jobapply':
             		global $userid;
             		$DbHandler = new DbHandler();
             		$employerInfo = $DbHandler->getEmployerEmailAddress( $content ['advertisement_id'] );	
             	//	$emailAdd = $DbHandler->getApplicantEmail($userid);
             		$content['to'] =$employerInfo[0];
             		//$content['to'] ='kolin.wj@gmail.com';
             		$subject ='Qatar One - Job Apply request';
             		$message = '
		
                            <html>
                            <body>
                                <p>
                                Hi,
                                </p>
                                <p>
                                 '.$content['employee_massage'].'
                                </p>
                                <p>
                                    Best Regards!<br>
   								'.$content['employee_fname'].'
                                </p>
		
                            </body>
                            </html>';
             	break;
     } 

    if(mail($content['to'], $subject, $message, $headers)) return true; else return false;
}


?>