<?php
    ini_set('display_errors', 1);
    session_start();
    error_reporting(E_ALL); 
    header('Content-type: text/html; charset=utf-8');
    include_once 'functions.php';
    include_once '../lib/autoload.php';
    include_once '../lib/password.php';
    require_once '../generated-conf/config.php';
	$structure=array();
/*Nell'array structure ci sono i normali input field ognuno con i suoi parametri*/

	$structure[]=array("type"=>"text","parameters"=>array(
		"name"=>"username",
        "class"=>"",        
        "default_value"=>isset($_POST["username"])? $_POST["username"] : "" ,
		"label"=>"Username",
		"placeholder"=>"Scegliere il proprio username"));

    $structure[]=array("type"=>"text","parameters"=>array(
		"name"=>"company",
        "class"=>"",
        "default_value"=>isset($_POST["company"])? $_POST["company"] : "" ,
		"label"=>"Azienda",
		"placeholder"=>"Inserire il nome della propria azienda"));

    $structure[]=array("type"=>"text","parameters"=>array(
		"name"=>"mail",
        "class"=>"",
        "default_value"=>isset($_POST["mail"])? $_POST["mail"] : "" ,
		"label"=>"E-mail",
		"placeholder"=>"Inserire il proprio indirizzo email"));

    $structure[]=array("type"=>"password","parameters"=>array(
		"name"=>"password",
        "class"=>"",
		"label"=>"Password",
		"placeholder"=>"Scegliere la propria password"));

    $structure[]=array("type"=>"password","parameters"=>array(
		"name"=>"repeat",
        "class"=>"",
		"label"=>"",
		"placeholder"=>"Ripetere la propria password"));

	/*$structure[]=array("type"=>"submit",
							 "parameters"=>array("name"=>"invio",
														"label"=>"Submit",
                                                        "outerClass"=>"col-lg-3 col-lg-offset-9",
														"class"=>"btn btn-primary"));
*/
$alert=0;
$alertString=array("Si prega di inserire tutti i campi", "Le password inserite non combaciano", "Inserire una e-mail valida", "Username già esistente", "Errore nella registrazione");
$alertVersion=4;
    
if(isset($_POST["invio"])){
    
    debug_to_console($_SERVER['REQUEST_URI']);
    $u = new User();
    $alertVersion=$u->register($_POST["username"], $_POST["company"], $_POST["mail"],$_POST["password"], $_POST["repeat"]);

    if($alertVersion==1){
        $_SESSION['userName']=$_POST["username"];
        $_SESSION['loggedIn']=true;
        if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false)
            header('Location: ../index.php');
        else
            header('Location: index.php');
    }
    
    if(in_array($alertVersion, [0,-1,-2,-3,-4])) 
        $alert=1;


}


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

    <div class="container sign">

        <div class="row">
          <div class="col-lg-6 col-lg-offset-3">
              <div class="bs-component">
                
                
                  <div class="well bs-component signComponent">
                      
              <form class="form-horizontal signForm" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <fieldset>
                    <h3 style="text-align: center;">Sign <i class="fa fa-sign-out fa-rotate-270" aria-hidden="true"></i>p</h3>
                    <?php echo_alert($alertString[abs($alertVersion)], $alert, "alert-danger"); ?>
                    <?php write_section($structure); ?>

                    <label class="checkbox inline">
                        <input type="checkbox" id="registerCheck"> Accetto i termini di servizio&nbsp;&nbsp;<a class="help-inline" href="faq.php?anchor=privacyLink" target="_blank">Leggi tutto</a>
                    </label>
                    

                    <div class="form-group">
                    <div class="col-lg-7 col-lg-offset-5 bottomButtons">
                        <button type="submit" class="btn btn-primary" name="invio" id="submit" disabled>Registrati</button>
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
    $( document ).ready(function() {
        $('#registerCheck').change(function() {
            if($('#submit').is('[disabled]'))
                $('#submit').prop('disabled', false);
            else
                $('#submit').prop('disabled', true);
        // do stuff here. It will fire on any checkbox change

        })
    }); 
      </script>
  </body>
</html>
