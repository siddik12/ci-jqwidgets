<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title?></title>
    <!-- Load Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('resources')?>/jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('resources')?>/jqwidgets/styles/jqx.classic.css" type="text/css" />
    
    <!-- Load Javascript -->
    <script type="text/javascript" src="<?php echo base_url('resources')?>/scripts/jquery-1.10.1.min.js"></script>  
    
    <!-- Load jQWidgets v2.9.0 -->
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxgrid.selection.js"></script>	
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxgrid.filter.js"></script>	
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxgrid.sort.js"></script>		
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxdata.js"></script>	
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxlistbox.js"></script>	
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxgrid.pager.js"></script>		
    <script type="text/javascript" src="<?php echo base_url('resources')?>/jqwidgets/jqxdropdownlist.js"></script>	
    <script type="text/javascript">
        $(document).ready(function () {
            // prepare the data
            var theme = 'classic';
      
            var source =
            {
                 datatype: "json",
                 datafields: [
                        { name: 'ShippedDate', type: 'date'},
                        { name: 'ShipName'},
                        { name: 'ShipAddress'},
                        { name: 'ShipCity'},
                        { name: 'ShipCountry'}
               ],
                        url: '<?php echo site_url("grid/data")?>',
                            cache: false,
                            filter: function()
                            {
                                // update the grid and send a request to the server.
                                $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                            },
                            sort: function()
                            {
                                // update the grid and send a request to the server.
                                $("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                            },
                            root: 'Rows',
                            beforeprocessing: function(data)
                            {		
                                if (data != null)
                                {
                                    source.totalrecords = data[0].TotalRows;					
                                }
                            }
            };		
		    var dataadapter = new $.jqx.dataAdapter(source, {
                                loadError: function(xhr, status, error)
                                {
                                    alert(error);
                                }
                            }
			);
	
            // initialize jqxGrid
            $("#jqxgrid").jqxGrid(
            {		
                source: dataadapter,
                theme: theme, 
                    width: '100%',
                    filterable: true,
                    sortable: true,
                    autoheight: true,
                    pageable: true,
                    virtualmode: true,
                    rendergridrows: function(obj)
                    {
                             return obj.data;    
                    },
                columns: [
                      { text: 'Shipped Date', datafield: 'ShippedDate', cellsformat: 'yyyy-MM-dd'},
                      { text: 'Ship Name', datafield: 'ShipName'},
                      { text: 'Address', datafield: 'ShipAddress'},
                      { text: 'City', datafield: 'ShipCity'},
                      { text: 'Country', datafield: 'ShipCountry'}
                  ]
            });
        });
    </script>
</head>
<body class='default'>
    <div id='jqxWidget'">
        <div id="jqxgrid"></div>
    </div>
    <?php echo $footer ?>
</body>
</html>
