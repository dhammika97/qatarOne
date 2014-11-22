<?php

/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 */
class DbHandler {




      /**
     * Validating user Access Token 
     * If the Access Token  is there in db, it is a valid key
     * @param String $user_accessToken,  user Access Token 
     * @return boolean
     */
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
            // TODO
            // $user_id = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user_id;
        } else {
            return NULL;
        }
    }

    /**
     * Generating random Unique MD5 String for user Api key
     */
    private function generateApiKey() {
        return md5(uniqid(rand(), true));
    }

  
  //===================Changes are starting from here============
   	
  /**
     * Retreving all users
    */
  public function getAllUsers() {
       
	    $db = new database();
	  
	  
		$table = 'user';
		$rows ='*';
		
        $db->select($table,$rows,'','','');
	    $user_list = $db->getResults();
        return $user_list;
    }

 /**
     * Retreving user by user id
     */
 	public function GetUserDetail($user_id) {
      
		$db = new database();
		$table = 'user';
		$rows ='*';
		$where = 'user_id = "'.$user_id.'"';
		
        $db->select($table,$rows,$where,'','');
	    $user = $db->getResults();
        return $user;	
    }
	

      /**
     * Creating user
     */
   
	public function createUser( $users) {
      		$date= date('y-m-d');
			$db = new database();
			$table  = "user";
			 $values = "'".$users['user_username']."', 
						  '".$users['user_password']."', 
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
	
	
	/**
     * Update user by user id
     */
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
	
	  /**
     * DELETE user by user id
     */
	 public function deleteUser($user_id) {
	 
		$db = new database();
		$table = 'user';
		$where = 'user_id = "'.$user_id.'" ';
		if ($db->delete($table,$where) ){
			return true;
		}
        //return $num_affected_rows > 0;
		
    }


        /**
     * Get all fixed add list 
     */
    
     public function getAllFixedAd() {
        
        $db = new database();    
    
        $table = 'fixedads';
        $rows ='*';
    
        $db->select($table,$rows,'','','');
        $fixedad_list = $db->getResults();
        return $fixedad_list;
    
    }


    
  /**
     * Get All Fixed Advertisments 
 */

    public function GetFixedAdvertismentDetail($fixedads_id) {           

      $db = new database();
      $table = 'fixedads';
      $rows ='*';
      $where = 'fixedads_id = "'.$fixedads_id.'"';
    
      $db->select($table,$rows,$where,'','');
      $user = $db->getResults();
      return $user; 
    }


    
  /**
     * Create   Fixed Advertisment 
 */

    public function createFixedAdvertisment( $fixed_advertisment) {

      $db = new database();
      $table  = "fixedads";
      $values = "'".$fixed_advertisment['fixedads_type']."',
              '".$fixed_advertisment['fixedads_image']."', 
              '".$fixed_advertisment['fixedads_enetredDate']."', 
              '".$fixed_advertisment['fixedads_url']."',              
              '".$fixed_advertisment['fixedads_status']."'";
              
              
      $rows   = "fixedads_type, 
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

    /**
     * Update Fixed Advertisment by Fixed Advertisment id
     */
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
	
  /**
     * DELETE Fixed Advertisment by Fixed Advertisment id
     */
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
	
	
	//========================Chages are done upto here===============================

    
	

//	
//  /**
//     * Get all fixed add list user by fixed advertisment id
//     */
//    
//     public function getAllFixedAd() {
//        $stmt = $this->conn->prepare("SELECT fixedads_id,
//                                        fixedads_type, 
//                                        fixedads_description, 
//                                        fixedads_note, 
//                                        fixedads_imageurl, 
//                                        fixedads_videourl, 
//                                        fixedads_enetreddate, 
//                                        fixedads_enteredby, 
//                                        fixedads_approvedstatus, 
//                                        fixedads_status 
//                                        FROM fixedads");   
//        $stmt->execute();
//        $user_list = $stmt->get_result();
//        $stmt->close();
//        return $user_list;
//    }
//
//    
//  /**
//     * Get fixed add details by fixed advertisment id
// */
//
//    public function GetFixedAdvertismentDetail($fixedads_id) {
//       
//        $stmt = $this->conn->prepare("SELECT * FROM fixedads where fixedads_id= ?");
//        $stmt->bind_param("i", $fixedads_id);
//        if ($stmt->execute()) {           
//            $fixedad = $stmt->get_result()->fetch_assoc();           
//            return $fixedad;
//        } else {
//            return NULL;
//        }
//    }
//
// /**
//     * Creating Fixed Advertisment
//     */
//
//    public function createFixedAdvertisment( $body) {
//        $stmt = $this->conn->prepare("INSERT INTO fixedads(  fixedads_type, 
//                                        fixedads_description, 
//                                        fixedads_note, 
//                                        fixedads_imageurl, 
//                                        fixedads_videourl, 
//                                        fixedads_enetreddate, 
//                                        fixedads_enteredby, 
//                                        fixedads_approvedstatus, 
//                                        fixedads_status ) 
//                                        VALUES(?,?,?,?,?,?,?,?,?)");
//        $stmt->bind_param("sssssssss", $body['fixedads_type'],
//                                                    $body['fixedads_description'],
//                                                    $body['fixedads_note'],
//                                                    $body['fixedads_imageurl'],
//                                                    $body['fixedads_videourl'],
//                                                    $body['fixedads_enetreddate'],
//                                                    $body['fixedads_enteredby'],
//                                                    $body['fixedads_approvedstatus'],
//                                                    $body['fixedads_status']
//                                                    );
//        $result = $stmt->execute();
//        $stmt->close();
//
//         // Check for successful insertion
//            if ($result) {
//                // Fixed Advertisment successfully inserted
//                return USER_CREATED_SUCCESSFULLY;
//            } else {
//                // Failed to create Fixed Advertisment
//                return USER_CREATE_FAILED;
//            }
//                    
//    }
//
//
// /**
//     * Update Fixed Advertisment by user id
//     */
//    public function updateFixedAdvertisment($fixedads_id, $body) {       
//            $stmt = $this->conn->prepare( " UPDATE fixedads 
//                                        SET fixedads_type, 
//                                        fixedads_description, 
//                                        fixedads_note, 
//                                        fixedads_imageurl, 
//                                        fixedads_videourl, 
//                                        fixedads_enetreddate, 
//                                        fixedads_enteredby, 
//                                        fixedads_approvedstatus, 
//                                        fixedads_status 
//                                        WHERE fixedads_id=?");
//        $stmt->bind_param("sssssssssi", $body['fixedads_type'],
//                                        $body['fixedads_description'],
//                                        $body['fixedads_note'],
//                                        $body['fixedads_imageurl'],
//                                        $body['fixedads_videourl'],
//                                        $body['fixedads_enetreddate'],
//                                        $body['fixedads_enteredby'],
//                                        $body['fixedads_approvedstatus'],
//                                        $body['fixedads_status'],
//                                        $fixedads_id);
//        $stmt->execute();
//        $num_affected_rows = $stmt->affected_rows;
//        $stmt->close();
//        return $num_affected_rows >0;
//            
//    }
//
//
// /**
//     * DELETE user by user id
//     */
//     public function deleteFixedAdvertisment($fixedads_id) {
//     
//        $stmt = $this->conn->prepare("DELETE FROM fixedads WHERE fixedads_id= ?");
//        $stmt->bind_param("i", $fixedads_id);
//        $stmt->execute();
//        $num_affected_rows = $stmt->affected_rows;
//        $stmt->close();
//        return $num_affected_rows > 0;
//    }
//    
//
//
//
//
//	 public function checkLogin($email, $password) {
//        // fetching user by email
//        $stmt = $this->conn->prepare("SELECT password_hash FROM users WHERE email = ?");
//
//        $stmt->bind_param("s", $email);
//
//        $stmt->execute();
//
//        $stmt->bind_result($password_hash);
//
//        $stmt->store_result();
//
//        if ($stmt->num_rows > 0) {
//            // Found user with the email
//            // Now verify the password
//
//            $stmt->fetch();
//
//            $stmt->close();
//
//            if (PassHash::check_password($password_hash, $password)) {
//                // User password is correct
//                return TRUE;
//            } else {
//                // user password is incorrect
//                return FALSE;
//            }
//        } else {
//            $stmt->close();
//
//            // user not existed with the email
//            return FALSE;
//        }
//    }
//	
//	
//	public function getUserByEmail($email) {
//        $stmt = $this->conn->prepare("SELECT first_name,last_name, email, api_key, status FROM users WHERE email = ?");
//        $stmt->bind_param("s", $email);
//        if ($stmt->execute()) {
//            // $user = $stmt->get_result()->fetch_assoc();
//            $stmt->bind_result($first_name, $last_name, $email, $api_key, $status);
//            $stmt->fetch();
//            $user = array();
//            $user["first_name"] = $first_name;
//			$user["last_name"] = $last_name;			
//            $user["email"] = $email;
//            $user["api_key"] = $api_key;
//            $user["status"] = $status;           
//            $stmt->close();
//            return $user;
//        } else {
//            return NULL;
//        }
//    }
//	
//	 public function setUserAccessToken() {	      
//			if(!isset ($_SESSION['user_access_token']))
//			{	
//				session_start();
//				$_SESSION['user_access_token']=md5(uniqid());		
//				return true;
//			} else {
//				return false;
//			}       
//    }
	
	//==============================CATEGORIES============================
	
	//list all
	public function getAllCategories(){

	$db = new database();
	  
	  
		$table = 'category';
		$rows ='*';
		$where = 'category_status = "1" ';
		
        $db->select($table,$rows,$where,'','');
	    $category_list = $db->getResults();
        return $category_list;
		
}	


//List single category
public function GetCategoryDetail($category_id){
		
		$db = new database();
		$table = 'category';
		$rows ='*';
		$where = 'category_id = "'.$category_id.'" AND category_status = "1" ';
		
        $db->select($table,$rows,$where,'','');
	    $user = $db->getResults();
		
		
        return $user;	
		
}

// Add category

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
	$values = "'".$category['category_name']."', '".$category['category_enteredBy']."'";				  
	$rows   = "category_name, category_enteredBy";
			
	if($db->insert($table,$values,$rows) ){
		return true;
	}
}
	
//Update category
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
	
	
	
//====================================SUB-CATEGORIES===================================	

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

	// $table1 = 'category_sub';
//     $rows1 ='category_name';
//	 $where1 = 'category_name = "'.$category['category_name'].'"';
//	
//	 $db->select($table1,$rows1,$where1,'','');
//	 $categoryNumRows = $db->getNumRows();
//	
//	 if( $categoryNumRows > 1 ){
//		
//		 return false;
//	 }
	
	
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

}

?>
