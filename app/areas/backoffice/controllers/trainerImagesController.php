<?php
/** TrainerImages Controller */

class TrainerImagesController extends BaseController {

	/** __construct */
	public function __construct(){
		parent::__construct();
		// Load the User Model ($modelName, $area)
		$this->_model = $this->loadModel('trainerImagesBackoffice', 'backoffice');
        $this->_trainersModel = $this->loadModel('trainersBackoffice', 'backoffice');

	}

    /**
	 * PAGE: Store Image Index
	 * GET: /backoffice/trainer-images/index/:id
	 * This method handles the view awards page
     * @param int $id id of trainers page.
	 */
	public function index($id){
        Auth::checkAdminLogin();

        if(!isset($id) || empty($id)){
            $this->_view->flash[] = "No ID provided for Store Image";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/trainers/');
        }else{
            $selectedStore = $this->_trainersModel->selectDataByID($id);
            if(!isset($selectedStore) || empty($selectedStore[0])){
                $this->_view->flash[] = "No Store matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
                Url::redirect('backoffice/trainers/');
            }
        }

        $this->_view->parent_id = $id;

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
        $this->_view->getAllData = $this->_model->getAllData($pages->get_limit(), $_GET['keywords'], false, $id);
        $this->_view->countData = $this->_model->countAllData(false, $id);

		// Create the pagination nav menu
		$this->_view->page_links = $pages->page_links();

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('trainer-images/index', 'layout', 'backoffice');
	}

    /**
	 * PAGE: Store Image Edit
	 * GET: /backoffice/trainer-images/edit:id
     * @param string $id The unique id for the award user
	 * This method handles the edit award user page
	 */
	public function edit($id = false, $parent_id = false){
        Auth::checkAdminLogin();
		if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
            if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                $this->_view->stored_data = $selectDataByID[0];

			}else{
                $this->_view->flash[] = "No Store Image matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/trainer-images/index/'.$parent_id.'/');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Store Image";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/trainer-images/index/'.$parent_id.'/');
		}

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Trainers');
		// Set Page Description
		$this->_view->pageDescription = 'Trainers Index';
		// Set Page Section
		$this->_view->pageSection = 'Trainers';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Trainers Index';

        $this->_view->parent_id = $parent_id;


		// Set Page Specific CSS
		//$this->_view->pageCss = $pageCss;

		// Set Page Specific Javascript
		//$this->_view->pageJs = $pageJs;

		// Set default variables
		$this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST['save'])){
            $_POST['id'] = $id;
            $_POST['stored_title'] = $selectDataByID[0]['title'];

            if(!isset($_FILES) || $_FILES['image']['name'] == null) {
                $_POST['image'][0] = $this->_view->stored_data['image'];
            }else{
                //calls function that moves resourced documents
                $this->uploadFile($_FILES);

                if(isset($_POST['imagebase64'])){
                    $data = $_POST['imagebase64'];
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    file_put_contents('assets/uploads/trainers/'. $_POST['image'][0], $data);
                }
            }

            // Update Store Image details
            $updateData = $this->_model->updateData($_POST);

            if(isset($updateData['error']) && $updateData['error'] != null){
                foreach($updateData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            } else {
                if (isset($_FILES) && $_FILES['image']['name'] != null) {
                    //remove old file
                    unlink(ROOT . UPLOAD_DIR . '/trainers/' . $this->_view->stored_data['image']);
                }

                $this->_view->flash[] = "Store Image updated successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/trainer-images/index/'.$parent_id.'/');
            }
		}

		if(!empty($_POST['cancel'])){
			Url::redirect('backoffice/trainer-images/index/'.$parent_id.'/');
		}

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('trainer-images/add', 'layout', 'backoffice');
	}

    /**
     * PAGE: Store Image Delete
     * GET: /backoffice/trainer-images/delete/:id
     * This method handles the deletion of Store Image
     * @param string $id The unique id for the Store Image
     */
    public function delete($id, $parent_id = false){
        Auth::checkAdminLogin();
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Trainers');
		// Set Page Description
		$this->_view->pageDescription = 'Trainers Index';
		// Set Page Section
		$this->_view->pageSection = 'Trainers';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Trainers Index';

        //Check we got ID
        if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
            $this->_view->selectedData = $selectDataByID;

            //Check ID returns an Store Image
			if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                if(isset($_POST) && !empty($_POST)) {
                    if (!empty($_POST['delete'])) {
                        $deleteAttempt = $this->_model->deleteData($id);
                        //Check we have deleted Store Image
                        if (!empty($deleteAttempt)) {
                            unlink(ROOT.UPLOAD_DIR.'/trainers/'.$selectDataByID[0]['image']);

                            // Redirect to next page
                            $this->_view->flash[] = "Store Image deleted successfully.";
                            Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                            Url::redirect('backoffice/trainer-images/index/'.$parent_id.'/');
                        } else {
                            $this->_view->error[] = 'A problem has occurred when trying to delete this award.';
                        }
                    } elseif (!empty($_POST['cancel'])) {
                        Url::redirect('backoffice/trainer-images/index/'.$parent_id.'/');
                    }
                }
			}else{
                $this->_view->flash[] = "No Store Image matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/trainer-images/index/'.$parent_id.'/');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Store Image";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/trainer-images/index/'.$parent_id.'/');
		}
        // Render the view ($renderBody, $layout, $area)
		$this->_view->render('trainer-images/delete', 'layout', 'backoffice');
    }


    /**
     * PAGE: Store Image Add
     * GET: /backoffice/trainer-images/add/:id
     * This method handles the adding of trainer-images
     * @param int $id
     */
	public function add($id){
        Auth::checkAdminLogin();
		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Trainers');
		// Set Page Description
		$this->_view->pageDescription = 'Trainers Index';
		// Set Page Section
		$this->_view->pageSection = 'Trainers';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Trainers Index';

        $this->_view->error = array();

        $this->_view->parent_id = $id;


        // If Form has been submitted process it
		if(!empty($_POST)){
            //if user selected cancel
            if(!empty($_POST['cancel'])){
			    Url::redirect('backoffice/trainer-images/index/'.$id);
		    }

            if(!isset($_FILES) || empty($_FILES['image']['name'])){
                $_POST['image'] = null;
            }else{
                $this->uploadFile($_FILES);

                if(isset($_POST['imagebase64'])){
                    $data = $_POST['imagebase64'];
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    file_put_contents('assets/uploads/trainers/'. $_POST['image'][0], $data);
                }
            }

            // Create new Store Image
            $createData = $this->_model->createData($_POST);
            if(isset($createData['error']) && $createData['error'] != null){
                foreach($createData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            }else{
                $maxOrder = $this->_model->getMaxOrder();
                $this->_model->updateSortOrder($createData, ($maxOrder[0]['max_order']+1), $id);

                $this->_view->flash[] = "Store Image added successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/trainer-images/index/'.$id);
            }
		}
		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('trainer-images/add', 'layout', 'backoffice');
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
	 * PAGE: Store Image image download
	 * GET: /backoffice/trainer-images/download/:id/
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
     * PAGE: trainer-images types sort
     * GET: /backoffice/trainer-images/sort/:direction/:id
     * This method handles the sorting of trainer-images
     * @param string $direction, int $id
     */
    public function sort($direction = null, $id= null, $order = null, $parent_id = null){
        if(!empty($id)){
            if($direction == 'up'){
                $order = $order-1;
                // Make sure we don't move below 0
                if($order < 0){
                    $order = 0;
                }

                // Update the previous item with the new order and add one to it.
                $this->_model->updateOldSortOrder('add', $order, $parent_id);

                // Update the selected item sort order.
                $this->_model->updateSortOrder($id, $order, $parent_id);

            }elseif($direction == 'down'){
                $order = $order+1;

                // Update the previous item with the new order and add one to it.
                $this->_model->updateOldSortOrder('subtract', $order, $parent_id);

                // Update the selected item sort order.
                $this->_model->updateSortOrder($id, $order, $parent_id);

            }
            Url::redirect('backoffice/trainer-images/index/'.$parent_id);
        }else{
            Url::redirect('backoffice/trainer-images/index/'.$parent_id);
        }
    }
}
?>