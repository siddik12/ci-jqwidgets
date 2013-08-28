<?php
class orders extends MY_Model {
    
    protected $_table_name = 'orders';
        
    public function __construct() {
        parent::__construct();
    }
    
    function filter_data(){
        if (isset($_GET['filterscount']))
	{
            $filterscount = $_GET['filterscount'];

            if ($filterscount > 0)
            {
                $where = "(";
                $tmpdatafield = "";
                $tmpfilteroperator = "";
                for ($i=0; $i < $filterscount; $i++)
                {
                    // get the filter's value.
                    $filtervalue = $_GET["filtervalue" . $i];
                    // get the filter's condition.
                    $filtercondition = $_GET["filtercondition" . $i];
                    // get the filter's column.
                    $filterdatafield = $_GET["filterdatafield" . $i];
                    // get the filter's operator.
                    $filteroperator = $_GET["filteroperator" . $i];

                    if ($tmpdatafield == "")
                    {
                        $tmpdatafield = $filterdatafield;			
                    }
                    else if ($tmpdatafield <> $filterdatafield)
                    {
                        $where .= ")AND(";
                    }
                    else if ($tmpdatafield == $filterdatafield)
                    {
                        if ($tmpfilteroperator == 0)
                        {
                                $where .= " AND ";
                        }
                        else $where .= " OR ";	
                    }

                    // build the "WHERE" clause depending on the filter's condition, value and datafield.
                    switch($filtercondition)
                    {
                        case "CONTAINS":
                                $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
                                break;
                        case "DOES_NOT_CONTAIN":
                                $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                                break;
                        case "EQUAL":
                                $where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                                break;
                        case "NOT_EQUAL":
                                $where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
                                break;
                        case "GREATER_THAN":
                                $where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
                                break;
                        case "LESS_THAN":
                                $where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
                                break;
                        case "GREATER_THAN_OR_EQUAL":
                                $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
                                break;
                        case "LESS_THAN_OR_EQUAL":
                                $where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
                                break;
                        case "STARTS_WITH":
                                $where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                                break;
                        case "ENDS_WITH":
                                $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                                break;
                    }

                    if ($i == $filterscount - 1)
                    {
                        $where .= ")";
                    }

                    $tmpfilteroperator = $filteroperator;
                    $tmpdatafield = $filterdatafield;			
                }
                // build the query.
                return $this->db->where($where);
            }
	}
    }
            
    function result(){
	$pagenum = $_GET['pagenum'];
	$pagesize = $_GET['pagesize'];
	$start = $pagenum * $pagesize;
        
        // filter data.
	$this->filter_data();
        
        if (isset($_GET['sortdatafield']))
	{

            $sortfield = $_GET['sortdatafield'];
            $sortorder = $_GET['sortorder'];

            if ($sortorder != '')
            {
                if ($_GET['filterscount'] == 0)
                {
                        if ($sortorder == "desc")
                        {
                            $this->db->order_by($sortfield, "desc"); 
                        }
                        else if ($sortorder == "asc")
                        {
                            $this->db->order_by($sortfield, "asc"); 
                        }
                }
                else
                {
                    if ($sortorder == "desc")
                    {
                        $this->db->order_by($sortfield, "desc"); 
                    }
                    else if ($sortorder == "asc")	
                    {
                        $this->db->order_by($sortfield, "asc"); 
                    }
                }		
            }
	}

        
        
        return $this->get(FALSE, $pagesize, $start);
    }
    
    function total_rows(){
        // filter data.
	$this->filter_data();
        return $this->get(TRUE);
    }
    
}