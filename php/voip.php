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

    $concurrent=1;
    $voipBand=0;
    
if (isset($_POST['invio'])){
    $v = VoipQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!$v)
        $v =new Voip();
    if($_POST['uso_voip']=="voipEnabled") {
        $vcq = new voipCodecQuery();
        $vc = $vcq->findPK($_POST["codec"]);
        
        if(!!$vc) {
            if($_POST['compressed_rtp']=="false")
                $rtp=40;
            else
                $rtp=2;

            if($_POST['l2_protocol']=="ethernet")
                $l2=18;
            else
                $l2=6;

            if (!empty($_POST['telefonate_contemporanee']))
                $concurrent=$_POST['telefonate_contemporanee'];

            $voipBand=voipBand($vc->getPayload(), $vc->getBitRate(), $rtp, $l2, $concurrent);
            
            $v->setUsoVoip(true)->setTelefonateContemporanee($concurrent)
                ->setCodec($_POST["codec"])->setCompressedRtp($_POST['compressed_rtp'])
                ->setL2Protocol($_POST["l2_protocol"])->setUpBandwidth($voipBand)->setExtRid($_SESSION["rid"])
                ->setDownBandwidth($voipBand);
            
        }
    } else {
        $v->setUsoVoip(false)->setTelefonateContemporanee($concurrent)
                ->setCodec(null)->setCompressedRtp(null)
                ->setL2Protocol(null)->setUpBandwidth(null)->setExtRid($_SESSION["rid"])
                ->setDownBandwidth(null);
    }
    $v->save();
    header("Location: video.php");
}
    debug_to_console("BandaDownload: ".$voipBand."Kbps");
    debug_to_console("BandaUpload: ".$voipBand."Kbps");
    debug_to_console($_SESSION['rid']);

/*Creo un vettore con tutti i campi vuoti*/
$v = new Voip();
$dati= $v->toArray();

if (isset($_SESSION["rid"])) {    
    $v = VoipQuery::create()->findOneByExtRid($_SESSION["rid"]);    
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
      
    <!--Font Awesome-->
    <link rel="stylesheet" href="../dist/css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        function handleSelect() {
             if (document.forms.voipForm.uso_voip.value == 'voipDisabled') {
                 //".radio-toggle").attr("disabled",true);
                 document.getElementById('telefonate_contemporanee').disabled = true;
                document.getElementById('codec').disabled = true;
                document.getElementById('compressed_rtp').disabled = true;
                document.getElementById('l2_protocol').disabled = true;                 
             } else {
                 
                document.getElementById('telefonate_contemporanee').disabled = false;
                document.getElementById('codec').disabled = false;
                document.getElementById('compressed_rtp').disabled = false;
                document.getElementById('l2_protocol').disabled = false;
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
                    <li class="active">Unified Communications (VoiP)</li>
                  </ul>
                  
              </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Description-->
                  <h2>Istruzioni</h2>
                  <p>Unified communications: i seguenti dati riguardano l'utilizzo di servizi Voice-Over-IP (VoiP).</p>
              </div>
            </div>
        </div>

        
        <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                
                  <div class="well bs-component">
              <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']?>" method="post" onchange="handleSelect()" id="voipForm">
                <fieldset>
                  <legend>Inserimento dati</legend>
                                    
                <div class="form-group">
                    <label class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Nel caso il centralino telefonico della vostra azienda (PBX, Private Branch eXchange) implementi la tecnologia ISDN allora non vi è consumo di banda alcuno da dover calcolare."><span class="badge">?</span></a>&nbsp;&nbsp;Tecnologia centralino telefonico</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="uso_voip" id="voipEnabled" value="voipEnabled" <?php echoChecked($dati["UsoVoip"],true,true) ?> />
                          VoiP
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="uso_voip" id="voipDisabled" value="voipDisabled" <?php echoChecked($dati["UsoVoip"],false) ?>>
                          ISDN
                        </label>
                      </div>
                    </div>
                </div>
                  
                <div class="form-group">
                    <label for="nTelTemp" class="col-lg-2 control-label radio-toggle">Media telefonate contemporanee</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="telefonate_contemporanee" id="telefonate_contemporanee" value="<?php echo $dati["TelefonateContemporanee"]; ?>" placeholder="Inserire il numero medio di telefonato contemporanee">
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="codec" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Tipologia di compressione dati. Valore di default: G.729"><span class="badge">?</span></a>&nbsp;&nbsp;Codec utilizzato</label>
                    <div class="col-lg-10">
                      <select multiple="" class="form-control" class="radio-toggle" id="codec" name="codec">
                        <option value="7298" <?php echoSelected($dati["Codec"],7298,true);?> >G.729 (8 Kbps)</option>
                        <option value="71164" <?php echoSelected($dati["Codec"],71164);?>>G.711 (64 Kbps)</option>
                        <option value="723163" <?php echoSelected($dati["Codec"],723163);?>>G.723.1 (6.3 Kbps)</option>
                        <option value="723153" <?php echoSelected($dati["Codec"],723153);?>>G.723.1 (5.3 Kbps)</option>
                        <option value="72632" <?php echoSelected($dati["Codec"],72632);?>>G.726 (32 Kbps)</option>
                        <option value="72624" <?php echoSelected($dati["Codec"],72624);?>>G.726 (24 Kbps)</option>
                        <option value="72816" <?php echoSelected($dati["Codec"],72816);?>>G.728 (16 Kbps)</option>
                        <option value="7226464" <?php echoSelected($dati["Codec"],7226464);?>>G722_64k (64 Kbps)</option>
                        <option value="20152" <?php echoSelected($dati["Codec"],20152);?>>ilbc_mode_20 (15.2 Kbps)</option>
                        <option value="301333" <?php echoSelected($dati["Codec"],301333);?>>ilbc_mode_30 (13.33 Kbps)</option>
                      </select>
                    </div>
                  </div>
                
                <button type="button" class="col-lg-offset-2 btn btn-primary btn-sm btn-collapse" data-toggle="collapse" data-target="#advanced">Opzioni avanzate</button>
                  <div id="advanced" class=" collapse">
                     <div class="form-group">
                    <label for="rtp" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Valore di default: protocollo RTP non compresso"><span class="badge">?</span></a>&nbsp;&nbsp;Protocollo RTP</label>
                    <div class="col-lg-10">
                      <select class="form-control radio-toggle"  id="compressed_rtp" name="compressed_rtp">
                        <option value="false" <?php echoSelected($dati["CompressedRtp"],false,true);?>>Standard</option>
                        <option value="true" <?php echoSelected($dati["CompressedRtp"],true);?>>Compressed RTP</option>
                      </select>
                    </div>
                      </div>
                      <div class="form-group">   
                    <label for="l2" class="col-lg-2 control-label"><a href="#" data-toggle="tooltip" title="Protocollo di livello 2 della pila OSI. Valore di default: Multilink Point-to-Point (MP)"><span class="badge">?</span></a>&nbsp;&nbsp;Protocollo livello 2</label>
                    <div class="col-lg-10">
                      <select class="form-control radio-toggle" id="l2_protocol" name="l2_protocol">
                        <option value="mp" <?php echoSelected($dati["L2Protocol"],"mp",true);?>>Multilink Point-to-Point (MP)</option>
                        <option value="frf" <?php echoSelected($dati["L2Protocol"],"frf");?>>Frame Relay Forum (FRF.12)</option>
                        <option value="ethernet" <?php echoSelected($dati["L2Protocol"],"ethernet");?>>Ethernet</option>
                      </select>
                    </div>
                  </div>
                  </div>
                 
                  <?php faqLink("Hai bisogno di aiuto?");?>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-9 bottomButtons">
                      <a href="generic.php" class="btn btn-primary">Back</a>
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
