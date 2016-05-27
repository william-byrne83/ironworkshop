<?php
class Homepages extends Model{
	/** __construct */
	public function __construct(){
		parent::__construct();
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


    /**
	 * FUNCTION: getHomepageImagesById
	 * This function gets homepage images by parent id
	 * @param Int $id of an homepages
	 */
    public function getHomepageImagesById($id){
        $sql = "SELECT t1.*
				FROM homepage_images t1
				WHERE t1.homepage_id = :id AND t1.is_active = 1
				ORDER BY t1.sort ASC";
		return $this->_db->select($sql, array(':id' => $id));

    }

}?>