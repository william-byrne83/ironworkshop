<?php
/** Emails Controller */

class EmailsController extends BaseController {

    /** __construct */
    public function __construct(){
        parent::__construct();
        // Load the User Model ($modelName, $area)
        $this->_model = $this->loadModel('Emails');
    }

    /**
     * PAGE: Emails Add
     * GET: /emails/add/
     * This method handles the adding of Emails
     */
    public function add()
    {
        $this->_view->error = array();

        // If Form has been submitted process it
        if (!empty($_POST)) {
            //if user selected cancel
            if (!empty($_POST['cancel'])) {
                Url::redirect('/');
            }

            // Create new Emails
            $createData = $this->_model->createData($_POST);
            if (isset($createData['error']) && $createData['error'] != null) {
                foreach ($createData['error'] as $key => $error) {
                    $this->_view->error[$key] = $error;
                }
                $result = 'Message could not be sent.';

            } else {

                $this->_view->flash[] = "Email added successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                //Url::redirect('/');
                $result = 'Message successfully sent.';
            }
        }
        echo $result;
        // Render the view ($renderBody, $layout, $area)
        //$this->_view->render('emails/add', 'layout', 'backoffice');
    }
}
?>