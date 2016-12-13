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

    $fatArray=array();
    $user = UserQuery::create()->findOneByUsername($_SESSION["userName"]);
    $uid = $user->getUid(); 
    
    
    // Cerco tutte le richieste dell'uente in questione 
    $requests = RequestsQuery::create()->findByExtUid($uid);

    foreach($requests as $r){
        
        $cls = array("generic", "voip", "video", "security", "remote", "web", "mail");
        $upband = array();
        $downband =array();
        
        //Inizializzo a zero i risultati totali di banda in up e in down
        $fatArray[$r->getRid()]["totupBand"]="Da calcolare";
        $fatArray[$r->getRid()]["totdownBand"]="Da calcolare";

        foreach ($cls as $cl) {
            $metodo = "get" . ucfirst(str_replace("y","ie",$cl)) ."s";
            $up = 0;
            $down = 0;
            $t=call_user_func(array($r, $metodo));
            if (count($t)) {
                
                $up = $t[0]->getUpBandwidth();
                $down = $t[0]->getDownBandwidth();
            }
            $upband[$cl] = $up;
            $downband[$cl] = $down;
        }
        
        //Inserimento dei risultati nell'array ciccione
       $ra=$r->toArray();
       $fatArray[$r->getRid()]["upBand"]=$upband;
        $fatArray[$r->getRid()]["downBand"]=$downband;
       
        if(!empty($ra["Resultup"])){
            $fatArray[$r->getRid()]["totupBand"]=$ra["Resultup"];
            $fatArray[$r->getRid()]["totupBand"].=" Kbps";
        }
        if(!empty($ra["Resultdown"])){
            $fatArray[$r->getRid()]["totdownBand"]=$ra["Resultdown"];
            $fatArray[$r->getRid()]["totdownBand"].=" Kbps";
        }
        
        if ($r->getAvg())
            $fatArray[$r->getRid()]["type"]="Banda Media";
        else
            $fatArray[$r->getRid()]["type"]="Banda Massima";
        
        $fatArray[$r->getRid()]["date"]=$r->getDate();
    }

    //rimando alla sezione corrispnodente
    if (isset($_GET["rid"])){
        $r = RequestsQuery::create()->findOneByRid($_GET["rid"]);
        $_SESSION["rid"] =$_GET["rid"];
        if ($r->getAvg())
            $_SESSION["band_type"]="avg";
        else 
            $_SESSION["band_type"]="max";
        
        //controllo sulla stringa
        header("Location: " . $_GET["section"] . ".php");
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

    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              
            </div>

          </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Description-->
                  <h2>Profilo</h2>
                  <p>Di seguito vengono elencati tutti gli inserimenti precedenti.</p>
              </div>
            </div>
        </div>

        
        <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                
                  <div class="well bs-component" id="profileWell">
              <!--<form class="form-horizontal" action="end.php" method="post" id="averageForm">
                <fieldset>-->                  
                    <table class="table table-striped table-hover" id="styleTable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th style="width:5%;">Tipologia</th>
                          <th style="width:5%;">Data</th> 
                          <th>Banda</th>                          
                          <th>Navigazione</th>
                          <th>Voip</th>
                          <th>Video-conf.</th>
                          <th>Video-sorv.</th>
                          <th>Accesso remoto</th>
                          <th>Web server</th>
                          <th>Mail server</th>
                          <th>Totali</th>
                        </tr>
                      </thead>
                      <tbody>
                <?php
                    $i=1;
                    foreach($fatArray as $key=>$upDownArrays) {
                        echo '<tr class="up-row">';
                        echo "<td rowspan='2'  style='vertical-align: middle;'>$i</td><td rowspan='2' style='vertical-align: middle;'>{$fatArray[$key]["type"]}</td>";
                        if (empty($fatArray[$key]["date"]))
                            $date="?";
                        else
                            $date=$fatArray[$key]["date"]->format('d/m/y H:i:s');
                        echo "<td rowspan='2'  style='vertical-align: middle;'>{$date}</td><td>Up</td>";
                        foreach($upDownArrays["upBand"] as $innerKey => $upValues){
                            if (empty($upValues))
                                $upValues = 0;
                            echo <<<EOF
                                    <td><a href="profile.php?rid=$key&amp;section={$innerKey}">{$upValues} Kbps<i class="fa fa-pencil-square-o" aria-hidden="true" style="float:right; line-height:20px; visibility: hidden;"></i></a></td>                                    
EOF;
                            }
                        echo "<td style=\"background-color:#18bc9c; color:white;\">" .$fatArray[$key]["totupBand"] . "</td>";
                        echo "</tr>";
                        echo '<tr class="down-row" style="border-bottom:1px solid green;"><td>Down</td>';
                        foreach($upDownArrays["downBand"] as $innerKey => $downValues){                                
                            if (empty($downValues))
                                $downValues = 0;
                            echo <<<EOF
                                    <td><a href="profile.php?rid=$key&amp;section={$innerKey}">{$downValues} Kbps<i class="fa fa-pencil-square-o" aria-hidden="true" style="float:right; line-height:20px; visibility: hidden;"></i></a></td>                                    
EOF;
                            }
                        echo "<td style=\"background-color:#18bc9c; color:white;\">" .$fatArray[$key]["totdownBand"] . "</td>";
                        echo "</tr>";
                        $i++;
                    }
                ?>
                        </tbody>
                    </table>
              
                  
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
