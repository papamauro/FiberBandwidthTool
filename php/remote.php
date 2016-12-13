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

    $remoteBandDown=0;
    $nRemTemp=1;
    
if (isset($_POST['invio'])){
        $r = RemoteQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!$r)
        $r = new Remote();
    if($_POST['remote_used']=="remoteEnabled") {
        $r->setRemoteUsed(true);
        $r->setCitrixBR(false);
        $remoteBands = new remoteBand();
        
        if($_POST['remote_service']=="rdp" || $_POST['remote_service']=="ctx") {            
            $rmq = new remoteBandQuery();            
            if (isset($_POST['citrix_br']) && $_POST['citrix_br']=="y"){
                $remoteBands=$rmq->findPK("ctxbr");//query_db($sql_connection, "remoteband", "id", "ctxbr");
                $r->setCitrixBR(true);
            }
            else
                $remoteBands=$rmq->findPK($_POST['remote_service']);//query_db($sql_connection, "remoteband", "id", $_POST['remote_service']);            
        } else {

            $sliced=array_slice($_POST,3,5,true);
            
            foreach ($sliced as $key => $value) {
                //$remoteBands[0][str_replace("_band", "", $key)]=$value;
                $keyName = str_replace("_band", "", $key);
                $keyName = ucwords(str_replace("_", " ", $keyName));
                $keyName = str_replace(" ", "", $keyName);
                $remoteBands->setByName( $keyName ,$value);
                
            }
        }
        
        if (!empty($_POST['concurrent_access']))
                $nRemTemp=$_POST['concurrent_access'];
        
        $r->setConcurrentAccess($_POST['concurrent_access']);
        $r->setRemoteService($_POST['remote_service']); 
        $r->setExtRid($_SESSION["rid"]);
        
        foreach (["Office","Internet","Printing", "HdVideo","SdVideo"] as $value) {
            $r->setByName($value."Band",$remoteBands->toArray()[$value]);
        }
        
        $remoteBandDown=remoteBand($remoteBands->toArray(), $nRemTemp);
        $r->setDownBandwidth($remoteBandDown);


    } else {
        $r->setRemoteUsed(false);
        $r->setCitrixBR(null);
        $r->setConcurrentAccess(null);
        $r->setRemoteService(null); 
        $r->setExtRid($_SESSION["rid"]);
        
        foreach (["Office","Internet","Printing", "HdVideo","SdVideo"] as $value) {
            $r->setByName($value."Band", null);
        }
        
        $remoteBandDown=remoteBand(null);
        $r->setDownBandwidth(null);
    }
    $r->save();
    debug_to_console("BandaDownload: ".$remoteBandDown."Kbps");
    header("Location: web.php");
}

/*Creo un vettore con tutti i campi vuoti*/
$r = new Remote();
$dati= $r->toArray();
debug_to_console($dati);

if (isset($_SESSION["rid"])) {    
    $r = RemoteQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!!$r) {
        $dati=$r->toArray();
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
      
    
  </head>

  <body>

    <?php echo_navbar(); ?>

    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h3>Accesso remoto</h3>
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
                    <li class="active">Accesso remoto</li>
                  </ul>
                  
              </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Description-->
                  <h2>Istruzioni</h2>
                  <p>I seguenti dati riguardano la stima della banda consumata durante sessioni di accesso remoto.</p>
              </div>
            </div>
        </div>

        
         <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                
                  <div class="well bs-component">
              <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']?>" method="post" id="remoteForm">
                <fieldset>
                  <legend>Inserimento dati</legend>
                                    
                <div class="form-group">
                    <label class="col-lg-2 control-label">Si utilizzano servizi di accesso remoto?</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="remote_used" id="remote_used" value="remoteEnabled" <?php echoChecked($dati["RemoteUsed"],true,true) ?> onchange="handleRadio()">
                          Si
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="remote_used" id="remote_used" value="remoteDisabled" <?php echoChecked($dati["RemoteUsed"],false) ?> onchange="handleRadio()">
                          No
                        </label>
                      </div>
                    </div>
                </div>
                  
                <div class="form-group">
                    <label for="concurrent_access" class="col-lg-2 control-label">Numero medio di accessi contemporanei</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" id="concurrent_access" value="<?php echo $dati["ConcurrentAccess"]?>" name="concurrent_access" placeholder="Inserire il numero medio di accessi contemporanei">
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="remote_service" class="col-lg-2 control-label">Servizio utilizzato</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="remote_service" name="remote_service" onchange="handleCitrix()">
                        <option value="rdp" <?php echoSelected($dati["RemoteService"],"rdp",true) ?>>Windows RDP v6+</option>
                        <option value="ctx" <?php echoSelected($dati["RemoteService"],"ctx") ?>>Citrix XenApp HDX</option>  
                        <option value="otr" <?php echoSelected($dati["RemoteService"],"otr") ?>>Altro...</option>
                      </select>
                    </div>
                  </div>
                    
                <div class="form-group">
                    <label for="citrix_br" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="In caso venga utilizzato il servizio Citrix XenApp, è possibile indicare la presenza di dispositivi Citrix Branch Repeaters installati nell'azienda, i quali comportano una drastica riduzione del consumo di banda."><span class="badge">?</span></a>&nbsp;&nbsp;Citrix Branch Repeater</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="citrix_br" name="citrix_br" disabled>
                        <option value="n" <?php echoSelected($dati["CitrixBr"],false,true) ?>>No</option>  
                        <option value="y" <?php echoSelected($dati["CitrixBr"],true) ?>>Si</option>
                      </select>
                    </div>
                  </div>

                    
                <div class="form-group">
                    <label class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Inserire il consumo di banda del software utilizzato per tipologia di utilizzo."><span class="badge">?</span></a>&nbsp;&nbsp;Consumo di banda per tipologia di utilizzo</label>
                    <div class="col-lg-2">
                        <label for="OfficeBand">Ufficio</label>    
                        <input type="text" class="form-control" <?php checkAndPrint($dati["RemoteService"],"otr",'value="' .$dati["OfficeBand"] . '"'); ?> id="office_band" name="office_band" placeholder="0 Kbps" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="InternetBand">Internet</label>    
                        <input type="text" class="form-control" <?php checkAndPrint($dati["RemoteService"],"otr",'value="' .$dati["InternetBand"] . '"'); ?> id="internet_band" name="internet_band" placeholder="0 Kbps" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="PrintingBand">Stampa</label>    
                        <input type="text" class="form-control" <?php checkAndPrint($dati["RemoteService"],"otr",'value="' .$dati["PrintingBand"] . '"'); ?> id="printing_band" name="printing_band" placeholder="0 Kbps" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="SdVideoBand">SD Video</label>    
                        <input type="text" class="form-control" <?php checkAndPrint($dati["RemoteService"],"otr",'value="' .$dati["SdVideoBand"] . '"'); ?> id="sd_video_band" name="sd_video_band" placeholder="0 Kbps" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="HdVideoBand">HD Video</label>    
                        <input type="text" class="form-control" <?php checkAndPrint($dati["RemoteService"],"otr",'value="' .$dati["HdVideoBand"] . '"'); ?> id="hd_video_band" name="hd_video_band" placeholder="0 Kbps" disabled>
                    </div>
                </div>  
                    
                <div class="form-group switchable">
                    <label class="col-lg-2 control-label">Tipologia di utilizzo effettuato</label>
                    <div class="col-lg-2">
                        <label for="Office">Ufficio</label>    
                        <input type="checkbox" name='office' id="office" data-size="mini" checked>
                    </div>
                    <div class="col-lg-2">
                        <label for="Internet">Internet</label>    
                        <input type="checkbox" name="internet" id="internet" data-size="mini" checked>
                    </div>
                    <div class="col-lg-2">
                        <label for="Printing">Stampa</label>    
                        <input type="checkbox" name="printing" id="printing" data-size="mini" checked>
                    </div>
                    <div class="col-lg-2">
                        <label for="SdVideo">SD Video</label>    
                        <input type="checkbox" name="sdvideo" id="sd_video" data-size="mini" checked>
                    </div>
                    <div class="col-lg-2">
                        <label for="HdVideo">HD Video</label>    
                        <input type="checkbox" name="hdvideo" id="hd_video" data-size="mini" checked>
                    </div>
                </div>  
                
                 <?php faqLink("Hai bisogno di aiuto?");?> 
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-9 bottomButtons">
                        <a href="security.php" class="btn btn-primary">Back</a>
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
      
    <!-- Bootstrap Switch -->
    <link href="../dist/css/bootstrap-switch.css" rel="stylesheet">
    <script src="../dist/js/bootstrap-switch.js"></script>
      
    <!--Font Awesome-->
    <link rel="stylesheet" href="../dist/css/font-awesome.min.css">
      
    <script>
        $(document).ready(function(){
            $("#office").bootstrapSwitch();
            $("#internet").bootstrapSwitch();
            $("#printing").bootstrapSwitch();
            $("#sd_video").bootstrapSwitch();
            $("#hd_video").bootstrapSwitch();
        });
    </script>
      
    <script>
        
        function handleCitrix(){
            
            if (document.forms.remoteForm.remote_service.value == 'ctx')
                document.getElementById('citrix_br').disabled = false;
            else
                document.getElementById('citrix_br').disabled = true;
        
            if (document.forms.remoteForm.remote_service.value == 'otr'){
                document.getElementById('office_band').disabled = false;
                document.getElementById('internet_band').disabled = false;
                document.getElementById('printing_band').disabled = false;
                document.getElementById('sd_video_band').disabled = false;
                document.getElementById('hd_video_band').disabled = false;
            }else{
                document.getElementById('office_band').disabled = true;
                document.getElementById('internet_band').disabled = true;
                document.getElementById('printing_band').disabled = true;
                document.getElementById('sd_video_band').disabled = true;
                document.getElementById('hd_video_band').disabled = true;
            }
        }
        
        function handleRadio() {
            
            if (document.forms.remoteForm.remote_used.value == 'remoteEnabled'){
                document.getElementById('concurrent_access').disabled = false;
                document.getElementById('remote_service').disabled = false;
                document.getElementById('office').disabled = false;
                document.getElementById('internet').disabled = false;
                document.getElementById('printing').disabled = false;
                document.getElementById('sd_video').disabled = false;
                document.getElementById('hd_video').disabled = false;
             }

            if (document.forms.remoteForm.remote_used.value == 'remoteEnabled' && document.forms.remoteForm.remote_service.value == 'ctx')
                document.getElementById('citrix_br').disabled = false;
                
            if (document.forms.remoteForm.remote_used.value == 'remoteDisabled') {
                document.getElementById('concurrent_access').disabled = true;
                document.getElementById('remote_service').disabled = true;
                document.getElementById('office').disabled = true;
                document.getElementById('internet').disabled = true;
                document.getElementById('printing').disabled = true;
                document.getElementById('sd_video').disabled = true;
                document.getElementById('hd_video').disabled = true;
                document.getElementById('office_band').disabled = true;
                document.getElementById('internet_band').disabled = true;
                document.getElementById('printing_band').disabled = true;
                document.getElementById('sd_video_band').disabled = true;
                document.getElementById('hd_video_band').disabled = true;
                document.getElementById('citrix_br').disabled = true;
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
