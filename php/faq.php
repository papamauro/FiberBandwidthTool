<?php
    ini_set('display_errors', 1);
    session_start();
    error_reporting(E_ALL); 
    header('Content-type: text/html; charset=utf-8');
    include_once 'functions.php';

    $structure=array();

    $structure[]=array("type"=>"faq","parameters"=>array(
		"title"=>"Termini di servizio",
        "body"=>"Lo sviluppatore di questa applicazione non fornisce alcuna garanzia riguardo la validità dei dati forniti. Utilizzando questa applicazione, pertanto, si esula il suddetto da ogni responsabilità. Nell’ambito dell’attività statistica i dati sono tutelati dal segreto statistico (art. 9 d.lgs n.322/1989) e dalla normativa sulla protezione dei dati personali. I medesimi dati possono essere diffusi soltanto in forma aggregata, in modo che non se ne possa trarre alcun riferimento individuale, e possono essere utilizzati,
anche per successivi trattamenti, esclusivamente per fini statistici e per finalità di ricerca scientifica. ",
        "id"=>"privacy"));
    $structure[]=array("type"=>"faq","parameters"=>array(
		"title"=>"Pagina: Navigazione (numero dipendenti)",
        "body"=>"In questa schermata si cerca di calcolare il consumo di banda, dovuto alla navigazione web, di tutte le postazioni informatiche presenti nell'azienda. Viene quindi richiesto all'utente il numero medio (o massimo) di postazioni informatiche in utilizzo contemporaneamente durante l'orario lavorativo. Se tale valore non dovesse venire fornito, l'applicazione lo supporrà pari ad 1 per default. <hr /> L'applicazione necessita, inoltre, che l'utente inserisca il consumo di banda (espresso in Kbps) per singola postazione. In tal caso è possibile scegliere tra tre differenti stime proposte. Si consiglia di scegliere \"Medium User\" o \"Heavy User\" nel caso in cui gli impiegati utilizzino sistematicamente servizi online quali, ad esempio, gestionali su cloud. Viene anche fornita la possibilità di inserire un valore specifico nel caso in cui l'utilizzatore sia al corrente dell'esatto consumo di banda per singola postazione.",
        "id"=>"generic"));
    $structure[]=array("type"=>"faq","parameters"=>array(
		"title"=>"Pagina: Unified communications (VoIP)",
        "body"=>"Nel caso il centralino telefonico della vostra azienda (PBX, Private Branch eXchange) implementi la tecnologia ISDN allora non vi è consumo di banda alcuno da dover calcolare. Se invece viene utilizzata la tecnologia VoIP (Voice over IP), che rende possibile effettuare una conversazione telefonica sfruttando una connessione Internet, è necessario fornire il numero medio (o massimo) di possibili telefonate contemporanee. <hr /> Vengono poi richiesti ulteriori parametri quali: il codec utilizzato ( ovvero la tipologia di compressione dati), la versione del protocollo RTP (Real-time Transport Protocol) ed il protocollo di secondo livello della pila OSI. Nel caso in cui non si disponga di queste informazioni, l'applicazione utilizzerà valori di default posti rispettivamente pari a: codec G.729, protocollo RTP non compresso e protocollo di livello 2 Multilink Point-to-Point (MP)",
        "id"=>"voip"));
    $structure[]=array("type"=>"faq","parameters"=>array(
		"title"=>"Pagina: Unified communications (Video-conferenza)",
        "body"=>"In questa pagina viene innanzitutto chiesto il numero medio (o massimo) di partecipanti, in entrata ed in uscita, per singola sessione. Supponendo infatti che all'interno di una sessione di video-conferenza siano presenti più partecipanti, definiremo come \"in uscita\" quelli che utilizzano una webcam posta all'interno della rete dell'azienda e viceversa. <hr /> Viene poi chiesto di inserire la risoluzione ed i frames per second (FPS) delle webcam utilizzate. In questo caso i valori di default sono rispettivamente: risoluzione Full HD (1920x1080) e 30FPS. <hr /> L'ultimo valore che necessita di una spiegazione è il \"Profilo H.264\". Il codec H.264 utilizza algoritmi di predizione per raggiungere alti livelli di compressione. Ne consegue che la codifica H.264 fornisce bitrate più bassi, nel caso in cui l'immagine ripresa sia per lo più statica, e bitrate più elevati in caso contrario. Il \"Profilo H.264\" è quindi un indice di quanto l'immagine ripresia sia dinamica. Si consiglia di mantenersi su un profilo basso se quanto ripreso dalla webcam risulti essere molto statico.",
        "id"=>"video"));
    $structure[]=array("type"=>"faq","parameters"=>array(
		"title"=>"Pagina: Video-sorveglianza",
        "body"=>"Questa pagina vuole calcolare il consumo di banda dovuto all'implementazione di un servizio di video sorveglianza. E' bene quindi distingere sin da subito le diverse possibilità di progettazione di questi sistemi per poter comprendere i dati richiesti dall'interfaccia dell'applicazione: <ul><li><strong>Caso A:</strong> Le telecamere e la stazione di visualizzazione risultano essere collegate alla LAN dell'azienda ma il Media Server è posto esternamente a quest'ultima. In questo caso avremo sia una banda in upload, dovuta al trasferimento delle immagini dalle telecamere sino al Media Server esterno, che un banda in download, necessaria per scaricare e visualizzare le riprese di alcune telecamere dal Media Server sino alla stazione di visualizzazione.</li><li><strong>Caso B:</strong> Le telecamere, la stazione di visualizzazione ed il Media Server risultano tutti collegati alla LAN dell'azienda. Si potrebbe quindi supporre che non possa esserci alcun consumo di banda. E' tuttavia necessario contemplare la possibilità che venga consentita la visualizzazione di quanto salvato sul Media Server ad utenti esterni all'azienda. Questa funzionalità di accesso remoto si traduce nel calcolo di una banda in upload necessaria al Media Server per l'invio delle immagini alla stazione di visualizzazione esterna.</li></ul><hr />Viene poi chiesto di inserire la risoluzione ed i frames per second (FPS) delle telecamere utilizzate. In questo caso i valori di default sono rispettivamente: risoluzione HDTV (1920x1080) e 25FPS. <hr /> Il codec H.264 utilizza algoritmi di predizione per raggiungere alti livelli di compressione. Ne consegue che la codifica H.264 fornisce bitrate più bassi, nel caso in cui l'immagine ripresa sia per lo più statica, e bitrate più elevati in caso contrario. Il \"Profilo H.264\" è quindi un indice di quanto l'immagine ripresa sia dinamica. Si consiglia di mantenersi su un profilo basso se quanto ripresO dalle telecamere risulti essere molto statico.<hr /> Sul numero totale di telecamere che si vuole visualizzare, solo una, in genere, viene mostrata a risoluzione piena, mentre le altre vengono ridotte in miniature. Per questo motivo viene richiesto di specificare la risoluzione di queste ultime (valore di default: VGA 640x480).",
        "id"=>"security"));
    $structure[]=array("type"=>"faq","parameters"=>array(
		"title"=>"Pagina: Accesso remoto",
        "body"=>"In questa pagina viene calcolata la banda in download dovuta a funzionalità di accesso remoto verso server posti esternamente all'azienda. Il primo dato richiesto riguarda quale software di accesso remoto viene utilizzato. Tale scelta si divide tra: Windows RDP v6+, Citrix XenApp HDX od altri. Nei primi due casi l'applicazione utilizzera dati stimati, in termini di Kbps, suddivisi per tipologia di utilizzo. Nel terzo caso, invece, verrà chiesto all'utente di inserire il consumo di banda del software utilizzato.<br />
        <strong>Nota:</strong> In caso venga utilizzato il servizio Citrix XenApp, è possibile indicare la presenza di dispositivi Citrix Branch Repeaters installati nell'azienda, i quali comportano una drastica riduzione del bitrate necessario.<hr /> Come già anticipato, funzionalità di accesso remoto determinano un consumo diverso a seconda del tipo di utilizzo che ne viene fatto (ufficio, internet, stampa di documenti, streaming ecc.), per questo motivo l'utente ha la possibilità di disattivare i tipi di utilizzo che non incorrono mai durante una propria sessione di accesso.",
        "id"=>"remote"));
    $structure[]=array("type"=>"faq","parameters"=>array(
		"title"=>"Pagina: Web server",
        "body"=>"Questa pagina vuole calcolare il consumo di banda in upload dovuto all'implementazione di un web server interno all'azienda. I dati richiesti in questo caso sono: la dimensione media (o massima) delle pagine web, il tempo medio di caricamento di una pagina ed il numero medio (o massimo) di visitatori contemporanei. Nel caso non si posseggano questi dati, l'applicazione fornisce delle medie statistiche estratte dal servizio di web monitoring Pingdom.com, tuttavia, si consiglia di registrarsi a <a href=\"https://www.google.com/analytics/\"target=\"_blank\"><img src=\"../images/google.png\" alt=\"Google Analytics\" style=\"width:180px; padding:10px;\"></a> per ottenere dati inerenti al proprio sito web implementato sul web server aziendale.",
        "id"=>"web"));
    $structure[]=array("type"=>"faq","parameters"=>array(
		"title"=>"Pagina: Mail server",
        "body"=>"Questa pagina è relativa al consumo di banda dovuto all'implementazione di un mail server interno all'azienda. Tra i campi richiesti troviamo: il numero di caselle di posta, il numero medio di email giornaliere ricevute ed inviate per mailbox, la dimensione media per singola mail. Per tali campi sono impostati valori statistici di default pari, rispettivamente, a: 100 caselle di posta, 88 mail in entrata per mailbox, 34 mail in uscita per mailbox, 100KB per singola mail. Vengono poi richiesti i ritardi in consegna ed in ricezione delle mail.E' bene specificare che per 'Ritardo di consegna' si intende l'intervallo temporale entro il quale deve completarsi l'invio delle mail in uscita. Analogo discorso per il 'Ritardo di ricezione'. ",
        "id"=>"mail"));
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
    /*Apre la faq richiesta tramite variabile get*/
    window.onload = function() {
          document.getElementById('<?php echo $_GET['anchor']?>').click()
      };
          </script>
    </head>


  <body>

    <?php echo_navbar(); ?>

    <div class="container">
    <br />
    <br />
    <br />
    <?php echo_alert("Benvenuto nella sezione delle Frequently Asked Questions", 1, "alert-success"); ?>

    <br />

    <div class="panel-group" id="accordion">
        <div class="faqHeader">Frequently Asked Questions</div>
        
        <?php write_section($structure); ?>

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
