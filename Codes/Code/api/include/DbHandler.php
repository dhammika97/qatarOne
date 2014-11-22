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
		$where = 'category_status = "1" ';
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
}

?>
