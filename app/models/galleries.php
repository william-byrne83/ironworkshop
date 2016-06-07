<?php
class Galleries extends Model{
    /** __construct */
    public function __construct(){
        parent::__construct();
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
    public function getAllData($limit = false, $keywords = false, $active = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optActive = $active != false ? " AND t1.is_active = $active" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";

        $sql = "SELECT t1.id, t1.title, t1.slug, t1.image, t1.video, t1.sort, t1.is_active
				FROM galleries t1
				WHERE 1 = 1
				".$optKeywords."
				".$optActive."
				ORDER BY t1.sort ASC
				".$optLimit;

        return $this->_db->select($sql);
    }

    /**
     * FUNCTION: countAllData
     * This function returns the count for All galleries
     * @param int $keywords
     */
    public function countAllData($keywords = false, $active = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";
        $optActive = $active != false ? " AND t1.is_active = $active" : "";


        $sql = "SELECT COUNT(t1.id) AS total
				FROM galleries t1
				WHERE 1 = 1
				".$optActive."
				".$optKeywords;

        return $this->_db->select($sql);
    }


    /**
     * FUNCTION: selectDataBySlug
     * This function gets date based on title
     * @param string $slug
     */
    public function selectDataBySlug($slug){
        $sql = "SELECT t1.*
				FROM galleries t1
				WHERE t1.slug = :slug AND t1.is_active = 1";

        return $this->_db->select($sql, array(':slug' => $slug));
    }

}?>