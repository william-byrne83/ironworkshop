<?php
class Emails extends Model{
    /** __construct */
    public function __construct(){
        parent::__construct();
    }

    /**
     * FUNCTION: createData
     * This function adds a new results to the Database
     * @param mixed $data Array of results Data
     */
    public function createData($data){
        $dbTable = 'emails';
        $postData = array(
            'email' => $data['contact-email'],
            'name' => $data['contact-name'],
            'subject' => $data['contact-website'],
            'message' => $data['contact-message']
        );

        $this->_db->insert($dbTable, $postData);

        // Gets Last Insert ID
        return $lastInsertID = $this->_db->lastInsertId('id');
    }

}?>