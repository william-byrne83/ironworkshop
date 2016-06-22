<?php
/** AboutUs Controller */

class AboutUsController extends BaseController {

	/** __construct */
	public function __construct(){
		parent::__construct();
		// Load the User Model ($modelName, $area)
		$this->_model = $this->loadModel('aboutUsBackoffice', 'backoffice');
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

            for($i = 1; $i <= 2; $i++){
                if(!isset($_FILES) || $_FILES['image'.$i]['name'] == null) {
                    $_POST['image'.$i][0] = $this->_view->stored_data['image'.$i];
                }else{
                    //calls function that moves resourced documents
                    $this->uploadFile($_FILES, $i);

                    if(isset($_POST['imagebase64'])){
                        $data = $_POST['imagebase64'];
                        list($type, $data) = explode(';', $data);
                        list(, $data)      = explode(',', $data);
                        $data = base64_decode($data);
                        file_put_contents('assets/uploads/homepages/'. $_POST['image'.$i][0], $data);
                    }

                    if(isset($_POST['imagebase642']) && $i == 2){
                        $data2 = $_POST['imagebase642'];
                        list($type, $data2) = explode(';', $data2);
                        list(, $data2)      = explode(',', $data2);
                        $data2 = base64_decode($data2);
                        file_put_contents('assets/uploads/homepages/'. $_POST['image'.$i][0], $data2);
                    }
                }
            }

            // Update About Us details
            $updateData = $this->_model->updateData($_POST);

            if(isset($updateData['error']) && $updateData['error'] != null){
                foreach($updateData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            } else {
                for($i = 1; $i <= 2; $i++) {
                    if (isset($_FILES) && $_FILES['image'.$i]['name'] != null) {
                        //remove old file
                        unlink(ROOT . UPLOAD_DIR . '/homepages/' . $this->_view->stored_data['image'.$i]);
                    }
                }

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
                            unlink(ROOT.UPLOAD_DIR.'/homepages/'.$selectDataByID[0]['image1']);
                            unlink(ROOT.UPLOAD_DIR.'/homepages/'.$selectDataByID[0]['image2']);

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

            for($i = 1; $i <=2; $i++){
                if(!isset($_FILES) || $_FILES['image'.$i]['name'] == null){
                    $_POST['image'.$i] = null;
                }else{
                    $this->uploadFile($_FILES, $i);

                    if(isset($_POST['imagebase64'])){
                        $data = $_POST['imagebase64'];
                        list($type, $data) = explode(';', $data);
                        list(, $data)      = explode(',', $data);
                        $data = base64_decode($data);
                        file_put_contents('assets/uploads/homepages/'. $_POST['image'.$i][0], $data);
                    }

                    if(isset($_POST['imagebase642'])){
                        $data = $_POST['imagebase642'];
                        list($type, $data) = explode(';', $data);
                        list(, $data)      = explode(',', $data);
                        $data = base64_decode($data);
                        file_put_contents('assets/uploads/homepages/'. $_POST['image'.$i][0], $data);
                    }
                }
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

    /**
     * UploadFile
     * This method handles the upload and moving of docs on backoffice
     * @param array $files is the $_FILES
     */
    public function uploadFile($files, $i){
        require_once(ROOT.'system/helpers/Upload.php');
        // upload file
        try {
            if(isset($files['image'.$i])){
                $file = new Ps2_Upload(ROOT.UPLOAD_DIR.'/homepages/', 'image'.$i, true);
                $file->addPermittedTypes(array(
                        'image/png', 'image/jpeg', 'image/gif',
                    )
                );
                $file->setMaxSize(MAX_FILE_SIZE);
                $file->move();
                $_POST['image'.$i] = $file->getFilenames();

                return $this->_view->error = array_merge($this->_view->error, $file->getMessages());
            }
        } catch (Exception $e) {
            return $this->_view->error[] = $e->getMessage();
        }
    }

    /**
     * PAGE: news-items image download
     * GET: /backoffice/about-us/download/:id/
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
                header('Content-Length: ' . filesize(ROOT.'assets/uploads/homepages/'.$selectedData[0]['image']));
                readfile(ROOT.'assets/uploads/homepages/'.$selectedData[0]['image']);
                exit;
            } else {
                $this->_view->flash[] = "No data matches this ID";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
                Url::redirect('backoffice/about-us/');
            }
        }else{
            $this->_view->flash[] = "No ID was provided";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
            Url::redirect('backoffice/about-us/');
        }
    }

}
?>