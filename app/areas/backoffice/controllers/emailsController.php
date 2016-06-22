<?php
/** Emails Controller */

class EmailsController extends BaseController {

	/** __construct */
	public function __construct(){
		parent::__construct();
		// Load the User Model ($modelName, $area)
		$this->_model = $this->loadModel('emailsBackoffice', 'backoffice');
	}

    /**
	 * PAGE: Emails Index
	 * GET: /backoffice/emails/index
	 * This method handles the view awards page
	 */
	public function index(){
        Auth::checkAdminLogin();

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Email');
		// Set Page Description
		$this->_view->pageDescription = 'Email Index';
		// Set Page Section
		$this->_view->pageSection = 'Emails';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Email Index';

		###### PAGINATION ######
        //sanitise or set keywords to false
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $_GET['keywords'] = FormInput::checkKeywords($_GET['keywords']);
        }else{
            $_GET['keywords'] = false;
        }

        $totalItems = $this->_model->countAllData($_GET['keywords']);
        $pages = new Pagination(20,'keywords='.$_GET['keywords'].'&page', $totalItems[0]['total']);
        $this->_view->getAllData = $this->_model->getAllData($pages->get_limit(), $_GET['keywords']);

		// Create the pagination nav menu
		$this->_view->page_links = $pages->page_links();

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('emails/index', 'layout', 'backoffice');
	}

    /**
     * PAGE: Emails Delete
     * GET: /backoffice/admin-users/delete/:id
     * This method handles the deletion of Emails
     * @param string $id The unique id for the Emails
     */
    public function delete($id){
        Auth::checkAdminLogin();
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Email', 'Email');
		// Set Page Description
		$this->_view->pageDescription = 'Email Delete';
		// Set Page Section
		$this->_view->pageSection = 'Emails';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Email Index';

        //Check we got ID
        if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
            $this->_view->selectedData = $selectDataByID;

            //Check ID returns an Emails
			if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                if(isset($_POST) && !empty($_POST)) {
                    if (!empty($_POST['delete'])) {
                        $deleteAttempt = $this->_model->deleteData($id);
                        //Check we have deleted Emails
                        if (!empty($deleteAttempt)) {

                            // Redirect to next page
                            $this->_view->flash[] = "Emails deleted successfully.";
                            Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                            Url::redirect('backoffice/emails/index');
                        } else {
                            $this->_view->error[] = 'A problem has occurred when trying to delete this award.';
                        }
                    } elseif (!empty($_POST['cancel'])) {
                        Url::redirect('backoffice/emails/index');
                    }
                }
			}else{
                $this->_view->flash[] = "No Emails matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/emails/index');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Emails";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/emails/index');
		}
        // Render the view ($renderBody, $layout, $area)
		$this->_view->render('emails/delete', 'layout', 'backoffice');
    }
}
?>