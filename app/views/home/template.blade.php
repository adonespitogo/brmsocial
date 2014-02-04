@extends('base')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="archon/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Loading Stylesheets -->    
    <link href="archon/css/archon.css" rel="stylesheet">
    <link href="archon/css/responsive.css" rel="stylesheet">
    <link href="archon/css/prettify.css" rel="stylesheet">

    <!-- Loading Custom Stylesheets -->    
    <link href="archon/css/custom.css" rel="stylesheet">

    <link rel="shortcut icon" href="archon/images/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->

@stop

@section('body')
   
@stop
@section('scripts')
	{{ javascript_include_tag('vendor') }}
    <!-- Load JS here for greater good =============================-->
    <script src="archon/js/jquery-1.8.3.min.js"></script>
    <script src="archon/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="archon/js/jquery.ui.touch-punch.min.js"></script>
    <script src="archon/js/bootstrap.min.js"></script>
    <script src="archon/js/bootstrap-select.js"></script>
    <script src="archon/js/bootstrap-switch.js"></script>
    <script src="archon/js/jquery.tagsinput.js"></script>
    <script src="archon/js/jquery.placeholder.js"></script>
    <script src="archon/js/bootstrap-typeahead.js"></script>
    <script src="archon/js/application.js"></script>
    <script src="archon/js/moment.min.js"></script>
    <script src="archon/js/jquery.dataTables.min.js"></script>
    <script src="archon/js/jquery.sortable.js"></script>
    <script type="text/javascript" src="archon/js/jquery.gritter.js"></script>

<?php
    /*
    <!-- Charts  =============================-->
    <script src="archon/js/charts/jquery.flot.js"></script>
    <script src="archon/js/charts/jquery.flot.resize.js"></script>
    <script src="archon/js/charts/jquery.flot.stack.js"></script>
    <script src="archon/js/charts/jquery.flot.pie.min.js"></script>    
    <script src="archon/js/charts/jquery.sparkline.min.js"></script>   
    <script src="archon/js/jquery.knob.js"></script>


    <!-- NVD3 graphs  =============================-->
    <script src="archon/js/nvd3/lib/d3.v3.js"></script>
    <script src="archon/js/nvd3/nv.d3.js"></script>
    <script src="archon/js/nvd3/src/models/legend.js"></script>
    <script src="archon/js/nvd3/src/models/pie.js"></script>
    <script src="archon/js/nvd3/src/models/pieChart.js"></script>
    <script src="archon/js/nvd3/src/utils.js"></script>

    <!-- Map and icons on map-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
    <script src="archon/js/map-icons.js"></script>


    <!-- Archon JS =============================-->
    
    <script src="archon/js/knobs-custom.js"></script>
    <script src="archon/js/sparkline-custom.js"></script>
    <script src="archon/js/archon.js"></script>
    <script src="archon/js/dashboard-custom.js"></script>
*/

?>
@stop