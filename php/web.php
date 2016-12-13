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

    $webBandUpload=0;
    $concorrent_requests=0;
    $page_size=0;
    $page_load_time=1;

    
if (isset($_POST['invio'])) {
    
    $w = WebQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!$w)
        $w =new Web();
    
    if ($_POST['internal_web_server']=="webEnabled"){
        
        $w->setInternalWebServer(true);
        
        if (!empty($_POST['concorrent_requests'])) {
                $concorrent_requests=$_POST['concorrent_requests'];
                
        }
        if (!empty($_POST['page_size'])) {
                $page_size=$_POST['page_size'];
        }
        if (!empty($_POST['page_load_time'])) { 
            $page_load_time=$_POST['page_load_time'];
        }
        $webBandUpload=webBand($page_size, $concorrent_requests, $page_load_time);
        $w->setUpBandwidth($webBandUpload)->setExtRid($_SESSION["rid"]);
        $w->setConcorrentRequests($concorrent_requests)->setPageSize($page_size)->setPageLoadTime($page_load_time);
        
    } else {
        $w->setInternalWebServer(false)->setConcorrentRequests(null)->setPageSize(null)->setPageLoadTime(null)->setExtRid($_SESSION["rid"])->setUpBandwidth(null);
    }
    $w->save();
    debug_to_console("BandaUpload: ".$webBandUpload."Kbps");
    header("Location: mail.php");
}

/*Creo un vettore con tutti i campi vuoti*/
$w = new Web();
$dati= $w->toArray();
debug_to_console($dati);

if (isset($_SESSION["rid"])) {    
    $w = WebQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!!$w) {
        $dati=$w->toArray();
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

    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h3>Web Server</h3>
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
                    <li class="active">Web server</li>
                  </ul>
                  
              </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Description-->
                  <h2>Istruzioni</h2>
                  <p>Calcolo della banda in upload in presenza di un web server interno all'azienda.</p>
              </div>
            </div>
        </div>

        
        <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                
                  <div class="well bs-component">
              <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']?>" method="post" id="webForm">
                <fieldset>
                  <legend>Inserimento dati</legend>
                                    
                <div class="form-group">
                    <label class="col-lg-2 control-label">Web server</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="internal_web_server" id="webEnabled" value="webEnabled" <?php echoChecked($dati["InternalWebServer"],true,true) ?>  onchange="handleWeb()">
                          Interno
                        </label>
                      </div>                        
                      <div class="radio">
                        <label>
                          <input type="radio" name="internal_web_server" id="webDisabled" <?php echoChecked($dati["InternalWebServer"],false) ?> value="webDisabled"  onchange="handleWeb()">
                          Esterno
                        </label>
                      </div>

                    </div>
                </div>
                    
                 <div class="form-group">
                    <label class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" data-html="true" title="Per ottenere dati precisi da poter inserire, si consiglia di utilizzare il servizio <i class='fa fa-google' aria-hidden='true'></i><strong>oogle Analytics</strong>"><span class="badge">?</span></a>&nbsp;&nbsp;Dimensione media delle pagine web</label>
                     <div class="col-lg-10"> 
                        <div class="input-group">
                            <input type="text" class="form-control" id="page_size" name="page_size" value="<?php echo $dati["PageSize"]; ?>" placeholder="Inserire dimensione media delle pagine web in KB">
                            <span class="input-group-addon">KB</span>
                         </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" data-html="true" title="Per ottenere dati precisi da poter inserire, si consiglia di utilizzare il servizio <i class='fa fa-google' aria-hidden='true'></i><strong>oogle Analytics</strong>"><span class="badge">?</span></a>&nbsp;&nbsp;Tempo medio di caricamento pagina</label>
                     <div class="col-lg-10">
                        <div class="input-group">
                         
                         <input type="text" class="form-control" id="page_load_time" name="page_load_time" value="<?php echo $dati["PageLoadTime"]; ?>" placeholder="Inserire il tempo medio di caricamento pagina in secondi">
                            <span class="input-group-addon">Sec</span>
                       </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" data-html="true" title="Per ottenere dati precisi da poter inserire, si consiglia di utilizzare il servizio <i class='fa fa-google' aria-hidden='true'></i><strong>oogle Analytics</strong>"><span class="badge">?</span></a>&nbsp;&nbsp;Numero medio di accessi contemporanee</label>
                     <div class="col-lg-10">   
                       <input type="text" class="form-control" id="concorrent_requests" name="concorrent_requests" value="<?php echo $dati["ConcorrentRequests"]; ?>" placeholder="Numero medio di utenti che visualizzano il sito contemporaneamente">
                    </div>
                </div>
                <div class="col-lg-offset-2">
                    <a href="#" style="margin-bottom:35px;" class="btn btn-success btn-sm" onclick="handlePingDom()">Utilizza medie statistiche [Source:Pingdom.com]</a>
                </div>
                
               <?php faqLink("Hai bisogno di aiuto?");?>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-9 bottomButtons">
                        <a href="remote.php" class="btn btn-primary">Back</a>
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="invio">Next</button>
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
        function handlePingDom(){
            document.getElementById('page_size').value = '3000';
            document.getElementById('page_load_time').value = '5';
            
        }
        
        function handleWeb() {
             if (document.forms.webForm.internal_web_server.value ==  'webEnabled') {
                 document.getElementById('page_size').disabled = false;
                 document.getElementById('concorrent_requests').disabled = false;
                 document.getElementById('page_load_time').disabled = false;
             }
            
            if (document.forms.webForm.internal_web_server.value =='webDisabled'){
                 document.getElementById('page_size').disabled = true;
                 document.getElementById('concorrent_requests').disabled = true;
                 document.getElementById('page_load_time').disabled = true;                
                 
             }
         }
    </script>
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
