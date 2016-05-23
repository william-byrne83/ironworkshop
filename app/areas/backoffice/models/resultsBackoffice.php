<?php
class ResultsBackoffice extends Model{
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

            //text
            if($key == 'text'){
                //required
                if(empty($input) || $input == null){
                    $return['error'][$key] = 'text cannot be empty';
                }
            }

            //image
            if($key == 'image'){
                //required
                if(empty($input) || $input == null){
                    $return['error'][$key] = 'Result Image cannot be empty';
                }
            }
        }
        return $return;
    }

    /**
	 * FUNCTION: selectDataByID
	 * This function gets results information for backoffice
	 * @param int $id
	 */
	public function selectDataByID($id){
		$sql = "SELECT t1.id, t1.trainer_id, t1.image, t1.text, t1.sort, t1.is_active
				FROM results t1
				WHERE t1.id = :id
                ";

		return $this->_db->select($sql, array(':id' => $id));
	}

    /**
	 * FUNCTION: getAllData
	 * This function returns the details for All results
	 * @param int $limit, $keywords
	 */
	public function getAllData($limit = false, $keywords = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.text),' ',CONCAT(LOWER(t1.text),' ')), IF(isnull(t2.name),' ',CONCAT(LOWER(t2.name),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT t1.id, t1.trainer_id, t1.image, t1.text, t1.sort, t1.is_active, t2.name
				FROM results t1
				  LEFT JOIN trainers t2 ON t1.trainer_id = t2.id
				WHERE 1 = 1
				".$optKeywords."
                GROUP BY t1.id
				ORDER BY t1.sort ASC
				".$optLimit;

		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: countAllData
	 * This function returns the count for All results
	 * @param int $keywords
	 */
	public function countAllData($keywords = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.text),' ',CONCAT(LOWER(t1.text),' ')), IF(isnull(t2.name),' ',CONCAT(LOWER(t2.name),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT COUNT(t1.id) AS total
				FROM results t1
                  LEFT JOIN trainers t2 ON t1.trainer_id = t2.id
				WHERE 1 = 1
				".$optKeywords."
                GROUP BY t1.id";
		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: createData
	 * This function adds a new results to the Database from backoffice
	 * @param mixed $data Array of results Data
	 */
	public function createData($data){
        $data = $this->validation($data, 'add');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'results';
            $postData = array(
                'trainer_id' => $data['trainer_id'],
                'text' => $data['text'],
                'image' => $data['image'][0],
                'is_active' => $data['is_active']
            );

            $this->_db->insert($dbTable, $postData);

            // Gets Last Insert ID
            return $lastInsertID = $this->_db->lastInsertId('id');
        }
	}

    /**
	 * FUNCTION: updateData
	 * This function updates results details for backoffice
	 * @param mixed $data An array of data passed from the Controller
	 */
	public function updateData($data){
        $data = $this->validation($data, 'edit');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'results';
            $postData = array(
                'trainer_id' => $data['trainer_id'],
                'text' => $data['text'],
                'image' => $data['image'][0],
                'is_active' => $data['is_active']
            );
            $where = "`id` = {$data['id']}";

            $this->_db->update($dbTable, $postData, $where);
            return true;
        }
	}

    /**
	 * FUNCTION: deleteData
	 * This function deletes an results
	 * @param Int $id of an results
	 */
    public function deleteData($id){
        $dbTable = 'results';
        $where = "`id` = $id";
        $this->_db->delete($dbTable, $where);
		return true;
    }

    /**
	 * FUNCTION: updateSortOrder
	 * This function updates the results order field
	 * @param Int $id, int $order
	 */
    public function updateSortOrder($id, $order){
        $id = FormInput::checkInput($id);
        $order = FormInput::checkInput($order);

        $dbTable = 'results';
        $postData = array(
            'sort' => $order,
        );
        $where = "`id` = {$id}";
        $this->_db->update($dbTable, $postData, $where);
        return true;
    }


    /**
	 * FUNCTION: updateOldSortOrder
	 * This function updates the results order field based on its order value
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

        $dbTable = 'results';
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
				FROM results t1";

		return $this->_db->select($sql);
    }

}?>