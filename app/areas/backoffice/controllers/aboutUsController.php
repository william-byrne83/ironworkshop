<?php
/** AboutUs Controller */

class AboutUsController extends BaseController {

	/** __construct */
	public function __construct(){
		parent::__construct();
		// Load the User Model ($modelName, $area)
		$this->_model = $this->loadModel('AboutUsBackoffice', 'backoffice');
	}

    /**
	 * PAGE: AboutUs Index
	 * GET: /backoffice/about-us/index
	 * This method handles the view awards page
	 */
	public function index(){
        Auth::checkAdminLogin();

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('About Us', 'About Us');
		// Set Page Description
		$this->_view->pageDescription = 'About Us Index';
		// Set Page Section
		$this->_view->pageSection = 'About Us';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'About Us Index';

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
        $this->_view->countData = $this->_model->countAllData();

		// Create the pagination nav menu
		$this->_view->page_links = $pages->page_links();

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('about-us/index', 'layout', 'backoffice');
	}

    /**
	 * PAGE: AboutUs Edit
	 * GET: /backoffice/about-us/edit:id
     * @param string $id The unique id for the award user
	 * This method handles the edit award user page
	 */
	public function edit($id = false){
        Auth::checkAdminLogin();
		if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
            if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                $this->_view->stored_data = $selectDataByID[0];
			}else{
                $this->_view->flash[] = "No About Us matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/about-us/index');
			}
		}else{
            $this->_view->flash[] = "No ID provided for About Us";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/about-us/index');
		}

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('About Us', 'About Us');
		// Set Page Description
		$this->_view->pageDescription = 'About Us Index';
		// Set Page Section
		$this->_view->pageSection = 'About Us';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'About Us Index';

		// Set Page Specific CSS
		//$this->_view->pageCss = $pageCss;

		// Set Page Specific Javascript
		//$this->_view->pageJs = $pageJs;

		// Set default variables
		$this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST['save'])){
            $_POST['id'] = $id;

            // Update About Us details
            $updateData = $this->_model->updateData($_POST);

            if(isset($updateData['error']) && $updateData['error'] != null){
                foreach($updateData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            } else {
                $this->_view->flash[] = "About Us updated successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/about-us/index');
            }
		}

		if(!empty($_POST['cancel'])){
			Url::redirect('backoffice/about-us/index');
		}

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('about-us/add', 'layout', 'backoffice');
	}

    /**
     * PAGE: About Us Delete
     * GET: /backoffice/admin-users/delete/:id
     * This method handles the deletion of About Us
     * @param string $id The unique id for the About Us
     */
    public function delete($id){
        Auth::checkAdminLogin();
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('About Us', 'About Us');
		// Set Page Description
		$this->_view->pageDescription = 'About Us Index';
		// Set Page Section
		$this->_view->pageSection = 'About Us';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'About Us Index';

        //Check we got ID
        if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
            $this->_view->selectedData = $selectDataByID;

            //Check ID returns an About Us
			if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                if(isset($_POST) && !empty($_POST)) {
                    if (!empty($_POST['delete'])) {
                        $deleteAttempt = $this->_model->deleteData($id);
                        //Check we have deleted About Us
                        if (!empty($deleteAttempt)) {
                            // Redirect to next page
                            $this->_view->flash[] = "About Us deleted successfully.";
                            Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                            Url::redirect('backoffice/about-us/index');
                        } else {
                            $this->_view->error[] = 'A problem has occurred when trying to delete this item.';
                        }
                    } elseif (!empty($_POST['cancel'])) {
                        Url::redirect('backoffice/about-us/index');
                    }
                }
			}else{
                $this->_view->flash[] = "No About Us matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/about-us/index');
			}
		}else{
            $this->_view->flash[] = "No ID provided for About Us";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/about-us/index');
		}
        // Render the view ($renderBody, $layout, $area)
		$this->_view->render('about-us/delete', 'layout', 'backoffice');
    }


    /**
     * PAGE: About Us Add
     * GET: /backoffice/about-us/add/:id
     * This method handles the adding of about-us
     */
	public function add(){
        Auth::checkAdminLogin();
		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('About Us', 'About Us');
		// Set Page Description
		$this->_view->pageDescription = 'About Us Index';
		// Set Page Section
		$this->_view->pageSection = 'About Us';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'About Us Index';

        $this->_view->error = array();

        // If we already have one data then bounce them back to index
        $this->_view->countData = $this->_model->countAllData();
        if($this->_view->countData[0]['total'] != 0){
            Url::redirect('backoffice/about-us/index');
        }

        // If Form has been submitted process it
		if(!empty($_POST)){
            //if user selected cancel
            if(!empty($_POST['cancel'])){
			    Url::redirect('backoffice/about-us/index');
		    }

            // Create new About Us
            $createData = $this->_model->createData($_POST);
            if(isset($createData['error']) && $createData['error'] != null){
                foreach($createData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            }else{
                $this->_view->flash[] = "About Us added successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/about-us/index');
            }
		}
		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('about-us/add', 'layout', 'backoffice');
	}


}
?>