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
                                login<br>
                                http://kasunengineers.com/qone/web/site/app/#/login <br>
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
     } 

    if(mail($content['to'], $subject, $message, $headers)) return true; else return false;
}

?>