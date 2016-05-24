<?php
class HomepagesBackoffice extends Model{
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
                //Required
                if(empty($input) || $input == null){
                    $return['error'][$key] = 'Title cannot be empty';
                }
            }
        }
        return $return;
    }

    /**
	 * FUNCTION: selectDataByID
	 * This function gets homepages information for backoffice
	 * @param int $id
	 */
	public function selectDataByID($id){
		$sql = "SELECT t1.id, t1.title
				FROM homepages t1
				WHERE t1.id = :id";

		return $this->_db->select($sql, array(':id' => $id));
	}

    /**
	 * FUNCTION: getAllData
	 * This function returns the details for All homepages
	 * @param int $limit, $keywords
	 */
	public function getAllData($limit = false, $keywords = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT t1.id, t1.title
				FROM homepages t1
				WHERE 1 = 1
				".$optKeywords."
				ORDER BY t1.id DESC
				".$optLimit;

		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: countAllData
	 * This function returns the count for All homepages
	 * @param int $keywords
	 */
	public function countAllData($keywords = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT COUNT(t1.id) AS total
				FROM homepages t1
				WHERE 1 = 1
				".$optKeywords;
		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: createData
	 * This function adds a new homepages to the Database from backoffice
	 * @param mixed $data Array of homepages Data
	 */
	public function createData($data){
        $data = $this->validation($data, 'add');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'homepages';
            $postData = array(
                'title' => $data['title'],
            );

            $this->_db->insert($dbTable, $postData);

            // Gets Last Insert ID
            return $lastInsertID = $this->_db->lastInsertId('id');
        }
	}

    /**
	 * FUNCTION: updateData
	 * This function updates homepages details for backoffice
	 * @param mixed $data An array of data passed from the Controller
	 */
	public function updateData($data){
        $data = $this->validation($data, 'edit');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'homepages';
            $postData = array(
                'title' => $data['title']
            );
            $where = "`id` = {$data['id']}";

            $this->_db->update($dbTable, $postData, $where);
            return true;
        }
	}

    /**
	 * FUNCTION: deleteData
	 * This function deletes an homepages
	 * @param Int $id of an homepages
	 */
    public function deleteData($id){
        $dbTable = 'homepages';
        $where = "`id` = $id";
        $this->_db->delete($dbTable, $where);
		return true;
    }

}?>