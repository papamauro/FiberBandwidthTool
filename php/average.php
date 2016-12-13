<?php
    ini_set('display_errors', 1);
    session_start();
    error_reporting(E_ALL); 
    header('Content-type: text/html; charset=utf-8');
    include_once 'functions.php';
    include_once '../lib/autoload.php';
    require_once '../generated-conf/config.php';
    /*Controllo che l'utente sia loggato*/
    redirect();

    $structure=array();
	$structure[]=array("type"=>"diagram","parameters"=>array(
		"name"=>"generic",       
		"label"=>"Navigazione web"));
    $structure[]=array("type"=>"diagram","parameters"=>array(
		"name"=>"voip",       
		"label"=>"UC: VoiP"));
    $structure[]=array("type"=>"diagram","parameters"=>array(
		"name"=>"video",       
		"label"=>"UC: Videoconferenza"));
    $structure[]=array("type"=>"diagram","parameters"=>array(
		"name"=>"security",       
		"label"=>"Video-sorveglianza"));
    $structure[]=array("type"=>"diagram","parameters"=>array(
		"name"=>"remote",       
		"label"=>"Accesso remoto"));
    $structure[]=array("type"=>"diagram","parameters"=>array(
		"name"=>"web",       
		"label"=>"Web server"));
    $structure[]=array("type"=>"diagram","parameters"=>array(
		"name"=>"mail",       
		"label"=>"Mail server"));


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Fiber Bandwidth Tool</title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../dist/css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!--Font Awesome-->
    <link rel="stylesheet" href="../dist/css/font-awesome.min.css">
    
  </head>

  <body>

    <?php echo_navbar(); ?>

    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h3>Tempi di utilizzo</h3>
            </div>

          </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Breadcrumbs-->
                  <ul class="breadcrumb">
                    <li><a href="../index.php">Getting started</a></li> 
                    <li><a href="generic.php">N. Dipendenti</a></li> 
                    <li><a href="voip.php">Unified Communications (VoiP)</a></li>
                    <li><a href="video.php">Unified Communications (Video-conferenza)</a></li>  
                    <li><a href="security.php">Video-sorveglianza</a></li> 
                    <li><a href="remote.php">Accesso remoto</a></li>
                    <li><a href="web.php">Web server</a></li>
                    <li class="active">Calcolo media</li>
                  </ul>
                  
              </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Description-->
                  <h2>Istruzioni</h2>
                  <p>Inserire gli orari di inizio e fine utilizzo, espressi in ore e minuti, per singolo servizio.</p>
              </div>
            </div>
        </div>

        
        <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                
                  <div class="well bs-component">
              <form class="form-horizontal" action="end.php" method="post" id="averageForm">
                <fieldset>
                  <legend>Inserimento dati</legend>
                
                    
                  <?php write_section($structure); ?>
                    
              
                  <div class="form-group">
                    <div class="col-lg-12 bottomButtons twoButtons">
                        <button type="submit" class="btn btn-primary" name="invio">Next</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
                  </div>
                </fieldset>
              </form></div>
                  
              </div>
          </div>
        </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script>
        $('#genericAll').change(function() {
            var checkboxes = $(this).closest('form').find('.generic');
            if($(this).is(':checked')) {
                checkboxes.addClass('active');
                $('.genericclass').prop('checked', true);
                
            } else {
                $('.genericclass').prop('checked', false);
                checkboxes.removeClass('active');
            }
        });

        $('#voipAll').change(function() {
            var checkboxes = $(this).closest('form').find('.voip');
            if($(this).is(':checked')) {
                checkboxes.addClass('active');
                $('.voipclass').prop('checked', true);
            } else {
                checkboxes.removeClass('active');
                $('.voipclass').prop('checked', false);
            }
        });
        
        $('#videoAll').change(function() {
            var checkboxes = $(this).closest('form').find('.video');
            if($(this).is(':checked')) {
                checkboxes.addClass('active');
                $('.videoclass').prop('checked', true);
            } else {
                checkboxes.removeClass('active');
                $('.videoclass').prop('checked', false);
            }
        });
        
        $('#securityAll').change(function() {
            var checkboxes = $(this).closest('form').find('.security');
            if($(this).is(':checked')) {
                checkboxes.addClass('active');
                $('.securityclass').prop('checked', true);
            } else {
                checkboxes.removeClass('active');
                $('.securityclass').prop('checked', false);
            }
        });
        
        $('#remoteAll').change(function() {
            var checkboxes = $(this).closest('form').find('.remote');
            if($(this).is(':checked')) {
                checkboxes.addClass('active');
                $('.remoteclass').prop('checked', true);
            } else {
                checkboxes.removeClass('active');
                $('.remoteclass').prop('checked', false);
            }
        });
        
        $('#webAll').change(function() {
            var checkboxes = $(this).closest('form').find('.web');
            if($(this).is(':checked')) {
                checkboxes.addClass('active');
                $('.webclass').prop('checked', true);
            } else {
                checkboxes.removeClass('active');
                $('.webclass').prop('checked', false);
            }
        });
        
        $('#mailAll').change(function() {
            var checkboxes = $(this).closest('form').find('.mail');
            if($(this).is(':checked')) {
                checkboxes.addClass('active');
                $('.mailclass').prop('checked', true);
            } else {
                checkboxes.removeClass('active');
                $('.mailclass').prop('checked', false);
            }
        });
    </script>
  </body>
</html>
