<?php
class TrainersBackoffice extends Model{
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
		$sql = "SELECT t1.id, t1.name, t1.slug, t1.text, t1.phone, t1.email, t1.website, t1.sort, t1.is_active, t1.facebook, t1.twitter, t1.google, t1.instagram
				FROM trainers t1
				WHERE t1.id = :id
                ";

		return $this->_db->select($sql, array(':id' => $id));
	}

    /**
	 * FUNCTION: getAllData
	 * This function returns the details for All trainers
	 * @param int $limit, $keywords
	 */
	public function getAllData($limit = false, $keywords = false, $active = false){
        $optLimit = $limit != false ? " LIMIT $limit" : "";
        $optActive = $active != false ? " AND t1.is_active = $active" : "";
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.name),' ',CONCAT(LOWER(t1.name),' ')),IF(isnull(t1.phone),' ',CONCAT(LOWER(t1.phone),' ')),IF(isnull(t1.email),' ',CONCAT(LOWER(t1.email),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT t1.id, t1.name, t1.slug, t1.text, t1.phone, t1.email, t1.website, t1.sort, t1.is_active, t1.facebook, t1.twitter, t1.google, t1.instagram

				FROM trainers t1
				WHERE 1 = 1
				".$optKeywords."
				".$optActive."
				ORDER BY t1.sort ASC
				".$optLimit;

		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: countAllData
	 * This function returns the count for All trainers
	 * @param int $keywords
	 */
	public function countAllData($keywords = false){
        $optKeywords = $keywords != false ? " AND CONCAT(IF(isnull(t1.name),' ',CONCAT(LOWER(t1.name),' ')),IF(isnull(t1.phone),' ',CONCAT(LOWER(t1.phone),' ')),IF(isnull(t1.email),' ',CONCAT(LOWER(t1.email),' '))) LIKE '%$keywords%'" : "";

		$sql = "SELECT COUNT(t1.id) AS total
				FROM trainers t1
				WHERE 1 = 1
				".$optKeywords;
		return $this->_db->select($sql);
	}

    /**
	 * FUNCTION: selectDataByName
	 * This function selects the data by name
	 * @param string $name
	 */
    public function selectDataByName($name){
        $sql = "SELECT t1.id, t1.name, t1.slug, t1.text, t1.phone, t1.email, t1.website, t1.sort, t1.is_active, t1.facebook, t1.twitter, t1.google, t1.instagram
				FROM trainers t1
				WHERE t1.name = :name
                ";

		return $this->_db->select($sql, array(':name' => $name));
    }


    public function getHeroImage($trainer_id, $active = false){
        $optActive = $active != false ? " AND t1.is_active = $active" : "" ;

        $sql = "SELECT t1.id, t1.image, t1.title
				FROM trainer_images t1
				WHERE t1.trainer_id = :trainer_id
				".$optActive."
                ";

		return $this->_db->select($sql, array(':trainer_id' => $trainer_id));
    }

}?>