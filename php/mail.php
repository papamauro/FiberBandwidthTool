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



    
if (isset($_POST['invio'])){
    
    $m = MailQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!$m)
        $m = new Mail();
    
    if ($_POST["internal_mail_server"] == 1) {
        $m->setInternalMailServer(true);
        $m->setMailCount($_POST["mail_count"]);
        $m->setSendMailLatency($_POST["send_mail_latency"]);
        $m->setReceiveMailLatency($_POST["receive_mail_latency"]);
        $m->setAverageReceivedMail($_POST["average_received_mail"]);
        $m->setAverageSendedMail($_POST["average_sended_mail"]);
        $m->setMailSize($_POST["mail_size"]);
        
        $daily_outbound_traffic = $_POST["mail_count"]*$_POST["mail_size"]*$_POST["average_sended_mail"];
		$daily_inbound_traffic = $_POST["mail_count"]*$_POST["mail_size"]*$_POST["average_received_mail"];
		$upload_bandwidth=$daily_outbound_traffic/($_POST["send_mail_latency"]*3600);
		$download_bandwidth=$daily_inbound_traffic/($_POST["receive_mail_latency"]*3600);
        
        
        $m->setUpBandwidth($upload_bandwidth*8);
        $m->setDownBandwidth($download_bandwidth*8);
        
        debug_to_console("BandaUpload: ".($upload_bandwidth*8)."Kbps");
        debug_to_console("BandaDownload: ".($download_bandwidth*8)."Kbps");
    } else {
        $m->setInternalMailServer(false);
        $m->setMailCount(null);
        $m->setSendMailLatency(null);
        $m->setReceiveMailLatency(null);
        $m->setAverageReceivedMail(null);
        $m->setAverageSendedMail(null);
        $m->setMailSize(null);
        $m->setUpBandwidth(null);
        $m->setDownBandwidth(null);
    }
    $m->setExtRid($_SESSION["rid"]);
    $m->save();
   // http://www.radicati.com/wp/wp-content/uploads/2015/02/Email-Statistics-Report-2015-2019-Executive-Summary.pdf
    
    if (strcmp($_SESSION["band_type"],"avg") == 0)
	   header("Location: average.php");
    else
       header("Location: end.php");
}

/*Creo un vettore con tutti i campi vuoti*/
$m = new Mail();
$dati= $m->toArray();
debug_to_console($dati);

if (isset($_SESSION["rid"])) {    
    $m = MailQuery::create()->findOneByExtRid($_SESSION["rid"]);    
    if (!!$m) {
        $dati=$m->toArray();
    }
}
debug_to_console( "eccomi".$dati["MailId"]);

$structure=array();
$group_advanced=array();

/*Array $group_advanced utilizzato come "parametro" del tipo gruppo riferito alle opzioni avanzate*/
$group_advanced[]=array("type"=>"text","parameters"=>array(
    "name"=>"average_received_mail",
    "class"=>"comp-toggle",        
    "default_value"=>empty($dati["AverageReceivedMail"])? 88: $dati["AverageReceivedMail"],
    "label"=>"Numero medio di email giornaliere ricevute per mailbox",
    "placeholder"=>"Numero medio di email ricevute"));
$group_advanced[]=array("type"=>"text","parameters"=>array(
    "name"=>"average_sended_mail",
    "class"=>"comp-toggle",        
    "default_value"=>empty($dati["AverageSendedMail"])? 34 : $dati["AverageSendedMail"],
    "label"=>"Numero medio di email giornaliere inviate per mailbox",
    "placeholder"=>"Numero medio di email inviate"));
$group_advanced[]=array("type"=>"text","parameters"=>array(
    "name"=>"mail_size",
    "class"=>"comp-toggle",
    "default_value"=>empty($dati["MailSize"])? 100 : $dati["MailSize"],
    "label"=>"Dimensione media di ciascuna email (kB)",
    "placeholder"=>"Dimensione media email"));

/*Nell'array structure ci sono i normali input field ognuno con i suoi parametri*/
$structure[]=array("type"=>"radio",
                         "parameters"=>array("name"=>"internal_mail_server",
                                                    "label"=>"Si possiede un server di posta interno?",
                                                    "items"=>array(                                                        array("value"=>1,"label"=>"Si","enable"=>".comp-toggle","default"=>(empty($dati["InternalMailServer"]) && empty($dati["MailId"])) || $dati["InternalMailServer"]==1 ? true : false),
                                                        array("value"=>0,"label"=>"No","disable"=>".comp-toggle","default"=>(empty($dati["InternalMailServer"]) && empty($dati["MailId"])) || $dati["InternalMailServer"]==1 ? false : true)
                                                    )));

$structure[]=array("type"=>"text","parameters"=>array(
    "name"=>"mail_count",
    "class"=>"comp-toggle",        
    "label"=>"Numero di caselle di posta",
    "default_value"=>empty($dati["MailCount"])? 100 : $dati["MailCount"],
    "placeholder"=>"Inserire il numero di caselle di posta"));

$structure[]=array("type"=>"slider",
                         "parameters"=>array("name"=>"send_mail_latency",
                                                    "class"=>"comp-toggle",
                                                    "label"=>"<a href=\"#\" data-toggle=\"tooltip\" title=\"Intervallo temporale entro il quale deve completarsi l'invio delle mail in uscita\"><span class=\"badge\">?</span></a>&nbsp;&nbsp;Ritardo massimo di consegna: <span id=\"send_mail_latency_label\">6</span> ore",
                                                    "min_value"=>1,
                                                    "max_value"=>24,
                                                    "default"=>empty($dati["SendMailLatency"])? 6 : $dati["SendMailLatency"],
                                                    "step"=>1));
$structure[]=array("type"=>"slider",
                         "parameters"=>array("name"=>"receive_mail_latency",
                                                    "class"=>"comp-toggle",
                                                    "label"=>"<a href=\"#\" data-toggle=\"tooltip\" title=\"Intervallo temporale entro il quale deve completarsi la ricezione delle mail in entrata\"><span class=\"badge\">?</span></a>&nbsp;&nbsp;Ritardo massimo di ricezione: <span id=\"receive_mail_latency_label\">6</span> ore",
                                                    "min_value"=>1,
                                                    "max_value"=>24,
                                                    "default"=>empty($dati["ReceiveMailLatency"])? 6 : $dati["ReceiveMailLatency"],
                                                    "step"=>1));
$structure[]=array("type"=>"button",
                         "parameters"=>array("name"=>"collapse_advanced",
                                                    "label"=>"Opzioni avanzate",
                                                    "button_type"=>"button",
                                                    "collapse"=>"#advanced",
                                                    "size"=>"small",
                                                    "class"=>"col-lg-offset-2 btn-primary"));
$structure[]=array("type"=>"group","parameters"=>array("name"=>"advanced","class"=>"collapse"),"controls"=>$group_advanced);
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
    <link href="../dist/css/bootstrap-slider.min.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>
    <script src="../assets/js/vendor/jquery.min.js"></script>
    <!--Font Awesome-->
    <link rel="stylesheet" href="../dist/css/font-awesome.min.css">
    

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
              <h3>Mail Server</h3>
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
                    <li><a href="web.php">Web server</a></li> 
                    <li class="active">Mail server</li>
                  </ul>
                  
              </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <!--Description-->
                  <h2>Istruzioni</h2>
                  <p>Questa pagina ha lo scopo di calcolare il consumo di banda dovuto all'implentazione di un mail server interno.</p>
              </div>
            </div>
        </div>

        
        <div class="row">
          <div class="col-lg-12">
              <div class="bs-component">
                
                  <div class="well bs-component">
              <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']?>" method="post"  id="mailForm">
                <fieldset>
                  <legend>Inserimento dati</legend>                                                   
               <!-- <button type="button" class="col-lg-offset-2 btn btn-primary btn-sm btn-collapse" data-toggle="collapse" data-target="#advanced">Opzioni avanzate</button> -->
						 <?php 
							write_section($structure);
						  ?>
				 
                  
                <?php faqLink("Hai bisogno di aiuto?");?>         
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-9 bottomButtons">
                        <a href="web.php" class="btn btn-primary">Back</a>
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="invio">Next</button>
                      <!--<a href="#" class="btn btn-success">Next</a>-->
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
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/bootstrap-slider.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script>
        $( document ).ready(function() {
			  //Enable or disable all boxes

			  
		  //Update the label with the slide value
			$("#send_mail_latency").on("slide", function(slideEvt) {
				 $("#send_mail_latency_label").text(slideEvt.value);
			});
            
            //Update the label with the slide value
			$("#receive_mail_latency").on("slide", function(slideEvt) {
				 $("#receive_mail_latency_label").text(slideEvt.value);
			});
        });
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
