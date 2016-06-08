<?php
class Stores extends Model{
	/** __construct */
	public function __construct(){
		parent::__construct();
	}

    /**
	 * FUNCTION: selectDataByID
	 * This function gets stores information for backoffice
	 * @param int $id
	 */
	public function selectDataByID($id){
		$sql = "SELECT t1.id, t1.price, t1.title, t1.slug, t1.text, t1.sort, t1.is_active
				FROM stores t1
				WHERE t1.id = :id
                ";
		return $this->_db->select($sql, array(':id' => $id));
	}

    /**
	 * FUNCTION: getAllData
	 * This function returns the details for All stores
	 * @param int $limit, $keywords
	 */
	public function getAllData($limit = false, $keywords = false, $active = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optActive = $active != false ? " AND t1.is_active = $active" : "" ;
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.price),' ',CONCAT(LOWER(t1.price),' ')), IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT t1.id, t1.price, t1.title, t1.slug, t1.text, t1.sort, t1.is_active
				FROM stores t1
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
	 * This function returns the count for All stores
	 * @param int $keywords
	 */
	public function countAllData($keywords = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.price),' ',CONCAT(LOWER(t1.price),' ')), IF(isnull(t1.title),' ',CONCAT(LOWER(t1.title),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT COUNT(t1.id) AS total
				FROM stores t1
				WHERE 1 = 1
				".$optKeywords."
                ";
		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: deleteData
	 * This function deletes an stores
	 * @param Int $id of an stores
	 */
    public function deleteData($id){
        $dbTable = 'stores';
        $where = "`id` = $id";
        $this->_db->delete($dbTable, $where);
		return true;
    }

    /**
	 * FUNCTION: selectDataByTitle
	 * This function gets date based on title
	 * @param int $title
	 */
	public function selectDataByTitle($title){
		$sql = "SELECT t1.id
				FROM stores t1
				WHERE t1.title = :title";

		return $this->_db->select($sql, array(':title' => $title));
	}

    /**
	 * FUNCTION: getHeroImage
	 * This function gets the lowest sorted store_images
	 * @param int $id
	 */
    public function getHeroImage($id, $active = false){
        $optActive = $active != false ? " AND t1.is_active = $active" : "" ;

        $sql = "SELECT t1.store_id, t1.sort, t1.image, t1.title
				FROM store_images t1
				WHERE t1.store_id = :id
				".$optActive."
				ORDER BY t1.sort ASC
				LIMIT 1";

		return $this->_db->select($sql, array(':id' => $id));
    }

    /**
     * FUNCTION: selectDataBySlug
     * This function gets data based on title
     * @param string $slug
     */
    public function selectDataBySlug($slug){
        $sql = "SELECT t1.*
				FROM stores t1
				WHERE t1.slug = :slug AND t1.is_active = 1";

        return $this->_db->select($sql, array(':slug' => $slug));
    }

    /**
     * FUNCTION: getStoreImagesByStoreId
     * This function gets data based on title
     * @param int $id
     */
    public function getStoreImagesByStoreId($id){
        $sql = "SELECT t1.*
				FROM store_images t1
				WHERE t1.store_id = :id AND t1.is_active = 1
				ORDER BY t1.sort ASC";

        return $this->_db->select($sql, array(':id' => $id));
    }

}?>