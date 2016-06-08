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
    public function getAllData($limit = false, $keywords = false, $active = false, $categories = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optActive = $active != false ? " AND t1.is_active = $active" : "";
        $optCategories = $categories != false ? " AND t2.category_id = $categories" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' ')), IF(isnull(t1.slug),' ',CONCAT(LOWER(t1.slug),' '))) LIKE '%$keywords%'" : "";

        $sql = "SELECT t1.id, t1.title, t1.slug, t1.text, t1.image, t1.video, t1.date, GROUP_CONCAT(DISTINCT t3.name) AS categories
				FROM news t1
                  LEFT JOIN news_categories t2 ON t1.id = t2.news_id
				    LEFT JOIN categories t3 ON t2.category_id = t3.id AND t3.is_active = 1
				WHERE 1 = 1
				".$optKeywords."
                ".$optActive."
                ".$optCategories."
                GROUP BY t1.id
				ORDER BY t1.date DESC
				".$optLimit;

        return $this->_db->select($sql);
    }

    /**
     * FUNCTION: countAllData
     * This function returns the count for All news
     * @param int $keywords
     */
    public function countAllData($keywords = false, $active = false, $categories = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' ')), IF(isnull(t1.slug),' ',CONCAT(LOWER(t1.slug),' '))) LIKE '%$keywords%'" : "";
        $optActive = $active != false ? " AND t1.is_active = $active" : "";
        $optCategories = $categories != false ? " AND t2.category_id = $categories" : "";

        $sql = "SELECT COUNT(t1.id) AS total
				FROM news t1
                  LEFT JOIN news_categories t2 ON t1.id = t2.news_id
				    LEFT JOIN categories t3 ON t2.category_id = t3.id AND t3.is_active = 1
				WHERE 1 = 1
				".$optActive."
				".$optCategories."
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

    /**
     * FUNCTION: getAllCategories
     * This function gets date based on title
     */
    public function getAllCategories(){
        $sql = "SELECT t1.*
				FROM categories t1
				WHERE t1.is_active = 1";

        return $this->_db->select($sql);
    }

    /**
     * FUNCTION: selectDataBySlug
     * This function gets data based on title
     * @param string $slug
     */
    public function selectDataBySlug($slug){
        $sql = "SELECT t1.*
				FROM news t1
				WHERE t1.slug = :slug AND t1.is_active = 1";

        return $this->_db->select($sql, array(':slug' => $slug));
    }


}?>