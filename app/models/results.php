<?php
class Results extends Model{
    /** __construct */
    public function __construct(){
        parent::__construct();
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
    public function getAllData($limit = false, $keywords = false, $active = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optActive = $active != false ? " AND t1.is_active = $active" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.text),' ',CONCAT(LOWER(t1.text),' ')), IF(isnull(t2.name),' ',CONCAT(LOWER(t2.name),' '))) LIKE '%$keywords%'" : "";

        $sql = "SELECT t1.id, t1.trainer_id, t1.image, t1.text, t1.sort, t1.is_active, t2.name
				FROM results t1
				  LEFT JOIN trainers t2 ON t1.trainer_id = t2.id
				WHERE 1 = 1
				".$optKeywords."
                ".$optActive."
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


}?>