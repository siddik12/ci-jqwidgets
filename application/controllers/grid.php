<?php
/*
 * jqwidgets : phpdemos/server_side_grid_filtering_and_sorting_and_paging/
 * by: mully.ryudo@gmail.com
 * 
 */
class grid extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    function index(){
        $this->load->view('grid/index', $this->data);
    }
    
    function data(){
	$result = $this->orders->result();
	$total_rows = $this->orders->total_rows();
	
//  Test data =============================      
//        echo $total_rows.'<p>';
//        echo '<pre>';
//        var_dump($result);
//        echo '</pre>';
//        =================================
        
        $orders = null;

        // get data and store in a json array
	foreach ($result as $row) {
            $orders[] = array(
                'OrderDate' => $row->OrderDate,
                'ShippedDate' => $row->ShippedDate,
                'ShipName' => $row->ShipName,
                'ShipAddress' => $row->ShipAddress,
                'ShipCity' => $row->ShipCity,
                'ShipCountry' => $row->ShipCountry
            );
	}
        $data[] = array(
            'TotalRows' => $total_rows,
            'Rows' => $orders
        );

        echo json_encode($data);        
    }
    
}