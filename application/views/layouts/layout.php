<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ATLAS</title>

    <script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
     <link href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Oleo Script:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="<?php echo base_url('assets/css/agency.min.css')?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/thumbnail-gallery.css')?>" rel="stylesheet">
    <style type="text/css">
    .row
    {
       /* margin-top: 50px;*/
    }
    .inline-separator
    {
      margin-top: 50px; 

    }

    .navbar-fixed
    {
        background-color: #00579F;
    }

    </style>
    <script type="text/javascript">
        $(function() {

       $('#start_date').datepicker();
       $('#end_date').datepicker();
});
    </script>

    

</head>

<body>
<?php if($header) echo $header ;?>
 <?php if($middle) echo $middle ;?>
 <?php if($footer) echo $footer ;?>
        <!-- Page Content -->
        <!-- Footer -->
</body>

</html>
