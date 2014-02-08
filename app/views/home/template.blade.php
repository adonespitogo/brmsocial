@extends('base')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="bucketadmin/images/favicon.html">
    <!--Core CSS -->
    <link href="bucketadmin/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="bucketadmin/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="bucketadmin/css/bootstrap-reset.css" rel="stylesheet">
    <link href="bucketadmin/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="bucketadmin/assets/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="bucketadmin/css/clndr.css" rel="stylesheet">
    <!--clock css-->
    <link href="bucketadmin/assets/css3clock/css/style.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="bucketadmin/assets/morris-chart/morris.css">
    <!-- Custom styles for this template -->
    <link href="bucketadmin/css/style.css" rel="stylesheet">
    <link href="bucketadmin/css/style-responsive.css" rel="stylesheet"/>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="bucketadmin/js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

@stop

@section('body')
   
@stop
@section('scripts')
	{{ javascript_include_tag('vendor') }}
    <!--Core js-->
    <script src="bucketadmin/js/lib/jquery.js"></script>
    <script src="bucketadmin/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
    <script src="bucketadmin/bs3/js/bootstrap.min.js"></script>
    <script src="bucketadmin/js/accordion-menu/jquery.dcjqaccordion.2.7.js"></script>
    <script src="bucketadmin/js/scrollTo/jquery.scrollTo.min.js"></script>
    <script src="bucketadmin/js/nicescroll/jquery.nicescroll.js" type="text/javascript"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="bucketadmin/js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="bucketadmin/assets/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="bucketadmin/assets/skycons/skycons.js"></script>
    <script src="bucketadmin/assets/jquery.scrollTo/jquery.scrollTo.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="bucketadmin/assets/calendar/clndr.js"></script>
    <!--script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script-->
    <script src="bucketadmin/assets/calendar/moment-2.2.1.js"></script>
    <script src="bucketadmin/js/calendar/evnt.calendar.init.js"></script>
    <script src="bucketadmin/assets/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="bucketadmin/assets/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
    <script src="bucketadmin/assets/gauge/gauge.js"></script>
    <!--clock init-->
    <script src="bucketadmin/assets/css3clock/js/script.js"></script>
    <!--Easy Pie Chart-->
    <script src="bucketadmin/assets/easypiechart/jquery.easypiechart.js"></script>
    <!--Sparkline Chart-->
    <script src="bucketadmin/assets/sparkline/jquery.sparkline.js"></script>
    <!--Morris Chart-->
    <script src="bucketadmin/assets/morris-chart/morris.js"></script>
    <script src="bucketadmin/assets/morris-chart/raphael-min.js"></script>
    <!--jQuery Flot Chart-->
    <script src="bucketadmin/assets/flot-chart/jquery.flot.js"></script>
    <script src="bucketadmin/assets/flot-chart/jquery.flot.tooltip.min.js"></script>
    <script src="bucketadmin/assets/flot-chart/jquery.flot.resize.js"></script>
    <script src="bucketadmin/assets/flot-chart/jquery.flot.pie.resize.js"></script>
    <script src="bucketadmin/assets/flot-chart/jquery.flot.animator.min.js"></script>
    <script src="bucketadmin/assets/flot-chart/jquery.flot.growraf.js"></script>
    <script src="bucketadmin/js/dashboard.js"></script>
    <script src="bucketadmin/js/custom-select/jquery.customSelect.min.js" ></script>
    <!--common script init for all pages-->
    <script src="bucketadmin/js/scripts.js"></script>
@stop