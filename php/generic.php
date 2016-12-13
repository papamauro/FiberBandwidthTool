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
        
    $avgDesk=1;
    $genericBandDown=0;
    $genericBandUp=0;
if (isset($_POST['invio'])){
     $g = GenericQuery::create()->findOneByExtRid($_SESSION["rid"]);
     if (!$g) {
         $g = new Generic(); 
     }
    
     if (isset($_POST['numero_postazioni']) && !empty($_POST['numero_postazioni']))
            $avgDesk=$_POST['numero_postazioni'];
     
    if($_POST['utilizzo_banda']=='0')
        $utilizzoBanda=$_POST['customBand'];
    else    
        $utilizzoBanda=$_POST['utilizzo_banda'];
    
    $genericBandDown=$utilizzoBanda*$avgDesk;
    $genericBandUp=$genericBandDown*0.1;
    
    $g->setNumeroPostazioni($avgDesk)->setUtilizzoBanda($utilizzoBanda)->setUpBandwidth($genericBandUp)->setDownBandwidth($genericBandDown)->setExtRid($_SESSION["rid"]);
    $g->save();
    
    debug_to_console("BandaDownload: ".$genericBandDown."Kbps");
    header("Location: voip.php");
}

/*Creo un vettore con tutti i campi vuoti*/
$g = new Generic();
$dati= $g->toArray();
debug_to_console($dati);

if (isset($_SESSION["rid"])) {    
    $g = GenericQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!!$g) {
        $dati=$g->toArray();
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
      
    <script>
        function handleSelect() {
             if (document.forms.genericForm.utilizzo_banda.value == '0') {
                 document.getElementById('customBand').disabled = false;
             }
            if (document.forms.genericForm.utilizzo_banda.value != '0') {
                document.getElementById('customBand').disabled = true;
             }
         }
    </script>
    </head>


  <body>

    <?php echo_navbar(); ?>

    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h3>Numero Dipendenti</h3>
            </div>

          </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Breadcrumbs-->
                  <ul class="breadcrumb">
                    <li><a href="../index.php">Getting started</a></li>  
                    <li class="active">N. Dipendenti</li>
                  </ul>
                  
              </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Description-->
                  <h2>Istruzioni</h2>
                  <p>Si prega di inserire il numero totale di dipendenti dell'azienda, il numero di postazioni informatiche e la presenza o meno di wi-fi.</p>
              </div>
            </div>
        </div>

        
        <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                
                  <div class="well bs-component">
              <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']?>" method="post" onchange="handleSelect()" id="genericForm">
                <fieldset>
                  <legend>Inserimento dati</legend>
                    
                  
                  <div class="form-group">
                    <label for="nItDesks" class="col-lg-2 control-label">Numero postazioni informatiche in utilizzo contemporaneamente</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" id="numero_postazioni" name="numero_postazioni" value="<?php echo $dati['NumeroPostazioni']; ?>" placeholder="Inserire il numero totale di computers attivi nell'azienda">
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <label class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Si consiglia di scegliere 'Medium User' o 'Heavy User' nel caso in cui gli impiegati utilizzino sistematicamente servizi online quali, ad esempio, gestionali su cloud."><span class="badge">?</span></a>&nbsp;&nbsp;Consumo medio di banda per postazione</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="utilizzo_banda" id="lightUser"
                          <?php echoChecked($dati['UtilizzoBanda'], 50,true); ?> value="50"/>
                          Light user: 50Kbps
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="utilizzo_banda" id="mediumUser"  <?php echoChecked($dati['UtilizzoBanda'], 80); ?> value="80">
                          Medium user: 80Kbps
                        </label>
                      </div>
                    <div class="radio">
                        <label>
                          <input type="radio" name="utilizzo_banda" id="heavyUser" <?php echoChecked($dati['UtilizzoBanda'], 120); ?> value="120">
                          Heavy user: 120 Kbps
                        </label>
                     </div>
                    <div class="radio">
                        <label>
                          <input type="radio" name="utilizzo_banda" id="customUser" <?php echoChecked($dati['UtilizzoBanda'], [50, 80, 120],true,true); ?> value="0">
                          Inserisci valore
                        </label>
                    </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="customBand" class="col-lg-2 control-label">Inserire consumo medio di banda per postazione</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="customBand" id="customBand" placeholder="0 Kbps" <?php checkAndPrint($dati['UtilizzoBanda'], [50, 80, 120],"value=\"".$dati['UtilizzoBanda']."\"",true,true);   checkAndPrint($dati['UtilizzoBanda'], [50, 80, 120],"disabled",true,false); ?>>
                    </div>
                  </div>

                  <?php faqLink("Hai bisogno di aiuto?");?>
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
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            
            $('[type="text"]').keyup(function () { 
                    this.value = this.value.replace(/[^0-9\.]/g,'');
            });
        });
    </script>

  </body>
</html>
