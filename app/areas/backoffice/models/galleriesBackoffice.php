<?php
class GalleriesBackoffice extends Model{
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

            //title
            if($key == 'title'){
                //required
                if(empty($input) || $input == null){
                    $return['error'][$key] = 'Image Title cannot be empty';
                }else{
                    // Creating slug based off formatted title.
                    $temp = Formatting::removeAccents($input);
					$temp = FormatUrl($temp);
                    $return['slug'] = $temp;
                }
            }
        }
        return $return;
    }

    /**
	 * FUNCTION: selectDataByID
	 * This function gets galleries information for backoffice
	 * @param int $id
	 */
	public function selectDataByID($id){
		$sql = "SELECT t1.id, t1.title, t1.slug, t1.image, t1.video, t1.sort, t1.is_active
				FROM galleries t1
				WHERE t1.id = :id
                ";

		return $this->_db->select($sql, array(':id' => $id));
	}

    /**
	 * FUNCTION: getAllData
	 * This function returns the details for All galleries
	 * @param int $limit, $keywords
	 */
	public function getAllData($limit = false, $keywords = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT t1.id, t1.title, t1.slug, t1.image, t1.video, t1.sort, t1.is_active
				FROM galleries t1
				WHERE 1 = 1
				".$optKeywords."
				ORDER BY t1.sort ASC
				".$optLimit;

		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: countAllData
	 * This function returns the count for All galleries
	 * @param int $keywords
	 */
	public function countAllData($keywords = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT COUNT(t1.id) AS total
				FROM galleries t1
				WHERE 1 = 1
				".$optKeywords;
		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: createData
	 * This function adds a new galleries to the Database from backoffice
	 * @param mixed $data Array of galleries Data
	 */
	public function createData($data){
        $data = $this->validation($data, 'add');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'galleries';
            $postData = array(
                'title' => $data['title'],
                'slug' => $data['slug'],
                'image' => $data['image'][0],
                'video' => $data['video'],
                'is_active' => $data['is_active']
            );

            $this->_db->insert($dbTable, $postData);

            // Gets Last Insert ID
            return $lastInsertID = $this->_db->lastInsertId('id');
        }
	}

    /**
	 * FUNCTION: updateData
	 * This function updates galleries details for backoffice
	 * @param mixed $data An array of data passed from the Controller
	 */
	public function updateData($data){
        $data = $this->validation($data, 'edit');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'galleries';
            $postData = array(
                'title' => $data['title'],
                'slug' => $data['slug'],
                'image' => $data['image'][0],
                'video' => $data['video'],
                'is_active' => $data['is_active']
            );
            $where = "`id` = {$data['id']}";

            $this->_db->update($dbTable, $postData, $where);
            return true;
        }
	}

    /**
	 * FUNCTION: deleteData
	 * This function deletes an galleries
	 * @param Int $id of an galleries
	 */
    public function deleteData($id){
        $dbTable = 'galleries';
        $where = "`id` = $id";
        $this->_db->delete($dbTable, $where);
		return true;
    }

    /**
	 * FUNCTION: updateSortOrder
	 * This function updates the galleries order field
	 * @param Int $id, int $order
	 */
    public function updateSortOrder($id, $order){
        $id = FormInput::checkInput($id);
        $order = FormInput::checkInput($order);

        $dbTable = 'galleries';
        $postData = array(
            'sort' => $order,
        );
        $where = "`id` = {$id}";
        $this->_db->update($dbTable, $postData, $where);
        return true;
    }


    /**
	 * FUNCTION: updateOldSortOrder
	 * This function updates the galleries order field based on its order value
	 * @param String $direction, Int $order
	 */
    public function updateOldSortOrder($direction = false, $order = false){
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

        $dbTable = 'galleries';
        $where = "`sort` = {$order}";
        $this->_db->update($dbTable, $postData, $where);
        return true;
    }

    /**
	 * FUNCTION: getMaxOrder
	 * This function returns the max order of the model
	 */
    public function getMaxOrder(){
        $sql = "SELECT MAX(t1.sort) AS max_order
				FROM galleries t1";

		return $this->_db->select($sql);
    }

}?>