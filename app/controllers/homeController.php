<?php
/** Home Controller */
class HomeController extends BaseController {
	/** __construct */
	public function __construct(){
		parent::__construct();

        $this->_model = $this->loadModel('homepages');
	}

	/**
	 * PAGE: Index
	 * GET: /home/index
	 * This method handles the sites home page
	 */
	public function index(){
		// Set the Page Title ('pageName', 'pageSection', 'areaName')
		$this->_view->pageTitle = array('Iron Work Shop');
		// Set Page Description
		$this->_view->pageDescription = 'Iron Work Shop, Belfast Gym';
		// Set Page Section
		$this->_view->pageSection = 'Home';
		// Set Page Sub Section
		$this->_view->pageSubSection = '';

        $this->_view->homepage = $this->_model->getAllData();
        $homepageImages = $this->_model->getHomepageImagesById($this->_view->homepage[0]['id']);
        $this->_view->homepage[0]['images'] = $homepageImages;

        // About us section
        $this->_aboutUs = $this->loadModel('aboutUs');
        $this->_view->about = $this->_aboutUs->getAllData();

        // Contact us section
        $this->_contactUs = $this->loadModel('contactUs');
        $this->_view->contact = $this->_contactUs->getAllData();

        // Shop items
        $this->_store = $this->loadModel('stores');
        $this->_view->stores = $this->_store->getAllData(3, false, 1);
        foreach($this->_view->stores as $key => $store){
            $this->_view->stores[$key]['hero_image'] = $this->_store->getHeroImage($store['id'], 1);
        }

        // trainers
        $this->_trainers = $this->loadModel('trainers');
        $this->_view->trainers = $this->_trainers->getAllData(false, false, 1);
        foreach($this->_view->trainers as $key => $trainer){
            $this->_view->trainers[$key]['hero_image'] = $this->_trainers->getHeroImage($trainer['id'], 1);
        }

        //news
        $this->_news = $this->loadModel('news');
        $this->_view->news = $this->_news->getAllData(6, false, 1);

        //results
        $this->_results = $this->loadModel('results');
        $this->_view->results = $this->_results->getAllData(false, false, 1);

        // Render the view ($renderBody, $layout, $area)
		$this->_view->render('home/index');



	}

}
?>