<?php

/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 *
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }


    /**
     * Validating user api key
     * If the api key is there in db, it is a valid key
     * @param String $api_key user api key
     * @return boolean
     */
    public function isValidApiKey($api_key) {
        $stmt = $this->conn->prepare("SELECT id from users WHERE api_key = ?");
        $stmt->bind_param("s", $api_key);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
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

	public function createUser( $body) {
      
			$db = new database();
			$table  = "user";
			$values = "'".$body['user_username']."'",
                                                    "'".$body['user_password']."'",
                                                    "'".$body['user_email']."'",
                                                    "'".$body['user_fullname']."'",
                                                    "'".$body['user_city']."'",
                                                    "'".$body['user_country']."'",
                                                    "'".$body['user_address1']."'",
                                                    "'".$body['user_address2']."'",
                                                    "'".$body['user_telephoneno1']."'",
                                                    "'".$body['user_telephoneno2']."'",
                                                    "'".$body['user_imageurl']."'",
                                                    "'".$body['user_type']."'",
													"'".$body['user_status']."'",
                                                    "'".$body['user_paymentstatus']."'",
                                                    "'".$body['user_category']."'",
                                                    "'".$body['user_profiletype']"'";
			$rows   = "user_username, 
                                                    user_password,
                                                    user_email,
                                                    user_fullname,
                                                    user_city,
                                                    user_country,
                                                    user_address1,
                                                    user_address2,
                                                    user_telephoneno1,
                                                    user_telephoneno2,
                                                    user_imageurl,
                                                    user_type,
                                                    user_status, 
                                                    user_paymentstatus, 
                                                    user_category, 
                                                    user_profiletype";
			
			if($db->insert($table,$values,$rows) ){
				return true;
			}else{
				return false;
			}			
    }
	
	
	//========================Chages are done upto here===============================

    /**
     * Update user by user id
     */
    public function updateUser($user_id, $body) {       
            $stmt = $this->conn->prepare( " UPDATE user 
                                        SET user_username=?, 
                                                    user_password=?,
                                                    user_email=?,
                                                    user_fullname=?,
                                                    user_city=?,
                                                    user_country=?,
                                                    user_address1=?,
                                                    user_address2=?,
                                                    user_telephoneno1=?,
                                                    user_telephoneno2=?,
                                                    user_imageurl=?,
                                                    user_entereddate=?,
                                                    user_type=?,
                                                    user_status=?, 
                                                    user_paymentstatus=?, 
                                                    user_category=?, 
                                                    user_profiletype=?
                                                    WHERE user_id=?");
        $stmt->bind_param("sssssssssssssssssi",  $body['user_username'],
                                                    $body['user_password'],
                                                    $body['user_email'],
                                                    $body['user_fullname'],
                                                    $body['user_city'],
                                                    $body['user_country'],
                                                    $body['user_address1'],
                                                    $body['user_address2'],
                                                    $body['user_telephoneno1'],
                                                    $body['user_telephoneno2'],
                                                    $body['user_imageurl'],
                                                    $body['user_entereddate'],
                                                    $body['user_type'],
                                                    $body['user_status'],
                                                    $body['user_paymentstatus'],
                                                    $body['user_category'],
                                                    $body['user_profiletype'],
                                                    $user_id);
        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $num_affected_rows >0;
            
    }
	

     /**
     * DELETE user by user id
     */
	 public function deleteUser($user_id) {
	 
        $stmt = $this->conn->prepare("DELETE FROM user WHERE user_id= ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $num_affected_rows > 0;
    }
	
  /**
     * Get all fixed add list user by fixed advertisment id
     */
    
     public function getAllFixedAd() {
        $stmt = $this->conn->prepare("SELECT fixedads_id,
                                        fixedads_type, 
                                        fixedads_description, 
                                        fixedads_note, 
                                        fixedads_imageurl, 
                                        fixedads_videourl, 
                                        fixedads_enetreddate, 
                                        fixedads_enteredby, 
                                        fixedads_approvedstatus, 
                                        fixedads_status 
                                        FROM fixedads");   
        $stmt->execute();
        $user_list = $stmt->get_result();
        $stmt->close();
        return $user_list;
    }

    
  /**
     * Get fixed add details by fixed advertisment id
 */

    public function GetFixedAdvertismentDetail($fixedads_id) {
       
        $stmt = $this->conn->prepare("SELECT * FROM fixedads where fixedads_id= ?");
        $stmt->bind_param("i", $fixedads_id);
        if ($stmt->execute()) {           
            $fixedad = $stmt->get_result()->fetch_assoc();           
            return $fixedad;
        } else {
            return NULL;
        }
    }

 /**
     * Creating Fixed Advertisment
     */

    public function createFixedAdvertisment( $body) {
        $stmt = $this->conn->prepare("INSERT INTO fixedads(  fixedads_type, 
                                        fixedads_description, 
                                        fixedads_note, 
                                        fixedads_imageurl, 
                                        fixedads_videourl, 
                                        fixedads_enetreddate, 
                                        fixedads_enteredby, 
                                        fixedads_approvedstatus, 
                                        fixedads_status ) 
                                        VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss", $body['fixedads_type'],
                                                    $body['fixedads_description'],
                                                    $body['fixedads_note'],
                                                    $body['fixedads_imageurl'],
                                                    $body['fixedads_videourl'],
                                                    $body['fixedads_enetreddate'],
                                                    $body['fixedads_enteredby'],
                                                    $body['fixedads_approvedstatus'],
                                                    $body['fixedads_status']
                                                    );
        $result = $stmt->execute();
        $stmt->close();

         // Check for successful insertion
            if ($result) {
                // Fixed Advertisment successfully inserted
                return USER_CREATED_SUCCESSFULLY;
            } else {
                // Failed to create Fixed Advertisment
                return USER_CREATE_FAILED;
            }
                    
    }


 /**
     * Update Fixed Advertisment by user id
     */
    public function updateFixedAdvertisment($fixedads_id, $body) {       
            $stmt = $this->conn->prepare( " UPDATE fixedads 
                                        SET fixedads_type, 
                                        fixedads_description, 
                                        fixedads_note, 
                                        fixedads_imageurl, 
                                        fixedads_videourl, 
                                        fixedads_enetreddate, 
                                        fixedads_enteredby, 
                                        fixedads_approvedstatus, 
                                        fixedads_status 
                                        WHERE fixedads_id=?");
        $stmt->bind_param("sssssssssi", $body['fixedads_type'],
                                        $body['fixedads_description'],
                                        $body['fixedads_note'],
                                        $body['fixedads_imageurl'],
                                        $body['fixedads_videourl'],
                                        $body['fixedads_enetreddate'],
                                        $body['fixedads_enteredby'],
                                        $body['fixedads_approvedstatus'],
                                        $body['fixedads_status'],
                                        $fixedads_id);
        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $num_affected_rows >0;
            
    }


 /**
     * DELETE user by user id
     */
     public function deleteFixedAdvertisment($fixedads_id) {
     
        $stmt = $this->conn->prepare("DELETE FROM fixedads WHERE fixedads_id= ?");
        $stmt->bind_param("i", $fixedads_id);
        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $num_affected_rows > 0;
    }
    




	 public function checkLogin($email, $password) {
        // fetching user by email
        $stmt = $this->conn->prepare("SELECT password_hash FROM users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->bind_result($password_hash);

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Found user with the email
            // Now verify the password

            $stmt->fetch();

            $stmt->close();

            if (PassHash::check_password($password_hash, $password)) {
                // User password is correct
                return TRUE;
            } else {
                // user password is incorrect
                return FALSE;
            }
        } else {
            $stmt->close();

            // user not existed with the email
            return FALSE;
        }
    }
	
	
	public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT first_name,last_name, email, api_key, status FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            // $user = $stmt->get_result()->fetch_assoc();
            $stmt->bind_result($first_name, $last_name, $email, $api_key, $status);
            $stmt->fetch();
            $user = array();
            $user["first_name"] = $first_name;
			$user["last_name"] = $last_name;			
            $user["email"] = $email;
            $user["api_key"] = $api_key;
            $user["status"] = $status;           
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }
	
	 public function setUserAccessToken() {	      
			if(!isset ($_SESSION['user_access_token']))
			{	
				session_start();
				$_SESSION['user_access_token']=md5(uniqid());		
				return true;
			} else {
				return false;
			}       
    }

}

?>
