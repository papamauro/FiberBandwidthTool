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
		"label"=>"Username",
		"placeholder"=>"Inserire il proprio username"));

    $structure[]=array("type"=>"password","parameters"=>array(
		"name"=>"password",
        "class"=>"",        
		"label"=>"Password",
		"placeholder"=>"Inserire la propria password"));

	/*$structure[]=array("type"=>"submit",
							 "parameters"=>array("name"=>"invio",
														"label"=>"Submit",
                                                        "outerClass"=>"col-lg-3 col-lg-offset-9",
														"class"=>"btn btn-primary"));
*/
$alert=0;

if(isset($_POST["invio"])){
    
    debug_to_console($_SERVER['REQUEST_URI']);
    $u = User::login($_POST["username"], $_POST["password"]);
    if(!$u)
        $alert=1;
    else {
        $_SESSION['userName']=$_POST["username"];
        $_SESSION['loggedIn']=true;
        if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false)
            header('Location: ../index.php');
        else
            header('Location: index.php');
    }

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
                    <h3 style="text-align: center;"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;L<i class="fa fa-circle-o-notch fa-spin fa-fw" style="font-size:0.6em"></i>gin</h3>
                    <?php echo_alert("Dati inseriti non validi", $alert, "alert-danger"); ?>
                    <?php write_section($structure); ?>
                    <div class="form-group">
                    <div class="col-lg-7 col-lg-offset-5 bottomButtons">
                        <button type="submit" class="btn btn-primary" name="invio">Submit</button>
                        <a href="register.php" class="btn btn-default">Registrati</a>
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
  </body>
</html>
