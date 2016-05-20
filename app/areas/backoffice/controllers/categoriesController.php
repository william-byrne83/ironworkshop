<?php
/** Categories Controller */

class CategoriesController extends BaseController {

	/** __construct */
	public function __construct(){
		parent::__construct();
		// Load the User Model ($modelName, $area)
		$this->_model = $this->loadModel('CategoriesBackoffice', 'backoffice');
	}

    /**
	 * PAGE: Categories Index
	 * GET: /backoffice/categories/index
	 * This method handles the view awards page
	 */
	public function index(){
        Auth::checkAdminLogin();

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Category');
		// Set Page Description
		$this->_view->pageDescription = 'Category Index';
		// Set Page Section
		$this->_view->pageSection = 'News';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Category Index';

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
		$this->_view->render('categories/index', 'layout', 'backoffice');
	}

    /**
	 * PAGE: Categories Edit
	 * GET: /backoffice/categories/edit:id
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
                $this->_view->flash[] = "No Categories matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/categories/index');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Categories";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/categories/index');
		}

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Category', 'Category');
		// Set Page Description
		$this->_view->pageDescription = 'Category edit';
		// Set Page Section
		$this->_view->pageSection = 'News';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Category Index';

		// Set Page Specific CSS
		//$this->_view->pageCss = $pageCss;

		// Set Page Specific Javascript
		//$this->_view->pageJs = $pageJs;

		// Set default variables
		$this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST['save'])){
            $_POST['id'] = $id;

            // Update Categories details
            $updateData = $this->_model->updateData($_POST);

            if(isset($updateData['error']) && $updateData['error'] != null){
                foreach($updateData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            } else {
                $this->_view->flash[] = "Categories updated successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/categories/index');
            }
		}

		if(!empty($_POST['cancel'])){
			Url::redirect('backoffice/categories/index');
		}

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('categories/add', 'layout', 'backoffice');
	}

    /**
     * PAGE: Categories Delete
     * GET: /backoffice/admin-users/delete/:id
     * This method handles the deletion of Categories
     * @param string $id The unique id for the Categories
     */
    public function delete($id){
        Auth::checkAdminLogin();
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Category', 'Category');
		// Set Page Description
		$this->_view->pageDescription = 'Category Delete';
		// Set Page Section
		$this->_view->pageSection = 'News';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Category Index';

        //Check we got ID
        if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
            $this->_view->selectedData = $selectDataByID;

            //Check ID returns an Categories
			if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                if(isset($_POST) && !empty($_POST)) {
                    if (!empty($_POST['delete'])) {
                        $deleteAttempt = $this->_model->deleteData($id);
                        //Check we have deleted Categories
                        if (!empty($deleteAttempt)) {

                            // Redirect to next page
                            $this->_view->flash[] = "Categories deleted successfully.";
                            Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                            Url::redirect('backoffice/categories/index');
                        } else {
                            $this->_view->error[] = 'A problem has occurred when trying to delete this award.';
                        }
                    } elseif (!empty($_POST['cancel'])) {
                        Url::redirect('backoffice/categories/index');
                    }
                }
			}else{
                $this->_view->flash[] = "No Categories matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/categories/index');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Categories";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/categories/index');
		}
        // Render the view ($renderBody, $layout, $area)
		$this->_view->render('categories/delete', 'layout', 'backoffice');
    }


    /**
     * PAGE: Categories Add
     * GET: /backoffice/categories/add/:id
     * This method handles the adding of categories
     */
	public function add(){
        Auth::checkAdminLogin();
		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Category', 'Category');
		// Set Page Description
		$this->_view->pageDescription = 'Category Add';
		// Set Page Section
		$this->_view->pageSection = 'News';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Category Index';

        $this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST)){
            //if user selected cancel
            if(!empty($_POST['cancel'])){
			    Url::redirect('backoffice/categories/index');
		    }

            // Create new Categories
            $createData = $this->_model->createData($_POST);
            if(isset($createData['error']) && $createData['error'] != null){
                foreach($createData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            }else{

                $this->_view->flash[] = "Category added successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/categories/index');
            }
		}
		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('categories/add', 'layout', 'backoffice');
	}

}
?>