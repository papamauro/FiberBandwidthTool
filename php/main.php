<?php
    ini_set('display_errors', 1);
    session_start();
    error_reporting(E_ALL); 
    header('Content-type: text/html; charset=utf-8');
    include_once 'functions.php';
    include_once '../lib/autoload.php';
    include_once '../lib/password.php';
    require_once '../generated-conf/config.php';

if (isset($_POST["newAvg"])) {
		$_SESSION["band_type"]="avg";
		
	
	} else if (isset($_POST["newMax"])) {
		$_SESSION["band_type"]="max";
	}

   if (isset($_POST["newAvg"]) || isset($_POST["newMax"])) {
		$r = new Requests();
		$u = UserQuery::create()->findOneByUsername($_SESSION["userName"]);
		$r->setCompleted(false);
		$r->setLastScreen(0);
        $r->setDate(date('Y-m-d H:i:s'));
		$r->setExtUid($u->getUid());
        if (strcmp($_SESSION["band_type"],"avg")== 0 )
		  $r->setAvg(true);
        else
            $r->setAvg(false);
		$r->save();
        $_SESSION["rid"] = $r->getRid();
		header("Location: generic.php");
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
        <div class="col-lg-12">
             <div class="page-header outerToCenter">
                  <h1 id="typography"><img src="../images/logo.jpg" style="width:50px;">&nbsp;&nbsp;Fiber Bandwidth Tool</h1>
            </div>
        </div>


        <div class="col-lg-8 col-lg-offset-2">
            <div class="well bs-component">
                <div><br />
                    <p style="text-align:justify;"><strong>Benvenuti!</strong> Questa applicazione ha lo scopo di analizzare e progettare i requisiti di banda della vostra azienda con il fine di facilitare la scelta di un pacchetto di accesso in fibra per il vostro business. Verrete guidati attraverso un percorso interattivo che calcolerà il consumo di banda, in upload ed in download, per i principali servizi di rete implementati all'interno della vosta impresa.</p><br />
                </div>
                
                <?php                 
                    if (checkLoggedIn()) { //if logged
                ?>


                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="outerToCenter">
                        <input class="btn btn-primary" type="submit" name="newAvg" value="Calcola banda media >">
                        <input class="btn btn-primary" type="submit" name="newMax" value="Calcola banda massima >"><br /><br />
                    </div>
                </form>

                <?php
                    } else { //if not logged
                ?>
            <div class="outerToCenter"><a class="btn btn-primary" href="login.php">Accedi al servizio ></a><br /></div>
                <?php
                    }
                 ?>

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
