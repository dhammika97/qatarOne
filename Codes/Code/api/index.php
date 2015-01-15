<?php
session_start();
require_once 'include/database.php';
require_once 'include/DbHandler.php';
require_once 'include/PassHash.php';
require_once 'include/functions.php';
require 'libs/Slim/Slim.php';
//test 
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
	//echo $headers['Authorization'];
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
        }else{
            global $user_id;
            // get user primary key id
            $user = $db->getUserId($user_accessToken);
			$user_id = $user['user_id'];
			//$user_id = $user['user_id'];
        }        
    } else {
        // User Access Token is missing in header
        $response["error"] = true;
        $response["message"] = "invalid Request. Please login to the system";
        echoRespnse(400, $response);
        $app->stop();
    }
}



/**
 * Get all users
 * url - /userlist
 * method - GET
 * params - api Key*/

$app->get('/user', 'authenticate', function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllUsers($params);
		if(!$result){
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}else{
			$response["error"] = false;
			$response['users'] = json_decode($result);
			echoRespnse(200, $response);
		}
});

/**
 * Get user by user id
 * url - /userlist
 * method - GET
 * params -user id*/		
$app->get('/user/:id', 'authenticate', function($user_id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->GetUserDetail($user_id);
        if ($result != NULL) {
        	$response["error"] = false;
			$response['user'] = json_decode($result);
			echoRespnse(200	, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}
	});	 


/**
 * Get user by checking the Accesstoken passed in header
 * url 		- /GetUserDetail
 * method 	- GET
 * params 	- '' */	
$app->get('/GetUserDetail', 'authenticate', function() {
		$response = array();
		$DbHandler = new DbHandler();
		global $user_id;			
		$result = $DbHandler->GetUserDetail($user_id);
		
        if ($result != NULL) {
        	$response["error"] = false;
			$response['user'] = json_decode($result);
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

$app->post('/user', 'authenticate', function() use ($app) {
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
			$response["message"] = "user creation failed!";
			echoRespnse(400, $response);
		}
});
		
/**
 * Update user 
 * url - /userlist
 * method - PUT
 * params -user object, user_id */
$app->put('/user/:id', 'authenticate', function($user_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$users =  $request->getBody();
		$result = $DbHandler->updateUser($user_id, $users);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "User updated successfully";
			echoRespnse(200, $response);
		} else {                
			$response["error"] = true;
			$response["message"] = "User failed to update. Please try again!";
			echoRespnse(400, $response);
		}
});
 					
/**
 * Delete user 
 * url - /userlist/:id
 * method - DELETE
 * params - user_id */ 
$app->delete('/user/:id', 'authenticate', function($user_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteUser($user_id);
		
		if ($result) {
			// user deleted successfully				
			$response["error"] = false;
			$response["message"] = "User deleted succesfully";
			echoRespnse(200, $response);
		} else {
			// task failed to delete
			$response["error"] = true;
			$response["message"] = "User failed to delete. Please try again!";
			echoRespnse(404, $response);
		}
});
		
/**
 * Retreive Fixed advertisment list 
 * url - /fixedAds
 * method - GET
 * params - */

$app->get('/fixedAds',  function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$response = array();
		$DbHandler = new DbHandler();			
		$result = $DbHandler->getAllFixedAd($params);
		if(!$result){
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}else{
			$response["error"] = false;
			$response['fixedAds'] = json_decode($result);
			echoRespnse(200, $response);
		}
	});
	
$app->get('/fixedAdds',  function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$response = array();
		$DbHandler = new DbHandler();			
		$result = $DbHandler->getAllFixedAdds($params);
		if(!$result){
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}else{
			$response["error"] = false;
			$response['fixedAds'] = json_decode($result);
			echoRespnse(200, $response);
		}
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
			$response['fixedAd'] = json_decode($result);
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

$app->post('/fixedAds', 'authenticate', function() use ($app) {
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
			echoRespnse(400, $response);
		}            
});

/**
 * Update  Fixed advertisment  
 * url - /fixedadlist/:id
 * method - PUT
 * params -Fixed advertisment object, fixedads_id */        
$app->put('/fixedAds/:id', 'authenticate', function($fixedads_id) {
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
			echoRespnse(200, $response);
		} else {
			// Fixed advertisment  failed to update
			$response["error"] = true;
			$response["message"] = "Fixed Advertisment failed to update. Please try again!";
			echoRespnse(400, $response);
		}
});

/**
 * Delete Fixed advertisment   
 * url - /userlist/:id'
 * method - DELETE
 * params - user_id */
 
$app->delete('/fixedAds/:id', 'authenticate', function($fixedads_id) use($app) {          
		$db = new DbHandler();
		$response = array();
		$result = $db->deleteFixedAdvertisment($fixedads_id);
		if ($result) {
			// user deleted successfully                
			$response["error"] = false;
			$response["message"] = "Fixed Advertisment deleted succesfully";
			echoRespnse(200, $response);
		} else {
			// task failed to delete
			$response["error"] = true;
			$response["message"] = "Fixed Advertisment failed to delete. Please try again!";
			echoRespnse(404, $response);
		}
});


// * list all categories 
// * url - /category
// * method - get
// * params -  
  
$app->get('/category', function() {	
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();

		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllCategories($params);

		if(!$result){
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}else{
			$response["error"] = false;
			$response['categories'] = json_decode($result);
			echoRespnse(200, $response);
		}
});




// * list all categories with count
// * url - /categoryWithCount
// * method - get
// * params -  
  
$app->get('/categoryWithCount', function() {	
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();

		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllCategoriesWithCount($params);

		if(!$result){
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}else{
			$response["error"] = false;
			$response['categories'] = json_decode($result);
			echoRespnse(200, $response);
		}
});


// * list categories by id
// * url - /category
// * method - get
// * params - user_id 
$app->get('/category/:id', function($category_id){
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->GetCategoryDetail($category_id);
		if ($result != NULL) {
			$response["error"] = false;
			$response["category"] = json_decode($result);
			echoRespnse(200, $response);
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
$app->post('/category', 'authenticate', function() use ($app) {
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
			echoRespnse(400, $response);
		}
});

// * Update category
// * url - /category/id
// * method - post
// * params -  id 
$app->put('/category/:categoryId', 'authenticate', function ($id) use ($app) {
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
			echoRespnse(400, $response);
		}
});


// * Delete category
// * url - /category/id
// * method - delete
// * params -  id 
$app->delete('/category/:categoryId', 'authenticate', function ($id) {
		$DbHandler = new DbHandler();
		$response = array();
		if ($DbHandler->deleteCategory($id)) {
			$response['error'] = FALSE;
			$response['message'] = 'Successfully Deleted';
			echoRespnse(200, $response);
		} else {
			$response['error'] = TRUE;
			$response['message'] = 'Not Deleted, This category contains sub categories';
			echoRespnse(404, $response);
		}
});


// * list all sub-category
// * url - /subCategory
// * method - get
// * params - 

$app->get('/subCategory', function()  {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
    
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllsubCategorys($params);	
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response['subcategories']=json_decode($result);
			echoRespnse(200, $response);
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
			$response["error"] = false;
			$response["subcategory"]=json_decode($row);
			echoRespnse(200, $response);
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

$app->post('/subCategory', 'authenticate', function() use ($app) {	
		$DbHandler = new DbHandler();
		$response = array();
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
			echoRespnse(400, $response);
		}
});


// * Edit sub-category
// * url - /subCategory
// * method - post
// * params - 

$app->put('/subCategory/:subCategoryId', 'authenticate', function ($id) use ( $app) {
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
			echoRespnse(400, $response);
		}
});


// * Delete sub-category
// * url - /subCategory
// * method - delete
// * params - 

$app->delete('/subCategory/:subCategoryId', 'authenticate', function ($id) {
		$DbHandler = new DbHandler();
		$response = array();
		if($DbHandler->deleteSubCategory($id)){
			$response['error'] = FALSE;
			$response['message'] = 'Successfully Deleted';
			echoRespnse(200, $response);
		}else{
			$response['error'] = TRUE;
			$response['message'] = 'Not Deleted';   	
			echoRespnse(404, $response);
		}
});

/**
 * Get all locations
 * url - /locations
 * method - GET
 * params - api Key*/

$app->get('/locations',  function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();    
    
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllLocations($params);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response['locations']=json_decode($result);
			echoRespnse(200, $response);
		}
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
			$response["error"] = false;
			$response["location"] = json_decode($row);
			echoRespnse(200, $response);
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

$app->post('/locations', 'authenticate', function() use ($app) {
		$location  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$location = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createLocation($location)){
			$response["error"] = false;
			$response["message"] = "location created successfully";
			echoRespnse(201, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "location creation failed";	
			echoRespnse(200, $response);
		}
});
		
/**
 * Update location 
 * url - /locations
 * method - PUT
 * params - location object */
$app->put('/locations/:id', 'authenticate', function($location_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$location =  $request->getBody();
		$result = $DbHandler->updateLocation($location_id, $location);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "Location updated successfully";
			echoRespnse(200, $response);
		} else {                
			$response["error"] = true;
			$response["message"] = "Location failed to update. Please try again!";
			echoRespnse(400, $response);
		}
});
 					
/**
 * Delete location
 * url - /locations/:id
 * method - DELETE
 * params - location id */ 
$app->delete('/locations/:id', 'authenticate', function($location_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteLocation($location_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "Location deleted succesfully";
			echoRespnse(200, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "Location failed to delete. Please delete the coraspond subers!";
			echoRespnse(400, $response);
		}
});



// * list all pages
// * url - /subCategory
// * method - get
// * params - 
$app->get('/page', function()  {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllPages($params);	
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["pages"] = json_decode($result);
			echoRespnse(200, $response);
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
			$response["error"] = false;
			$response["page"]=json_decode($row);
			echoRespnse(200, $response);
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

$app->post('/page', 'authenticate', function() use ($app) {	
		$DbHandler = new DbHandler();
		$response = array();
		$request = $app->request();
		$page = $request->getBody();
		$user_ID = "1";
		//User ID should be a global variable
		$page['page_addedBy'] = $user_ID;
		//print_r($subCategory);
		if ($DbHandler->addPage($page)) {
			$response["error"] = false;
			$response["message"] = "Successfully created the page";
			echoRespnse(201, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "page not created ";
			echoRespnse(400, $response);
		}
});
// * Edit page
// * url - /page
// * method - put
// * params - 

$app->put('/page/:pageid', 'authenticate', function ($id) use ( $app) {
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
			echoRespnse(400, $response);
		}
});
/**
 * Delete pages
 * url - /page/:id
 * method - DELETE
 * params - page id */ 
$app->delete('/page/:id', 'authenticate', function($page_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deletePage($page_id);
		
		if ($result) {
			// user deleted successfully				
			$response["error"] = false;
			$response["message"] = "Page deleted succesfully";
			echoRespnse(200, $response);
		} else {
			// task failed to delete
			$response["error"] = true;
			$response["message"] = "Page failed to delete. Please try again!";
			echoRespnse(404, $response);
		}
});

/**
 * User Login
 * url - /login
 * method - POST
 * params -email, password */
/*$app->post('/login', function() use ($app) {    						
		// reading post params						 
		$email = $app->request()->post('email');
		$password = $app->request()->post('password');
		$response = array();
	
		//$password_hash = PassHash::hash($password);
		//echo $password_hash;		
	
		$db = new DbHandler();
		// check for correct email and password
		if ($db->checkLogin($email, $password)) {
			//get the user by email
			$logged_User = $db->getUserByEmail($email);
			
			if ($logged_User != NULL) {
				$response["error"] = false;
				$response['accessToken'] = $logged_User['user_accessToken'];
				$response['message'] = "Successfully authenticated";
				echoRespnse(200, $response);
			} else {
				// unknown error occurred
				$response['error'] = true;
				$response['message'] = "An error occurred. Please try again";
				echoRespnse(200, $response);
			}
		} else {
			// user credentials are wrong
			$response['error'] = true;
			$response['message'] = 'Login failed. Incorrect credentials';
			echoRespnse(200, $response);
		}
			
});*/



/**
 * User Login
 * url - /login
 * method - POST
 * params -email, password */
$app->post('/login', function() use ($app) {    						
		// reading post params
		if($app->request()->post('email')){
			$email = $app->request()->post('email');
			$password = $app->request()->post('password');
            $type = $app->request()->post('type');
		}else{ 
			$params = $app->request()->getBody();
			$email= $params['email'];
			$password = $params['password'];
            $type = $params['type'];
		}
		$response = array();
		$db = new DbHandler();
		if ($db->checkLogin($email, $password, $type)) {
			//get the user by email
			$logged_User = $db->getUserByEmail($email);
			
			if ($logged_User != NULL) {
				$response["error"] = false;
				$response['accessToken'] = $logged_User['user_accessToken'];
				$response['username'] = $logged_User['user_firstname'];
				$response['message'] = "Successfully authenticated";
				echoRespnse(200, $response);
			} else {
				// unknown error occurred
				$response['error'] = true;
				$response['message'] = "An error occurred. Please try again";
				echoRespnse(200, $response);
			}
		} else {
			// user credentials are wrong
			$response['error'] = true;
			$response['message'] = 'Login failed. Incorrect credentials';
			echoRespnse(200, $response);
		}
			
});

/**
 * Get all suburbs
 * url - /suburbs
 * method - GET
 * params - api Key*/

$app->get('/suburbs',  function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllSuburbs($params);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["suburbs"]=json_decode($result);
			echoRespnse(200, $response);
		}
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
			$response['suburb'] = json_decode($result);
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

$app->post('/suburbs', 'authenticate', function() use ($app) {
		$location  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$suburb = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createSuburb($suburb)){
			$response["error"] = false;
			$response["message"] = "Suburb created successfully";
			echoRespnse(201, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "Suburb creation failed";
			echoRespnse(400, $response);	
		}
});
		
/**
 * Update suburbs 
 * url - /suburbs
 * method - PUT
 * params - suburb object */
$app->put('/suburbs/:id', 'authenticate', function($suburb_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$suburb =  $request->getBody();
		$result = $DbHandler->updateSuburb($suburb_id, $suburb);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "Suburb updated successfully";
			echoRespnse(200, $response);
		} else {                
			$response["error"] = true;
			$response["message"] = "Suburb failed to update. Please try again!";
			echoRespnse(400, $response);
		}
});
 					
/**
 * Delete suburbs
 * url - /suburbs/:id
 * method - DELETE
 * params - suburb id */ 
$app->delete('/suburbs/:id', 'authenticate', function($suburb_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteSuburb($suburb_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "Suburb deleted succesfully";
			echoRespnse(200, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "Suburb failed to delete. Please try again!";
			echoRespnse(404, $response);
		}
});


// * list all events
// * url - /subCategory
// * method - get
// * params - 

$app->get('/event', function()  {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllEvents($params);	
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["events"]=json_decode($result);
			echoRespnse(200, $response);
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
			$response["error"] = false;
			$response["event"] = json_decode($row);
			echoRespnse(200, $response);
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

$app->post('/event', 'authenticate', function() use ($app) {	
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
			echoRespnse(400, $response);
		}
});


// * Edit event
// * url - /event
// * method - put
// * params - 

$app->put('/event/:id', 'authenticate', function ($id) use ( $app) {
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
			echoRespnse(400, $response);
		}
});


// * Delete event
// * url - /event
// * method - delete
// * params - 

$app->delete('/event/:id', 'authenticate', function ($id) {
		$DbHandler = new DbHandler();
		$response = array();
		if($DbHandler->deleteEvent($id)){
			$response['error'] = FALSE;
			$response['message'] = 'Successfully Deleted';
			echoRespnse(200, $response);
		}else{
			$response['error'] = TRUE;
			$response['message'] = 'Not Deleted'; 
			echoRespnse(404, $response);  	
		}
});


/**
 * Get all slider
 * url - /slider
 * method - GET
 * params - api Key*/

$app->get('/slider',  function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllSliders($params);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["sliders"]=json_decode($result);
			echoRespnse(200, $response);
		}
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
				$response['slider'] = json_decode($result);
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

$app->post('/slider', 'authenticate', function() use ($app) {
		$slider  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$slider = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createSlider($slider)){
			$response["error"] = false;
			$response["message"] = "slider created successfully";
			echoRespnse(201, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "slider creation failed";
			echoRespnse(400, $response);	
		}
});
		
/**
 * Update slider 
 * url - /slider
 * method - PUT
 * params - slider object */
$app->put('/slider/:id', 'authenticate',  function($slider_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$slider =  $request->getBody();
		$result = $DbHandler->updateSlider($slider_id, $slider);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "slider updated successfully";
			echoRespnse(200, $response);
		} else {                
			$response["error"] = true;
			$response["message"] = "slider failed to update. Please try again!";
			echoRespnse(400, $response);
		}
});
 					
/**
 * Delete slider
 * url - /slider/:id
 * method - DELETE
 * params - slider id */ 
$app->delete('/slider/:id', 'authenticate', function($slider_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteSlider($slider_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "slider deleted succesfully";
			echoRespnse(200, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "slider failed to delete. Please try again!";
			echoRespnse(404, $response);
		}
});


/**
 * Get all news
 * url - /news
 * method - GET
 * params - api Key*/

$app->get('/news',  function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllNews($params);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["news"]=json_decode($result);
			echoRespnse(200, $response);
		}
		
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
			$response['news'] = json_decode($result);
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

$app->post('/news', 'authenticate', function() use ($app) {
		$news  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$news = $request->getBody();
		//echo json_encode($news);	
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createNews($news)){
			$response["error"] = false;
			$response["message"] = "news created successfully";
			echoRespnse(201, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "news creation failed";
			echoRespnse(400, $response);
		}
});
		
/**
 * Update news 
 * url - /news
 * method - PUT
 * params - news object */
$app->put('/news/:id', 'authenticate', function($news_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$news =  $request->getBody();
		$result = $DbHandler->updateNews($news_id, $news);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "news updated successfully";
			echoRespnse(200, $response);
		} else {                
			$response["error"] = true;
			$response["message"] = "news failed to update. Please try again!";
			echoRespnse(400, $response);
		}				
});
 					
/**
 * Delete news
 * url - /news/:id
 * method - DELETE
 * params - news id */ 
$app->delete('/news/:id', 'authenticate', function($news_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteNews($news_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "news deleted succesfully";
			echoRespnse(200, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "news failed to delete. Please try again!";
			echoRespnse(404, $response);
		}
});


/**
 * Get all packageType
 * url - /packageType
 * method - GET
 * params - api Key*/

$app->get('/packageType', function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$response = array();
		$DbHandler = new DbHandler();		
		$result = $DbHandler->getAllPackageTypes($params);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["packageTypes"]=json_decode($result);
			echoRespnse(200, $response);
		}
});

/**
 * Get packageType by packageType id
 * url - /packageType
 * method - GET
 * params -packageType id*/		
$app->get('/packageType/:id', function($packageType_id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->GetPackageTypeDetail($packageType_id);
        if ($result != NULL) {
        	$response["error"] = false;
				$response['packageType'] = json_decode($result);
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

$app->post('/packageType', 'authenticate', function() use ($app) {
		$packageType  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$packageType = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createPackageType($packageType)){
			$response["error"] = false;
			$response["message"] = "Package Type created successfully";
			echoRespnse(201, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "Package Type creation failed";
			echoRespnse(400, $response);
		}
});
		
/**
 * Update packageType 
 * url - /packageType
 * method - PUT
 * params - packageType object */
$app->put('/packageType/:id', 'authenticate', function($packageType_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$packageType =  $request->getBody();
		$result = $DbHandler->updatePackageType($packageType_id, $packageType);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "Package Type updated successfully";
			echoRespnse(200, $response);
		} else {                
			$response["error"] = true;
			$response["message"] = "Package Type failed to update. Please try again!";
			echoRespnse(404, $response);
		}				
});
 					
/**
 * Delete packageType
 * url - /packageType/:id
 * method - DELETE
 * params - packageType id */ 
$app->delete('/packageType/:id', 'authenticate', function($packageType_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deletePackageType($packageType_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "Package Type deleted succesfully";
			echoRespnse(200, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "Package Type failed to delete. Please try again!";
			echoRespnse(404, $response);
		}
});


/**
 * User Registration
 * url - /register
 * method - POST
 * params - $users object
 */
$app->post('/register', function() use ($app) {
            
        $users  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$users = $request->getBody();
		//echo print_r($users);	
		$users['user_type']='3';
		if($users['user_password']!=$users['user_confirmPassword']){
			$response["error"] = true;
			$response["message"] = "Password mis-matched!";
			echoRespnse(409, $response);
			return;
		}
		if($DbHandler->checkUserAvailability($users['user_email'])){
			$response["error"] = true;
			$response["message"] = "User already exist! please login to the system";
			echoRespnse(409, $response);
		}else{
			if($userId = $DbHandler->createUser($users)){
				$defaultPackageList = json_decode($DbHandler->getAllDefaultPackages(),true);
				for($i=0; $i<count($defaultPackageList);$i++){
					$DbHandler->CreateUserPackages($userId,$defaultPackageList[$i]['package_id'],$defaultPackageList[$i]['package_adLimit']);
				}
                                $headers  = 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                $headers .= 'From: dhammika <dhammika97@gmail.com>' . "\r\n";
                                $content['fname'] = $users['user_firstname'];
                                $content['to'] = $users['user_email'];
                                $content['mailType'] = "registrationActivation";
                                
                                sendMail($content, $headers);
				$response["error"] = false;
				$response["message"] = "Congradulations! We have sent an activation email to ".$users['user_email']." Please activate your account first";
				$response["user_id"] = $userId;
				echoRespnse(200, $response);
			}else{
				$response["error"] = true;
				$response["message"] = "User creation failed!, Please contact system administrator";
				echoRespnse(412, $response);
			}
		}
});
/**
 * Create Subscription 
 * url - /subscription
 * method - POST
 * params -subscription object*/

$app->post('/subscription',  function() use ($app) {
		$news  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$userSubscription = $request->getBody();
		if($DbHandler->addUserSubscription($userSubscription)){
			$response["error"] = false;
			$response["message"] = "User subscription created successfully";
			echoRespnse(201, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "User subscription creation failed";
			echoRespnse(400, $response);
		}
});

/**
 * Get advertisment by id
 * url - /advertisment
 * method - PUT
 * params -advertisment id*/		
$app->put('/advertisment/:id', 'authenticate' ,function($id) use ($app) {
	$request = $app->request();
	$DbHandler = new DbHandler();
	$response = array();
	$params =  $request->getBody();
	$user = $DbHandler->advertismentDetail($id);
	$t = json_decode($user,true);
	global $user_id;
	if($user_id == $t[0]['adby']){
		$result = $DbHandler->updateAdvertisement($id, $params);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "Advertisement un-published successfully";
			echoRespnse(200, $response);
		} else {                
			$response["error"] = true;
			$response["message"] = "Advertisement failed to un-publish. Please try again!";
			echoRespnse(404, $response);
		}
	}else{
		$response["error"] = true;
		$response["message"] = "Advertisement failed to un-publish. Please try again!";
		echoRespnse(404, $response);
	}
});


/**
 * Get advertisment by id
 * url - /advertisment
 * method - GET
 * params -advertisment id*/		
$app->get('/advertisment/:id', function($id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$rating = $DbHandler->getRating($id);
		$result = $DbHandler->advertismentDetail($id);
		$tmp = json_decode($result,true);
		$parentId = $DbHandler->GetCategoryParentId($tmp[0]['catId']);
		switch($parentId){
			case('2'):
				$response['job'] = true;
				break;
			case('1'):
				$response['job'] = false;
				break;
		}
        if ($result != NULL) {
			$images = $DbHandler->adImages($id);
			$response["error"] = false;
			$response["images"] = json_decode($images);
			$response['advertisment'] = json_decode($result);
			$response['rating'] = $rating;
			echoRespnse(200	, $response);
        } else {
			$response["error"] = true;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}
});	 
/**
 * Get advertisments 
 * url - /advertisment
 * method - GET
 * params -advertisments*/		
$app->get('/advertisments', function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->advertisments($params);
        if ($result != NULL) {
        	$response["error"] = false;
				$response['advertisments'] = json_decode($result);
                echoRespnse(200	, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });	 




/**
 * Create  Advertisment 
 * url 		- /advertisment
 * method 	- POST
 * params 	- Advertisment  object*/

$app->post('/advertisment', 'authenticate', function() use ($app) {
		$response = array();           
		$request = \Slim\Slim::getInstance()->request();
		$adDetails = $request->getBody();
		$db = new DbHandler();
		global $user_id;
		//$category = $db->GetsubCategoryDetail($adDetails['advertisement_subCategoryId']);
		if($adId = $db->createAdvertisment($adDetails)){
			$response["error"] = false;
			$response["message"] = "Advertisment created successfully";
			$response["insertedId"]=$adId;
			echoRespnse(201, $response);
		}else{
			$response["error"] = true;
			$response["message"] = "Failed to create Advertisment. Please try again";
			echoRespnse(400, $response);
		}	           
});

$app->delete('/postAdImage/:id', 'authenticate', function($id) use ($app){
	$response = array();
	$db = new DbHandler();
	try{
		unlink('uploads/advertisement/thumb/'.$id);	
	}catch(Exception $e){
	
	}
	try{
		unlink('uploads/advertisement/'.$id);
	}catch(exception $e){
		
	}
	
	if($db->deleteImage($id)){
		$response["error"] = false;
		$response["message"] = "Image deleted successfully";
		echoRespnse(200, $response);
	}else{
		$response["error"] = true;
		$response["message"] = "Image Delete failed!";
		echoRespnse(400, $response);
	}
	
});


$app->post('/postAdImage', function() use ($app){
	$response = array();
	$ad = $app->request()->getBody();
	$params = $app->request()->params();
	$db = new DbHandler();
	$img = false;
	for($i=0; $i < count($params); $i++){
		if($db->addAdImage($params[$i],$ad))
		$img = true;
		else
		$img = false;
	}
	if($img){
		$response["error"] = false;
		$response["message"] = "Advertisment created successfully";
		echoRespnse(201, $response);
	}else{
		$response["error"] = true;
		$response["message"] = "Failed to update Images. Please try again";
		echoRespnse(400, $response);
	}
});

/**
 * Get advertismentsByLocation 
 * url - /advertisment
 * method - GET
 * params -advertisments*/		
$app->get('/advertismentsBYlocation', function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$response = array();
		$DbHandler = new DbHandler();	
		$result = $DbHandler->advertismentsByLocation($params);
        if ($result != NULL) {
        	$response["error"] = false;
				$response['advertisments'] = json_decode($result);
                echoRespnse(200	, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });	 



// * list all categories 
// * url - /category
// * method - get
// * params -  
  
$app->get('/category2', function() {	
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();

		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getAllCategories($params);

		if(!$result){
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}else{
			$response["error"] = false;
			$response['categories'] = json_decode($result);
			echoRespnse(200, $response);
		}
});




// * list of sub-categories belongs to each categories  
// * url - /categoryMatrix
// * method - get
// * params - 

$app->get('/categoryMatrix', function()  {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getCategoryMatrix($params);	
		
	if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response['categorymatrix']=json_decode($result);

			echoRespnse(200, $response);
		}
});
// * list of similarItems to advertisments
// * url - /similarItems
// * method - get
// * params - 
$app->get('/similarItems', function()  {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getSimilarItems($params);	
		//print_r($result);
	if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response['items']=json_decode($result);

			echoRespnse(200, $response);
		}
});

	/**
	 * Get advertisments by category
	 * Tempararily created. 
	 * url - /advertismentsresults/id
	 * method - GET
	 * params -advertismentsresults*/
	$app->get('/advertismentsresults/:id', function($id) {
		//$request = \Slim\Slim::getInstance()->request();
		//	$params = $request->params();
		$response = array();
	
		$DbHandler = new DbHandler();
		$result = $DbHandler->advertismentsResults($id);
		if ($result != NULL) {
			$response["error"] = false;
			$response['advertisments'] = json_decode($result);
			
			echoRespnse(200	, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		}
	});
	
		/**
		 * Get advertisments
		 * url - /advertismentsresults
		 * method - GET
		* params -advertismentsresults*/
		$app->get('/advertismentsresults', function() {
			//$request = \Slim\Slim::getInstance()->request();
			//$params = $request->params();
			$parameter='';
			$response = array();
			$DbHandler = new DbHandler();
			$result = $DbHandler->advertismentsResults($parameter);
			if ($result != NULL) {
				$response["error"] = false;
				$response['advertisments'] = json_decode($result);
				echoRespnse(200	, $response);
			} else {
				$response["error"] = true;
				$response["message"] = "The requested resource doesn't exists";
				echoRespnse(404, $response);
			}
		});
		
		
		$app->get('/adlist', function() {
			$request = \Slim\Slim::getInstance()->request();
			$params = $request->params();
			$response = array();
			//print_r($params['category']);	
			$DbHandler = new DbHandler();
			$arr = array("category_alias" => "'".$params['category']."'");
			$cat = $DbHandler->getAllCategories($arr);
			//print_r($params['subcategory']);
			$count = $DbHandler->advertiesmentCount($params);
			$result = $DbHandler->advertiesmentsResults($params);
			$brands = array();
			if(isset($params['subcategory']) && trim($params['subcategory']) == 'mobile-phones'){
				$brands = array('acer','ag-tel',
							'alcatel', 'apple', 'asus', 'benq', 'blackberry', 'china-mobile','dell','e-tel','greentel','google-nexus','hp','htc','huawei','i-mate','ipro','lg','mega-gate','micromax','motorola','nokia','palm','philips','q-mobile','samsung','sky','sony','sony-ericsson','zigo','zte');
			}else if(isset($params['subcategory']) && trim($params['subcategory']) == 'cars'){
				$brands = array('alfa-romeo','aston-martin','audi','austin','bmw','buick','cadillac','changan','chery','chevrolet','chrysler','citroen','daewoo','daihatsu','datsun','dodge','ferrari','fiat','ford','geely','gmc','hino','honda','hummer','hyundai','isuzu','jaguar','jeep','kia','lamborghini','land-rover','lexus','lincoln','mahindra','maruti','mazda','mercedes-benz','mg','micro','mini','mitsubishi','morris','moto-guzzi','nissan','oldsmobile','opel','perodua','peugeot','plymoth','pontiac','porsche','proton','renault','rover','royal-enfield','saab','scion','seat','skoda','smart','ssang-yong','subaru','suzuki','tata','toyota','vauxhall','volkswagen','volvo','zoyte');
			}else{
				$brands = array();	
			}
			if ($result != NULL) {
				$response["error"] = false;
				$response['advertisments'] = json_decode($result);
				$response['category'] = json_decode($cat);
				$response['count'] = $count;
				if(count($brands)>0)
				$response['brands'] = $brands;
				echoRespnse(200	, $response);
			} else {
				$response["error"] = true;
				$response["message"] = "The requested resource doesn't exists";
				echoRespnse(404, $response);
				
			}
		});
	

	/*
		ADD Comments 
	*/
	$app->post('/comments/:id', 'authenticate', function($id) use ($app) {
		
		$response = array();           
		$request = \Slim\Slim::getInstance()->request();
		//$params = $request->params();
		$comment = $request->getBody();
		$DbHandler = new DbHandler();
		$result = $DbHandler->addComment($comment,$id);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "Comment Added successfully";                
			echoRespnse(201, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "Failed to add the Comment. Please try again";
			echoRespnse(400, $response);
		}            
	});

	/*Get All Comments*/

	$app->get('/getComments', function() {
			$request = \Slim\Slim::getInstance()->request();
			$params = $request->params();
			$response = array();
			$DbHandler = new DbHandler();
			$result = $DbHandler->getComments($params);
			if ($result != NULL) {
				$response["error"] = false;
				$response['comments'] = json_decode($result);
				echoRespnse(200	, $response);
			} else {
				$response["error"] = true;
				$response["message"] = "The requested resource doesn't exists";
				echoRespnse(404, $response);
			}
		});

/**
 * User Profile
 * url - /userProfile
 * method - PUT
 * params - $user Profile object
 */
$app->put('/userProfile','authenticate', function() use ($app) {
            
        $users  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$userProfile = $request->getBody();
		//echo print_r($users);	
		global $user_id;
		if($DbHandler->updateUserProfile($user_id,$userProfile)){
					$response["error"] = false;
					$response["message"] = "User Profile details updated suceesfully";
					echoRespnse(200, $response);
		}
});

$app->post('/mail', function() {
			$request = \Slim\Slim::getInstance()->request();
			$content = $request->getBody();
			$response = array();
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: dhammika <dhammika97@gmail.com>' . "\r\n";
			if (sendMail($content, $headers)) {
				$response["error"] = false;
				$response["message"] = "Mail successfully sent";
				echoRespnse(200	, $response);
			} else {
				$response["error"] = true;
				$response["message"] = "Something wrong, mail not sent";
				echoRespnse(404, $response);
			}
		});


/**
 * Get all videos
 * url - /video
 * method - GET
 * params - api Key*/

$app->get('/video', function() {
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$response = array();
		$DbHandler = new DbHandler();		
		$video = $DbHandler->getAllVideo($params);
		if (!$video) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["video"]=json_decode($video);
			echoRespnse(200, $response);
		}
});

/**
 * Get video by video id
 * url - /video/:id
 * method - GET
 * params -video id*/		
$app->get('/video/:id', function($video_id) {
		$response = array();
		$DbHandler = new DbHandler();	
		$video = $DbHandler->GetVideoDetail($video_id);
        if ($video != NULL) {
        	$response["error"] = false;
				$response['video'] = json_decode($video);
                echoRespnse(200	, $response);
            } else {
                $response["error"] = true;
                $response["message"] = "The requested resource doesn't exists";
                echoRespnse(404, $response);
            }
        });	 

/**
 * Create video 
 * url - /video
 * method - POST
 * params -video object*/

$app->post('/video', 'authenticate', function() use ($app) {
		$packageType  = array();
		$response = array();
		$request = $app->request();
		$DbHandler = new DbHandler();

		$video = $request->getBody();		
		//verifyRequiredParams(array("user_email", "user_password"));
		if($DbHandler->createVideo($video)){
			$response["error"] = false;
			$response["message"] = "Video created successfully";
			echoRespnse(201, $response);				
			}else{
			$response["error"] = true;
			$response["message"] = "Video creation failed";
			echoRespnse(400, $response);
		}
});
		
/**
 * Update video 
 * url - /video/:id
 * method - PUT
 * params - video object */
$app->put('/video/:id', 'authenticate', function($video_id) use ($app) {
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$video =  $request->getBody();
		$result = $DbHandler->updateVideo($video_id, $video);
		if ($result) {
			$response["error"] = false;
			$response["message"] = "Video updated successfully";
			echoRespnse(200, $response);
		} else {                
			$response["error"] = true;
			$response["message"] = "Video failed to update. Please try again!";
			echoRespnse(404, $response);
		}				
});
 					
/**
 * Delete video
 * url - /video/:id
 * method - DELETE
 * params - video id */ 
$app->delete('/video/:id', 'authenticate', function($video_id) use($app) {
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteVideo($video_id);
		
		if ($result) {			
			$response["error"] = false;
			$response["message"] = "Video deleted succesfully";
			echoRespnse(200, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "Video to delete. Please try again!";
			echoRespnse(404, $response);
		}
});
$app->get('/userActivation/:id', function($hash)  {
		
		$DbHandler = new DbHandler();
		$response = array();
		$activater = array('user_status' => '1');
		$id = (($hash-1603894240973228)*2)/300;
		$result = $DbHandler->updateUser($id,$activater);	
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "User activation failed";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["message"] = "User activated successfully";

			echoRespnse(200, $response);
		}
});

/* 
	// * list of sub-categories belongs to each categories and respective user account/package
	// * url - /categoryMatrixPackageBinding
	// * method - get
	// * params -
		
	$app->get('/categoryMatrixPackageBinding', function()  {
		global $user_id;
		$request = \Slim\Slim::getInstance()->request();
		$params = $request->params();
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getCategoryMatrixPackageBinding();
			
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response['categorymatrix']=json_decode($result);
				
			echoRespnse(200, $response);
		}
	}); */
	

		/**
		 * Create  Advertisment
		 * url 		- /advertisment
		 * method 	- POST
		 * params 	- Advertisment  object*/
		
		$app->post('/advertisment', 'authenticate', function() use ($app) {
			$response = array();
			$request = \Slim\Slim::getInstance()->request();
			$adDetails = $request->getBody();
			$db = new DbHandler();
			global $user_id;
			//$category = $db->GetsubCategoryDetail($adDetails['advertisement_subCategoryId']);
			if($adId = $db->createAdvertisment($adDetails)){
				if($adId=='No_inventory'){
						
					//echo '234';
					$response["error"] = false;
					$response['message']="No free ads remaining with your current account";
						
					echoRespnse(200, $response);
				}else {
					$response["error"] = false;
					$response["message"] = "Advertisment created successfully";
					$response["insertedId"]=$adId;
					echoRespnse(201, $response);
				}
					
			}else{
				$response["error"] = true;
				$response["message"] = "Failed to create Advertisment. Please try again";
				echoRespnse(400, $response);
			}
		});
		
		
			/**
			 * Category user package wise
			 * url - /categoryuserwise/:id
			 * method - POST
			 * params - $user Profile object
			*/
			$app->put('/userProfile/:id', function($id){
		
				$users  = array();
				$response = array();
				$request = $app->request();
				$DbHandler = new DbHandler();
		
				$userProfile = $request->getBody();
				//echo print_r($users);
		
				if($DbHandler->updateUserProfile($id,$userProfile)){
					$response["error"] = false;
					$response["message"] = "User Profile details updated suceesfully";
					echoRespnse(200, $response);
				}
			});
		
		
				// * post ads - availability based on each user account/package
				// * url - /categoryuserwise
				// * method - get
				// * params -
					
				$app->get('/categoryuserwise','authenticate', function() {
					global $user_id;
					$parameter='';
					$response = array();
					$DbHandler = new DbHandler();
		
					$result = $DbHandler->getPackageAvailability();
		
					if ($result != NULL) {
						$response["error"] = false;
						$response['packageDetails'] = $result;
						echoRespnse(200	, $response);
					} else {
						$response["error"] = true;
						$response["message"] = "The requested resource doesn't exists";
						echoRespnse(404, $response);
					}
				});
		
		
		
					// * list of sub-categories belongs to each categories and respective user account/package
					// * url - /categoryMatrixPackageBinding
					// * method - get
					// * params -
						
					$app->get('/categoryMatrixPackageBinding','authenticate', function()  {
						global $user_id;
						$request = \Slim\Slim::getInstance()->request();
						$params = $request->params();
						$DbHandler = new DbHandler();
						$response = array();
						$result = $DbHandler->getCategoryMatrixPackageBinding($user_id);
							
						if (!$result) {
							$response["error"] = TRUE;
							$response["message"] = "The requested resource doesn't exists";
							echoRespnse(404, $response);
						} else {
							$response["error"] = false;
							$response['categorymatrix']=json_decode($result);
								
							echoRespnse(200, $response);
						}
					});
					
$app->put('/publishAd/:id', function($id)  {
		
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->confirmAdvertisment($id);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "Advertisemet publish failed!";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["message"] = "Advertisement added successfully. Your ad will be reviewed and publish in a while..  ";

			echoRespnse(200, $response);
		}
});

// * list of pending advertisments
// * url - /advertismentsAdmin
// * method - get
// * params -
$app->get('/advertismentsAdmin', function()  {
		
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getPendingAdvertisments();
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["advertisments"] = json_decode($result);

			echoRespnse(200, $response);
		}
});
$app->put('/advertismentsAdmin/:id', 'authenticate', function($id)  {
		
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->approveAdvertisment($id);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["message"] = "Advertisement Approved";

			echoRespnse(200, $response);
		}
});	
$app->delete('/advertismentsAdmin/:id', 'authenticate', function($id)  {
		
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteAdvertisment($id);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["message"] = "Advertisement Denied";
			echoRespnse(200, $response);
		}
});	
$app->get('/CommentsAdmin', function() {
			$response = array();
			$DbHandler = new DbHandler();
			$result = $DbHandler->getCommentsAdmin();
			if ($result != NULL) {
				$response["error"] = false;
				$response['comments'] = json_decode($result);
				echoRespnse(200	, $response);
			} else {
				$response["error"] = true;
				$response["message"] = "The requested resource doesn't exists";
				echoRespnse(404, $response);
			}
		});
		
$app->put('/CommentsAdmin/:id',  function($id)  {
		
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->approveComments($id);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["message"] = "Comment Approved";

			echoRespnse(200, $response);
		}
});	
$app->delete('/CommentsAdmin/:id',  function($id)  {
		
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->deleteComments($id);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["message"] = "Comment Denied";
			echoRespnse(200, $response);
		}
});	


		/** Apply job, service receiver.... 
		  * Processing job apply massegae sending part and
 		  * Put an entry to the DB
 		  * */
		
$app->post('/applyjob', 'authenticate', function() use ($app) {
			global $user_id;
			$response = array();
			$request = \Slim\Slim::getInstance()->request();
			$jobApplyDetails = $request->getBody();
			$db = new DbHandler();
			global $user_id;
			if($adId = $db->processJobApply($jobApplyDetails)){
				if($adId=='No_inventory'){
		
					//echo '234';
					$response["error"] = false;
					$response['message']="No jobs apply attempts remaining with your current account";
		
					echoRespnse(200, $response);
				}else {
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: qatarone <qatarq1@gmail.com>' . "\r\n";
					if (sendMail($jobApplyDetails, $headers)) {
					$response["error"] = false;
					$response["message"] = "Job request sent successfully";
					echoRespnse(201, $response);
					} else {
						$response["error"] = true;
						$response["message"] = "Something wrong, mail not sent";
						echoRespnse(404, $response);
					}
					
				}
					
			}else{
				$response["error"] = true;
				$response["message"] = "Failed to send Job request. Please try again";
				echoRespnse(400, $response);
			}
});


	/** View job applied information, service receiver....
	 * 
	 * Pull data from DB
	 * */

$app->get('/applyjobsdetails', 'authenticate', function()  {
	global $user_id;
		$DbHandler = new DbHandler();
		$response = array();
		$result = $DbHandler->getJobsApplyInformation($user_id);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["jobsinfo"] = json_decode($result);

			echoRespnse(200, $response);
		}
});



	
/** update star rating, service receiver....
	 * update DB
	 * */
	
	$app->post('/rating', 'authenticate', function() use ($app) {
		global $user_id;
		$response = array();
		$request = \Slim\Slim::getInstance()->request();
		$ratingDetails = $request->getBody();
		$db = new DbHandler();
		if($adId = $db->updateRating($ratingDetails)){
			$response["error"] = false;
			$response["message"] = "Rating updated successfully";
			echoRespnse(201, $response);
		}else{
			$response["error"] = true;
			$response["message"] = "Rating update... failed";
			echoRespnse(400, $response);
		}
	});
	
		/** get calculated star rating, service receiver....
		 * Pull data from DB
		* */
		$app->get('/rating/:id', function($adId)  {
				
			$DbHandler = new DbHandler();
			$response = array();
			$result = $DbHandler->getRating($adId);
			if (!$result) {
				$response["error"] = TRUE;
				$response["message"] = "The requested resource doesn't exists";
				echoRespnse(404, $response);
			} else {
				$response["error"] = false;
				$response["ratingvalue"] = $result;
	
				echoRespnse(200, $response);
			}
		});

/**
 * User Profile update
 * url - /userProfileUpdate
 * method - PUT
 * params - $user Profile object
 */
$app->put ( '/userProfileUpdate', 'authenticate', function () use($app) {
	
	$users = array ();
	$response = array ();
	$request = $app->request ();
	$DbHandler = new DbHandler ();
	
	$userProfile = $request->getBody ();
	// echo print_r($users);
	global $user_id;
	$results = $DbHandler->updateUserDetails ( $user_id, $userProfile );
	
	if ($results != 'true') {
		$response ["error"] = true;
		$response ["message"] = $results;
		echoRespnse ( 200, $response );
	} else {
		$response ["error"] = false;
		$response ["message"] = "User Profile details updated suceesfully";
		echoRespnse ( 200, $response );
	}
} );

	/**
	 * contact applicant email
	 */

	$app->post('/contactApplicantEmail','authenticate', function() {
		global $user_id;
		
		$request = \Slim\Slim::getInstance()->request();
		$content = $request->getBody();
		$response = array();
		$DbHandler = new DbHandler ();
		
		$fromAddr = $DbHandler->getUserEmailAddress($user_id);
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$fromAddr.'' . "\r\n";
		if (sendMail($content, $headers)) {
			$response["error"] = false;
			$response["message"] = "Mail successfully sent";
			echoRespnse(200	, $response);
		} else {
			$response["error"] = true;
			$response["message"] = "Something wrong, mail not sent";
			echoRespnse(404, $response);
		}
	});

/**
 * Get myAdvertisments
 * url - /myAdvertisments
 * method - GET
 */
$app->get ( '/myAdvertisments','authenticate', function () {
	global $user_id;
	$request = \Slim\Slim::getInstance()->request();
	$params = $request->params();
	$response = array ();
	$DbHandler = new DbHandler();
	$result = $DbHandler->myAdvertisments($user_id);
	if ($result != NULL) {
		$response ["error"] = false;
		$response ['myadvertisments'] = json_decode( $result );
		echoRespnse( 200, $response );
	} else {
		$response ["error"] = true;
		$response ["message"] = "The requested resource doesn't exists";
		echoRespnse( 404, $response );
	}
} );
// * Detail View of pending advertisments
// * url - /advertismentsAdmin/:id
// * method - get
// * params -id
$app->get('/advertismentsAdmin/:id', function($id)  {
		
		$DbHandler = new DbHandler();
		$response = array();
		$images = $DbHandler->adImages($id);
		$result = $DbHandler->getPendingAdvertismentDetail($id);
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "The requested resource doesn't exists";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["images"] = json_decode($images);
			$response["advertisment"] = json_decode($result);

			echoRespnse(200, $response);
		}
});


/**
 * Send User forgot password link
 * url - /sendforgotPSWDLink
 * method - POST
 * params - $userforgotPSWDEmail  object
 */
$app->post ( '/sendforgotPSWDLink',  function () use($app) {
	
	
			$response = array();
			$request = \Slim\Slim::getInstance()->request();
			$userforgotPSWDEmail = $request->getBody();
			$db = new DbHandler();
			
			$forgotPSWDUser = $db->getUserByEmail($userforgotPSWDEmail);
			
			if ($forgotPSWDUser != NULL) {
				
					$headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: qatarone <qatarq1@gmail.com>' . "\r\n";
                    $content['fname'] = $forgotPSWDUser['user_firstname'];
                    $content['to'] = $forgotPSWDUser['user_email'];
                    $content['mailType'] = "forgotPasswordActivation";
                    $content['key'] = (($forgotPSWDUser['user_id']*300)/2)+1603894240973228;
                                                  
                    sendMail($content, $headers);
				    $response["error"] = false;
				    $response["message"] = "Congradulations! We have sent an password reset email link to ".$forgotPSWDUser['user_email']."";
				    echoRespnse(200, $response);
					

			} else {
				// unknown error occurred
				$response['error'] = true;
				$response['message'] = "User Does not exist";
				echoRespnse(404, $response);
			}

		
} );		

/**
 * User reset password update
 * url - /forgotPasswordUpdate/:id
 * method - PUT
 * params - $hash user's new hashed password
 */
$app->put ( '/forgotPasswordUpdate/:id', function ($hash) use($app) {
	
		$request = $app->request();
		$DbHandler = new DbHandler();
		$response = array();
		$userProfile= array();

		$forgotPSWDUser =  $request->getBody();		
		$userProfile['user_New_password']=$forgotPSWDUser['newPassword'];

		$id = (($hash-1603894240973228)*2)/300;		
		
		$result = $DbHandler->updatePassWord($id,$userProfile);		
		//$result=true;	
		if (!$result) {
			$response["error"] = TRUE;
			$response["message"] = "User password resetting failed";
			echoRespnse(404, $response);
		} else {
			$response["error"] = false;
			$response["message"] = "User password reset done successfully";
			echoRespnse(200, $response);
		}
} );

$app->run();
		
		
?>
