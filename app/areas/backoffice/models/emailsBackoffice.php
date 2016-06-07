<?php
class EmailsBackoffice extends Model{
	/** __construct */
	public function __construct(){
		parent::__construct();
	}

    /**
	 * FUNCTION: selectDataByID
	 * This function gets emails information for backoffice
	 * @param int $id
	 */
	public function selectDataByID($id){
        $sql = "SELECT t1.*
				FROM emails t1
				WHERE t1.id = :id";

		return $this->_db->select($sql, array(':id' => $id));
	}

    /**
	 * FUNCTION: getAllData
	 * This function returns the details for All emails
	 * @param int $limit, $keywords
	 */
	public function getAllData($limit = false, $keywords = false, $active = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optActive = $active != false ? " AND t1.is_active = 1" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.email),' ',CONCAT(LOWER(t1.email),' '))) LIKE '%$keywords%'" : "";

        $sql = "SELECT t1.*
				FROM emails t1
				WHERE 1 = 1
				".$optKeywords."
				".$optActive."
				ORDER BY t1.id DESC
				".$optLimit;

		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: countAllData
	 * This function returns the count for All emails
	 * @param int $keywords
	 */
	public function countAllData($keywords = false, $active = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.email),' ',CONCAT(LOWER(t1.email),' '))) LIKE '%$keywords%'" : "";
        $optActive = $active != false ? " AND t1.is_active = 1" : "";

		$sql = "SELECT COUNT(t1.id) AS total
				FROM emails t1
				WHERE 1 = 1
				".$optActive."
				".$optKeywords;
		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: deleteData
	 * This function deletes an emails
	 * @param Int $id of an emails
	 */
    public function deleteData($id){
        $dbTable = 'emails';
        $where = "`id` = $id";
        $this->_db->delete($dbTable, $where);
		return true;
    }

}?>