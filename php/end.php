<?php
    ini_set('display_errors', 1);
    session_start();
    error_reporting(E_ALL); 
    header('Content-type: text/html; charset=utf-8');
    include_once 'functions.php';
    include_once '../lib/autoload.php';
    include_once '../lib/password.php';
    require_once '../generated-conf/config.php';

    $r = RequestsQuery::create()->FindPk($_SESSION["rid"]);
    $cls = ["generic", "voip", "video", "security", "remote", "web", "mail"];
    $upband = array();
    $downband =array();
    foreach ($cls as $cl) {
        $metodo = "get" . ucfirst(str_replace("y","ie",$cl)) ."s";
        $up = 0;
        $down = 0;
        //print_r(count($r->$metodo()));
        if (count($r->$metodo()) ) {
            $up = $r->$metodo()[0]->getUpBandwidth();
            $down = $r->$metodo()[0]->getDownBandwidth();
        }
            $upband[$cl] = $up;
            $downband[$cl] = $down;
        
    }

if (isset($_POST['invio'])) {
    debug_to_console($_POST);
    unset($_POST['invio']);

    $avgBandUp=weightedAvg($_POST, $upband);
    $avgBandDown=weightedAvg($_POST, $downband);
    $r->setResultUp($avgBandUp);
    $r->setResultDown($avgBandDown);
    $r->setCompleted(true);
    $r->save();   
    
} else {
    
    $avgBandUp=0;
    $avgBandDown=0;
        
    foreach($upband as $value)
        $avgBandUp+=$value;
    
    foreach($downband as $value)
        $avgBandDown+=$value;
    
    $r->setResultUp($avgBandUp);
    $r->setResultDown($avgBandDown);
    $r->setCompleted(true);
    $r->save();
    
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
                  <h1 id="typography"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Complimenti! Ecco i risultati</h1>
            </div>
        </div>


        <div class="col-lg-8 col-lg-offset-2">
            <div class="well bs-component">
                <div><br />
                    <p style="text-align:justify;">Hai completato correttamente tutti i passaggi dell'applicazione. Di seguito troverai il consumo di banda, in upload ed in download, della tua azienda, espresso in kilobit per secondo:</p><br />
                </div>
                <table style="width:100%">
                    <tr>
                        <td align="center"><i class="fa fa-arrow-circle-o-up fa-2x" style="line-height:30px;" aria-hidden="true"></i>&nbsp;&nbsp;<strong>Banda in upload: <?php echo round($avgBandUp);?> Kbps</strong></td>
                        <td align="center"><i class="fa fa-arrow-circle-o-down fa-2x" style="line-height:30px;" aria-hidden="true"></i>&nbsp;&nbsp;<strong>Banda in download: <?php echo round($avgBandDown);?> Kbps</strong></td>
                    </tr>
                </table>
                
                  

          </div>        
       </div>
   </div>



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

