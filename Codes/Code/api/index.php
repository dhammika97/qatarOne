<?php
session_start();
require_once 'include/database.php';
require_once 'include/DbHandler.php';
require_once 'include/PassHash.php';
require_once 'include/functions.php';
require 'libs/Slim/Slim.php';
 
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->add(new \Slim\Middleware\ContentTypes());

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Content-Type: application/json');
	
/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();

    // Verifying Authorization Header
    if (isset($headers['Authorization'])) {
        $db = new DbHandler();

        // get the access token
        $user_accessToken = $headers['Authorization'];
        // validating Access Token
        if (!$db->isValidAccessToken($user_accessToken)) {
            // acess token not present in users table
            $response["error"] = true;
            $response["message"] = "Access Denied. Invalid Access Token";
            echoRespnse(401, $response);
            $app->stop();
        }        
    } else {
        // User Access Token is missing in header
        $response["error"] = true;
        $response["message"] = "User Access Token key is misssing";
        echoRespnse(400, $response);
        $app->stop();
    }
}



/**
 * Get all users
 * url - /userlist
 * method - GET
 * params - api Key*/

$app->get('/user',  function() {
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllUsers();
		$result['error'] = false;
        echoRespnse(200, $result);
});

/**
 * Get user by user id
 * url - /userlist
 * method - GET
 * params -user id*/		
$app->get('/user/:id',  function($user_id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->GetUserDetail($user_id);
        if ($result != NULL) {
        	$response["error"] = false;
				$response['user'] = $result;
                echoRespnse(200	, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });	 

/**
 * Create user 
 * url - /userlist
 * method - POST
 * params -user object*/

$app->post('/user', function() use ($app) {
		$users  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$users = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createUser($users)){
			$response["error"] = false;
			$response["message"] = "user created successfully";
			echoRespnse(200, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "user created unsuccessfull";	
		}
});
		
/**
 * Update user 
 * url - /userlist
 * method - PUT
 * params -user object, user_id */
$app->put('/user/:id',  function($user_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$users =  $request->getBody();
		$result = $DbHandler->updateUser($user_id, $users);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "User updated successfully";
		} else {                
			$response["error"] = true;
			$response["message"] = "User failed to update. Please try again!";
		}
		echoRespnse(200, $response);				
});
 					
/**
 * Delete user 
 * url - /userlist/:id
 * method - DELETE
 * params - user_id */ 
$app->delete('/user/:id',  function($user_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteUser($user_id);
		
		if ($result) {
			// user deleted successfully				
			$response["error"] = false;
			$response["message"] = "User deleted succesfully";
		} else {
			// task failed to delete
			$response["error"] = true;
			$response["message"] = "User failed to delete. Please try again!";
		}
		echoRespnse(200, $response);
});
		
/**
 * Retreive Fixed advertisment list 
 * url - /fixedAds
 * method - GET
 * params - */

$app->get('/fixedAds',  function() {           
		$response = array();
		$DbHandler = new DbHandler();			
		$result = $DbHandler->getAllFixedAd();
		$result['error'] = false;
		echoRespnse(200, $result);
	});

/**
 * Get Fixed advertisment by advertisment id
 * url - /fixedAds/:id
 * method - GET
 * params -fixedads_id */
 $app->get('/fixedAds/:id',  function($fixedads_id) {
		$response = array();
		$DbHandler = new DbHandler();       		
		$result = $DbHandler->GetFixedAdvertismentDetail($fixedads_id);
		if ($result != NULL) {            
			$response["error"] = false;
			$response['user'] = $result;
			echoRespnse(200 , $response);
		} else {
			$response["error"] = true;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}            
});

/**
 * Create Fixed advertisment 
 * url - /fixedAds
 * method - POST
 * params -fixed advertisment  object*/

$app->post('/fixedAds',"authenticate",function() use ($app) {
		// check for required paramsss
	   	// verifyRequiredParams(array('task'));
		$response = array();           
		$request = \Slim\Slim::getInstance()->request();
		$fixed_advertisment = $request->getBody();
		$db = new DbHandler();
		$result = $db->createFixedAdvertisment($fixed_advertisment);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "Fixed Advertisment created successfully";                
			echoRespnse(201, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "Failed to create Fixed Advertisment. Please try again";
			echoRespnse(200, $response);
		}            
});

/**
 * Update  Fixed advertisment  
 * url - /fixedadlist/:id
 * method - PUT
 * params -Fixed advertisment object, fixedads_id */        
$app->put('/fixedAds/:id',"authenticate",  function($fixedads_id) {
		$request = \Slim\Slim::getInstance()->request();
		$fixed_advertisment = $request->getBody();
		
		$db = new DbHandler();
		$response = array();	
		// updating Fixed advertisment 
		$result = $db->updateFixedAdvertisment($fixedads_id, $fixed_advertisment);
		if ($result) {
			// Fixed advertisment  updated successfully
			$response["error"] = false;
			$response["message"] = "Fixed Advertisment updated successfully";
		} else {
			// Fixed advertisment  failed to update
			$response["error"] = true;
			$response["message"] = "Fixed Advertisment failed to update. Please try again!";
		}
		echoRespnse(200, $response);               
});

/**
 * Delete Fixed advertisment   
 * url - /userlist/:id'
 * method - DELETE
 * params - user_id */
 
$app->delete('/fixedAds/:id',"authenticate" , function($fixedads_id) use($app) {          
		$db = new DbHandler();
		$response = array();
		$result = $db->deleteFixedAdvertisment($fixedads_id);
		if ($result) {
			// user deleted successfully                
			$response["error"] = false;
			$response["message"] = "Fixed Advertisment deleted succesfully";
		} else {
			// task failed to delete
			$response["error"] = true;
			$response["message"] = "Fixed Advertisment failed to delete. Please try again!";
		}
		echoRespnse(200, $response);
});


// * list all categories 
// * url - /category
// * method - get
// * params -  
  
$app->get('/category', function() {	
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllCategories();				
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$result["error"] = false;
			echoRespnse(200, $result);
		}
});


// * list categories by id
// * url - /category
// * method - get
// * params - user_id 
$app->get('/category/:id', function($category_id){
		$response = array();
		$DbHandler = new DbHandler();		
		$row = $DbHandler->GetCategoryDetail($category_id);
		if ($row != NULL) {
			$row["error"] = false;
			echoRespnse(200, $row);
		} else {
	
			$response["error"] = true;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}
});

// * Add category
// * url - /category
// * method - post
// * params -  
$app->post('/category', function() use ($app) {
		$response = array();
		$category = array();
		$DbHandler = new DbHandler();
		global $user_ID;		
		$category = $app->request()->getBody();
		$category['category_enteredBy'] = $user_ID = 1;
		if ($DbHandler->addCategory($category)) {
			$response["error"] = false;
			$response["message"] = "Successfully created the category";
			echoRespnse(201, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "User Already exists";
			echoRespnse(200, $response);
		}
});

// * Update category
// * url - /category/id
// * method - post
// * params -  id 
$app->put('/category/:categoryId', function ($id) use ($app) {
		$DbHandler = new DbHandler();
		$request = $app->request();
		$category = $request->getBody();		
		if ($result = $DbHandler->updateCateory($category, $id)) {
			$response["error"] = FALSE;
			$response["message"] = "Successfully Updated";
			echoRespnse(200, $response);
		} else {
			$response["error"] = TRUE;
			$response["message"] = "Updated failed";
			echoRespnse(401, $response);
		}
});


// * Delete category
// * url - /category/id
// * method - delete
// * params -  id 
$app->delete('/category/:categoryId', function ($id) {
		$DbHandler = new DbHandler();
		$response = array();
		if ($DbHandler->deleteCategory($id)) {
			$response['error'] = FALSE;
			$response['message'] = 'Successfully Deleted';
		} else {
			$response['error'] = TRUE;
			$response['message'] = 'Not Deleted';
		}
		echoRespnse(200, $response);
});


// * list all sub-category
// * url - /subCategory
// * method - get
// * params - 

$app->get('/subCategory', function()  {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllsubCategorys();	
		if (!$result) {
			$result["error"] = TRUE;
			$result["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $result);
		} else {
			$result["error"] = false;
			echoRespnse(200, $result);
		}
});

// * list all sub-category
// * url - /subCategory
// * method - get
// * params - subcategoryID

$app->get('/subCategory/:id', function($subCategory_id) {
		$DbHandler = new DbHandler();
		$response = array();
		$row = $DbHandler->GetsubCategoryDetail($subCategory_id);
		if ($row != NULL) {
			$row["error"] = false;
			echoRespnse(200, $row);
		} else {
			$response["error"] = true;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}
});

// * Add sub-category
// * url - /subCategory
// * method - post
// * params - 

$app->post('/subCategory', function() use ($app) {	
		$DbHandler = new DbHandler();
		$response = array();
		$category = array();
		$request = $app->request();
		$subCategory = $request->getBody();
		$user_ID = "1";
		//User ID should be a global variable
		$subCategory['category_sub_enteredBy'] = $user_ID;
		//print_r($subCategory);
		if ($DbHandler->addsubCategory($subCategory)) {
			$response["error"] = false;
			$response["message"] = "Successfully created the category";
			echoRespnse(201, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "category not created ";
			echoRespnse(412, $response);
		}
});


// * Edit sub-category
// * url - /subCategory
// * method - post
// * params - 

$app->put('/subCategory/:subCategoryId', function ($id) use ( $app) {
		$DbHandler = new DbHandler();
		$request = $app->request();
		$subCategory = $request->getBody();		  
		if ($result = $DbHandler->updatesubCategory($subCategory, $id)) {
			$response["error"] = FALSE;
			$response["message"] = "Successfully Updated";
			echoRespnse(200, $response);
		}else{
			$response["error"] = TRUE;
			$response["message"] = "Updated falid";
			echoRespnse(401, $response);
		}
});


// * Delete sub-category
// * url - /subCategory
// * method - delete
// * params - 

$app->delete('/subCategory/:subCategoryId', function ($id) {
		$DbHandler = new DbHandler();
		$response = array();
		if($DbHandler->deleteSubCategory($id)){
			$response['error'] = FALSE;
			$response['message'] = 'Successfully Deleted';
		}else{
			$response['error'] = TRUE;
			$response['message'] = 'Not Deleted';   	
		}	   
		echoRespnse(200, $response);
});

/**
 * Get all locations
 * url - /locations
 * method - GET
 * params - api Key*/

$app->get('/locations',  function() {
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllLocations();
		$result['error'] = false;
        echoRespnse(200, $result);
});

/**
 * Get location by location id
 * url - /locations
 * method - GET
 * params -user id*/		
$app->get('/locations/:id',  function($user_id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->GetUserDetail($user_id);
        if ($result != NULL) {
        	$response["error"] = false;
				$response['user'] = $result;
                echoRespnse(200	, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });	 

/**
 * Create locations 
 * url - /locations
 * method - POST
 * params -location object*/

$app->post('/locations', function() use ($app) {
		$location  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$location = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createLocation($location)){
			$response["error"] = false;
			$response["message"] = "location created successfully";
			echoRespnse(200, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "location creation failed";	
		}
});
		
/**
 * Update location 
 * url - /locations
 * method - PUT
 * params - location object */
$app->put('/locations/:id',  function($location_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$users =  $request->getBody();
		$result = $DbHandler->updateUser($user_id, $users);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "User updated successfully";
		} else {                
			$response["error"] = true;
			$response["message"] = "User failed to update. Please try again!";
		}
		echoRespnse(200, $response);				
});
 					
/**
 * Delete location
 * url - /locations/:id
 * method - DELETE
 * params - location id */ 
$app->delete('/locations/:id',  function($location_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteUser($user_id);
		
		if ($result) {
			// user deleted successfully				
			$response["error"] = false;
			$response["message"] = "User deleted succesfully";
		} else {
			// task failed to delete
			$response["error"] = true;
			$response["message"] = "User failed to delete. Please try again!";
		}
		echoRespnse(200, $response);
});


$app->run();
		
		
?>
