<?php
/** Homepages Controller */

class HomepagesController extends BaseController {

	/** __construct */
	public function __construct(){
		parent::__construct();
		// Load the User Model ($modelName, $area)
		$this->_model = $this->loadModel('HomepagesBackoffice', 'backoffice');
	}

    /**
	 * PAGE: Homepages Index
	 * GET: /backoffice/homepages/index
	 * This method handles the view awards page
	 */
	public function index(){
        Auth::checkAdminLogin();

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Homepage');
		// Set Page Description
		$this->_view->pageDescription = 'Homepage Index';
		// Set Page Section
		$this->_view->pageSection = 'Homepage';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Homepage Index';

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
		$this->_view->render('homepages/index', 'layout', 'backoffice');
	}

    /**
	 * PAGE: Homepages Edit
	 * GET: /backoffice/homepages/edit:id
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
                $this->_view->flash[] = "No Homepage matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/homepages/index');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Homepage";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/homepages/index');
		}

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Homepage');
		// Set Page Description
		$this->_view->pageDescription = 'Homepage Edit';
		// Set Page Section
		$this->_view->pageSection = 'Homepage';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Homepage Index';

		// Set Page Specific CSS
		//$this->_view->pageCss = $pageCss;

		// Set Page Specific Javascript
		//$this->_view->pageJs = $pageJs;

		// Set default variables
		$this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST['save'])){
            $_POST['id'] = $id;

            // Update Homepage details
            $updateData = $this->_model->updateData($_POST);

            if(isset($updateData['error']) && $updateData['error'] != null){
                foreach($updateData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            } else {
                $this->_view->flash[] = "Homepage updated successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/homepages/index');
            }
		}

		if(!empty($_POST['cancel'])){
			Url::redirect('backoffice/homepages/index');
		}

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('homepages/add', 'layout', 'backoffice');
	}

    /**
     * PAGE: Homepage Delete
     * GET: /backoffice/admin-users/delete/:id
     * This method handles the deletion of Homepage
     * @param string $id The unique id for the Homepage
     */
    public function delete($id){
        Auth::checkAdminLogin();
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Homepage');
		// Set Page Description
		$this->_view->pageDescription = 'Homepage Delete';
		// Set Page Section
		$this->_view->pageSection = 'Homepage';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Homepage Index';

        //Check we got ID
        if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
            $this->_view->selectedData = $selectDataByID;

            //Check ID returns an Homepages
			if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                if(isset($_POST) && !empty($_POST)) {
                    if (!empty($_POST['delete'])) {
                        // Need to delete all the child images/files
                        $this->_imagesModel = $this->loadModel('HomepageImagesBackoffice', 'backoffice');
                        $images = $this->_imagesModel->getAllData(false, false, false, $id);
                        if(!empty($images)){
                            foreach($images as $image){
                                unlink(ROOT . UPLOAD_DIR . '/homepages/' . $image['image']);
                            }
                        }

                        $deleteAttempt = $this->_model->deleteData($id);
                        //Check we have deleted Homepage
                        if (!empty($deleteAttempt)) {
                            // Redirect to next page
                            $this->_view->flash[] = "Homepage deleted successfully.";
                            Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                            Url::redirect('backoffice/homepages/index');
                        } else {
                            $this->_view->error[] = 'A problem has occurred when trying to delete this item.';
                        }
                    } elseif (!empty($_POST['cancel'])) {
                        Url::redirect('backoffice/homepages/index');
                    }
                }
			}else{
                $this->_view->flash[] = "No Homepage matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/homepages/index');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Homepage";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/homepages/index');
		}
        // Render the view ($renderBody, $layout, $area)
		$this->_view->render('homepages/delete', 'layout', 'backoffice');
    }


    /**
     * PAGE: Homepage Add
     * GET: /backoffice/homepages/add/:id
     * This method handles the adding of homepages
     */
	public function add(){
        Auth::checkAdminLogin();
		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Homepage');
		// Set Page Description
		$this->_view->pageDescription = 'Homepage Add';
		// Set Page Section
		$this->_view->pageSection = 'Homepage';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Homepage Index';

        $this->_view->error = array();

        // If we already have one data then bounce them back to index
        $this->_view->countData = $this->_model->countAllData();
        if($this->_view->countData[0]['total'] != 0){
            Url::redirect('backoffice/homepages/index');
        }

        // If Form has been submitted process it
		if(!empty($_POST)){
            //if user selected cancel
            if(!empty($_POST['cancel'])){
			    Url::redirect('backoffice/homepages/index');
		    }

            // Create new Homepage
            $createData = $this->_model->createData($_POST);
            if(isset($createData['error']) && $createData['error'] != null){
                foreach($createData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            }else{
                $this->_view->flash[] = "Homepage added successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/homepages/index');
            }
		}
		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('homepages/add', 'layout', 'backoffice');
	}


}
?>