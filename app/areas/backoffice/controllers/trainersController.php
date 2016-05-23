<?php
/** Trainers Controller */

class TrainersController extends BaseController {

	/** __construct */
	public function __construct(){
		parent::__construct();
		// Load the User Model ($modelName, $area)
		$this->_model = $this->loadModel('TrainersBackoffice', 'backoffice');
	}

    /**
	 * PAGE: Trainers Index
	 * GET: /backoffice/trainers/index
	 * This method handles the view awards page
	 */
	public function index(){
        Auth::checkAdminLogin();

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Trainers');
		// Set Page Description
		$this->_view->pageDescription = 'Trainers Index';
		// Set Page Section
		$this->_view->pageSection = 'Trainers';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Trainers Index';

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

        foreach($this->_view->getAllData as $key => $data){
            $this->_view->getAllData[$key]['hero_image'] = $this->_model->getHeroImage($data['id']);
        }

		// Create the pagination nav menu
		$this->_view->page_links = $pages->page_links();

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('trainers/index', 'layout', 'backoffice');
	}

    /**
	 * PAGE: Trainers Edit
	 * GET: /backoffice/trainers/edit:id
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
                $this->_view->flash[] = "No Trainers matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/trainers/');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Trainers";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/trainers/');
		}

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Trainers');
		// Set Page Description
		$this->_view->pageDescription = 'Trainers Edit';
		// Set Page Section
		$this->_view->pageSection = 'Trainers';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Trainers Index';

		// Set Page Specific CSS
		//$this->_view->pageCss = $pageCss;

		// Set Page Specific Javascript
		//$this->_view->pageJs = $pageJs;

		// Set default variables
		$this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST['save'])){
            $_POST['id'] = $id;
            $_POST['stored_name'] = $selectDataByID[0]['name'];

            // Update Trainers details
            $updateData = $this->_model->updateData($_POST);

            if(isset($updateData['error']) && $updateData['error'] != null){
                foreach($updateData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            } else {

                $this->_view->flash[] = "Trainers updated successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/trainers/index');
            }
		}

		if(!empty($_POST['cancel'])){
			Url::redirect('backoffice/trainers/index');
		}

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('trainers/add', 'layout', 'backoffice');
	}

    /**
     * PAGE: Trainers Delete
     * GET: /backoffice/trainers/delete/:id
     * This method handles the deletion of Trainers
     * @param string $id The unique id for the Trainers
     */
    public function delete($id){
        Auth::checkAdminLogin();
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Trainers');
		// Set Page Description
		$this->_view->pageDescription = 'Trainers Delete';
		// Set Page Section
		$this->_view->pageSection = 'Trainers';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Trainers Index';

        //Check we got ID
        if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
            $this->_view->selectedData = $selectDataByID;

            //Check ID returns an Trainers
			if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                if(isset($_POST) && !empty($_POST)) {
                    if (!empty($_POST['delete'])) {
                        $deleteAttempt = $this->_model->deleteData($id);
                        //Check we have deleted Trainers
                        if (!empty($deleteAttempt)) {

                            // Redirect to next page
                            $this->_view->flash[] = "Trainers deleted successfully.";
                            Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                            Url::redirect('backoffice/trainers/');
                        } else {
                            $this->_view->error[] = 'A problem has occurred when trying to delete this award.';
                        }
                    } elseif (!empty($_POST['cancel'])) {
                        Url::redirect('backoffice/trainers/');
                    }
                }
			}else{
                $this->_view->flash[] = "No Trainers matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/trainers/');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Trainers";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/trainers/');
		}
        // Render the view ($renderBody, $layout, $area)
		$this->_view->render('trainers/delete', 'layout', 'backoffice');
    }


    /**
     * PAGE: Trainers Add
     * GET: /backoffice/trainers/add/:id
     * This method handles the adding of trainers
     */
	public function add(){
        Auth::checkAdminLogin();
		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Trainers');
		// Set Page Description
		$this->_view->pageDescription = 'Trainers Add';
		// Set Page Section
		$this->_view->pageSection = 'Trainers';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Trainers Index';

        $this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST)){
            //if user selected cancel
            if(!empty($_POST['cancel'])){
			    Url::redirect('backoffice/trainers/index');
		    }

            // Create new Trainers
            $createData = $this->_model->createData($_POST);
            if(isset($createData['error']) && $createData['error'] != null){
                foreach($createData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            }else{
                $maxOrder = $this->_model->getMaxOrder();
                $this->_model->updateSortOrder($createData, ($maxOrder[0]['max_order']+1));

                $this->_view->flash[] = "Trainers added successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/trainers/index');
            }
		}
		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('trainers/add', 'layout', 'backoffice');
	}

    /**
     * UploadFile
     * This method handles the upload and moving of docs on backoffice
     * @param array $files is the $_FILES
     */
    public function uploadFile($files){
        require_once(ROOT.'system/helpers/Upload.php');
        // upload file
        try {
            if(isset($files['image'])){
                $file = new Ps2_Upload(ROOT.UPLOAD_DIR.'/trainers/', 'image', true);
                $file->addPermittedTypes(array(
                        'image/png', 'image/jpeg', 'image/gif',
                    )
                );
                $file->setMaxSize(MAX_FILE_SIZE);
                $file->move();
                $_POST['image'] = $file->getFilenames();

                return $this->_view->error = array_merge($this->_view->error, $file->getMessages());
            }
        } catch (Exception $e) {
            return $this->_view->error[] = $e->getMessage();
        }
    }

    /**
	 * PAGE: Trainers image download
	 * GET: /backoffice/trainers/download/:id/
	 * This method handles the download image action.
	 */
    public function download($id){
        if(!empty($id)) {
            $selectedData = $this->_model->selectDataByID($id);
            if (isset($selectedData) && !empty($selectedData)) {
                header('Content-Description: File Transfer');
                header('Content-Disposition: attachment; filename="'.basename(ROOT.UPLOAD_DIR.$selectedData[0]['image']).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Content-Transfer-Encoding: binary');
                header('Pragma: public');
                header('Content-Length: ' . filesize(ROOT.'assets/uploads/trainers/'.$selectedData[0]['image']));
                readfile(ROOT.'assets/uploads/trainers/'.$selectedData[0]['image']);
                exit;
            } else {
                $this->_view->flash[] = "No data matches this ID";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
                Url::redirect('backoffice/trainers/');
            }
        }else{
            $this->_view->flash[] = "No ID was provided";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
            Url::redirect('backoffice/trainers/');
        }
    }

    /**
     * PAGE: trainers types sort
     * GET: /backoffice/trainers/sort/:direction/:id
     * This method handles the sorting of trainers
     * @param string $direction, int $id
     */
    public function sort($direction = null, $id= null, $order = null){
        if(!empty($id)){
            if($direction == 'up'){
                $order = $order-1;
                // Make sure we don't move below 0
                if($order < 0){
                    $order = 0;
                }

                // Update the previous item with the new order and add one to it.
                $this->_model->updateOldSortOrder('add', $order);

                // Update the selected item sort order.
                $this->_model->updateSortOrder($id, $order);

            }elseif($direction == 'down'){
                $order = $order+1;

                // Update the previous item with the new order and add one to it.
                $this->_model->updateOldSortOrder('subtract', $order);

                // Update the selected item sort order.
                $this->_model->updateSortOrder($id, $order);

            }
            Url::redirect('backoffice/trainers/');
        }else{
            Url::redirect('backoffice/trainers/');
        }
    }
}
?>