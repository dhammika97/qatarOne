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
 * get location details
 * url - /locations/:id
 * method - GET
 * params - location id */ 
$app->GET('/locations/:id',  function($location_id) {
		$DbHandler = new DbHandler();
		$response = array();
		$row = $DbHandler->getLocationDetail($location_id);
		if ($row != NULL) {
			$row["error"] = false;
			echoRespnse(200, $row);
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
		$location =  $request->getBody();
		$result = $DbHandler->updateLocation($location_id, $location);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "Location updated successfully";
		} else {                
			$response["error"] = true;
			$response["message"] = "Location failed to update. Please try again!";
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
		$result = $DbHandler->deleteLocation($location_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "Location deleted succesfully";
		} else {
			$response["error"] = true;
			$response["message"] = "Location failed to delete. Please try again!";
		}
		echoRespnse(200, $response);
});



// * list all pages
// * url - /subCategory
// * method - get
// * params - 
$app->get('/page', function()  {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllPages();	
		if (!$result) {
			$result["error"] = TRUE;
			$result["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $result);
		} else {
			$result["error"] = false;
			echoRespnse(200, $result);
		}
});

// * list single page
// * url - /page
// * method - get
// * params - subcategoryID
$app->get('/page/:id', function($page_id) {
		$DbHandler = new DbHandler();
		$response = array();
		$row = $DbHandler->GetPageDetail($page_id);
		if ($row != NULL) {
			$row["error"] = false;
			echoRespnse(200, $row);
		} else {
			$response["error"] = true;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}
});

// * Add page
// * url - /page
// * method - post
// * params - 

$app->post('/page', function() use ($app) {	
		$DbHandler = new DbHandler();
		$response = array();
		$category = array();
		$request = $app->request();
		$page = $request->getBody();
		$user_ID = "1";
		//User ID should be a global variable
		$page['page_addedBy'] = $user_ID;
		//print_r($subCategory);
		if ($DbHandler->addPage($page)) {
			$response["error"] = false;
			$response["message"] = "Successfully created the category";
			echoRespnse(201, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "category not created ";
			echoRespnse(412, $response);
		}
});
// * Edit page
// * url - /page
// * method - put
// * params - 

$app->put('/page/:pageid', function ($id) use ( $app) {
		$DbHandler = new DbHandler();
		$request = $app->request();
		$page = $request->getBody();		  
		if ($result = $DbHandler->updatePages($page, $id)) {
			$response["error"] = FALSE;
			$response["message"] = "Successfully Updated";
			echoRespnse(200, $response);
		}else{
			$response["error"] = TRUE;
			$response["message"] = "Updated falid";
			echoRespnse(401, $response);
		}
});
/**
 * Delete pages
 * url - /page/:id
 * method - DELETE
 * params - page id */ 
$app->delete('/page/:id',  function($page_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deletePage($page_id);
		
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
 * User Login
 * url - /login
 * method - POST
 * params -email, password */
$app->post('/login', function() use ($app) {    						
		// reading post params						 
		$email = $app->request()->post('email');
		$password = $app->request()->post('password');
		$response = array();
	
		//$password_hash = PassHash::hash($password);
		// echo $password_hash;		
	
		$db = new DbHandler();
		// check for correct email and password
		if ($db->checkLogin($email, $password)) {
			//get the user by email
			$logged_User = $db->getUserByEmail($email);
			
			if ($logged_User != NULL) {
				$response["error"] = false;
				$response['accessToken'] = $logged_User['user_accessToken'];
				$response['user_status'] = $logged_User['user_status'];
			} else {
				// unknown error occurred
				$response['error'] = true;
				$response['message'] = "An error occurred. Please try again";
			}
		} else {
			// user credentials are wrong
			$response['error'] = true;
			$response['message'] = 'Login failed. Incorrect credentials';
		}
	
		echoRespnse(200, $response);
			
});

// * list all pagesCantent
// * url - /pageContent
// * method - get
// * params - 
$app->get('/pageContent', function()  {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllPagesContent();	
		if (!$result) {
			$result["error"] = TRUE;
			$result["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $result);
		} else {
			$result["error"] = false;
			echoRespnse(200, $result);
		}
});

// * list single pageContent
// * url - /page
// * method - get
// * params - subcategoryID
$app->get('/pageContent/:id', function($pageContent_id) {
		$DbHandler = new DbHandler();
		$response = array();
		$row = $DbHandler->GetPageContentDetail($pageContent_id);
		if ($row != NULL) {
			$row["error"] = false;
			echoRespnse(200, $row);
		} else {
			$response["error"] = true;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}
});

// * Add pageContent
// * url - /pageContent
// * method - post
// * params - 

$app->post('/pageContent', function() use ($app) {	
		$DbHandler = new DbHandler();
		$response = array();
		$category = array();
		$request = $app->request();
		$pageContent = $request->getBody();
		$user_ID = "1";
		//User ID should be a global variable
		$pageContent['page_addedBy'] = $user_ID;
		//print_r($subCategory);
		if ($DbHandler->addPageContent($pageContent)) {
			$response["error"] = false;
			$response["message"] = "Successfully created the category";
			echoRespnse(201, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "category not created ";
			echoRespnse(412, $response);
		}
});
// * Edit pageContent
// * url - /pageContent/:id
// * method - put
// * params - 

$app->put('/pageContent/:pageContentId', function ($pageContentId) use ( $app) {
		$DbHandler = new DbHandler();
		$request = $app->request();
		$pageContent = $request->getBody();		  
		if ($result = $DbHandler->updatePagesContent($pageContent, $pageContentId)) {
			$response["error"] = FALSE;
			$response["message"] = "Successfully Updated";
			echoRespnse(200, $response);
		}else{
			$response["error"] = TRUE;
			$response["message"] = "Updated falid";
			echoRespnse(401, $response);
		}
});
/**
 * Delete pages
 * url - /page/:id
 * method - DELETE
 * params - page id */ 
$app->delete('/pageContent/:pageContentId',  function($pageContentId) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deletePageContent($pageContentId);
		
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
 * Get all suburbs
 * url - /suburbs
 * method - GET
 * params - api Key*/

$app->get('/suburbs',  function() {
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllSuburbs();
		$result['error'] = false;
        echoRespnse(200, $result);
});

/**
 * Get suburbs by suburb id
 * url - /suburbs
 * method - GET
 * params -suburb id*/		
$app->get('/suburbs/:id',  function($suburb_id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->GetSuburbDetail($suburb_id);
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
 * Create suburbs 
 * url - /suburbs
 * method - POST
 * params -suburb object*/

$app->post('/suburbs', function() use ($app) {
		$location  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$suburb = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createSuburb($suburb)){
			$response["error"] = false;
			$response["message"] = "Suburb created successfully";
			echoRespnse(200, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "Suburb creation failed";	
		}
});
		
/**
 * Update suburbs 
 * url - /suburbs
 * method - PUT
 * params - suburb object */
$app->put('/suburbs/:id',  function($suburb_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$suburb =  $request->getBody();
		$result = $DbHandler->updateSuburb($suburb_id, $suburb);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "Suburb updated successfully";
		} else {                
			$response["error"] = true;
			$response["message"] = "Suburb failed to update. Please try again!";
		}
		echoRespnse(200, $response);				
});
 					
/**
 * Delete suburbs
 * url - /suburbs/:id
 * method - DELETE
 * params - suburb id */ 
$app->delete('/suburbs/:id',  function($suburb_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteSuburb($suburb_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "Suburb deleted succesfully";
		} else {
			$response["error"] = true;
			$response["message"] = "Suburb failed to delete. Please try again!";
		}
		echoRespnse(200, $response);
});


// * list all events
// * url - /subCategory
// * method - get
// * params - 

$app->get('/event', function()  {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllEvents();	
		if (!$result) {
			$result["error"] = TRUE;
			$result["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $result);
		} else {
			$result["error"] = false;
			echoRespnse(200, $result);
		}
});

// * list event details
// * url - /event/:id
// * method - get
// * params - id

$app->get('/event/:id', function($event_id) {
		$DbHandler = new DbHandler();
		$response = array();
		$row = $DbHandler->GetEventDetail($event_id);
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

$app->post('/event', function() use ($app) {	
		$DbHandler = new DbHandler();
		$response = array();
		$category = array();
		$request = $app->request();
		$event = $request->getBody();
		
		if ($DbHandler->addEvent($event)) {
			$response["error"] = false;
			$response["message"] = "Successfully created the event";
			echoRespnse(201, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "event not created ";
			echoRespnse(412, $response);
		}
});


// * Edit event
// * url - /event
// * method - put
// * params - 

$app->put('/event/:id', function ($id) use ( $app) {
		$DbHandler = new DbHandler();
		$request = $app->request();
		$event = $request->getBody();		  
		if ($result = $DbHandler->updateEvent($event, $id)) {
			$response["error"] = FALSE;
			$response["message"] = "Successfully Updated";
			echoRespnse(200, $response);
		}else{
			$response["error"] = TRUE;
			$response["message"] = "Updated falid";
			echoRespnse(401, $response);
		}
});


// * Delete event
// * url - /event
// * method - delete
// * params - 

$app->delete('/event/:id', function ($id) {
		$DbHandler = new DbHandler();
		$response = array();
		if($DbHandler->deleteEvent($id)){
			$response['error'] = FALSE;
			$response['message'] = 'Successfully Deleted';
		}else{
			$response['error'] = TRUE;
			$response['message'] = 'Not Deleted';   	
		}	   
		echoRespnse(200, $response);
});


/**
 * Get all slider
 * url - /slider
 * method - GET
 * params - api Key*/

$app->get('/slider',  function() {
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllSliders();
		$result['error'] = false;
        echoRespnse(200, $result);
});

/**
 * Get slider by slider id
 * url - /slider
 * method - GET
 * params -slider id*/		
$app->get('/slider/:id',  function($slider_id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->GetSliderDetail($slider_id);
        if ($result != NULL) {
        	$response["error"] = false;
				$response['slider'] = $result;
                echoRespnse(200	, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });	 

/**
 * Create slider 
 * url - /slider
 * method - POST
 * params -slider object*/

$app->post('/slider', function() use ($app) {
		$slider  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$slider = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createSlider($slider)){
			$response["error"] = false;
			$response["message"] = "slider created successfully";
			echoRespnse(200, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "slider creation failed";	
		}
});
		
/**
 * Update slider 
 * url - /slider
 * method - PUT
 * params - slider object */
$app->put('/slider/:id',  function($slider_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$slider =  $request->getBody();
		$result = $DbHandler->updateSlider($slider_id, $slider);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "slider updated successfully";
		} else {                
			$response["error"] = true;
			$response["message"] = "slider failed to update. Please try again!";
		}
		echoRespnse(200, $response);				
});
 					
/**
 * Delete slider
 * url - /slider/:id
 * method - DELETE
 * params - slider id */ 
$app->delete('/slider/:id',  function($slider_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteSlider($slider_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "slider deleted succesfully";
		} else {
			$response["error"] = true;
			$response["message"] = "slider failed to delete. Please try again!";
		}
		echoRespnse(200, $response);
});


/**
 * Get all news
 * url - /news
 * method - GET
 * params - api Key*/

$app->get('/news',  function() {
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllNews();
		$result['error'] = false;
        echoRespnse(200, $result);
});

/**
 * Get news by news id
 * url - /news
 * method - GET
 * params -news id*/		
$app->get('/news/:id',  function($news_id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->GetNewsDetail($news_id);
        if ($result != NULL) {
        	$response["error"] = false;
				$response['news'] = $result;
                echoRespnse(200	, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });	 

/**
 * Create news 
 * url - /news
 * method - POST
 * params -news object*/

$app->post('/news', function() use ($app) {
		$news  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$news = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createNews($news)){
			$response["error"] = false;
			$response["message"] = "news created successfully";
			echoRespnse(200, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "news creation failed";	
		}
});
		
/**
 * Update news 
 * url - /news
 * method - PUT
 * params - news object */
$app->put('/news/:id',  function($news_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$news =  $request->getBody();
		$result = $DbHandler->updateNews($news_id, $news);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "news updated successfully";
		} else {                
			$response["error"] = true;
			$response["message"] = "news failed to update. Please try again!";
		}
		echoRespnse(200, $response);				
});
 					
/**
 * Delete news
 * url - /news/:id
 * method - DELETE
 * params - news id */ 
$app->delete('/news/:id',  function($news_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteNews($news_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "news deleted succesfully";
		} else {
			$response["error"] = true;
			$response["message"] = "news failed to delete. Please try again!";
		}
		echoRespnse(200, $response);
});


/**
 * Get all packageType
 * url - /packageType
 * method - GET
 * params - api Key*/

$app->get('/packageType',  function() {
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllPackageTypes();
		$result['error'] = false;
        echoRespnse(200, $result);
});

/**
 * Get packageType by packageType id
 * url - /packageType
 * method - GET
 * params -packageType id*/		
$app->get('/packageType/:id',  function($packageType_id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->GetPackageTypeDetail($packageType_id);
        if ($result != NULL) {
        	$response["error"] = false;
				$response['packageType'] = $result;
                echoRespnse(200	, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });	 

/**
 * Create packageType 
 * url - /packageType
 * method - POST
 * params -packageType object*/

$app->post('/packageType', function() use ($app) {
		$packageType  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$packageType = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createPackageType($packageType)){
			$response["error"] = false;
			$response["message"] = "package type created successfully";
			echoRespnse(200, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "package type creation failed";	
		}
});
		
/**
 * Update packageType 
 * url - /packageType
 * method - PUT
 * params - packageType object */
$app->put('/packageType/:id',  function($packageType_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$packageType =  $request->getBody();
		$result = $DbHandler->updatePackageType($packageType_id, $packageType);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "package type updated successfully";
		} else {                
			$response["error"] = true;
			$response["message"] = "package type failed to update. Please try again!";
		}
		echoRespnse(200, $response);				
});
 					
/**
 * Delete packageType
 * url - /packageType/:id
 * method - DELETE
 * params - packageType id */ 
$app->delete('/packageType/:id',  function($packageType_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deletePackageType($packageType_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "package type deleted succesfully";
		} else {
			$response["error"] = true;
			$response["message"] = "package type failed to delete. Please try again!";
		}
		echoRespnse(200, $response);
});


$app->run();
		
		
?>
