<?php
class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->data['title'] = 'mully-ci-jqwidgets';
        $this->data['footer'] = 'ci-jqwidgets by '.  mailto('mully.ryudo@gmail.com', 'mully') .' &copy; 2013';
        
        //load model
        $this->load->model('orders');
        
    }

}