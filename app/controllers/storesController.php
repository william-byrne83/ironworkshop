<?php
/** Stores Controller */

class StoresController extends BaseController {

    /** __construct */
    public function __construct(){
        parent::__construct();
        // Load the User Model ($modelName, $area)
        $this->_model = $this->loadModel('stores');
    }

    /**
     * PAGE: Stores Index
     * GET: /backoffice/stores/index
     * This method handles the view awards page
     */
    public function index(){
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
        $this->_view->pageTitle = array('Stores');
        // Set Page Description
        $this->_view->pageDescription = 'Stores Index';
        // Set Page Section
        $this->_view->pageSection = 'Stores';
        // Set Page Sub Section
        $this->_view->pageSubSection = 'Stores Index';

        ###### PAGINATION ######
        //sanitise or set keywords to false
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $_GET['keywords'] = FormInput::checkKeywords($_GET['keywords']);
        }else{
            $_GET['keywords'] = false;
        }

        $totalItems = $this->_model->countAllData($_GET['keywords']);
        $pages = new Pagination(16,'keywords='.$_GET['keywords'].'&page', $totalItems[0]['total']);
        $this->_view->getAllData = $this->_model->getAllData($pages->get_limit(), $_GET['keywords'], 1);
        $this->_view->countData = $this->_model->countAllData(1);

        foreach($this->_view->getAllData as $key => $data){
            $this->_view->getAllData[$key]['hero_image'] = $this->_model->getHeroImage($data['id'], 1);
        }

        // Create the pagination nav menu
        $this->_view->page_links = $pages->page_links('?', null, 'front');

        // Render the view ($renderBody, $layout, $area)
        $this->_view->render('stores/index', 'layout');
    }

    /**
     * PAGE: Stores Index
     * GET: /stores/view/:slug
     * @param string $slug
     * This method handles the view awards page
     */
    public function view($slug){
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
        $this->_view->pageTitle = array('Stores');
        // Set Page Description
        $this->_view->pageDescription = 'Stores Index';
        // Set Page Section
        $this->_view->pageSection = 'Stores';
        // Set Page Sub Section
        $this->_view->pageSubSection = 'Stores Index';

        $this->_view->data = $this->_model->selectDataBySlug($slug);

        if(isset($this->_view->data) && !empty($this->_view->data)){
            $this->_view->data[0]['images'] = $this->_model->getStoreImagesByStoreId($this->_view->data[0]['id']);
        }

        // Render the view ($renderBody, $layout, $area)
        $this->_view->render('stores/view', 'layout');

    }
}
?>