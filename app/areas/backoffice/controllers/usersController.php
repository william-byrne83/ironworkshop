<?php
/** Users Controller */
class UsersController extends BaseController {

	/** __construct */
	public function __construct(){
		parent::__construct();

		// Check User is Logged In
		Auth::checkAdminLogin();

		// Load the User Model ($modelName, $area)
		$this->_model = $this->loadModel('userBackoffice', 'backoffice');
	}

	/**
	 * PAGE: Index
	 * GET: /backoffice/users/index
	 * This method handles the view users page
	 */
	public function index(){
		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('View Users', 'Users');
		// Set Page Description
		$this->_view->pageDescription = 'Users';
		// Set Page Section
		$this->_view->pageSection = 'Users';

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
		$this->_view->render('users/index', 'layout', 'backoffice');
	}

	/**
	 * PAGE: Add User
	 * GET: /backoffice/users/add
	 * This method handles the add users page
	 */
	public function add(){
		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Add', 'Users');
		// Set Page Description
		$this->_view->pageDescription = '';
		// Set Page Section
		$this->_view->pageSection = 'Users';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Add';

		// Set default variables
		$this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST)){
            //if user selected cancel
            if(!empty($_POST['cancel'])){
                Url::redirect('backoffice/users/index');
            }
            $_POST['salt'] = null;

            // Create new user
            $createData = $this->_model->createData($_POST);
            if(isset($createData['error']) && $createData['error'] != null){
                foreach($createData['error'] as $key => $error){
                    $this->_view->error[$key] = $error;
                }
            }else {
                $this->_view->flash[] = "User added successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/users/');
            }
		}
		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('users/add', 'layout', 'backoffice');
	}

	/**
	 * PAGE: Edit
	 * GET: /backoffice/users/edit
	 * This method handles the edit user page
	 */
	public function edit($id = false){
		if(!empty($id)){
			$selectDataByID = $this->_model->selectDataByID($id);
			if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                $this->_view->stored_data = $selectDataByID[0];
                if(isset($_POST['is_active']) && ($_POST['is_active'] == 1 || $_POST['is_active'] == 0)){
                     $this->_view->stored_data['is_active'] = $_POST['is_active'];
                }
			}else{
                $this->_view->flash[] = "No Users matches this id";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
				Url::redirect('backoffice/users/');
			}
		}else{
            $this->_view->flash[] = "No ID was provided";
            Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
			Url::redirect('backoffice/users/');
		}

		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Edit User', 'Users');
		// Set Page Description
		$this->_view->pageDescription = '';
		// Set Page Section
		$this->_view->pageSection = 'Users';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Edit User';


		// Set default variables
		$this->_view->error = array();

        // If Form has been submitted process it
		if(!empty($_POST['save'])){
            $_POST['id'] = $id;
            $_POST['salt'] = $selectDataByID[0]['salt'];
            $_POST['user_pass'] = $selectDataByID[0]['password'];
            $_POST['stored_user_email'] = $selectDataByID[0]['email'];

            // Update user details
            $updateData = $this->_model->updateData($_POST);

            if(isset($updateData['error']) && $updateData['error'] != null){
                foreach($updateData['error'] as $key => $error) {
                    $this->_view->error[$key] = $error;
                }
            } else {
                $this->_view->flash[] = "User updated successfully.";
                Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                Url::redirect('backoffice/users/');
            }
		}

		if(!empty($_POST['cancel'])){
			Url::redirect('backoffice/users/');
		}

		// Render the view ($renderBody, $layout, $area)
		$this->_view->render('users/add', 'layout', 'backoffice');
	}

    /**
     * PAGE: Users Delete
     * GET: /backoffice/users/delete/:id
     * This method handles the deletion of a User
     * @param string $id The unique id for the User
     */
    public function delete($id){
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Delete User', 'Users');
		// Set Page Description
		$this->_view->pageDescription = '';
		// Set Page Section
		$this->_view->pageSection = 'Users';
		// Set Page Sub Section
		$this->_view->pageSubSection = 'Delete User';

        //Check we got ID
        if(!empty($id)){
            $selectDataByID = $this->_model->selectDataByID($id);
            $this->_view->selectedData = $selectDataByID;

            //Check ID returns an admin user
			if(isset($selectDataByID[0]['id']) && !empty($selectDataByID[0]['id'])){
                if(isset($_POST) && !empty($_POST)) {
                    if (!empty($_POST['delete'])) {
                        $deleteAttempt = $this->_model->deleteData($id);
                        //Check we have deleted admin user
                        if (!empty($deleteAttempt)) {
                            // Redirect to next page
                            $this->_view->flash[] = "User Data has been deleted successfully.";
                            Session::set('backofficeFlash', array($this->_view->flash, 'success'));
                            Url::redirect('backoffice/users/index');
                        } else {
                            $this->_view->error[] = 'A problem has occurred when trying to delete this upload.';
                        }
                    } elseif (!empty($_POST['cancel'])) {
                        Url::redirect('backoffice/users/index');
                    }
                }
			}else{
				Url::redirect('backoffice/users/index');
			}
		}else{
			Url::redirect('backoffice/users/index');
		}
        // Render the view ($renderBody, $layout, $area)
		$this->_view->render('users/delete', 'layout', 'backoffice');
    }

    /**
	 * PAGE: Generate Random Password
	 * GET: /users/generate-random-password
	 * This method give out a new random password
	 */
	public function generateRandomPassword(){
		$new_password = htmlspecialchars(Password::strong_random_password());
		if(!empty($new_password)){
			echo '<input id="new_pw" value="'.$new_password.'" class="form-control" readonly/>';
		}
	}

    /**
	 * PAGE: Login
	 * GET: /backoffice/users/login
	 * This method handles the login as frontend user method
	 */
	public function login($users_id = false){
		if(!empty($users_id)){
			// Select user information
			$data = $this->_model->getDataByID($users_id);

            if(!isset($data[0]['id']) || empty($data[0]['id'])){
                $this->_view->flash[] = "User is not active or does not exist";
                Session::set('backofficeFlash', array($this->_view->flash, 'failure'));
                Url::redirect('backoffice/users/');
            }

			// Unset current user sessions
			unset($_SESSION['UserLoggedIn']);
			unset($_SESSION['UserCurrentUserID']);
			unset($_SESSION['UserCurrentFirstName']);
			unset($_SESSION['UserCurrentSurname']);
			unset($_SESSION['UserCurrentFullName']);
			unset($_SESSION['UserProfileImage']);
			unset($_SESSION['UserCurrency']);
			unset($_SESSION['UserCurrencySign']);

			// Set user session & redirect user
			Session::set('UserLoggedIn', true);
            Session::set('UserAccountIsVerified', $data[0]['email_verified']);
            Session::set('UserCurrentUserID', $data[0]['id']);
            Session::set('UserCurrentFirstName', $data[0]['firstname']);
            Session::set('UserCurrentSurname', $data[0]['surname']);
            Session::set('UserCurrentFullName', $data[0]['firstname'] . ' ' . $data[0]['surname']);

			if(!empty($_SESSION['UserLoggedIn'])){
				Url::redirect('users');
			}
		} else {
			Url::redirect('backoffice/users/');
		}
	}
}
?>