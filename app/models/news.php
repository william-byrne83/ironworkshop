<?php
class News extends Model{
    /** __construct */
    public function __construct(){
        parent::__construct();
    }

    /**
     * FUNCTION: selectDataByID
     * This function gets news information for backoffice
     * @param int $id
     */
    public function selectDataByID($id){
        $sql = "SELECT t1.id, t1.title, t1.slug, t1.text, t1.image, t1.video, t1.date, GROUP_CONCAT(DISTINCT t3.id) AS categories
				FROM news t1
				  LEFT JOIN news_categories t2 ON t1.id = t2.news_id
				    LEFT JOIN categories t3 ON t2.category_id = t3.id AND t3.is_active = 1
				WHERE t1.id = :id
                GROUP BY t1.id
                ";

        return $this->_db->select($sql, array(':id' => $id));
    }

    /**
     * FUNCTION: getAllData
     * This function returns the details for All news
     * @param int $limit, $keywords
     */
    public function getAllData($limit = false, $keywords = false, $active = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optActive = $active != false ? " AND t1.is_active = $active" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' ')), IF(isnull(t1.slug),' ',CONCAT(LOWER(t1.slug),' '))) LIKE '%$keywords%'" : "";

        $sql = "SELECT t1.id, t1.title, t1.slug, t1.text, t1.image, t1.video, t1.date, GROUP_CONCAT(DISTINCT t3.name) AS categories
				FROM news t1
                  LEFT JOIN news_categories t2 ON t1.id = t2.news_id
				    LEFT JOIN categories t3 ON t2.category_id = t3.id AND t3.is_active = 1
				WHERE 1 = 1
				".$optKeywords."
                ".$optActive."
                GROUP BY t1.id
				ORDER BY t1.id DESC
				".$optLimit;

        return $this->_db->select($sql);
    }

    /**
     * FUNCTION: countAllData
     * This function returns the count for All news
     * @param int $keywords
     */
    public function countAllData($keywords = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' ')), IF(isnull(t1.slug),' ',CONCAT(LOWER(t1.slug),' '))) LIKE '%$keywords%'" : "";

        $sql = "SELECT COUNT(t1.id) AS total
				FROM news t1
				WHERE 1 = 1
				".$optKeywords;
        return $this->_db->select($sql);
    }


    /**
     * FUNCTION: selectDataByTitle
     * This function gets date based on title
     * @param int $title
     */
    public function selectDataByTitle($title){
        $sql = "SELECT t1.id
				FROM news t1
				WHERE t1.title = :title";

        return $this->_db->select($sql, array(':title' => $title));
    }

}?>