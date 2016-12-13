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

    $numero_partecipanti_entrata=1;
    $sessioni_contemporanee=1;
    $numero_partecipanti_uscita=1;
    $videoBandUp=0;
    $videoBandDown=0;

if (isset($_POST['invio'])){
    $v = VideoQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!$v)
        $v =new Video();
    
    if ($_POST['uso_video']=="videoEnabled"){        

        $temp=explode("|",$_POST['risoluzione']);
        $width=$temp[0];
        $height=$temp[1];
                
        if (!empty($_POST['numero_partecipanti_entrata']))
            $numero_partecipanti_entrata=$_POST['numero_partecipanti_entrata'];
        
        if (!empty($_POST['numero_partecipanti_uscita']))
            $numero_partecipanti_uscita=$_POST['numero_partecipanti_uscita'];
        
        if (!empty($_POST['sessioni_contemporanee']))
            $sessioni_contemporanee=$_POST['sessioni_contemporanee'];
                
        $videoBandUp=kush_gauge($width, $height, $_POST['fps'], $_POST['dinamicita_immagine'], $numero_partecipanti_uscita*$sessioni_contemporanee);
        
        $videoBandDown=kush_gauge($width, $height, $_POST['fps'], $_POST['dinamicita_immagine'], $numero_partecipanti_entrata*$sessioni_contemporanee);
        
        /*Inserimento nel database*/
        
        $v->setUsoVideo(true)->setNumeroPartecipantiEntrata($_POST['numero_partecipanti_entrata'])->setNumeroPartecipantiUscita($_POST['numero_partecipanti_uscita'])->setRisoluzione($_POST['risoluzione'])->setDinamicitaImmagine($_POST['dinamicita_immagine'])->setFps($_POST['fps'])->setSessioniContemporanee($_POST['sessioni_contemporanee'])->setExtRid($_SESSION["rid"])->setUpBandwidth($videoBandUp)->setDownBandwidth($videoBandDown);
    } else{
        
        $v->setUsoVideo(false)->setNumeroPartecipantiEntrata(null)->setNumeroPartecipantiUscita(null)->setRisoluzione(null)->setDinamicitaImmagine(null)->setFps(null)->setSessioniContemporanee(null)->setExtRid($_SESSION["rid"])->setUpBandwidth(null)->setDownBandwidth(null);
    }
    
    $v->save();
    
    debug_to_console("BandaDownload: ".$videoBandDown."Kbps");
    debug_to_console("BandaUpload: ".$videoBandUp."Kbps");
    header("Location: security.php");
    }
$v = new Video();
$dati= $v->toArray();
if (isset($_SESSION["rid"])) {    
    $v = VideoQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!!$v) {
        $dati=$v->toArray();
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
              <h3>Unified communications</h3>
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
                    <li class="active">Unified Communications (Video-conferenza)</li>
                  </ul>
                  
              </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Description-->
                  <h2>Istruzioni</h2>
                  <p>Unified communications: i seguenti dati riguardano l'utilizzo di servizi videoconferenza quali: Skype, etc.</p>
              </div>
            </div>
        </div>

        
        <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                
                  <div class="well bs-component">
                <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']?>" method="post" onchange="handleSelect()" id="videoForm">
                <fieldset>
                  <legend>Inserimento dati</legend>
                                    
                          
                <div class="form-group">
                    <label class="col-lg-2 control-label">Utilizzo servizi di videoconferenza</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="uso_video" id="videoEnabled" value="videoEnabled" <?php echoChecked($dati["UsoVideo"],true,true) ?>>
                          Si
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="uso_video" id="videoDisabled" value="videoDisabled"  <?php echoChecked($dati["UsoVideo"],false) ?>>
                          No
                        </label>
                      </div>
                    </div>
                </div>
                  
                <div class="form-group">
                    <label for="avgVideoUsers" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Supponendo più di un partecipante per sessione di video-conferenza, definiremo come 'in entrata' quelli che utilizzano una webcam posta all'esterno della rete dell'azienda"><span class="badge">?</span></a>&nbsp;&nbsp;Numero medio di partecipanti per sessione in entrata</label>
                    <div class="col-lg-10">
                      <input type="text" value="<?php echo $dati["NumeroPartecipantiEntrata"];?>" class="form-control" id="numero_partecipanti_entrata" name="numero_partecipanti_entrata" placeholder="Inserire numero medio di partecipanti per sessione in entrata">
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="avgVideoUsers" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Supponendo più di un partecipante per sessione di video-conferenza, definiremo come 'in uscita' quelli che utilizzano una webcam posta all'interno della rete dell'azienda"><span class="badge">?</span></a>&nbsp;&nbsp;Numero medio di partecipanti per sessione in uscita</label>
                    <div class="col-lg-10">
                      <input type="text" value="<?php echo $dati["NumeroPartecipantiUscita"];?>" class="form-control" id="numero_partecipanti_uscita" name="numero_partecipanti_uscita" placeholder="Inserire numero medio di partecipanti per sessione in uscita">
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="risoluzione" class="col-lg-2 control-label">Qualità video</label>
                    <div class="col-lg-10">
                      <select multiple="" class="form-control" id="risoluzione" name="risoluzione">
                        <option value="720|480" <?php echoSelected($dati["Risoluzione"],"720|480");?>>480p SD (720x480)</option>
                        <option value="1280|720" <?php echoSelected($dati["Risoluzione"],"1280|720");?>>720p HD (1280x720)</option>
                        <option value="1920|1080" <?php echoSelected($dati["Risoluzione"],"1920|108",true);?>>1080p Full HD (1920x1080)</option>
                        <option value="3840|2160" <?php echoSelected($dati["Risoluzione"],"3840|2160");?>>4k UHD (3840x2160)</option>
                      </select>
                    </div>
                  </div>
                
                <div class="form-group">
                    <label for="dinamicita_immagine" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Se l'immagine ripresa dalla webcam è molto statica mantenersi sul profilo basso"><span class="badge">?</span></a>&nbsp;&nbsp;&nbsp;Profilo H.264</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="dinamicita_immagine" name="dinamicita_immagine">
                        <option value="1" <?php echoSelected($dati["DinamicitaImmagine"],1,true);?>>Basso</option>
                        <option value="2" <?php echoSelected($dati["DinamicitaImmagine"],2);?>>Medio</option>
                        <option value="4" <?php echoSelected($dati["DinamicitaImmagine"],4);?>>Alto</option>
                      </select>
                    </div>
                 </div>

                <div class="form-group">
                    <label for="fps" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Numero di frames per secondo (FPS) delle webcam utilizzate"><span class="badge">?</span></a>&nbsp;&nbsp;Frame rate</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="fps" name="fps">
                        <option value="25" <?php echoSelected($dati["Fps"],25);?>>25 FPS</option>
                        <option value="30" <?php echoSelected($dati["Fps"],30,true);?>>30 FPS</option>
                        <option value="60" <?php echoSelected($dati["Fps"],60);?>>60 FPS</option>
                      </select>
                    </div>
                 </div>
                    
                <div class="form-group">
                    <label for="sessioni_contemporanee" class="col-lg-2 control-label">Numero medio di sessioni contemporanee</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" value="<?php echo $dati["SessioniContemporanee"];?>" id="sessioni_contemporanee" name="sessioni_contemporanee" placeholder="Inserire numero medio di sessioni contemporanee">
                    </div>
                </div>
                    
                <?php faqLink("Hai bisogno di aiuto?");?>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-9 bottomButtons">
                      <a href="voip.php" class="btn btn-primary">Back</a>
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
        function handleSelect() {
             if (document.forms.videoForm.uso_video.value == 'videoDisabled') {
                 document.getElementById('risoluzione').disabled = true;
                 document.getElementById('numero_partecipanti_entrata').disabled = true;
                 document.getElementById('numero_partecipanti_uscita').disabled = true;
                 document.getElementById('sessioni_contemporanee').disabled = true;
                 document.getElementById('fps').disabled = true;
                 document.getElementById('dinamicita_immagine').disabled = true;
             } else {
                 document.getElementById('risoluzione').disabled = false;
                 document.getElementById('numero_partecipanti_entrata').disabled = false;
                 document.getElementById('numero_partecipanti_uscita').disabled = false;
                 document.getElementById('sessioni_contemporanee').disabled = false;
                 document.getElementById('fps').disabled = false;
                 document.getElementById('dinamicita_immagine').disabled = false;
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
