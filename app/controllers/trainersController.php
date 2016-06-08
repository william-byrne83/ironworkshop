<?php
/** Trainers Controller */

class TrainersController extends BaseController {

    /** __construct */
    public function __construct(){
        parent::__construct();
        // Load the User Model ($modelName, $area)
        $this->_model = $this->loadModel('Trainers');
    }

    /**
     * PAGE: Trainers Index
     * GET: /trainers/view/:slug
     * @param string $slug
     * This method handles the view awards page
     */
    public function view($slug){
        // Set the Page Title ('pageName', 'pageSection', 'areaName')
        $this->_view->pageTitle = array('Trainers');
        // Set Page Description
        $this->_view->pageDescription = 'Trainers Index';
        // Set Page Section
        $this->_view->pageSection = 'Trainers';
        // Set Page Sub Section
        $this->_view->pageSubSection = 'Trainers Index';

        $this->_view->data = $this->_model->selectDataBySlug($slug);

        if(isset($this->_view->data) && !empty($this->_view->data)){
            $this->_view->data[0]['images'] = $this->_model->getTrainerImagesByTrainerId($this->_view->data[0]['id']);
            $this->_view->data[0]['results'] = $this->_model->getResultsByTrainerId($this->_view->data[0]['id']);
        }

        // Render the view ($renderBody, $layout, $area)
        $this->_view->render('trainers/view', 'layout');

    }
}
?>