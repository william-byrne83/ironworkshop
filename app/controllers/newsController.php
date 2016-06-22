<?php
/** News Controller */

class NewsController extends BaseController {

    /** __construct */
    public function __construct(){
        parent::__construct();
        // Load the User Model ($modelName, $area)
        $this->_model = $this->loadModel('news');
    }

    /**
     * PAGE: News Index
     * GET: /news/index
     * This method handles the view awards page
     */
    public function index(){
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
        $this->_view->pageTitle = array('News', 'News');
        // Set Page Description
        $this->_view->pageDescription = 'News Index';
        // Set Page Section
        $this->_view->pageSection = 'News';
        // Set Page Sub Section
        $this->_view->pageSubSection = 'News Index';

        ###### PAGINATION ######
        //sanitise or set keywords to false
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $_GET['keywords'] = FormInput::checkKeywords($_GET['keywords']);
        }else{
            $_GET['keywords'] = false;
        }

        if(isset($_GET['categories']) && !empty($_GET['categories'])){
            $_GET['categories'] = FormInput::checkKeywords($_GET['categories']);
        }else{
            $_GET['categories'] = false;
        }

        $totalItems = $this->_model->countAllData($_GET['keywords'], 1, $_GET['categories']);
        $pages = new Pagination(10,'keywords='.$_GET['keywords'].'&page', $totalItems[0]['total']);
        $this->_view->getAllData = $this->_model->getAllData($pages->get_limit(), $_GET['keywords'], 1, $_GET['categories']);
        $this->_view->countData = $this->_model->countAllData($_GET['keywords'], 1, $_GET['categories']);

        // Create the pagination nav menu
        $this->_view->page_links = $pages->page_links('?', null, 'front');

        //Get Categories
        $this->_view->categories = $this->_model->getAllCategories();

        // Render the view ($renderBody, $layout, $area)
        $this->_view->render('news/index', 'layout');
    }

    /**
     * PAGE: News Index
     * GET: /news/view/:slug
     * @param string $slug
     * This method handles the view awards page
     */
    public function view($slug){
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
        $this->_view->pageTitle = array('News', 'News');
        // Set Page Description
        $this->_view->pageDescription = 'News Index';
        // Set Page Section
        $this->_view->pageSection = 'News';
        // Set Page Sub Section
        $this->_view->pageSubSection = 'News Index';

        $this->_view->data = $this->_model->selectDataBySlug($slug);

        //Get Categories
        $this->_view->categories = $this->_model->getAllCategories();

        // Render the view ($renderBody, $layout, $area)
        $this->_view->render('news/view', 'layout');

    }


}
?>