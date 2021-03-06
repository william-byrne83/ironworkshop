<?php
/** Galleries Controller */

class GalleriesController extends BaseController {

	/** __construct */
	public function __construct(){
		parent::__construct();
		// Load the User Model ($modelName, $area)
		$this->_model = $this->loadModel('galleriesBackoffice', 'backoffice');
	}

    /**
	 * PAGE: Galleries Index
	 * GET: /backoffice/galleries/index
	 * This method handles the view awards page
	 */
	public function index(){
        Auth::checkAdminLogin();

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Gallery');
		// Set Page Description
		$this->_view->pageDescription = 'Gallery Index';
		// Set Page Section
		$this->_view->pageSection = 'Gallery';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Gallery Index';

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
		$this->_view->render('galleries/index', 'layout', 'backoffice');
	}

    /**
	 * PAGE: Galleries Edit
	 * GET: /backoffice/galleries/edit:id
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
                $this->_view->flash[] = "No Galleries matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/galleries/');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Galleries";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/galleries/');
		}

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Gallery');
		// Set Page Description
		$this->_view->pageDescription = 'Gallery Edit';
		// Set Page Section
		$this->_view->pageSection = 'Gallery';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Gallery Index';

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
                    $mimes = array('.jpg', '.gif', '.jpeg');
                    $_POST['image'][0] = str_replace($mimes, '.png', $_POST['image'][0]);
                    file_put_contents('assets/uploads/galleries/'. $_POST['image'][0], $data);
                }
            }

            // Update Galleries details
            $updateData = $this->_model->updateData($_POST);

            if(isset($updateData['error']) && $updateData['error'] != null){
                foreach($updateData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            } else {
                if (isset($_FILES) && $_FILES['image']['name'] != null) {
                    //remove old file
                    unlink(ROOT . UPLOAD_DIR . '/galleries/' . $this->_view->stored_data['image']);
                }

                $this->_view->flash[] = "Galleries updated successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/galleries/index');
            }
		}

		if(!empty($_POST['cancel'])){
			Url::redirect('backoffice/galleries/index');
		}

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('galleries/add', 'layout', 'backoffice');
	}

    /**
     * PAGE: Galleries Delete
     * GET: /backoffice/galleries/delete/:id
     * This method handles the deletion of Galleries
     * @param string $id The unique id for the Galleries
     */
    public function delete($id){
        Auth::checkAdminLogin();
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Gallery');
		// Set Page Description
		$this->_view->pageDescription = 'Gallery Delete';
		// Set Page Section
		$this->_view->pageSection = 'Gallery';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Gallery Index';

        //Check we got ID
        if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
            $this->_view->selectedData = $selectDataByID;

            //Check ID returns an Galleries
			if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                if(isset($_POST) && !empty($_POST)) {
                    if (!empty($_POST['delete'])) {
                        $deleteAttempt = $this->_model->deleteData($id);
                        //Check we have deleted Galleries
                        if (!empty($deleteAttempt)) {
                            unlink(ROOT.UPLOAD_DIR.'/galleries/'.$selectDataByID[0]['image']);

                            // Redirect to next page
                            $this->_view->flash[] = "Galleries deleted successfully.";
                            Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                            Url::redirect('backoffice/galleries/');
                        } else {
                            $this->_view->error[] = 'A problem has occurred when trying to delete this award.';
                        }
                    } elseif (!empty($_POST['cancel'])) {
                        Url::redirect('backoffice/galleries/');
                    }
                }
			}else{
                $this->_view->flash[] = "No Galleries matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/galleries/');
			}
		}else{
            $this->_view->flash[] = "No ID provided for Galleries";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/galleries/');
		}
        // Render the view ($renderBody, $layout, $area)
		$this->_view->render('galleries/delete', 'layout', 'backoffice');
    }


    /**
     * PAGE: Galleries Add
     * GET: /backoffice/galleries/add/:id
     * This method handles the adding of galleries
     */
	public function add(){
        Auth::checkAdminLogin();
		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Gallery');
		// Set Page Description
		$this->_view->pageDescription = 'Gallery Add';
		// Set Page Section
		$this->_view->pageSection = 'Gallery';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Gallery Index';

        $this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST)){
            //if user selected cancel
            if(!empty($_POST['cancel'])){
			    Url::redirect('backoffice/galleries/index');
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
                    $mimes = array('.jpg', '.gif', '.jpeg');
                    $_POST['image'][0] = str_replace($mimes, '.png', $_POST['image'][0]);
                    file_put_contents('assets/uploads/galleries/'. $_POST['image'][0], $data);
                }
            }

            // Create new Galleries
            $createData = $this->_model->createData($_POST);
            if(isset($createData['error']) && $createData['error'] != null){
                foreach($createData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            }else{
                $maxOrder = $this->_model->getMaxOrder();
                $this->_model->updateSortOrder($createData, ($maxOrder[0]['max_order']+1));

                $this->_view->flash[] = "Galleries added successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/galleries/index');
            }
		}
		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('galleries/add', 'layout', 'backoffice');
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
                $file = new Ps2_Upload(ROOT.UPLOAD_DIR.'/galleries/', 'image', true);
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
	 * PAGE: galleries image download
	 * GET: /backoffice/galleries/download/:id/
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
                header('Content-Length: ' . filesize(ROOT.'assets/uploads/galleries/'.$selectedData[0]['image']));
                readfile(ROOT.'assets/uploads/galleries/'.$selectedData[0]['image']);
                exit;
            } else {
                $this->_view->flash[] = "No data matches this ID";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
                Url::redirect('backoffice/galleries/');
            }
        }else{
            $this->_view->flash[] = "No ID was provided";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
            Url::redirect('backoffice/galleries/');
        }
    }

    /**
     * PAGE: galleries types sort
     * GET: /backoffice/galleries/sort/:direction/:id
     * This method handles the sorting of galleries
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
            Url::redirect('backoffice/galleries/');
        }else{
            Url::redirect('backoffice/galleries/');
        }
    }
}
?>