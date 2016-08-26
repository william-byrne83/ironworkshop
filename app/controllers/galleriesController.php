<?php
/** Galleries Controller */

class GalleriesController extends BaseController {

    /** __construct */
    public function __construct(){
        parent::__construct();
        // Load the User Model ($modelName, $area)
        $this->_model = $this->loadModel('galleries');
    }

    /**
     * PAGE: Galleries Index
     * GET: /galleries/index
     * This method handles the view awards page
     */
    public function index(){

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

        $totalItems = $this->_model->countAllData($_GET['keywords'], 1);
        $pages = new Pagination(16,'keywords='.$_GET['keywords'].'&page', $totalItems[0]['total']);
        $this->_view->getAllData = $this->_model->getAllData($pages->get_limit(), $_GET['keywords'], 1);
        $this->_view->countData = $this->_model->countAllData();

        // Create the pagination nav menu
        $this->_view->page_links = $pages->page_links('?', null, 'front');

        // Render the view ($renderBody, $layout, $area)
        $this->_view->render('galleries/index', 'layout');
    }


    /**
     * PAGE: Galleries Index
     * GET: /galleries/view:slug
     * @param string $slug
     * This method handles the view awards page
     */
    public function view($id){
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
        $this->_view->pageTitle = array('Gallery');
        // Set Page Description
        $this->_view->pageDescription = 'Gallery Index';
        // Set Page Section
        $this->_view->pageSection = 'Gallery';
        // Set Page Sub Section
        $this->_view->pageSubSection = 'Gallery Index';

        $this->_view->data = $this->_model->selectDataById($id);

        // Render the view ($renderBody, $layout, $area)
        $this->_view->render('galleries/view', 'layout');

    }


}
?>