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

    $secBandUp=0;
    $secBandDown=0;
    $number_camera_viewed=1;
    $number_camera=1;

if (isset($_POST['invio'])){
    $s = SecurityQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!$s)
        $s = new Security();
    if($_POST['use_security']=="securityEnabled") { 
        $s->setUseSecurity(true);    
        if (isset($_POST['external_mediaserver'])
                && $_POST['external_mediaserver']=="out") {
                $s->setExternalMediaserver(true);
            /*Ottengo variabili di risoluzione delle telecamere*/
                $temp=explode("|",$_POST['resolution']);
                $width=$temp[0];
                $height=$temp[1];
            
            /*Ottengo variabili di risoluzione delle miniature*/
                $temp=explode("|",$_POST['view_resolution']);
                $widthMini=$temp[0];
                $heightMini=$temp[1];

            if (!empty($_POST['number_camera_viewed']))
                $number_camera_viewed=$_POST['number_camera_viewed'];

            if (!empty($_POST['number_camera']))
                $number_camera=$_POST['number_camera'];
            
            $secBandUp=kush_gauge($width, $height, $_POST['fps'], $_POST['h264_profile'], $number_camera);

            $secBandDown=kush_gauge($width, $height, $_POST['fps'], $_POST['h264_profile'], 1) + kush_gauge($widthMini, $heightMini, $_POST['fps'], $_POST['h264_profile'], ($number_camera_viewed-1));
            $s->setNumberCamera($_POST['number_camera']);
                    $s->setFps( $_POST['fps']);
                $s->setResolution($_POST["resolution"]);
                $s->setH264Profile($_POST['h264_profile']);
                $s->setNumberCameraViewed($_POST['number_camera_viewed']);
                $s->setViewResolution($_POST['view_resolution']);   
             $s->setUpBandwidth($secBandUp)->setDownBandwidth($secBandDown)->setExtRid($_SESSION["rid"]);
        } else {
                        
            if (isset($_POST['external_mediaserver']) && $_POST['external_mediaserver']=="in" && $_POST['remote_access']=="y"){

              

                /*Ottengo variabili di risoluzione delle telecamere*/
                    $temp=explode("|",$_POST['resolution']);
                    $width=$temp[0];
                    $height=$temp[1];

                /*Ottengo variabili di risoluzione delle miniature*/
                    $temp=explode("|",$_POST['view_resolution']);
                    $widthMini=$temp[0];
                    $heightMini=$temp[1];

                if (!empty($_POST['number_camera_viewed']))
                    $number_camera_viewed=$_POST['number_camera_viewed'];

                $secBandUp=kush_gauge($width, $height, $_POST['fps'], $_POST['h264_profile'], 1) + kush_gauge($widthMini, $heightMini, $_POST['fps'], $_POST['h264_profile'], ($number_camera_viewed-1));
                 $s->setExternalMediaserver(false);
                $s->setNumberCamera(null);
                $s->setRemoteAccess(true);
                $s->setFps( $_POST['fps']);
                $s->setResolution($_POST["resolution"]);
                $s->setH264Profile($_POST['h264_profile']);
                $s->setNumberCameraViewed($_POST['number_camera_viewed']);
                $s->setViewResolution($_POST['view_resolution']);
                $s->setUpBandwidth($secBandUp)->setDownBandwidth($secBandDown)->setExtRid($_SESSION["rid"]);
            } else {
 
                $s->setRemoteAccess(false);
                $s->setFps( null);
                $s->setResolution(null);
                $s->setH264Profile(null);
                $s->setNumberCamera(null);
                $s->setNumberCameraViewed(null);
                $s->setViewResolution(null);
                $s->setUpBandwidth(null)->setDownBandwidth(null)->setExtRid($_SESSION["rid"]);
            }

        }
    } else {
        $s->setNumberCamera(null);
        $s->setUseSecurity(false);    
        $s->setFps( null);
        $s->setResolution(null);
        $s->setH264Profile(null);
        $s->setNumberCameraViewed(null);
        $s->setViewResolution(null);
        $s->setUpBandwidth(null)->setDownBandwidth(null)->setExtRid($_SESSION["rid"]);
    }
    $s->save();
    
    debug_to_console("BandaDownload: ".$secBandDown."Kbps");
    debug_to_console("BandaUpload: ".$secBandUp."Kbps");
    header("Location: remote.php");

}

/*Creo un vettore con tutti i campi vuoti*/
$s = new Security();
$dati= $s->toArray();
debug_to_console($dati);

if (isset($_SESSION["rid"])) {    
    $s = SecurityQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!!$s) {
        $dati=$s->toArray();
    }
}

?>
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
                  <h3>Video-sorveglianza</h3>
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
                    <li class="active">Video-sorveglianza</li>
                  </ul>
                  
              </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Description-->
                  <h2>Istruzioni</h2>
                  <p>I seguenti dati riguardano la stima della banda necessaria per il servizio di videosorveglianza implementato nella vostra azienda.</p>
              </div>
            </div>
        </div>

        
        <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                
                  <div class="well bs-component">
              <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']?>" method="post" id="secForm">
                <fieldset>
                  <legend>Inserimento dati</legend>
                                    
                <div class="form-group">
                    <label class="col-lg-2 control-label">Utilizzo video sorveglianza</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="use_security" id="securityEnabled" value="securityEnabled"  <?php echoChecked($dati["UseSecurity"],true,true) ?> onchange="handleRadio()">
                          Si
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="use_security" id="securityDisabled" value="securityDisabled" <?php echoChecked($dati["UseSecurity"],false) ?> onchange="handleRadio()">
                          No
                        </label>
                      </div>
                    </div>
                </div>
                                                
                <div class="form-group">
                    <label for="external_mediaserver" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Caso Esterno:Le telecamere e la stazione di visualizzazione risultano essere collegate alla LAN dell'azienda ma il Media Server è posto esternamente a quest'ultima. Caso Interno: Le telecamere, la stazione di visualizzazione ed il Media Server risultano tutti collegati alla LAN dell'azienda."><span class="badge">?</span></a>&nbsp;&nbsp;Media server</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="external_mediaserver" name="external_mediaserver" onchange="handleexternal_mediaserver()">
                        <option value="out" <?php echoSelected($dati["ExternalMediaserver"],true,true) ?> >Esterno</option>
                        <option value="in" <?php echoSelected($dati["ExternalMediaserver"],false) ?>>Interno</option>
                      </select>
                    </div>
                </div>
                
                <div id="remShow" class="collapse">    
                    <div class="form-group">
                        <label for="remote_access" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="La funzionalità di accesso remoto si traduce nel calcolo di banda in upload necessaria al Media Server per l'invio delle immagini alla stazione di visualizzazione esterna."><span class="badge">?</span></a>&nbsp;&nbsp;Accesso Remoto al media server interno</label>
                        <div class="col-lg-10">
                          <select class="form-control" id="remote_access" name="remote_access" onchange="handleRemote()" disabled>
                            <option value="n" <?php echoChecked($dati["RemoteAccess"],false) ?>>No</option>
                            <option value="y" <?php echoChecked($dati["RemoteAccess"],true,true) ?>>Si</option>                        
                          </select>
                        </div>
                    </div>
                </div>
                  
                <div class="form-group">
                    <label for="number_camera" class="col-lg-2 control-label">Numero di telecamere</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="number_camera" id="number_camera" value="<?php echo $dati["NumberCamera"]?>" placeholder="Inserire il numero totale di telecamere per la video-sorveglianza">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="camCodec" class="col-lg-2 control-label">Codec di compressione video</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="camCodec">
                        <option>H.264</option>
                      </select>
                    </div>
                  </div>
                    
                <div class="form-group">
                    <label for="fps" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Numero di frames per secondo (FPS) delle webcam utilizzate"><span class="badge">?</span></a>&nbsp;&nbsp;Frame Rate per camera</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="fps" name="fps">
                        <option value="10" <?php echoSelected($dati["Fps"],10) ?>>10 FPS</option>
                        <option value="15" <?php echoSelected($dati["Fps"],15) ?>>15 FPS</option>
                        <option value="20" <?php echoSelected($dati["Fps"],20) ?>>20 FPS</option>
                        <option value="25" <?php echoSelected($dati["Fps"],25,true) ?>>25 FPS</option>
                        <option value="30" <?php echoSelected($dati["Fps"],30) ?>>30 FPS</option>
                      </select>
                    </div>
                  </div>    
                                 
                <div class="form-group">
                    <label for="resolution" class="col-lg-2 control-label">Digital Video resolution</label>
                    <div class="col-lg-10">
                      <select multiple="" class="form-control" id="resolution" name="resolution">
                        <option value="640|480" <?php echoSelected($dati["Resolution"],"640|480") ?>>VGA 640x480</option>
                        <option value="1280|720" <?php echoSelected($dati["Resolution"],"1280|720") ?>>HDTV 1280x720</option>
                        <option value="1280|960" <?php echoSelected($dati["Resolution"],"1280|960") ?>>1MP 1280x960</option>
                        <option value="1280|1024" <?php echoSelected($dati["Resolution"],"1280|1024") ?>>1MP 1280x1024</option>
                        <option value="1600|1200" <?php echoSelected($dati["Resolution"],"1600|1200") ?>>2MP 1600x1200</option>
                        <option value="1920|1080" <?php echoSelected($dati["Resolution"],"1920|1080",true) ?>>HDTV 1920x1080</option>
                        <option value="2048|1536" <?php echoSelected($dati["Resolution"],"2048|1536") ?>>3MP 2048x1536</option>
                        <option value="2592|1520" <?php echoSelected($dati["Resolution"],"2592|1520") ?>>4MP 2592x1520</option>
                        <option value="2560|1960" <?php echoSelected($dati["Resolution"],"2560|1960") ?>>5MP 2560x1960</option>
                      </select>
                    </div>
                  </div>
                
                <div class="form-group">
                    <label for="h264_profile" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Se l'immagine ripresa dalla telecamera è molto statica mantenersi sul profilo basso"><span class="badge">?</span></a>&nbsp;&nbsp;&nbsp;Profilo H.264</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="h264_profile" name="h264_profile">
                        <option value="1" <?php echoSelected($dati["H264Profile"],1) ?> >Basso</option>
                        <option value="2" <?php echoSelected($dati["H264Profile"],2,true) ?>>Medio</option>
                        <option value="4" <?php echoSelected($dati["H264Profile"],4) ?>>Alto</option>
                      </select>
                    </div>
                 </div>
                    
                <div class="form-group">
                    <label for="number_camera_viewed" class="col-lg-2 control-label">Numero di telecamere da visualizzare</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="number_camera_viewed" id="number_camera_viewed" value="<?php echo $dati["NumberCameraViewed"];?>" placeholder="Inserire il numero di telecamere da voler visualizzare">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="view_resolution" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Sul numero totale di telecamere che si vuole visualizzare, solo una, in genere, viene mostrata a risoluzione piena, mentre le altre vengono ridotte in miniature."><span class="badge">?</span></a>&nbsp;&nbsp;Risoluzione delle miniature di visualizzazione</label>
                    <div class="col-lg-10">
                      <select multiple="" class="form-control" id="view_resolution" name="view_resolution">
                        <option value="640|480" <?php echoSelected($dati["ViewResolution"],"640|480",true); ?>>VGA 640x480</option>
                        <option value="1280|720" <?php echoSelected($dati["ViewResolution"],"1280|720"); ?>>HDTV 1280x720</option>
                        <option value="1280|960"  <?php echoSelected($dati["ViewResolution"],"1280|960"); ?>>1MP 1280x960</option>
                        <option value="1280|1024"  <?php echoSelected($dati["ViewResolution"],"1280|1024") ?>>1MP 1280x1024</option>
                        <option value="1600|1200"  <?php echoSelected($dati["ViewResolution"],"1600|1200") ?>>2MP 1600x1200</option>
                        <option value="1920|1080"  <?php echoSelected($dati["ViewResolution"],"1920|1080") ?>>HDTV 1920x1080</option>
                      </select>
                    </div>
                  </div>
                  
                <?php faqLink("Hai bisogno di aiuto?");?>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-9 bottomButtons">
                        <a href="video.php" class="btn btn-primary">Back</a>
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
        function handleRemote(){
                if (document.forms.secForm.remote_access.value == 'y'){
                    //document.getElementById('external_mediaserver').disabled = false;
                    document.getElementById('number_camera').disabled = true;
                    document.getElementById('camCodec').disabled = false;
                    document.getElementById('fps').disabled = false;
                    document.getElementById('resolution').disabled = false;
                    document.getElementById('h264_profile').disabled = false;
                    document.getElementById('view_resolution').disabled = false;
                    document.getElementById('number_camera_viewed').disabled = false;
                }
            
                if (document.forms.secForm.remote_access.value == 'n'){
                    //document.getElementById('external_mediaserver').disabled = true;
                    document.getElementById('number_camera').disabled = true;
                    document.getElementById('camCodec').disabled = true;
                    document.getElementById('fps').disabled = true;
                    document.getElementById('resolution').disabled = true;
                    document.getElementById('h264_profile').disabled = true;
                    document.getElementById('view_resolution').disabled = true;
                    document.getElementById('number_camera_viewed').disabled = true;
                }
        }
        
        function handleexternal_mediaserver(){
            if (document.forms.secForm.external_mediaserver.value == 'in'){
                document.getElementById('remote_access').disabled = false;
                document.getElementById('number_camera').disabled = true;
                $('.collapse').collapse("show");}
            
            if ( document.getElementById('external_mediaserver').value == 'out'){
                document.getElementById('remote_access').value = 'y';
                document.getElementById('remote_access').disabled = true;
                document.getElementById('number_camera').disabled = false;
                document.getElementById('remote_access').disabled = true;
                document.getElementById('camCodec').disabled = false;
                document.getElementById('fps').disabled = false;
                document.getElementById('resolution').disabled = false;
                document.getElementById('h264_profile').disabled = false;
                document.getElementById('view_resolution').disabled = false;
                document.getElementById('number_camera_viewed').disabled = false;                
                $('.collapse').collapse("hide");
            }
        
        }
        
        function handleRadio() {
            if (document.forms.secForm.use_security.value == 'securityEnabled'){
                //document.forms.secForm.reset(); 
                document.getElementById('external_mediaserver').disabled = false;
                document.getElementById('remote_access').disabled = true;
                document.getElementById('number_camera').disabled = false;
                document.getElementById('camCodec').disabled = false;
                document.getElementById('fps').disabled = false;
                document.getElementById('resolution').disabled = false;
                document.getElementById('h264_profile').disabled = false;
                document.getElementById('view_resolution').disabled = false;
                document.getElementById('number_camera_viewed').disabled = false;
               
             }
            
            if (document.forms.secForm.use_security.value == 'securityDisabled') {
                 document.getElementById('external_mediaserver').disabled = true;
                 document.getElementById('number_camera').disabled = true;
                 document.getElementById('camCodec').disabled = true;
                 document.getElementById('fps').disabled = true;
                 document.getElementById('resolution').disabled = true;
                 document.getElementById('h264_profile').disabled = true;
                 document.getElementById('number_camera_viewed').disabled = true;
                 document.getElementById('view_resolution').disabled = true;
                 document.getElementById('remote_access').disabled = true;}
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
