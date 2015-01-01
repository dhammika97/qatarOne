<?php

/**
 * Class to handle all db operations
 * This class will have CRUD methods for database tables
 */
class DbHandler {

    public function getCategoryMatrix($params) {
        $where = 'category_status=1';
        $db = new database();
        $table = 'category c inner join category_sub s on c.category_id = s.category_sub_parentId';
        $rows = 'c.category_id,c.category_name,s.category_sub_id,s.category_sub_name,s.category_sub_tplType';
        $db->selectJson($table, $rows, $where, 'c.category_name', '', '');
        $subcategories = $db->getJson();
        return $subcategories;
    }

    public function isValidAccessToken($user_accessToken) {
        $db = new database();
        $table = 'user';
        $rows = '*';
        $where = 'user_accessToken = "' . $user_accessToken . '"';
        $db->select($table, $rows, $where, '', '');
        $user = $db->getResults();
        return $user;
    }

    public function getUserId($user_accessToken) {
        $db = new database();
        $table = 'user';
        $rows = '*';
        $where = 'user_accessToken = "' . $user_accessToken . '"';
        $db->select($table, $rows, $where, '', '');
        $user = $db->getResults();
        return $user;
    }

    private function generateApiKey() {
        return strtoupper(md5(uniqid(rand(), true)));
    }

    public function getAllUsers($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'user';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '', '');
        $user_list = $db->getJson();
        return $user_list;
    }

    public function GetUserDetail($user_id) {
        $db = new database();
        $table = 'user';
        $rows = 'user_username,user_email, user_firstname,' .
                'user_lastname,user_address1,user_address2, user_city,user_contactNo,' .
                'user_registeredDate,user_type,user_status, user_accessToken';
        $where = 'user_id = "' . $user_id . '"';
        $db->selectJson($table, $rows, $where, '', '', '');
        $user = $db->getJson();
        return $user;
    }

    public function createUser($users) {
        $date = date('y-m-d');
        $db = new database();
        $table = "user";

        (isset($users['user_firstname']) ? $user_firstname = $users['user_firstname'] : $user_firstname = "" );
        (isset($users['user_lastname']) ? $user_lastname = $users['user_lastname'] : $user_lastname = "" );
        (isset($users['user_address1']) ? $user_address1 = $users['user_address1'] : $user_address1 = "" );
        (isset($users['user_address2']) ? $user_address2 = $users['user_address2'] : $user_address2 = "" );
        (isset($users['user_city']) ? $user_city = $users['user_city'] : $user_city = "" );
        (isset($users['user_contactNo']) ? $user_contactNo = $users['user_contactNo'] : $user_contactNo = "" );

        $values = "'" . md5($users['user_password']) . "', 
					  '" . $users['user_email'] . "', 
					  '" . $user_firstname . "', 
					  '" . $user_lastname . "', 
					  '" . $user_address1 . "', 
					  '" . $user_address2 . "', 
					  '" . $user_city . "',
					  '" . $user_contactNo . "', 
					  '" . $date . "', 
					  '" . $users['user_type'] . "',
					  '1',
					  '" . strtoupper(md5(uniqid(rand(), true))) . "'";

        $rows = "user_password,
				   user_email,
				   user_firstname,
				   user_lastname,
				   user_address1,
				   user_address2,
				   user_city,
				   user_contactNo,
				   user_registeredDate,
				   user_type,
				   user_status,
				   user_accessToken";
        if ($db->insert($table, $values, $rows)) {
            return $db->getInsertId();
        } else {
            return false;
        }
    }

    public function updateUser($user_id, $users) {
        $db = new database();
        $table = 'user';
        $rows = $users;
        $where = 'user_id = "' . $user_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($user_id) {
        $db = new database();
        $table = 'user';
        $where = 'user_id = "' . $user_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function getAllFixedAd($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'fixedads';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '', '');
        $fixedad_list = $db->getJson();
        return $fixedad_list;
    }

    public function getAllFixedAdds($params) {
        $where = 'fixedads_type = "' . $params['fixedads_type'] . '" AND fixedads_status = "' . $params['fixedads_status'] . '"';
        $addtype = $params['fixedads_type'];
        $limit = '';
        if (isset($addtype)) {

            switch ($addtype) {
                case 1:
                    $limit = '1';
                    break;
                case 4:
                    $limit = '1';
                    break;
                case 5:
                    $limit = '1';
                    break;

                default:
                    $limit = '2';
            }
        }

        $db = new database();
        $table = 'fixedads';
        $rows = '*';
        $db->selectJson($table, $rows, $where, 'RAND()', $limit, '');
        $fixedad_list = $db->getJson();
        return $fixedad_list;
    }

    public function GetFixedAdvertismentDetail($fixedads_id) {
        $db = new database();
        $table = 'fixedads';
        $rows = '*';
        $where = 'fixedads_id = "' . $fixedads_id . '"';
        $db->selectJson($table, $rows, $where, '', '', '');
        $user = $db->getJson();
        return $user;
    }

    public function createFixedAdvertisment($fixed_advertisment) {
        $db = new database();
        $table = "fixedads";

        isset($fixed_advertisment['fixedads_title']) ? $fixedads_title = $fixed_advertisment['fixedads_title'] : $fixedads_title = "";
        isset($fixed_advertisment['fixedads_type']) ? $fixedads_type = $fixed_advertisment['fixedads_type'] : $fixedads_type = "";
        isset($fixed_advertisment['fixedads_image']) ? $fixedads_image = $fixed_advertisment['fixedads_image'] : $fixedads_image = "";
        isset($fixed_advertisment['fixedads_url']) ? $fixedads_url = $fixed_advertisment['fixedads_url'] : $fixedads_url = "";

        $values = "'" . $fixedads_title . "',
				  '" . $fixedads_type . "',
				  '" . $fixedads_image . "',
				  '" . $fixedads_url . "',              
				  '1'";
        $rows = "fixedads_title,
			   fixedads_type, 
			   fixedads_image,
			   fixedads_url,
			   fixedads_status";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateFixedAdvertisment($fixedads_id, $fixed_advertisment) {
        $db = new database();
        $table = 'fixedads';
        $rows = $fixed_advertisment;
        $where = 'fixedads_id = "' . $fixedads_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteFixedAdvertisment($fixedads_id) {
        $db = new database();
        $table = 'fixedads';
        $where = 'fixedads_id = "' . $fixedads_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllCategories($params) {
        //print_r($params);
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'category';
        $rows = '*';
        $db->selectJson($table, $rows, $where, 'category_name', '', '');
        $category_list = $db->getJson();
        return $category_list;
    }

    public function getAllCategoriesWithCount($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= ' AND ' . $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i ++;
        }
        $db = new database ();
        $table = 'category c, advertisment a';
        $rows = 'c.* , count( a. advertisment_id) as addCount';
        $where_query = 'a.advertisement_categoryId = c.category_id AND a.advertisement_status = "1" ' . $where;
        $group_by = 'c.category_id';
        $db->selectJson($table, $rows, $where_query, '', '', $group_by);
        $category_list = $db->getJson();
        return $category_list;
    }

    //SELECT c.* , count( a. advertisment_id)
//FROM category c, advertisment a
//where a.advertisement_categoryId = c.category_id
//GROUP BY c.category_id


    public function GetCategoryDetail($category_id) {
        $db = new database();
        $table = 'category';
        $rows = '*';
        $where = 'category_id = "' . $category_id . '"';
        $db->selectJson($table, $rows, $where, '', '', '');
        $user = $db->getJson();
        return $user;
    }

    public function addCategory($category) {
        $db = new database();
        global $user_id;
        $table1 = 'category';
        $rows1 = 'category_name';
        $where1 = 'category_name = "' . $category['category_name'] . '"';
        $db->select($table1, $rows1, $where1, '', '');
        $categoryNumRows = $db->getNumRows();
        if ($categoryNumRows > 1) {
            return false;
        }
        $table = "category";
        (isset($category['category_name']) ? $category_name = $category['category_name'] : $category_name = "" );
        (isset($category['category_parentId']) ? $category_parentId = $category['category_parentId'] : $category_parentId = "" );
        (isset($category['category_alias']) ? $cat_alias = $category['category_alias'] : $cat_alias = "" );

        $values = "'" . $category_name . "', 
				  '" . $user_id . "' , 
				  '" . $category_parentId . "',
				  '" . $cat_alias . "'";
        $rows = "category_name, category_enteredBy, category_parentId,category_alias";
        if ($db->insert($table, $values, $rows)) {
            return true;
        }
    }

    public function updateCateory($category, $category_id) {
        $db = new database();
        $table = 'category';
        $rows = $category;
        $where = 'category_id = "' . $category_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCategory($category_id) {
        $db = new database();
        $table1 = 'category_sub';
        $rows1 = '*';
        $where1 = '	category_sub_parentId = "' . $category_id . '"';
        $db->select($table1, $rows1, $where1, '', '');
        $NumRows = $db->getNumRows();
        if ($NumRows > 1) {
            return false;
        }
        $table = 'category';
        $where = 'category_id = "' . $category_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function getAllsubCategorys($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'category_sub';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '', '');
        $subcategories = $db->getJson();
        return $subcategories;
    }

    public function GetsubCategoryDetail($id) {
        $db = new database();
        $table = 'category_sub';
        $rows = '*';
        $where = 'category_sub_id = "' . $id . '"';
        $db->selectJson($table, $rows, $where, '', '', '');
        $subcategory = $db->getJson();
        return $subcategory;
    }

    public function addsubCategory($category) {
        global $user_id;
        $db = new database();
        $table = "category_sub";
        (isset($category['category_sub_tplType']) ? $category_sub_tplType = $category['category_sub_tplType'] : $category_sub_tplType = "" );
        (isset($category['category_sub_name']) ? $category_sub_name = $category['category_sub_name'] : $category_sub_name = "" );
        (isset($category['category_sub_parentId']) ? $category_sub_parentId = $category['category_sub_parentId'] : $category_sub_parentId = "" );
        (isset($category['category_sub_alias']) ? $cat_alias = $category['category_sub_alias'] : $cat_alias = "" );
        $values = "'" . $category_sub_name . "',
				 '" . $category_sub_parentId . "' ,
				 '" . $user_id . "',
				 '" . $category_sub_tplType . "',
				 '" . $cat_alias . "'";
        $rows = "category_sub_name, 
				category_sub_parentId, 
				category_sub_enteredBy, 
				category_sub_tplType,
				category_sub_alias";
        if ($db->insert($table, $values, $rows)) {
            return true;
        }
    }

    public function updatesubCategory($subCategory, $category_sub_id) {
        $db = new database();
        $table = 'category_sub';
        $rows = $subCategory;
        $where = 'category_sub_id = "' . $category_sub_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSubCategory($category_sub_id) {
        $db = new database();
        $table = 'category_sub';
        $where = 'category_sub_id = "' . $category_sub_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function createLocation($location) {
        $db = new database();
        $table = "locations";
        $values = "'" . $location['location_name'] . "',
				'" . $location['location_alias'] . "',
				'" . $location['location_cordinates'] . "'";
        $rows = "location_name,
				   location_alias,
				   location_cordinates";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllLocations($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'locations';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '');
        $location_list = $db->getJson();
        return $location_list;
    }

    public function updateLocation($location_id, $locations) {
        $db = new database();
        $table = 'locations';
        $rows = $locations;
        $where = 'location_id = "' . $location_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteLocation($location_id) {
        $db = new database();
        $table1 = 'suburbs';
        $rows1 = 'suburb_id';
        $where1 = 'suburb_location_id = "' . $location_id . '"';
        $db->select($table1, $rows1, $where1, '', '');
        $NumRows = $db->getNumRows();
        if ($NumRows > 1) {
            return false;
        }
        $table = 'locations';
        $where = 'location_id = "' . $location_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function getLocationDetail($location_id) {
        $db = new database();
        $table = 'locations';
        $rows = '*';
        $where = 'location_id = "' . $location_id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $page = $db->getJson();
        return $page;
    }

    public function addPage($page) {
        global $user_id;
        $db = new database();
        $table1 = 'pages';
        $rows1 = 'page_title';
        $where1 = 'page_title = "' . $page['page_title'] . '"';
        $db->select($table1, $rows1, $where1, '', '');
        $pageNumRows = $db->getNumRows();
        if ($pageNumRows > 1) {
            return false;
        }
        $table = "pages";
        $values = "'" . $page['page_title'] . "', '" . $page['page_content'] . "','" . $user_id . "'";
        $rows = "page_title,page_content, page_addedBy";
        if ($db->insert($table, $values, $rows)) {
            return true;
        }
    }

    public function updatePages($page, $page_id) {
        $db = new database();
        $table = 'pages';
        $rows = $page;
        $where = 'page_id = "' . $page_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePage($page_id) {
        $db = new database();
        $table = 'pages';
        $where = 'page_id = "' . $page_id . '"';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function getAllPages($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'pages';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '');
        $pages_list = $db->getJson();
        return $pages_list;
    }

    public function GetPageDetail($page_id) {
        $db = new database();
        $table = 'pages';
        $rows = '*';
        $where = 'page_id = "' . $page_id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $page = $db->getJson();
        return $page;
    }

    public function checkLogin($user_email, $user_password) {
        $db = new database();
        $table = 'user';
        $rows = '*';
        $where = 'user_email= "' . $user_email . '" AND user_status = 1';

        $db->select($table, $rows, $where, '', '');
        $logged_User = $db->getResults();
        //return true;
        if ($logged_User != NULL) {
            if ($logged_User["user_password"] == md5($user_password)) {
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
        $rows = '*';
        $where = 'user_email= "' . $user_email . '"';

        $db->select($table, $rows, $where, '', '');
        $logged_User = $db->getResults();
        return $logged_User;
    }

    public function createSuburb($suburb) {
        $db = new database();
        $table = "suburbs";
        $values = "'" . $suburb['suburb_location_id'] . "', 
				'" . $suburb['suburb_name'] . "',
				'" . $suburb['suburb_alias'] . "',
				'" . $suburb['suburb_cordinates'] . "'";
        $rows = "suburb_location_id, 
				   suburb_name,
				   suburb_alias,
				   suburb_cordinates";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllSuburbs($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'suburbs';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '');
        $location_list = $db->getJson();
        return $location_list;
    }

    public function GetSuburbDetail($suburb_id) {
        $db = new database();
        $table = 'suburbs';
        $rows = '*';
        $where = 'suburb_id = "' . $suburb_id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $page = $db->getJson();
        return $page;
    }

    public function updateSuburb($suburb_id, $suburbs) {
        $db = new database();
        $table = 'suburbs';
        $rows = $suburbs;
        $where = 'suburb_id = "' . $suburb_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSuburb($suburb_id) {
        $db = new database();
        $table = 'suburbs';
        $where = 'suburb_id = "' . $suburb_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function addEvent($event) {
        $db = new database();

        $table = "events";
        (isset($event['event_title']) ? $event_title = $event['event_title'] : $event_title = "" );
        (isset($event['event_description']) ? $event_description = $event['event_description'] : $event_description = "" );
        (isset($event['event_date']) ? $event_date = $event['event_date'] : $event_date = "" );
        (isset($event['event_shortDescription']) ? $event_shortDescription = $event['event_shortDescription'] : $event_shortDescription = "" );
        (isset($event['event_image']) ? $event_image = $event['event_image'] : $event_image = "" );
        $values = "'" . $event_title . "', '" . $event_date . "', 
				  '" . $event_shortDescription . "', '" . $event_description . "', '" . $event_image . "'";
        $rows = "event_title, event_date, event_shortDescription, event_description,event_image";
        if ($db->insert($table, $values, $rows)) {
            return true;
        }
    }

    public function updateEvent($event, $event_id) {
        $db = new database();
        $table = 'events';
        $rows = $event;
        $where = 'evenet_id = "' . $event_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEvent($event_id) {
        $db = new database();
        $table = 'events';
        $where = 'evenet_id = "' . $event_id . '"';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function getAllEvents($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'events';
        $rows = '*';

        $db->selectJson($table, $rows, $where, '', '', '');
        $pages_list = $db->getJson();
        return $pages_list;
    }

    public function GetEventDetail($evenet_id) {
        $db = new database();
        $table = 'events';
        $rows = '*';
        $where = 'evenet_id = "' . $evenet_id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $page = $db->getJson();
        return $page;
    }

    public function createSlider($slider) {
        $db = new database();
        $table = "sliders";
        (isset($slider['slider_title']) ? $slider_title = $slider['slider_title'] : $slider_title = "" );
        (isset($slider['slider_image']) ? $slider_image = $slider['slider_image'] : $slider_image = "" );
        (isset($slider['slider_url']) ? $slider_url = $slider['slider_url'] : $slider_url = "" );

        $values = "'" . $slider_title . "', 
				'" . $slider_image . "',
				'" . $slider_url . "'";
        $rows = "slider_title, 
				   slider_image,
				   slider_url";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllSliders($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'sliders';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '');
        $location_list = $db->getJson();
        return $location_list;
    }

    public function GetSliderDetail($slider_id) {
        $db = new database();
        $table = 'sliders';
        $rows = '*';
        $where = 'slider_id = "' . $slider_id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $page = $db->getJson();
        return $page;
    }

    public function updateSlider($slider_id, $slider) {
        $db = new database();
        $table = 'sliders';
        $rows = $slider;
        $where = 'slider_id = "' . $slider_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSlider($slider_id) {
        $db = new database();
        $table = 'sliders';
        $where = 'slider_id = "' . $slider_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function createNews($news) {
        $date = date('y-m-d');
        (isset($news['news_image']) ? $news_image = $news['news_image'] : $news_image = "" );
        $db = new database();
        $table = "news";
        $values = "'" . $news['news_title'] . "', 
				'" . $news['news_shortDescription'] . "',
				'" . $news['news_Description'] . "',
				'" . $news_image . "',
				'" . $date . "',
				'1'";
        $rows = "news_title, 
				   news_shortDescription,
				   news_Description,
				   news_image,
				   news_date,
				   news_status";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllNews($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'news';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '');
        $location_list = $db->getJson();
        return $location_list;
    }

    public function GetNewsDetail($news_id) {
        $db = new database();
        $table = 'news';
        $rows = '*';
        $where = 'news_id = "' . $news_id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $page = $db->getJson();
        return $page;
    }

    public function updateNews($news_id, $news) {
        $db = new database();
        $table = "news";
        $rows = $news;
        $where = "news_id = '" . $news_id . "'";
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteNews($news_id) {
        $db = new database();
        $table = 'news';
        $where = 'news_id = "' . $news_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function createPackageType($packageType) {
        global $user_id;
        (isset($packageType['packageType']) ? $package_type = $packageType['packageType'] : $package_type = "" );
        (isset($packageType['package_name']) ? $package_name = $packageType['package_name'] : $package_name = "" );
        (isset($packageType['package_Description']) ? $package_description = $packageType['package_Description'] : $package_description = "" );
        (isset($packageType['package_price']) ? $package_price = $packageType['package_price'] : $package_price = "" );
        (isset($packageType['package_adLimit']) ? $package_adLimit = $packageType['package_adLimit'] : $package_adLimit = "" );

        $db = new database();
        $table = "packagetypes";
        $values = "'" . $package_type . "',
				'" . $package_name . "', 
				'" . $package_description . "',
				'" . $package_price . "',
				'" . $package_adLimit . "',
				'" . $user_id . "',
				'1'";
        $rows = "packageType,
				   package_name, 
				   package_Description,
				   package_price,
				   package_adLimit,
				   package_addedBy,
				   package_status";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllPackageTypes($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'packagetypes';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '');
        $location_list = $db->getJson();
        return $location_list;
    }

    public function GetPackageTypeDetail($packageType_id) {
        $db = new database();
        $table = 'packagetypes';
        $rows = '*';
        $where = 'package_id = "' . $packageType_id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $page = $db->getJson();
        return $page;
    }

    public function updatePackageType($packageType_id, $packageType) {
        $db = new database();
        $table = 'packagetypes';
        $rows = $packageType;
        $where = 'package_id = "' . $packageType_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePackageType($packageType_id) {
        $db = new database();
        $table = 'packagetypes';
        $where = 'package_id = "' . $packageType_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function createRegisteredUser($users) {
        $date = date('y-m-d');
        $db = new database();
        $table = "user";

        (isset($users['user_firstname']) ? $user_firstname = $users['user_firstname'] : $user_firstname = "" );
        (isset($users['user_lastname']) ? $user_lastname = $users['user_lastname'] : $user_lastname = "" );
        (isset($users['user_address1']) ? $user_address1 = $users['user_address1'] : $user_address1 = "" );
        (isset($users['user_address2']) ? $user_address2 = $users['user_address2'] : $user_address2 = "" );
        (isset($users['user_city']) ? $user_city = $users['user_city'] : $user_city = "" );
        (isset($users['user_contactNo']) ? $user_contactNo = $users['user_contactNo'] : $user_contactNo = "" );

        $values = "'" . $users['user_username'] . "', 
					  '" . md5($users['user_password']) . "', 
					  '" . $users['user_email'] . "', 
					  '" . $user_firstname . "', 
					  '" . $user_lastname . "', 
					  '" . $user_address1 . "', 
					  '" . $user_address2 . "', 
					  '" . $user_city . "',
					  '" . $user_contactNo . "', 
					  '" . $date . "', 
					  '" . $users['user_type'] . "',
					  '0',
					  '" . strtoupper(md5(uniqid(rand(), true))) . "'";

        $rows = "user_username, 
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
				   user_status,
				   user_accessToken";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserAvailability($user_email) {
        $db = new database();
        $table = 'user';
        $rows = '*';
        $where = 'user_email= "' . $user_email . '"';

        $db->select($table, $rows, $where, '', '');
        $avail_User = $db->getResults();
        //return true;
        if ($avail_User != NULL) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllDefaultPackages() {

        $db = new database();
        $table = ' packagetypes';
        $rows = 'package_id,package_adLimit';
        $where = 'packageType = 0';
        $db->selectJson($table, $rows, $where, '', '');
        $default_package_list = $db->getJson();
        return $default_package_list;
    }

    public function CreateUserPackages($userpkg_userId, $userpkg_pkgId, $userpkg_remainAds) {
        $db = new database();

        $table = "userpackge";
        $values = "'" . $userpkg_userId . "', 					 
					  '" . $userpkg_pkgId . "',
					  '" . $userpkg_remainAds . "', 
					  '1'";

        $rows = "userpkg_userId, 
				   userpkg_pkgId,
				   userpkg_remainAds,
				   userpkg_status";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function addUserSubscription($userSubscription) {
        $db = new database();
        $table = "usersubscription";
        (isset($userSubscription['subscription_email']) ? $subscription_email = $userSubscription['subscription_email'] : $subscription_email = "" );

        $values = "'" . $subscription_email . "',  
			 			'1'";

        $rows = "subscription_email,subscription_status";
        if ($db->insert($table, $values, $rows)) {
            return true;
        }
    }

    public function advertismentDetail($id) {
        $db = new database();
        $table = 'advertisment a , locations l, suburbs s, category_sub c';
        $rows = 'a.advertisement_title, 
				a.advertisement_contactName,
				a.advertisement_currency as currency, 
				a.advertisement_price, 
				a.advertisement_description, 
				a.advertisement_attributes, 
				a.advertisement_contactEmail,
				a.advertisement_contactNo,
				a.advertisement_categoryId as catId, 
				date(a.advertisement_date) as date, 
				time(a.advertisement_date) as time, 
				l.location_name, 
				l.location_cordinates, 
				s.suburb_name,
				s.suburb_cordinates, 
				c.category_sub_name';
        $where = 'a.advertisement_location= l.location_id
				 AND a.advertisement_suburb = s.suburb_id
				 AND a.advertisement_subCategoryId	 = c.category_sub_id
				 AND a.advertisment_id = "' . $id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $add = $db->getJson();
        return $add;
    }

    public function adImages($id) {
        $db = new database();
        $table = 'advertisement_images';
        $rows = 'advertisement_image';
        $where = 'advertisement_id = "' . $id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $images = $db->getJson();
        return $images;
    }

    public function advertisments($params) {
        //$catid = $params['categoryID'];
        $where_atri = '';
        $i = 1;


        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where_atri .= ' AND ' . $key . '=' . $value;
            else
                $where_atri .= ' AND ' . $key . '="' . $value . '"';
            $i++;
        }


        $db = new database();
        $table = 'advertisment a, advertisement_images i, locations l , category_sub c, suburbs s';
        $rows = 'a.advertisement_title, a.advertisment_id as aid, a.advertisement_price as price, a.advertisement_description, i.advertisement_image, s.suburb_name as suberb, s.suburb_id as suburbid
				,date(a.advertisement_date) as date,time(a.advertisement_date) as time, l.location_name as location, 
				l.location_id as locationid,c.category_sub_name as category,c.category_sub_id as categoryid';
        $where = 'a.advertisment_id = i.advertisement_id
				 AND advertisement_suburb = s.suburb_id	
				 AND advertisement_location = l.location_id 
				 AND advertisement_status = "1"
				 AND a.advertisement_subCategoryId = c.category_sub_id' . $where_atri;
        $db->selectJson($table, $rows, $where, '', '');
        $add = $db->getJson();
        return $add;
    }

    public function addAdImage($image, $ad) {
        $db = new database();
        $table = "advertisement_images";
        $values = "'" . $image . "',
					'" . $ad . "'";
        $rows = "advertisement_image, advertisement_id";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function createAdvertisment($adDetail) {
        global $user_id;
        $ads = '';
        $db = new database();
        $expire = $end = date('Y-m-d', strtotime('+3 months'));
        $table = "advertisment";
        $category = json_decode(self::GetsubCategoryDetail($adDetail['advertisement_subCategoryId']), true);
        $mode = self::GetCategoryParentId($category[0]['category_sub_parentId']);
        $ads = self::checkPackageAvailability($user_id, $mode);
        if ($ads !== '0') {

            (isset($adDetail['advertisement_attributes']) ? $attr = json_encode($adDetail['advertisement_attributes']) : $attr = "" );
            (isset($adDetail['advertisement_price']) ? $price = $adDetail['advertisement_price'] : $price = "" );


            $values = "'" . $category[0]['category_sub_parentId'] . "',
				'" . $adDetail['advertisement_subCategoryId'] . "',
				'" . json_encode($adDetail['advertisement_attributes']) . "',
				'" . $adDetail['advertisement_title'] . "',
				'" . $adDetail['advertisement_description'] . "',
				'" . $adDetail['currency'] . "',
				'" . $price . "',
				'" . $adDetail['advertisement_contactName'] . "',
				'" . $adDetail['advertisement_contactNo'] . "',
				'" . $adDetail['advertisement_contactEmail'] . "',
				'" . $adDetail['advertisement_location'] . "',
				'" . $adDetail['advertisement_suburb'] . "',
				'6.934023, 79.845219',
				'3',
				'" . $expire . "',
				'" . $user_id . "'";
            $rows = "advertisement_categoryId,
				advertisement_subCategoryId,
				advertisement_attributes,
				advertisement_title,
				advertisement_description,
				advertisement_currency,
				advertisement_price,
				advertisement_contactName,
				advertisement_contactNo,
				advertisement_contactEmail,
				advertisement_location,
				advertisement_suburb,
				advertisement_googleCodes,
				advertisement_status,
				advertisement_expire,
				advertisement_addedBy";
            if ($db->insert($table, $values, $rows)) {
                $update = self::updatePackageAvailability($user_id, $mode);

                return $db->getInsertId();
            } else {
                return false;
            }
        } else {
            return "No_inventory";
        }
    }

    public function advertismentsByLocation($params) {
        $where_atri = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where_atri .= ' AND ' . $key . '=' . $value;
            else
                $where_atri .= ' AND ' . $key . '="' . $value . '"';
            $i++;
        }
        $db = new database();
        $table = 'advertisment a, advertisement_images i,locations l, suburbs s , category_sub c';
        $rows = 'a.advertisement_title, a.advertisment_id, a.advertisement_price as price, a.advertisement_description, i.advertisement_image
				,date(a.advertisement_date) as date,time(a.advertisement_date) as time, s.suburb_name as suburb, 
				s.suburb_id as suburbid,c.category_sub_name as category,c.category_sub_id as categoryid';
        $where = 'a.advertisment_id = i.advertisement_id
				 AND advertisement_suburb = s.suburb_id
				 AND advertisement_location = l.location_id
				 AND advertisement_status = "1"
				 AND a.advertisement_subCategoryId = c.category_sub_id' . $where_atri;
        $db->selectJson($table, $rows, $where, '', '');
        $add = $db->getJson();
        return $add;
    }

    public function getSimilarItems($params) {
        $aid = $params['advertistment'];

        $db = new database();
        $table = 'advertisment';
        $rows = 'advertisement_subCategoryId';
        $where = 'advertisment_id ="' . $aid . '"';
        $db->select($table, $rows, $where, '', '');
        $cat = $db->getResults();



        $db = new database();
        $table = 'advertisment a ,advertisement_images i';
        $rows = 'a.advertisment_id, i.advertisement_image';
        $where = 'i.advertisement_id = a.advertisment_id 
				  AND a.advertisement_subCategoryId	 ="' . $cat['advertisement_subCategoryId'] . '"
				  AND a.advertisment_id != "' . $aid . '"
				  AND  a.advertisement_status = "1" group by a.advertisment_id';
        $order_by = 'RAND()';
        $limit = '4';
        $db->selectJson($table, $rows, $where, $order_by, $limit = '12');
        $items = $db->getJson();

        return $items;
    }

    /* public function advertismentsResults($id){
      $where_atri = ' AND advertisement_categoryId = ' . $id;

      $db = new database ();
      $table = 'advertisment a, advertisement_images i, locations l , category_sub c, suburbs s';
      $rows = 'a.advertisement_title, a.advertisment_id as aid, a.advertisement_price as price, a.advertisement_description, i.advertisement_image, s.suburb_name as suberb, s.suburb_id as suburbid
      ,date(a.advertisement_date) as date,time(a.advertisement_date) as time, l.location_name as location,
      l.location_id as locationid,c.category_sub_name as category,a.advertisement_categoryId as categoryid';
      $where = 'a.advertisment_id = i.advertisement_id
      AND a.advertisement_location= l.location_id
      AND a.advertisement_suburb = s.suburb_id
      AND a.advertisement_subCategoryId	 = c.category_sub_id
      AND advertisement_status = "1" ' . $where_atri;
      $db->selectJson ( $table, $rows, $where, '', '' );
      $add = $db->getJson ();
      return $add;
      } */

    public function advertiesmentsResults($params) {
        $where_atri = '';
        $order_by = '';
        $i = 0;
        $dd = Array();
        $categoryLst = json_decode(self::getAllCategories($dd), true);
        $subCategoryLst = json_decode(self::getAllsubCategorys($dd), true);
        $locationLst = json_decode(self::getAllLocations($dd), true);
        $suburbLst = json_decode(self::getAllSuburbs($dd), true);

        foreach ($params as $key => $value) {

            if ($i != count($params)) {
                if ($key == 'category') {
                    for ($s = 0; count($categoryLst) > $s; $s++) {
                        if ($value == $categoryLst[$s]['category_alias']) {
                            $cat = $categoryLst[$s]['category_id'];
                            break;
                        } else {
                            $cat = '';
                        }
                    }
                    if ($cat != "") {
                        $where_atri = $where_atri . ' AND a.advertisement_categoryId = ' . $cat;
                    }
                }
                if ($key == 'subcategory') {
                    for ($s = 0; count($subCategoryLst) > $s; $s++) {
                        if ($value == $subCategoryLst[$s]['category_sub_alias']) {
                            $subcat = $subCategoryLst[$s]['category_sub_id'];
                            break;
                        } else {
                            $subcat = '';
                        }
                    }
                    if ($subcat != '')
                        $where_atri = $where_atri . ' AND a.advertisement_subCategoryId = ' . $subcat;
                }
                if ($key == 'location') {

                    for ($s = 0; count($locationLst) > $s; $s++) {
                        if ($value == $locationLst[$s]['location_alias']) {
                            $loc = $locationLst[$s]['location_id'];
                            break;
                        } else {
                            $loc = '';
                        }
                    }
                    if ($loc != '')
                        $where_atri = $where_atri . ' AND a.advertisement_location = ' . $loc;
                }
                if ($key == 'suburb' && $value != '') {
                    for ($s = 0; count($suburbLst) > $s; $s++) {
                        if ($value == $suburbLst[$s]['suburb_alias']) {
                            $sub = $suburbLst[$s]['suburb_id'];
                            break;
                        } else {
                            $sub = '';
                        }
                    }
                    if ($sub != '')
                        $where_atri = $where_atri . ' AND a.advertisement_suburb = ' . $sub;
                }
                if ($key == 'searchby' && $value != '') {
                    $like = '';
                    $tmp = explode("&", $value);
                    for ($i = 0; count($tmp) > $i; $i++) {
                        $s = explode('=', $tmp[$i]);
                        switch ($s[0]) {
                            case 'title':
                                $lbl = 'a.advertisement_title';
                                break;
                            default:
                                $lbl = 'a.advertisement_attributes';
                        }


                        $like .= $lbl . " like '%" . $s[1] . "%' ";
                        if ($i != count($tmp) - 1)
                            $like .= "or ";
                    }
                    //echo $like;
                    $where_atri = $where_atri . " AND " . $like;
                }

                if ($key == 'pricerangegreaterthan' && $value != '') {
                    $where_atri = $where_atri . ' AND a.advertisement_price >= ' . $value;
                }
                if ($key == 'pricerangelessthan' && $value != '') {
                    $where_atri = $where_atri . ' AND a.advertisement_price < ' . $value;
                }
                if ($key == 'limitS') {
                    $start = $value;
                }
                if ($key == 'limitE') {
                    $end = $value;
                }
                if ($key == 'sortby' && $value != '') {
                    $order_by = ' order by ' . $value;
                }
            } else {
                //$where_atri .= ' AND ' . $key . '="' . $value . '"';
            }
            $i ++;
        }
        $where_atri = $where_atri . $order_by;
        //echo $where_atri;

        $db = new database ();
        $table = 'advertisment a inner join locations l on l.location_id = a.advertisement_location 
				inner join category c on c.category_id = a.advertisement_categoryId 
				inner join category_sub sc on sc.category_sub_id = a.advertisement_subCategoryId 
				inner join suburbs s on s.suburb_id = a.advertisement_suburb 
				left join advertisement_images ai on ai.advertisement_id = a.advertisment_id';
        $rows = 'a.advertisement_title, 
				a.advertisment_id as aid, 
				a.advertisement_currency as currency,
				a.advertisement_price as price, 
				a.advertisement_description, 
				s.suburb_name as suberb, 
				s.suburb_id as suburbid,
				date(a.advertisement_date) as date, 
				time(a.advertisement_date) as time, 
				l.location_name as location, 
				l.location_id as locationid, 
				sc.category_sub_name as category, 
				a.advertisement_categoryId as categoryid, 
				sc.category_sub_alias as scalias, 
				l.location_alias as lalias, 
				s.suburb_alias as sub_alias, 
				ai.advertisement_image as image, 
				sc.category_sub_id as subCatId, 
				a.advertisement_attributes as attributes';
        $where = 'advertisement_status = "1" ' . $where_atri;
        //echo $where;
        $db->selectJson($table, $rows, $where, '', $start . ',' . $end, 'a.advertisment_id');
        $add = $db->getJson();
        return $add;
    }

    public function advertiesmentCount($params) {
        $where_atri = '';
        $order_by = '';
        $i = 0;
        $dd = Array();
        $categoryLst = json_decode(self::getAllCategories($dd), true);
        $subCategoryLst = json_decode(self::getAllsubCategorys($dd), true);
        $locationLst = json_decode(self::getAllLocations($dd), true);
        $suburbLst = json_decode(self::getAllSuburbs($dd), true);

        foreach ($params as $key => $value) {

            if ($i != count($params)) {
                if ($key == 'category') {
                    for ($s = 0; count($categoryLst) > $s; $s++) {
                        if ($value == $categoryLst[$s]['category_alias']) {
                            $cat = $categoryLst[$s]['category_id'];
                            break;
                        } else {
                            $cat = '';
                        }
                    }
                    if ($cat != "") {
                        $where_atri = $where_atri . ' AND a.advertisement_categoryId = ' . $cat;
                    }
                }
                if ($key == 'subcategory') {
                    for ($s = 0; count($subCategoryLst) > $s; $s++) {
                        if ($value == $subCategoryLst[$s]['category_sub_alias']) {
                            $subcat = $subCategoryLst[$s]['category_sub_id'];
                            break;
                        } else {
                            $subcat = '';
                        }
                    }
                    if ($subcat != '')
                        $where_atri = $where_atri . ' AND a.advertisement_subCategoryId = ' . $subcat;
                }
                if ($key == 'location') {

                    for ($s = 0; count($locationLst) > $s; $s++) {
                        if ($value == $locationLst[$s]['location_alias']) {
                            $loc = $locationLst[$s]['location_id'];
                            break;
                        } else {
                            $loc = '';
                        }
                    }
                    if ($loc != '')
                        $where_atri = $where_atri . ' AND a.advertisement_location = ' . $loc;
                }
                if ($key == 'suburb' && $value != '') {
                    for ($s = 0; count($suburbLst) > $s; $s++) {
                        if ($value == $suburbLst[$s]['suburb_alias']) {
                            $sub = $suburbLst[$s]['suburb_id'];
                            break;
                        } else {
                            $sub = '';
                        }
                    }
                    if ($sub != '')
                        $where_atri = $where_atri . ' AND a.advertisement_suburb = ' . $sub;
                }
                if ($key == 'searchby' && $value != '') {
                    $like = '';
                    $tmp = explode("&", $value);
                    for ($i = 0; count($tmp) > $i; $i++) {
                        $s = explode('=', $tmp[$i]);
                        switch ($s[0]) {
                            case 'title':
                                $lbl = 'a.advertisement_title';
                                break;
                            default:
                                $lbl = 'a.advertisement_attributes';
                        }


                        $like .= $lbl . " like '%" . $s[1] . "%' ";
                        if ($i != count($tmp) - 1)
                            $like .= "or ";
                    }
                    //echo $like;
                    $where_atri = $where_atri . " AND " . $like;
                }

                if ($key == 'pricerangegreaterthan' && $value != '') {
                    $where_atri = $where_atri . ' AND a.advertisement_price >= ' . $value;
                }
                if ($key == 'pricerangelessthan' && $value != '') {
                    $where_atri = $where_atri . ' AND a.advertisement_price < ' . $value;
                }
            } else {
                //$where_atri .= ' AND ' . $key . '="' . $value . '"';
            }
            $i ++;
        }
        $where_atri = $where_atri . $order_by;
        //echo $where_atri;

        $db = new database ();
        $table = 'advertisment a inner join locations l on l.location_id = a.advertisement_location inner join category c on c.category_id = a.advertisement_categoryId inner join category_sub sc on sc.category_sub_id = a.advertisement_subCategoryId inner join suburbs s on s.suburb_id = a.advertisement_suburb left join advertisement_images ai on ai.advertisement_id = a.advertisment_id';
        $rows = 'a.advertisment_id as aid';
        $where = 'advertisement_status = "1" ' . $where_atri;
        //echo $where;
        $db->selectJson($table, $rows, $where, '', '', 'a.advertisment_id');
        $add = $db->getNumRows();
        return $add;
    }

    public function addComment($comment, $id) {
        $db = new database();

        $advertisment_Id = $id;
        $comment_Date = date("Y-m-d");
        $comment_Time = date("H:i:s");
        $comment_status = "0";
        //$commentBody = $params;
        $comment_addedBy = '33';

        $table = "item_comments";
        $values = "'" . $advertisment_Id . "',
				  '" . $comment_Date . "',
				  '" . $comment_Time . "',
				  '" . $comment_status . "',
				  '" . $comment_addedBy . "',
				  '" . $comment . "'";

        $rows = "advertisment_Id,
			   comment_Date, 
			   comment_Time,
			   comment_status,
			   comment_addedBy,
			   Comment";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function getComments($params) {
        $id = $params['advertisment_Id'];
        $db = new database ();
        $table = 'advertisment a, item_comments  c';
        $rows = ' c.* , a.advertisment_id';
        $where = 'c.advertisment_Id = a.advertisment_id
				  AND c.advertisment_Id = "' . $id . '"
				  AND comment_status = "1"';
        $order_by = "c.comment_Id DESC";
        $db->selectJson($table, $rows, $where, $order_by, '');
        $add = $db->getJson();
        return $add;
    }

    public function updateUserProfile($user_id, $userProfile) {
        $db = new database();
        $table = 'user';
        $rows = $userProfile; //.$userProfile['user_id'].		
        $where = 'user_id = "' . $user_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllVideo($params) {
        $where = '';
        $i = 1;
        foreach ($params as $key => $value) {
            if ($i != count($params))
                $where .= $key . '=' . $value . ' AND ';
            else
                $where .= $key . '=' . $value;
            $i++;
        }
        $db = new database();
        $table = 'video';
        $rows = '*';
        $db->selectJson($table, $rows, $where, '', '');
        $video_list = $db->getJson();
        return $video_list;
    }

    public function GetVideoDetail($video_id) {
        $db = new database();
        $table = 'video';
        $rows = '*';
        $where = 'video_id = "' . $video_id . '"';
        $db->selectJson($table, $rows, $where, '', '');
        $video = $db->getJson();
        return $video;
    }

    public function createVideo($video) {

        (isset($video['video_title']) ? $video_title = $video['video_title'] : $video_title = "" );
        (isset($video['video_url']) ? $video_url = $video['video_url'] : $video_url = "" );
        (isset($video['video_filename']) ? $video_filename = $video['video_filename'] : $video_filename = '');

        $db = new database();
        $table = "video";
        $values = "'" . $video_title . "',
				'" . $video_url . "',
				'" . $video_filename . "',			
				'1'";
        $rows = "video_title,
				   video_url,
				   video_filename, 				
				   video_status";
        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateVideo($video_id, $video) {
        $db = new database();
        $table = 'video';
        $rows = $video;
        $where = 'video_id = "' . $video_id . '"';
        if ($db->update($table, $rows, $where)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteVideo($video_id) {
        $db = new database();
        $table = 'video';
        $where = 'video_id = "' . $video_id . '" ';
        if ($db->delete($table, $where)) {
            return true;
        }
    }

    public function getPackageAvailability() {
        global $user_id;
        $ads = self::checkPackageAvailability($user_id, 1); //check ads =1
        $jobs = self::checkPackageAvailability($user_id, 2); //check jobs =2

        $response['ads'] = $ads;
        $response['jobs'] = $jobs;

        return $response;
    }

    public function checkPackageAvailability($user_id, $mode) {

        $response = self::checkPayedPackageAvailability($user_id, $mode);

        if ($response == 'Payed_Available') {
            $response = 'unlimited';
        } else {
            $response = self::checkRegisteredPackageAvailability($user_id, $mode);
        }
        return $response;
    }

    public function checkPayedPackageAvailability($user_id, $mode) {
        //echo $user_id;

        $db = new database ();
        $table = 'userpackge up, packagetypes pt ';
        $rows = ' packageType ';
        $where = 'up.userpkg_pkgid= pt.package_id
				  AND up.userpkg_userid = "' . $user_id . '"
				  AND pt.package_mode = "' . $mode . '"
				  AND pt.packageType = "1"
				 ';
        $order_by = " packageType";

        $db->selectJson($table, $rows, $where, $order_by, '');
        $resultsset = $db->getJson();

        if ($resultsset != NULL) {
            $response = 'Payed_Available';
        } else {
            $response = 'Payed_NotAvailable';
        }

        return $response;
    }

    public function checkRegisteredPackageAvailability($user_id, $mode) {
        //echo $user_id;

        $db = new database ();
        $table = 'userpackge up, packagetypes pt ';
        $rows = ' userpkg_remainAds ';
        $where = 'up.userpkg_pkgid= pt.package_id
				  AND up.userpkg_userid = "' . $user_id . '"
				  AND pt.package_mode = "' . $mode . '"
				   AND pt.packageType = "0"
				 ';
        $order_by = " packageType";

        $db->select($table, $rows, $where, $order_by, '');

        $resultsset = $db->getResults();

        if ($resultsset != NULL) {
            $response = $resultsset [0];
        } else {
            $response = '0';
        }

        return $response;
    }

    public function updatePackageAvailability($user_id, $mode) {

        $response = self::checkPayedPackageAvailability($user_id, $mode);

        if ($response == 'Payed_Available') {
            $response = 'TRUE';
        } else {
            $response = self::updateRegisteredPackageAvailability($user_id, $mode);
        }
        return $response;
    }

    public function updateRegisteredPackageAvailability($user_id, $mode) {
        $db = new database(); //$user_id,$mode
        $query = 'update userpackge set userpkg_remainAds=userpkg_remainAds-1
				where userpkg_userid = ' . $user_id . ' AND userpkg_pkgid in (select package_id from packagetypes where packagetype=0 AND package_mode = ' . $mode . ')';
        if ($db->updatePreparedStatment($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategoryMatrixPackageBinding($user_id) {
        //global $user_id;
        $where_atri = '';
        $ads = self::checkPackageAvailability($user_id, 1); //check ads =1
        $jobs = self::checkPackageAvailability($user_id, 2); //check jobs =2
        //echo $ads;
        //echo $jobs;

        if ($ads == '0') {
            $where_atri = $where_atri . ' AND c.category_parentId != 1 ';
        }

        if ($jobs == '0') {
            $where_atri = $where_atri . ' AND c.category_parentId != 2 ';
        }

        $where = 'category_status=1' . $where_atri;
        $db = new database();
        $table = 'category c inner join category_sub s on c.category_id = s.category_sub_parentId';
        $rows = 'c.category_id,c.category_name,s.category_sub_id,s.category_sub_name,s.category_sub_tplType';
        $db->selectJson($table, $rows, $where, 'c.category_name', '', '');
        //echo 'select '.$rows.' from '.$table.' '.$where;
        $subcategories = $db->getJson();

        return $subcategories;
    }

    public function GetCategoryParentId($id) {
        $db = new database();
        $table = 'category ';
        $rows = 'category_parentId ';
        $where = ' category_id = ' . $id;
        $db->select($table, $rows, $where, '', '', '');
        $subcategory = $db->getResults();

        return $subcategory[0];
    }

    public function getPendingAdvertisments() {
        $db = new database();
        $table = 'advertisment a, category_sub sc';
        $rows = 'a.advertisment_id, a.advertisement_title, a.advertisement_date, sc.category_sub_name,
				 a.advertisement_contactEmail, date(a.advertisement_date), time(a.advertisement_date)';
        $where = ' a.advertisement_subCategoryId = sc.category_sub_id 
				   AND a.advertisement_status = 0';
        $db->selectJson($table, $rows, $where, '', '', '');
        $advertisment = $db->getJson();
        return $advertisment;
    }

    public function confirmAdvertisment($id) {
        $db = new database();
        $status = array();
        $status['advertisement_status'] = 0;
        $table = 'advertisment';
        $rows = $status;
        $where = 'advertisment_id = "' . $id . '"';
        if ($db->update($table, $rows, $where))
            return true;
        else
            return false;
    }

    public function approveAdvertisment($id) {
        $db = new database();
        $status = array();
        $status['advertisement_status'] = 1;
        $table = 'advertisment';
        $rows = $status;
        $where = 'advertisment_id = "' . $id . '"';
        if ($db->update($table, $rows, $where))
            return true;
        else
            return false;
    }

    public function deleteAdvertisment($id) {
        $db = new database();
        $status = array();
        $status['advertisement_status'] = 2;
        $table = 'advertisment';
        $rows = $status;
        $where = 'advertisment_id = "' . $id . '"';
        if ($db->update($table, $rows, $where))
            return true;
        else
            return false;
    }

    public function getCommentsAdmin() {
        $db = new database ();
        $table = 'item_comments c, advertisment ad';
        $rows = 'c.comment_Id, c.Comment, c.comment_Date, c.comment_Time, ad.advertisement_title';
        $where = 'c.advertisment_Id = ad.advertisment_id AND c.comment_status = "0"';
        $order_by = "c.comment_Id DESC";
        $db->selectJson($table, $rows, $where, $order_by, '');
        $add = $db->getJson();
        return $add;
    }

    public function approveComments($id) {
        $db = new database();
        $status = array();
        $status['comment_status'] = 1;
        $table = 'item_comments';
        $rows = $status;
        $where = 'comment_Id = "' . $id . '"';
        if ($db->update($table, $rows, $where))
            return true;
        else
            return false;
    }

    public function deleteComments($id) {
        $db = new database();
        $status = array();
        $status['comment_status'] = 2;
        $table = 'item_comments';
        $rows = $status;
        $where = 'comment_Id = "' . $id . '"';
        if ($db->update($table, $rows, $where))
            return true;
        else
            return false;
    }

    public function getEmployerEmailAddress($advertiesmentid) {
        try {
            $db = new database ();
            $table = 'advertisment ad, user us';
            $rows = 'us.user_email, ad.advertisement_addedBy';
            $where = 'ad.advertisement_addedBy=us.user_id and advertisment_id =' . $advertiesmentid;
            $order_by = "";
            $db->select($table, $rows, $where, $order_by, '');
            $resut = $db->getResults();

            return $resut;
        } catch (Exception $e) {
            $e . pr;
            return '';
        }
    }

    public function processJobApply($jobApplyDetails) {
        global $user_id;
        $mode = 3; // Apply jobs package/feature

        $ads = self::checkPackageAvailability($user_id, $mode);

        if ($ads !== '0') {

            $employerInfo = self::getEmployerEmailAddress($jobApplyDetails ['advertisement_id']);

            // Send Email to the customer
            // self::sendMessageToEmployer($employerInfo[0],$jobApplyDetails);
            // Save in DB (if need can be validated saving with email send step)
            $db = new database ();
            $date = date('y-m-d');
            $table = "jobapplydetails";

            $rows = "jobapplydetails_ad_id,
			jobapplydetails_employee_email,
			jobapplydetails_employee_phoneno,
			jobapplydetails_employee_massage,
			jobapplydetails_employee_userid,
			jobapplydetails_employer_userid,
			jobapplydetails_appliedon,
			jobapplydetails_status";

            $values = "'" . $jobApplyDetails ['advertisement_id'] . "',
				'" . $jobApplyDetails ['employee_email'] . "',
				'" . $jobApplyDetails ['employee_phoneno'] . "',
				'" . $jobApplyDetails ['employee_massage'] . "',
				'" . $user_id . "',
				'" . $employerInfo [1] . "',
				'" . $date . "',
				'0'";

            if ($db->insert($table, $values, $rows)) {
                $update = self::updatePackageAvailability($user_id, $mode);

                return $db->getInsertId();
            } else {
                return false;
            }
        } else {
            return "No_inventory";
        }
    }

    public function sendMessageToEmployer($emailAddress, $jobApplyDetails) {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: qatarone <qatarq1@gmail.com>' . "\r\n";
        $subject = 'Qatar One - Job Applicant request';
        $message = '
			
                            <html>
                            <body>
                                <p>
                                Hi, 
                                </p>
                                <p>
                                 ' . $jobApplyDetails['employee_massage'] . '
                                </p>
                                <p>
                                    Best Regards!<br>
   								' . $jobApplyDetails['employee_fname'] . '                                   
                                </p>
			
                            </body>
                            </html>';
        if (mail($emailAddress, $subject, $message, $headers))
            return true;
        else
            return false;
    }

    public function getJobsApplyInformation() {
        $db = new database();
        $table = ' advertisment a, jobapplydetails j, user u ';
        $rows = ' j.jobapplydetails_ad_id as ad_id, a.advertisement_title as title,u.user_firstname as name, j.jobapplydetails_employee_email as email, j.jobapplydetails_employee_phoneno contactnum, 
		j.jobapplydetails_employee_massage message, j.jobapplydetails_appliedon applydate, j.jobapplydetails_employee_userid as epmloyeeuserid ';
        $where = ' a.advertisment_id=j.jobapplydetails_ad_id
		AND u.user_id=j.jobapplydetails_employee_userid
		AND jobapplydetails_status = 0';
        $db->selectJson($table, $rows, $where, '', '', '');
        $advertisment = $db->getJson();
        return $advertisment;
    }

    public function getApplicantEmail($userid) {
        try {
            $db = new database ();
            $table = ' user ';
            $rows = 'user_email';
            $where = ' user_id =' . $userid;
            $order_by = "";
            $db->select($table, $rows, $where, $order_by, '');
            $resut = $db->getResults();

            return $resut;
        } catch (Exception $e) {
            $e . pr;
            return '';
        }
    }

    public function updateRating($ratingDetails) {
        global $user_id;

        $avail = self::checkRatingAvailable($user_id, $ratingDetails);

        if ($avail == '0') {
            return self::insertRating($user_id, $ratingDetails);
        } else {
            return self::setRating($user_id, $ratingDetails);
        }
    }

    public function setRating($user_id, $ratingDetails) {
        $db = new database (); // $user_id,$modeuser_New_password
        $query = 'update rating set rating_rate="' . $ratingDetails ['rate'] . '"
				where rating_user_id=' . $user_id . ' and rating_ad_id=' . $ratingDetails ['ad_id'] . '';
        if ($db->updatePreparedStatment($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkRatingAvailable($user_id, $ratingDetails) {
        try {
            $db = new database ();
            $table = ' rating ';
            $rows = 'count(*) as cnt';
            $where = ' rating_user_id=' . $user_id . ' and rating_ad_id=' . $ratingDetails ['ad_id'] . '';
            $order_by = "";
            $db->select($table, $rows, $where, $order_by, '');
            $resut = $db->getResults();
            // echo $resut[0];
            return $resut [0];
        } catch (Exception $e) {
            $e . pr;
            return '';
        }
    }

    public function insertRating($user_id, $ratingDetails) {
        //global $user_id;
        //print_r($ratingDetails);
        $db = new database ();
        $table = "rating";
        $rows = "rating_ad_id,
			rating_user_id,
			rating_rate";
        $values = "'" . $ratingDetails ['ad_id'] . "',
				'" . $user_id . "',
				'" . $ratingDetails ['rate'] . "'";

        if ($db->insert($table, $values, $rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function getRating($adid) {
        try {
            $db = new database ();
            $table = ' rating ';
            $rows = 'round(sum(rating_rate)/count(*)) as starrate';
            $where = ' rating_ad_id=' . $adid;
            $order_by = "";
            $db->select($table, $rows, $where, $order_by, '');
            $resut = $db->getResults();

            return $resut[0];
        } catch (Exception $e) {
            $e . pr;
            return '';
        }
    }

    public function updateUserDetails($user_id, $userProfile) {
        $avail = self::validateExistingPassword($user_id, $userProfile);
        $res = 'Current PassWord incorrect..!';

        if ($avail == '1') {

            if ($userProfile ["user_New_password"] == $userProfile ["user_confirmPassword"]) {

                self::updatePassWord($user_id, $userProfile);
                $res = 'true';
            } else {
                $res = 'Confirm PassWord incorrect..!';
            }
        }
        return $res;
    }

    public function validateExistingPassword($user_id, $userProfile) {
        try {
            $db = new database ();
            $table = ' user ';
            $rows = 'count(*) as cnt';
            $where = ' user_id=' . $user_id . ' and user_password="' . md5($userProfile ["user_password"]) . '"';
            $order_by = "";
            $db->select($table, $rows, $where, $order_by, '');
            $resut = $db->getResults();
            // echo $resut[0];
            return $resut [0];
        } catch (Exception $e) {
            $e . pr;
            return '';
        }
    }

    public function updatePassWord($user_id, $userProfile) {
        $db = new database (); // $user_id,$modeuser_New_password
        $query = 'update user set user_password="' . md5($userProfile ["user_New_password"]) . '"
				where user_id=' . $user_id . '';
        if ($db->updatePreparedStatment($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserEmailAddress($userid) {
        try {
            //echo $userid;
            $db = new database ();
            $table = 'user ';
            $rows = 'user_email ';
            $where = ' user_id =' . $userid;
            $order_by = "";
            $db->select($table, $rows, $where, $order_by, '');
            $resut = $db->getResults();

            return $resut[0];
        } catch (Exception $e) {
            $e . pr;
            return '';
        }
    }

    public function myAdvertisments($user_id) {
        //global  $userid;

        $db = new database ();
        $table = 'advertisment ';
        $rows = 'advertisment_id, advertisement_title, advertisement_expire, advertisement_date';
        $where = ' advertisement_addedBy=' . $user_id . ' and advertisement_expire>=current_date';
        $db->selectJson($table, $rows, $where, '', '');
        $add = $db->getJson();
        return $add;
    }

    public function getPendingAdvertismentDetail($id) {
        $db = new database();
        $table = 'advertisment a, category_sub sc, locations l, suburbs s  ';
        $rows = 'a.advertisment_id, a.advertisement_title, a.advertisement_date, sc.category_sub_name,a.advertisement_description,
                a.advertisement_price,a.advertisement_contactNo,l.location_name,s.suburb_name,a.advertisement_contactName,
                a.advertisement_contactEmail, date(a.advertisement_date), time(a.advertisement_date)';
        $where = ' a.advertisement_subCategoryId = sc.category_sub_id 
                   AND a.advertisement_location = l.location_id
                   AND a.advertisement_suburb = s.suburb_id
                   AND a.advertisement_status = 0 AND a.advertisment_id = "'.$id.'"';
        $db->selectJson($table, $rows, $where, '', '', '');
        $advertismentDetail = $db->getJson();
        return $advertismentDetail;
    }

}

?>
