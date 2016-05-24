<?php
class TrainersBackoffice extends Model{
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
            if($key != 'text') {
                $input = is_array($input) ? FormInput::trimArray($input) : FormInput::checkInput($input);
            }
            $return[$key] = $input;

            //name
            if($key == 'name'){
                //required
                if(empty($input) || $input == null){
                    $return['error'][$key] = 'Name cannot be empty';
                }else{
                    // Creating slug based off formatted title.
                    $temp = Formatting::removeAccents($input);
					$temp = FormatUrl($temp);
                    $return['slug'] = $temp;
                }

                //unique
                if($type != 'edit') {
                    $temp = $this->selectDataByName($input);
                    if (!empty($temp) || $temp != null) {
                        $return['error'][$key] = "This Name already exists";
                    }
                }else{
                    //if the edited name is different than their previous one, check its unique.
                    if($input != $return['stored_name']){
                        $temp = $this->selectDataByName($input);
                        if (!empty($temp) || $temp != null) {
                            $return['error'][$key] = "This Name already exists";
                        }
                    }
                }
            }

            //text
            if($key == 'text'){
                //required
                if(empty($input) || $input == null){
                    $return['error'][$key] = 'Text cannot be empty';
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
	 * FUNCTION: createData
	 * This function adds a new trainers to the Database from backoffice
	 * @param mixed $data Array of trainers Data
	 */
	public function createData($data){
        $data = $this->validation($data, 'add');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'trainers';
            $postData = array(
                'name' => $data['name'],
                'slug' => $data['slug'],
                'text' => $data['text'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'website' => $data['website'],
                'is_active' => $data['is_active'],
                'facebook' => $data['facebook'],
                'twitter' => $data['twitter'],
                'google' => $data['google'],
                'instagram' => $data['instagram']
            );

            $this->_db->insert($dbTable, $postData);

            // Gets Last Insert ID
            return $lastInsertID = $this->_db->lastInsertId('id');
        }
	}

    /**
	 * FUNCTION: updateData
	 * This function updates trainers details for backoffice
	 * @param mixed $data An array of data passed from the Controller
	 */
	public function updateData($data){
        $data = $this->validation($data, 'edit');
        if(isset($data['error']) && $data['error'] != null){
            return $data;
        }else {
            $dbTable = 'trainers';
            $postData = array(
                'name' => $data['name'],
                'slug' => $data['slug'],
                'text' => $data['text'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'website' => $data['website'],
                'is_active' => $data['is_active'],
                'facebook' => $data['facebook'],
                'twitter' => $data['twitter'],
                'google' => $data['google'],
                'instagram' => $data['instagram']
            );
            $where = "`id` = {$data['id']}";

            $this->_db->update($dbTable, $postData, $where);
            return true;
        }
	}

    /**
	 * FUNCTION: deleteData
	 * This function deletes an trainers
	 * @param Int $id of an trainers
	 */
    public function deleteData($id){
        $dbTable = 'trainers';
        $where = "`id` = $id";
        $this->_db->delete($dbTable, $where);
		return true;
    }

    /**
	 * FUNCTION: updateSortOrder
	 * This function updates the trainers order field
	 * @param Int $id, int $order
	 */
    public function updateSortOrder($id, $order){
        $id = FormInput::checkInput($id);
        $order = FormInput::checkInput($order);

        $dbTable = 'trainers';
        $postData = array(
            'sort' => $order,
        );
        $where = "`id` = {$id}";
        $this->_db->update($dbTable, $postData, $where);
        return true;
    }


    /**
	 * FUNCTION: updateOldSortOrder
	 * This function updates the trainers order field based on its order value
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

        $dbTable = 'trainers';
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
				FROM trainers t1";

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