<?php
class CategoriesBackoffice extends Model{
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

            //name
            if($key == 'name'){
                //Max length
                $temp = Form::MaxLength($input, 100);
                if($temp[0] != true){
                    $return['error'][$key] = 'Name should not exceed 100 characters';
                }

                //Required
                if(empty($input) || $input == null){
                    $return['error'][$key] = 'Name cannot be empty';
                }
            }
        }
        return $return;
    }

    /**
	 * FUNCTION: selectDataByID
	 * This function gets categories information for backoffice
	 * @param int $id
	 */
	public function selectDataByID($id){
		$sql = "SELECT t1.id, t1.name, t1.is_active
				FROM categories t1
				WHERE t1.id = :id";

		return $this->_db->select($sql, array(':id' => $id));
	}

    /**
	 * FUNCTION: getAllData
	 * This function returns the details for All categories
	 * @param int $limit, $keywords
	 */
	public function getAllData($limit = false, $keywords = false, $active = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optActive = $active != false ? " AND t1.is_active = 1" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.id),' ',CONCAT(LOWER(t1.id),' ')),IF(isnull(t1.name),' ',CONCAT(LOWER(t1.name),'  '))) LIKE '%$keywords%'" : "";

        $sql = "SELECT t1.id, t1.name, t1.is_active
				FROM categories t1
				WHERE 1 = 1
				".$optKeywords."
				".$optActive."
				ORDER BY t1.id DESC
				".$optLimit;

		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: countAllData
	 * This function returns the count for All categories
	 * @param int $keywords
	 */
	public function countAllData($keywords = false, $active = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.id),' ',CONCAT(LOWER(t1.id),' ')),IF(isnull(t1.name),' ',CONCAT(LOWER(t1.name),'  '))) LIKE '%$keywords%'" : "";
        $optActive = $active != false ? " AND t1.is_active = 1" : "";

		$sql = "SELECT COUNT(t1.id) AS total
				FROM categories t1
				WHERE 1 = 1
				".$optActive."
				".$optKeywords;
		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: createData
	 * This function adds a new categories to the Database from backoffice
	 * @param mixed $data Array of categories Data
	 */
	public function createData($data){
        $data = $this->validation($data, 'add');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'categories';
            $postData = array(
                'name' => $data['name'],
                'is_active' => $data['is_active']
            );

            $this->_db->insert($dbTable, $postData);

            // Gets Last Insert ID
            return $lastInsertID = $this->_db->lastInsertId('id');
        }
	}

    /**
	 * FUNCTION: updateData
	 * This function updates categories details for backoffice
	 * @param mixed $data An array of data passed from the Controller
	 */
	public function updateData($data){
        $data = $this->validation($data, 'edit');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'categories';
            $postData = array(
                'name' => $data['name'],
                'is_active' => $data['is_active']
            );
            $where = "`id` = {$data['id']}";

            $this->_db->update($dbTable, $postData, $where);
            return true;
        }
	}

    /**
	 * FUNCTION: deleteData
	 * This function deletes an categories
	 * @param Int $id of an categories
	 */
    public function deleteData($id){
        $dbTable = 'categories';
        $where = "`id` = $id";
        $this->_db->delete($dbTable, $where);
		return true;
    }

    /**
	 * FUNCTION: getDataByID
	 * This function gets the user by their ID
	 * @param int $id
	 */
	public function getDataByID($id){
        $sql = "SELECT t1.id, t1.name, t1.is_active
				FROM categories t1
				WHERE t1.id = :id";

        return $this->_db->select($sql, array(':id' => $id));
    }

}?>