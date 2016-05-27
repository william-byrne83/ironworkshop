<?php
class AboutUs extends Model{
	/** __construct */
	public function __construct(){
		parent::__construct();
	}


    /**
	 * FUNCTION: selectDataByID
	 * This function gets about_us information for backoffice
	 * @param int $id
	 */
	public function selectDataByID($id){
		$sql = "SELECT t1.id, t1.text, t1.monday, t1.tuesday, t1.wednesday, t1.thursday, t1.friday, t1.saturday, t1.sunday, t1.pricing
				FROM about_us t1
				WHERE t1.id = :id";

		return $this->_db->select($sql, array(':id' => $id));
	}

    /**
	 * FUNCTION: getAllData
	 * This function returns the details for All about_us
	 * @param int $limit, $keywords
	 */
	public function getAllData($limit = false, $keywords = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.text),' ',CONCAT(LOWER(t1.text),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT t1.id, t1.text, t1.monday, t1.tuesday, t1.wednesday, t1.thursday, t1.friday, t1.saturday, t1.sunday, t1.pricing
				FROM about_us t1
				WHERE 1 = 1
				".$optKeywords."
				ORDER BY t1.id DESC
				".$optLimit;

		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: countAllData
	 * This function returns the count for All about_us
	 * @param int $keywords
	 */
	public function countAllData($keywords = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.text),' ',CONCAT(LOWER(t1.text),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT COUNT(t1.id) AS total
				FROM about_us t1
				WHERE 1 = 1
				".$optKeywords;
		return $this->_db->select($sql);
	}





    /**
	 * FUNCTION: deleteData
	 * This function deletes an about_us
	 * @param Int $id of an about_us
	 */
    public function deleteData($id){
        $dbTable = 'about_us';
        $where = "`id` = $id";
        $this->_db->delete($dbTable, $where);
		return true;
    }

}?>