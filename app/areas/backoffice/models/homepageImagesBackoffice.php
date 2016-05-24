<?php
class HomepageImagesBackoffice extends Model{
	/** __construct */
	public function __construct(){
		parent::__construct();
	}

    /**
	 * FUNCTION: validation
	 * This function validates post data, and should be called for any update or create model calls.
	 * @param mixed array $data, $type can define different standards depending on if edit for example.
	 */
    public function validation($data, $type){
        $return = $data;
        foreach($data as $key => $input){
            $temp = null;
            $input = is_array($input) ? FormInput::trimArray($input) : FormInput::checkInput($input);
            $return[$key] = $input;

            //image
            if($key == 'image'){
                //required
                if(empty($input) || $input == null){
                    $return['error'][$key] = 'Image cannot be empty';
                }
            }

            //title
            if($key == 'title'){
                //required
                if(empty($input) || $input == null){
                    $return['error'][$key] = 'Title cannot be empty';
                }
            }

        }
        return $return;
    }

    /**
	 * FUNCTION: selectDataByID
	 * This function gets homepage_images information for backoffice
	 * @param int $id
	 */
	public function selectDataByID($id){
		$sql = "SELECT t1.id, t1.homepage_id, t1.sort, t1.image, t1.title, t1.is_active
				FROM homepage_images t1
				WHERE t1.id = :id
                ";
		return $this->_db->select($sql, array(':id' => $id));
	}

    /**
	 * FUNCTION: getAllData
	 * This function returns the details for All homepage_images
	 * @param int $limit, $keywords
	 */
	public function getAllData($limit = false, $keywords = false, $active = false, $id = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optActive = $active != false ? " AND t1.is_active = $active" : "" ;
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";
        $optHomepage = $id != false ? " AND t1.homepage_id = $id" : "";

		$sql = "SELECT t1.id, t1.homepage_id, t1.sort, t1.image, t1.title, t1.is_active
				FROM homepage_images t1
				WHERE 1 = 1
				".$optKeywords."
				".$optActive."
				".$optHomepage."
				ORDER BY t1.sort ASC
				".$optLimit;

		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: countAllData
	 * This function returns the count for All homepage_images
	 * @param int $keywords
	 */
	public function countAllData($keywords = false, $id = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";
        $optHomepage = $id != false ? " AND t1.homepage_id = $id" : "";

		$sql = "SELECT COUNT(t1.id) AS total
				FROM homepage_images t1
				WHERE 1 = 1
				".$optKeywords."
				".$optHomepage."
                ";
		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: createData
	 * This function adds a new homepage_images to the Database from backoffice
	 * @param mixed $data Array of homepage_images Data
	 */
	public function createData($data){
        $data = $this->validation($data, 'add');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'homepage_images';
            $postData = array(
                'image' => $data['image'][0],
                'title' => $data['title'],
                'homepage_id' => $data['homepage_id'],
                'is_active' => $data['is_active']
            );

            $this->_db->insert($dbTable, $postData);

            // Gets Last Insert ID
            return $lastInsertID = $this->_db->lastInsertId('id');
        }
	}

    /**
	 * FUNCTION: updateData
	 * This function updates homepage_images details for backoffice
	 * @param mixed $data An array of data passed from the Controller
	 */
	public function updateData($data){
        $data = $this->validation($data, 'edit');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'homepage_images';
            $postData = array(
                'image' => $data['image'][0],
                'title' => $data['title'],
                'homepage_id' => $data['homepage_id'],
                'is_active' => $data['is_active']
            );
            $where = "`id` = {$data['id']}";

            $this->_db->update($dbTable, $postData, $where);
            return true;
        }
	}

    /**
	 * FUNCTION: deleteData
	 * This function deletes an homepage_images
	 * @param Int $id of an homepage_images
	 */
    public function deleteData($id){
        $dbTable = 'homepage_images';
        $where = "`id` = $id";
        $this->_db->delete($dbTable, $where);
		return true;
    }

    /**
	 * FUNCTION: updateSortOrder
	 * This function updates the homepage_images order field
	 * @param Int $id, int $order
	 */
    public function updateSortOrder($id, $order, $store_id){
        $id = FormInput::checkInput($id);
        $order = FormInput::checkInput($order);

        $dbTable = 'homepage_images';
        $postData = array(
            'sort' => $order,
        );
        $where = "`id` = {$id} AND `homepage_id` = {$store_id}";
        $this->_db->update($dbTable, $postData, $where);
        return true;
    }


    /**
	 * FUNCTION: updateOldSortOrder
	 * This function updates the homepage_images order field based on its order value
	 * @param String $direction, Int $order
	 */
    public function updateOldSortOrder($direction = false, $order = false, $store_id){
        $direction = FormInput::checkInput($direction);
        $order = FormInput::checkInput($order);

        // If add then add 1 to order
        if($direction == 'add'){
            $postData = array(
                'sort' => $order+1
            );
        // If down trhen minus 1 to order
        }elseif($direction == 'subtract'){
            // Need to make sure we don't drop below 0
            if(($order-1) <= 0){
                $order = 1;
            }
            $postData = array(
                'sort' => $order-1
            );
        }else{
            return false;
        }

        $dbTable = 'homepage_images';
        $where = "`sort` = {$order} AND `homepage_id` = {$store_id}";
        $this->_db->update($dbTable, $postData, $where);
        return true;
    }

    /**
	 * FUNCTION: getMaxOrder
	 * This function returns the max order of the model
	 */
    public function getMaxOrder(){
        $sql = "SELECT MAX(t1.sort) AS max_order
				FROM homepage_images t1";

		return $this->_db->select($sql);
    }


    /**
	 * FUNCTION: deleteAllImagesById
	 * This function deletes all images based on parent ID
	 * @param Int $id
	 */
    public function deleteAllImagesById($id){
        $dbTable = 'homepage_images';
        $where = "`homepage_id` = $id";
        $this->_db->delete($dbTable, $where);
    }

}?>