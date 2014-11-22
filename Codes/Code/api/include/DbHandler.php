<?php

/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 */
class DbHandler {

	public function isValidAccessToken($user_accessToken) {     
		$db = new database();
		$table = 'user';
		$rows ='*';
		$where = 'user_accessToken = "'.$user_accessToken.'"';	
		$db->select($table,$rows,$where,'','');
		$user = $db->getResults();
		return $user;	
	}
	
	public function getUserId($api_key) {
		$stmt = $this->conn->prepare("SELECT id FROM users WHERE api_key = ?");
		$stmt->bind_param("s", $api_key);
		if ($stmt->execute()) {
			$stmt->bind_result($user_id);
			$stmt->fetch();
			$stmt->close();
			return $user_id;
		} else {
			return NULL;
		}
	}

	private function generateApiKey() {
		return md5(uniqid(rand(), true));
	}

	public function getAllUsers() {   
		$db = new database();
		$table = 'user';
		$rows ='*';	
		$db->select($table,$rows,'','','');
		$user_list = $db->getResults();
		return $user_list;
	}

	public function GetUserDetail($user_id) {
		$db = new database();
		$table = 'user';
		$rows ='*';
		$where = 'user_id = "'.$user_id.'"';	
		$db->select($table,$rows,$where,'','');
		$user = $db->getResults();
		return $user;
	}
	
   
	public function createUser( $users) {
		$date= date('y-m-d');
		$db = new database();
		$table  = "user";
		$values = "'".$users['user_username']."', 
					  '".md5 ($users['user_password'])."', 
					  '".$users['user_email']."', 
					  '".$users['user_firstname']."', 
					  '".$users['user_lastname']."', 
					  '".$users['user_address1']."', 
					  '".$users['user_address2']."', 
					  '".$users['user_city']."',
					  '".$users['user_contactNo']."', 
					  '".$date."', 
					  '".$users['user_type']."',
					  '".$users['user_type']."'";					  
		$rows   = "user_username, 
				   user_password,
				   user_email,
				   user_firstname,
				   user_lastname,
				   user_address1,
				   user_address2,
				   user_city,
				   user_contactNo,
				   user_registeredDate,
				   user_type,
				   user_accessToken";		
		if($db->insert($table,$values,$rows) ){
			return true;
		}else{
			return false;
		}				
	}
	
	public function updateUser($user_id, $users) {       
		$db = new database();	
		$table = 'user';
		$rows  = $users ;
		$where = 'user_id = "'.$user_id.'"';
		if($db->update($table,$rows,$where) ){
			return true;
		}else{
			return false;
		}
	}
	

	public function deleteUser($user_id) { 
		$db = new database();
		$table = 'user';
		$where = 'user_id = "'.$user_id.'" ';
		if ($db->delete($table,$where) ){
			return true;
		}		
	}
    
	public function getAllFixedAd() {
		$db = new database();    
		$table = 'fixedads';
		$rows ='*';
		$db->select($table,$rows,'','','');
		$fixedad_list = $db->getResults();
		return $fixedad_list;
	}

	public function GetFixedAdvertismentDetail($fixedads_id) {           
		  $db = new database();
		  $table = 'fixedads';
		  $rows ='*';
		  $where = 'fixedads_id = "'.$fixedads_id.'"';
		  $db->select($table,$rows,$where,'','');
		  $user = $db->getResults();
		  return $user; 
	}

	public function createFixedAdvertisment( $fixed_advertisment) {
		$db = new database();
		$table  = "fixedads";
		$values = "'".$fixed_advertisment['fixedads_type']."',
				  '".$fixed_advertisment['fixedads_image']."', 
				  '".$fixed_advertisment['fixedads_enetredDate']."', 
				  '".$fixed_advertisment['fixedads_url']."',              
				  '".$fixed_advertisment['fixedads_status']."'";
		$rows="fixedads_type, 
			   fixedads_image,
			   fixedads_enetredDate,
			   fixedads_url,
			   fixedads_status";
		if($db->insert($table,$values,$rows) ){
			return true;
		}else{
			return false;
		}				
	}


	public function updateFixedAdvertisment($fixedads_id, $fixed_advertisment) {       
	   $db = new database();   
	   $table = 'fixedads';
	   $rows  = $fixed_advertisment ;
	   $where = 'fixedads_id = "'.$fixedads_id.'"';
	   if($db->update($table,$rows,$where) ){
			return true;
	   }else{
			return false;
	   }
	}
	
	public function deleteFixedAdvertisment($fixedads_id) { 
		$db = new database();
		$table = 'fixedads';
		$where = 'fixedads_id = "'.$fixedads_id.'" ';
		if ($db->delete($table,$where) ){
			return true;
		} else{
			return false;
		}
	}
	
	public function getAllCategories(){
		$db = new database();  
		$table = 'category';
		$rows ='*';
		$where = 'category_status = "1" ';
		$db->select($table,$rows,$where,'','');
		$category_list = $db->getResults();
		return $category_list;
	}	

	public function GetCategoryDetail($category_id){
		$db = new database();
		$table = 'category';
		$rows ='*';
		$where = 'category_id = "'.$category_id.'" AND category_status = "1" ';
		$db->select($table,$rows,$where,'','');
		$user = $db->getResults();
		return $user;			
	}

	public function addCategory($category){
		$db = new database();
		$table1 = 'category';
		$rows1 ='category_name';
		$where1 = 'category_name = "'.$category['category_name'].'"';
		$db->select($table1,$rows1,$where1,'','');
		$categoryNumRows = $db->getNumRows();	
		if( $categoryNumRows > 1 ){
			return false;
		}
		$table  = "category";
		$values = "'".$category['category_name']."', '".$category['category_enteredBy']."' , '".$category['category_parentId']."'";				
		$rows   = "category_name, category_enteredBy, category_parentId";		
		if($db->insert($table,$values,$rows) ){
			return true;
		}
	}
	
	public function updateCateory( $category, $category_id){
		$db = new database();	   
		$table = 'category';
		$rows  = $category;
		$where = 'category_id = "'.$category_id.'"';
		if($db->update($table,$rows,$where) ){
			return true;
		}else{
			return false;
		}
	}

	public function deleteCategory($category_id){
		$db = new database();
		$table = 'category';
		$where = 'category_id = "'.$category_id.'" ';
		if ($db->delete($table,$where) ){
			return true;
		}	
	}

	public function getAllsubCategorys(){	
		$db = new database();
		$table = 'category_sub';
		$rows ='*';
		$Where= 'category_sub_status = "1"';	
		$db->select($table,$rows,$Where,'','');
		$subcategories = $db->getResults();
		return $subcategories;
	}

	public function GetsubCategoryDetail($id){
		$db = new database();
		$table = 'category_sub';
		$rows ='*';
		$where = 'category_sub_id = "'.$id.'" AND category_sub_status = "1" ';
		$db->select($table,$rows,$where,'','');
		$subcategory = $db->getResults();
		return $subcategory;	
	}

	public function addsubCategory($category){	
		$db = new database();
		$table  = "category_sub";
		$values = "'".$category['category_sub_name']."', '".$category['category_sub_enteredBy']."' , '".$category['category_sub_parentId']."'";				
		$rows   = "category_sub_name, category_sub_enteredBy, category_sub_parentId";
		if($db->insert($table,$values,$rows) ){
			return true;
		}	
	}
	
	public function updatesubCategory($subCategory, $category_sub_id){
		$db = new database();  
		$table = 'category_sub';
		$rows  = $subCategory ;
		$where = 'category_sub_id = "'.$category_sub_id.'"';
		if($db->update($table,$rows,$where) ){
			return true;
		}else{
			return false;
		}
	}	
	
	public function deleteSubCategory($category_sub_id){
		$db = new database();
		$table = 'category_sub';
		$where = 'category_sub_id = "'.$category_sub_id.'" ';
		if ($db->delete($table,$where) ){
				return true;
		}
	}
	
	public function createLocation($location){
		$db = new database();
		$table  = "locations";
		$values = "'".$location['location_name']."', 
				'".$location['location_cordinates']."'";					  
		$rows   = "location_name, 
				   location_cordinates";		
		if($db->insert($table,$values,$rows) ){
			return true;
		}else{
			return false;
		}
	}
	
	public function getAllLocations(){
		$db = new database();
		$table = 'locations';
		$rows ='*';	
		$db->select($table,$rows,'','','');
		$location_list = $db->getResults();
		return $location_list;
	}
	
	public function updateLocation($location_id, $locations){
		$db = new database();	
		$table = 'locations';
		$rows  = $locations ;
		$where = 'location_id = "'.$location_id.'"';
		if($db->update($table,$rows,$where) ){
			return true;
		}else{
			return false;
		}
	}
	
	public function deleteLocation($location_id){
		$db = new database();
		$table = 'locations';
		$where = 'location_id = "'.$location_id.'" ';
		if ($db->delete($table,$where) ){
			return true;
		}
	}
	
	public function getLocationDetail($location_id){
		$db = new database();
		$table = 'locations';
		$rows ='*';
		$where = 'location_id = "'.$location_id.'"';
		$db->select($table,$rows,$where,'','');
		$page = $db->getResults();
		return $page;
	}
	
	public function addPage($page){
		$db = new database();
		$table1 = 'pages';
		$rows1 ='page_title';
		$where1 = 'page_title = "'.$page['page_title'].'"';
		$db->select($table1,$rows1,$where1,'','');
		$pageNumRows = $db->getNumRows();	
		if( $pageNumRows > 1 ){
			return false;
		}
		$table  = "pages";
		$values = "'".$page['page_title']."', '".$page['page_addedBy']."'";				
		$rows   = "page_title, page_addedBy";		
		if($db->insert($table,$values,$rows) ){
			return true;
		}
	}
	public function updatePages($page, $page_id){
		$db = new database();  
		$table = 'pages';
		$rows  = $page;
		$where = 'page_id = "'.$page_id.'"';
		if($db->update($table,$rows,$where) ){
			return true;
		}else{
			return false;
		}
	}	
	public function deletePage($page_id){
		$db = new database();
		$table = 'pages';
		$where = 'page_id = "'.$page_id.'"';
		if ($db->delete($table,$where) ){
				return true;
		}
	}
	
	public function getAllPages(){
		$db = new database();  
		$table = 'pages';
		$rows ='*';
		$where = 'page_status = "1" ';
		$db->select($table,$rows,$where,'','');
		$pages_list = $db->getResults();
		return $pages_list;
	}
	public function GetPageDetail($page_id){
		$db = new database();
		$table = 'pages';
		$rows ='*';
		$where = 'page_id = "'.$page_id.'" AND page_status = "1" ';
		$db->select($table,$rows,$where,'','');
		$page = $db->getResults();
		return $page;			
	}	

	 public function checkLogin($user_email, $user_password) {
	  $db = new database();	
      $table = 'user';
      $rows ='*';
      $where = 'user_email= "'.$user_email.'"';
    
      $db->select($table,$rows,$where,'','');
      $logged_User = $db->getResults();
    
     if ($logged_User != NULL) {            
         if (PassHash::check_password($logged_User["user_password"], $user_password)) {
           		return TRUE;
       		} else {           		      		
           		return FALSE;
       		}               
        } else {                  
       		return FALSE;
        }       
   }

	public function getUserByEmail($user_email) {
      $db = new database();
	  // fetching user by email
      $table = 'user';
      $rows ='*';
      $where = 'user_email= "'.$user_email.'"';
    
      $db->select($table,$rows,$where,'','');
      $logged_User = $db->getResults();
 	  return $logged_User;

   }
   	
	public function addPageContent($pageContent){
		$db = new database();
		$table1 = 'pagecontent';
		$rows1 ='pageContent_pageTitle';
		$where1 = 'pageContent_pageTitle = "'.$pageContent['pageContent_pageTitle'].'"';
		$db->select($table1,$rows1,$where1,'','');
		$pageNumRows = $db->getNumRows();	
		if( $pageNumRows > 1 ){
			return false;
		}
		$table  = "pagecontent";
		$values = "'".$pageContent['pageContent_pageTitle']."', '".$pageContent['pageContent_Description']."'";				
		$rows   = "pageContent_pageTitle, pageContent_Description";		
		if($db->insert($table,$values,$rows) ){
			return true;
		}
	}
	public function updatePagesContent($pageContent, $pageContent_id){
		$db = new database();  
		$table = 'pagecontent';
		$rows  = $pageContent;
		$where = 'pageContent_id = "'.$pageContent_id.'"';
		if($db->update($table,$rows,$where) ){
			return true;
		}else{
			return false;
		}
	}	
	public function deletePageContent($pageContent_id){
		$db = new database();
		$table = 'pagecontent';
		$where = 'pageContent_id = "'.$pageContent_id.'"';
		if ($db->delete($table,$where) ){
				return true;
		}
	}
	
	public function getAllPagesContent(){
		$db = new database();  
		$table = 'pagecontent';
		$rows ='*';
		
		$db->select($table,$rows,'','','');
		$pages_list = $db->getResults();
		return $pages_list;
	}
	public function GetPageContentDetail($pageContent_id){
		$db = new database();
		$table = 'pagecontent';
		$rows ='*';
		$where = 'pageContent_id = "'.$pageContent_id.'"';
		$db->select($table,$rows,$where,'','');
		$page = $db->getResults();
		return $page;			
	}
	
	
	public function createSuburb($suburb){
		$db = new database();
		$table  = "suburbs";
		$values = "'".$suburb['suburb_location_id']."', 
				'".$suburb['suburb_name']."',
				'".$suburb['suburb_cordinates']."'";					  
		$rows   = "suburb_location_id, 
				   suburb_name,
				   suburb_cordinates";		
		if($db->insert($table,$values,$rows) ){
			return true;
		}else{
			return false;
		}
	}
	
	public function getAllSuburbs(){
		$db = new database();
		$table = 'suburbs';
		$rows ='*';	
		$db->select($table,$rows,'','','');
		$location_list = $db->getResults();
		return $location_list;
	}
	
	public function GetSuburbDetail($suburb_id){
		$db = new database();
		$table = 'suburbs';
		$rows ='*';
		$where = 'suburb_id = "'.$suburb_id.'"';
		$db->select($table,$rows,$where,'','');
		$page = $db->getResults();
		return $page;
	}
	
	public function updateSuburb($suburb_id, $suburbs){
		$db = new database();	
		$table = 'suburbs';
		$rows  = $suburbs ;
		$where = 'suburb_id = "'.$suburb_id.'"';
		if($db->update($table,$rows,$where) ){
			return true;
		}else{
			return false;
		}
	}
	
	public function deleteSuburb($suburb_id){
		$db = new database();
		$table = 'suburbs';
		$where = 'suburb_id = "'.$suburb_id.'" ';
		if ($db->delete($table,$where) ){
			return true;
		}
	}
	
	public function addEvent($event){
		$db = new database();
		$table1 = 'events';
		$rows1 ='event_title';
		$where1 = 'event_title = "'.$event['event_title'].'"';
		$db->select($table1,$rows1,$where1,'','');
		$pageNumRows = $db->getNumRows();	
		if( $pageNumRows > 1 ){
			return false;
		}
		
		$table  = "events";
		$values = "'".$event['event_title']."', '".$event['event_date']."', 
				  '".$event['event_shortDescription']."', '".$event['event_description']."', '".$event['event_image']."'";				
		$rows   = "event_title, event_date, event_shortDescription, event_description,event_image";		 
		if($db->insert($table,$values,$rows) ){
			return true;
		}
	}
	public function updateEvent($event, $event_id){
		$db = new database();  
		$table = 'events';
		$rows  = $event;
		$where = 'evenet_id = "'.$event_id.'"';
		if($db->update($table,$rows,$where) ){
			return true;
		}else{
			return false;
		}
	}	
	public function deleteEvent($event_id){
		$db = new database();
		$table = 'events';
		$where = 'evenet_id = "'.$event_id.'"';
		if ($db->delete($table,$where) ){
				return true;
		}
	}
	
	public function getAllEvents(){
		$db = new database();  
		$table = 'events';
		$rows ='*';
		$where = 'event_status = "1" ';
		$db->select($table,$rows,$where,'','');
		$pages_list = $db->getResults();
		return $pages_list;
	}
	public function GetEventDetail($evenet_id){
		$db = new database();
		$table = 'events';
		$rows ='*';
		$where = 'evenet_id = "'.$evenet_id.'" AND event_status = "1" ';
		$db->select($table,$rows,$where,'','');
		$page = $db->getResults();
		return $page;			
	}
	
	public function createSlider($slider){
		$db = new database();
		$table  = "sliders";
		$values = "'".$slider['slider_title']."', 
				'".$slider['slider_image']."',
				'".$slider['slider_url']."',
				'".$slider['slider_status']."'";					  
		$rows   = "slider_title, 
				   slider_image,
				   slider_url,
				   slider_status";		
		if($db->insert($table,$values,$rows) ){
			return true;
		}else{
			return false;
		}
	}
	
	public function getAllSliders(){
		$db = new database();
		$table = 'sliders';
		$rows ='*';	
		$db->select($table,$rows,'','','');
		$location_list = $db->getResults();
		return $location_list;
	}
	
	public function GetSliderDetail($slider_id){
		$db = new database();
		$table = 'sliders';
		$rows ='*';
		$where = 'slider_id = "'.$slider_id.'"';
		$db->select($table,$rows,$where,'','');
		$page = $db->getResults();
		return $page;
	}
	
	public function updateSlider($slider_id, $slider){
		$db = new database();	
		$table = 'sliders';
		$rows  = $slider ;
		$where = 'slider_id = "'.$slider_id.'"';
		if($db->update($table,$rows,$where) ){
			return true;
		}else{
			return false;
		}
	}
	
	public function deleteSlider($slider_id){
		$db = new database();
		$table = 'sliders';
		$where = 'slider_id = "'.$slider_id.'" ';
		if ($db->delete($table,$where) ){
			return true;
		}
	}
}

?>
