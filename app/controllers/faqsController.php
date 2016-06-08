<?php
/** Faqs Controller */

class FaqsController extends BaseController {

    /** __construct */
    public function __construct(){
        parent::__construct();
        // Load the User Model ($modelName, $area)
        $this->_model = $this->loadModel('Faqs');
    }

    /**
     * PAGE: Faqs Index
     * GET: /backoffice/faqs/index
     * This method handles the view awards page
     */
    public function index(){
        Auth::checkAdminLogin();

        // Set the Page Title ('pageName', 'pageSection', 'areaName')
        $this->_view->pageTitle = array('Faq');
        // Set Page Description
        $this->_view->pageDescription = 'Faq Index';
        // Set Page Section
        $this->_view->pageSection = 'Faq';
        // Set Page Sub Section
        $this->_view->pageSubSection = 'Faq';

        ###### PAGINATION ######
        //sanitise or set keywords to false
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $_GET['keywords'] = FormInput::checkKeywords($_GET['keywords']);
        }else{
            $_GET['keywords'] = false;
        }

        $totalItems = $this->_model->countAllData($_GET['keywords'], 1);
        $pages = new Pagination(20,'keywords='.$_GET['keywords'].'&page', $totalItems[0]['total']);
        $this->_view->getAllData = $this->_model->getAllData($pages->get_limit(), $_GET['keywords'], 1);

        // Create the pagination nav menu
        $this->_view->page_links = $pages->page_links('?', null, 'front');

        // Render the view ($renderBody, $layout, $area)
        $this->_view->render('faqs/index', 'layout');
    }








}
?>