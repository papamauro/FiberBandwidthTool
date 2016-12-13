<?php
    ini_set('display_errors', 1);
    session_start();
    error_reporting(E_ALL); 
    header('Content-type: text/html; charset=utf-8');
    include_once 'functions.php';
    include_once '../lib/autoload.php';
    require_once '../generated-conf/config.php';
    /*Controllo che l'utente sia loggato*/

    //Generic count
    $classes = [[0,10],[11,50],[51,100],[101,1000],[1001]];
    $average = [];
    $ndip_sum=0;

    foreach($classes as $i=>$class) {
        
        $filter=["min"=>$class[0]];
        
        if (isset($class[1]))
            $filter["max"]=$class[1];
        
        $gc = GenericQuery::create()->filterByNumeroPostazioni($filter)->count();
        $gs = GenericQuery::create()->filterByNumeroPostazioni($filter)
        ->withColumn('SUM(up_bandwidth)')->withColumn('SUM(down_bandwidth)')->findOne()->toArray();
        $average[$i]=["up"=>0,"down"=>0,"count"=>0,"percentage"=>0];
        if  ($gc != 0)
            $average[$i]=["percentage"=>$gc,"count"=>$gc,"up"=>($gs["SUMup_bandwidth"]/$gc),"down"=>($gs["SUMdown_bandwidth"]/$gc)];
        $ndip_sum += $gc;
    }

    foreach($average as $i=>$d) {
        $average[$i]["percentage"]=$d["count"]/$ndip_sum*100;
    }

    $ndip_piechart = array_column($average,"percentage");
    $ndip_piechart =json_encode($ndip_piechart);
    $ndip_up = json_encode(array_column($average,"up"));
    $ndip_down = json_encode(array_column($average,"down"));


    //VoIP Count
    $classes = [[0,5],[6,25],[26,60],[61,100],[101]];
    $average = [];
    $voip_sum=0;

    $vy = VoipQuery::create()->filterByUsoVoip('1')->count();
    $vn = VoipQuery::create()->filterByUsoVoip(null)->count();

    if(!$vn)
        $vn = VoipQuery::create()->filterByUsoVoip('0')->count();
    
    $voip_percentage[0]=$vy*100/($vy+$vn);
    $voip_percentage[1]=$vn*100/($vy+$vn);

    debug_to_console($vy);
    debug_to_console($vn);

    foreach($classes as $i=>$class) {
                
        $filter=["min"=>$class[0]];
        
        if (isset($class[1]))
            $filter["max"]=$class[1];
        
        $vc = VoipQuery::create()->filterByTelefonateContemporanee($filter)->count();
        $vs = VoipQuery::create()->filterByTelefonateContemporanee($filter)
        ->withColumn('SUM(up_bandwidth)')->withColumn('SUM(down_bandwidth)')->findOne()->toArray();
        $average[$i]=["up"=>0,"down"=>0,"count"=>0,"percentage"=>0];
        if  ($vc != 0)
            $average[$i]=["percentage"=>$vc,"count"=>$vc,"up"=>($vs["SUMup_bandwidth"]/$vc),"down"=>($vs["SUMdown_bandwidth"]/$vc)];
        $voip_sum += $vc;
    }

    foreach($average as $i=>$d) {
        $average[$i]["percentage"]=$d["count"]/$voip_sum*100;
    }

    $voip_piechart = array_column($average,"percentage");
    $voip_piechart =json_encode($voip_piechart);
    $voip_up = json_encode(array_column($average,"up"));
    $voip_down = json_encode(array_column($average,"down"));
    $voip_percentage = json_encode($voip_percentage);

//video Count
    $classes = [[0,5],[6,10],[11,20],[21,30],[31]];
    $average = [];
    $video_sum=0;

    $vy = VideoQuery::create()->filterByUsoVideo('1')->count();
    $vn = VideoQuery::create()->filterByUsoVideo(null)->count();
    if(!$vn)
        $vn = VideoQuery::create()->filterByUsoVideo('0')->count();
    
    $video_percentage[0]=$vy*100/($vy+$vn);
    $video_percentage[1]=$vn*100/($vy+$vn);

    debug_to_console($vy);
    debug_to_console($vn);

    foreach($classes as $i=>$class) {
                
        $filter=["min"=>$class[0]];
        
        if (isset($class[1]))
            $filter["max"]=$class[1];
        
        $vc = VideoQuery::create()->filterBySessioniContemporanee($filter)->count();
        $vs = VideoQuery::create()->filterBySessioniContemporanee($filter)
        ->withColumn('SUM(up_bandwidth)')->withColumn('SUM(down_bandwidth)')->findOne()->toArray();
        $average[$i]=["up"=>0,"down"=>0,"count"=>0,"percentage"=>0];
        if  ($vc != 0)
            $average[$i]=["percentage"=>$vc,"count"=>$vc,"up"=>($vs["SUMup_bandwidth"]/$vc),"down"=>($vs["SUMdown_bandwidth"]/$vc)];
        $video_sum += $vc;
    }

    foreach($average as $i=>$d) {
        $average[$i]["percentage"]=$d["count"]/$video_sum*100;
    }

    $video_piechart = array_column($average,"percentage");
    $video_piechart =json_encode($video_piechart);
    $video_up = json_encode(array_column($average,"up"));
    $video_down = json_encode(array_column($average,"down"));
    $video_percentage = json_encode($video_percentage);

//Security Count
    $classes = [[0,5],[6,20],[21,50],[51,100],[101]];
    $average = [];
    $security_sum=0;

    $sy = SecurityQuery::create()->filterByUseSecurity('1')->count();
    $sn = SecurityQuery::create()->filterByUseSecurity(null)->count();
    if(!$sn)
        $sn = securityQuery::create()->filterByUseSecurity('0')->count();
    
    $security_percentage[0]=$sy*100/($sy+$sn);
    $security_percentage[1]=$sn*100/($sy+$sn);

    foreach($classes as $i=>$class) {
                
        $filter=["min"=>$class[0]];
        
        if (isset($class[1]))
            $filter["max"]=$class[1];
        
        $sc = securityQuery::create()->filterByNumberCameraViewed($filter)->count();
        $ss = securityQuery::create()->filterByNumberCameraViewed($filter)
        ->withColumn('SUM(up_bandwidth)')->withColumn('SUM(down_bandwidth)')->findOne()->toArray();
        $average[$i]=["up"=>0,"down"=>0,"count"=>0,"percentage"=>0];
        if  ($sc != 0)
            $average[$i]=["percentage"=>$sc,"count"=>$sc,"up"=>($ss["SUMup_bandwidth"]/$sc),"down"=>($ss["SUMdown_bandwidth"]/$sc)];
        $security_sum += $sc;
    }

    foreach($average as $i=>$d) {
        $average[$i]["percentage"]=$d["count"]/$security_sum*100;
    }

    $security_piechart = array_column($average,"percentage");
    $security_piechart =json_encode($security_piechart);
    $security_up = json_encode(array_column($average,"up"));
    $security_down = json_encode(array_column($average,"down"));
    $security_percentage = json_encode($security_percentage);

//Remote Count
    $classes = [[0,10],[11,20],[21,50],[51,70],[71]];
    $average = [];
    $remote_sum=0;

    $ry = RemoteQuery::create()->filterByRemoteUsed('1')->count();
    $rn = RemoteQuery::create()->filterByRemoteUsed(null)->count();
    if(!$rn)
        $rn = RemoteQuery::create()->filterByRemoteUsed('0')->count();
    
    $remote_percentage[0]=$ry*100/($ry+$rn);
    $remote_percentage[1]=$rn*100/($ry+$rn);

    foreach($classes as $i=>$class) {
                
        $filter=["min"=>$class[0]];
        
        if (isset($class[1]))
            $filter["max"]=$class[1];
        
        $rc = RemoteQuery::create()->filterByConcurrentAccess($filter)->count();
        $rs = RemoteQuery::create()->filterByConcurrentAccess($filter)
        ->withColumn('SUM(up_bandwidth)')->withColumn('SUM(down_bandwidth)')->findOne()->toArray();
        $average[$i]=["up"=>0,"down"=>0,"count"=>0,"percentage"=>0];
        if  ($rc != 0)
            $average[$i]=["percentage"=>$rc,"count"=>$rc,"up"=>($rs["SUMup_bandwidth"]/$rc),"down"=>($rs["SUMdown_bandwidth"]/$rc)];
        $remote_sum += $rc;
    }

    foreach($average as $i=>$d) {
        $average[$i]["percentage"]=$d["count"]/$remote_sum*100;
    }

    $remote_piechart = array_column($average,"percentage");
    $remote_piechart =json_encode($remote_piechart);
    $remote_up = json_encode(array_column($average,"up"));
    $remote_down = json_encode(array_column($average,"down"));
    $remote_percentage = json_encode($remote_percentage);

//web Count
    $classes = [[0,5],[6,15],[16,50],[51,100],[101]];
    $average = [];
    $web_sum=0;

    $wy = WebQuery::create()->filterByInternalWebServer('1')->count();
    $wn = webQuery::create()->filterByInternalWebServer(null)->count();
    if(!$wn)
        $wn = webQuery::create()->filterByInternalWebServer('0')->count();
    
    $web_percentage[0]=$wy*100/($wy+$wn);
    $web_percentage[1]=$wn*100/($wy+$wn);

    foreach($classes as $i=>$class) {
                
        $filter=["min"=>$class[0]];
        
        if (isset($class[1]))
            $filter["max"]=$class[1];
        
        $wc = WebQuery::create()->filterByConcorrentRequests($filter)->count();
        $ws = WebQuery::create()->filterByConcorrentRequests($filter)
        ->withColumn('SUM(up_bandwidth)')->withColumn('SUM(down_bandwidth)')->findOne()->toArray();
        $average[$i]=["up"=>0,"down"=>0,"count"=>0,"percentage"=>0];
        if  ($wc != 0)
            $average[$i]=["percentage"=>$wc,"count"=>$wc,"up"=>($ws["SUMup_bandwidth"]/$wc),"down"=>($ws["SUMdown_bandwidth"]/$wc)];
        $web_sum += $wc;
    }

    foreach($average as $i=>$d) {
        $average[$i]["percentage"]=$d["count"]/$web_sum*100;
    }

    $web_piechart = array_column($average,"percentage");
    $web_piechart =json_encode($web_piechart);
    $web_up = json_encode(array_column($average,"up"));
    $web_down = json_encode(array_column($average,"down"));
    $web_percentage = json_encode($web_percentage);

//mail Count
    $classes = [[0,15],[16,30],[31,50],[51,100],[101]];
    $average = [];
    $mail_sum=0;

    $my = MailQuery::create()->filterByInternalMailServer('1')->count();
    $mn = MailQuery::create()->filterByInternalMailServer(null)->count();
    if(!$mn)
        $mn = MailQuery::create()->filterByInternalmailServer('0')->count();
    
    $mail_percentage[0]=$my*100/($my+$mn);
    $mail_percentage[1]=$mn*100/($my+$mn);

    foreach($classes as $i=>$class) {
                
        $filter=["min"=>$class[0]];
        
        if (isset($class[1]))
            $filter["max"]=$class[1];
        
        $mc = MailQuery::create()->filterByMailCount($filter)->count();
        $ms = MailQuery::create()->filterByMailCount($filter)
        ->withColumn('SUM(up_bandwidth)')->withColumn('SUM(down_bandwidth)')->findOne()->toArray();
        $average[$i]=["up"=>0,"down"=>0,"count"=>0,"percentage"=>0];
        if  ($mc != 0)
            $average[$i]=["percentage"=>$mc,"count"=>$mc,"up"=>($ms["SUMup_bandwidth"]/$mc),"down"=>($ms["SUMdown_bandwidth"]/$mc)];
        $mail_sum += $mc;
    }

    foreach($average as $i=>$d) {
        $average[$i]["percentage"]=$d["count"]/$mail_sum*100;
    }

    $mail_piechart = array_column($average,"percentage");
    $mail_piechart =json_encode($mail_piechart);
    $mail_up = json_encode(array_column($average,"up"));
    $mail_down = json_encode(array_column($average,"down"));
    $mail_percentage = json_encode($mail_percentage);
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
                  <h2>Report statistici</h2>
                  <p>Di seguito vengono mostrate i report statistici si ogni singolo servizio, suddiviso per classe di interesse.</p>
              </div>
            </div>
        </div>


        <div class="row">
          <div class="col-lg-12">
              <div class="bs-component" >
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#generic" data-toggle="tab">Navigazione Web</a></li>
                  <li><a href="#voip" data-toggle="tab">VoIP</a></li>
                  <li><a href="#video" data-toggle="tab">Video-conferenza</a></li>
                  <li><a href="#security" data-toggle="tab">Video-sorveglianza</a></li>
                  <li><a href="#remote" data-toggle="tab">Accesso remoto</a></li>
                  <li><a href="#web" data-toggle="tab">Web Server</a></li>
                  <li><a href="#mail" data-toggle="tab">Mail Server</a></li>
                </ul>
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade active in" id="generic">
            <div id="profileWell" class="well bs-component">
                  <h2 style="text-align:center">Statistiche navigazione web</h2>
                  <div class="col-lg-4 col-lg-offset-1">
                      <canvas id="ndip-piechart" width="50" height="50"></canvas>                      
                     <div style="text-align:center"> Percentuali numero dipendenti per ordine di grandezza</div>
                  </div>
                  <div class="col-lg-4 col-lg-offset-1">                      
                      <canvas id="ndip-barchart" width="50" height="50"></canvas>                      
                      <div style="text-align:center"> Banda media in upload e download</div>
                  </div> 
                      <hr style="clear:both;visibility:hidden"/>
            </div>
          </div>
          <div class="tab-pane fade" id="voip">
                <div id="profileWell" class="well bs-component">
                  <h2 style="text-align:center">Statistiche VoIP</h2>
                      <div class="col-lg-4">
                          <canvas id="voip-usochart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali implementazione servizio</div>
                      </div>    
                      <div class="col-lg-4">
                          <canvas id="voip-piechart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali telefonate contemporanee per ordine di grandezza</div>
                      </div>
                      <div class="col-lg-4">                      
                          <canvas id="voip-barchart" width="50" height="50"></canvas>                      
                          <div style="text-align:center"> Banda media in upload e download</div>
                      </div> 
                        <hr style="clear:both;visibility:hidden"/>
                    </div>

          </div>
          <div class="tab-pane fade" id="video">
                <div id="profileWell" class="well bs-component">
                  <h2 style="text-align:center">Statistiche Video-conferenze</h2>
                      <div class="col-lg-4">
                          <canvas id="video-usochart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali implementazione servizio</div>
                      </div>    
                      <div class="col-lg-4">
                          <canvas id="video-piechart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali sessioni contemporanee per ordine di grandezza</div>
                      </div>
                      <div class="col-lg-4">                      
                          <canvas id="video-barchart" width="50" height="50"></canvas>                      
                          <div style="text-align:center"> Banda media in upload e download</div>
                      </div> 
                        <hr style="clear:both;visibility:hidden"/>
                    </div>

          </div>
          <div class="tab-pane fade" id="security">
                <div id="profileWell" class="well bs-component">
                  <h2 style="text-align:center">Statistiche Video-sorveglianza</h2>
                      <div class="col-lg-4">
                          <canvas id="security-usochart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali implementazione servizio</div>
                      </div>    
                      <div class="col-lg-4">
                          <canvas id="security-piechart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali numero telecamere visualizzate per ordine di grandezza</div>
                      </div>
                      <div class="col-lg-4">                      
                          <canvas id="security-barchart" width="50" height="50"></canvas>                      
                          <div style="text-align:center"> Banda media in upload e download</div>
                      </div> 
                        <hr style="clear:both;visibility:hidden"/>
                    </div>

          </div>
            <div class="tab-pane fade" id="remote">
                <div id="profileWell" class="well bs-component">
                  <h2 style="text-align:center">Statistiche Accesso Remoto</h2>
                      <div class="col-lg-4">
                          <canvas id="remote-usochart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali implementazione servizio</div>
                      </div>    
                      <div class="col-lg-4">
                          <canvas id="remote-piechart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali sessioni contemporanee per ordine di grandezza</div>
                      </div>
                      <div class="col-lg-4">                      
                          <canvas id="remote-barchart" width="50" height="50"></canvas>                      
                          <div style="text-align:center"> Banda media in upload e download</div>
                      </div> 
                        <hr style="clear:both;visibility:hidden"/>
                    </div>

          </div>

          <div class="tab-pane fade" id="web">
              <div id="profileWell" class="well bs-component">
                  <h2 style="text-align:center">Statistiche Web Server Interno</h2>
                      <div class="col-lg-4">
                          <canvas id="web-usochart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali implementazione servizio</div>
                      </div>    
                      <div class="col-lg-4">
                          <canvas id="web-piechart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali accessi contemporanei per ordine di grandezza</div>
                      </div>
                      <div class="col-lg-4">                      
                          <canvas id="web-barchart" width="50" height="50"></canvas>                      
                          <div style="text-align:center"> Banda media in upload e download</div>
                      </div> 
                        <hr style="clear:both;visibility:hidden"/>
                    </div>
          </div>
          <div class="tab-pane fade" id="mail">
                <div id="profileWell" class="well bs-component">
                  <h2 style="text-align:center">Statistiche Mail Server Interno</h2>
                      <div class="col-lg-4">
                          <canvas id="mail-usochart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali implementazione servizio</div>
                      </div>    
                      <div class="col-lg-4">
                          <canvas id="mail-piechart" width="50" height="50"></canvas>                      
                         <div style="text-align:center"> Percentuali caselle di posta per ordine di grandezza</div>
                      </div>
                      <div class="col-lg-4">                      
                          <canvas id="mail-barchart" width="50" height="50"></canvas>                      
                          <div style="text-align:center"> Banda media in upload e download</div>
                      </div> 
                        <hr style="clear:both;visibility:hidden"/>
                    </div>
          </div>
        </div>
                  
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
    <script src="../dist/js/Chart.bundle.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
      <script>
          $(document).ready(function() {
              //generating charts              
              var ndip_piechart = new Chart( $("#ndip-piechart"), {
                type: 'doughnut',
                data: {
                    labels: [
                        "0-10",
                        "10-50",
                        "50-100",
                        "100-1000",
                        "1000+"
                    ],
                    datasets: [
                        {
                            data:<?php echo $ndip_piechart;?>,
                            backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"
                            ],
                            hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                               "#204469",
                                "#71d995"
                            ]
                        }]
                },
                options:{
                  legend:{
                      position:'bottom'
                  }
              }
            }); 
              
                var ndip_barchart = new Chart( $("#ndip-barchart"), {
                type: 'bar',
                data: {
                    labels: [
                        "0-10",
                        "10-50",
                        "50-100",
                        "100-1000",
                        "1000+"
                    ],
                    datasets: [
                        {
                            label:"Up",
                            data:<?php echo $ndip_up;?>,
                            backgroundColor: "#FF6384",
                            hoverBackgroundColor: "#FF6384" 
                        },{
                            label:"Down",
                            data:<?php echo $ndip_down;?>,
                            backgroundColor: "#FFCE56",
                            hoverBackgroundColor:  "#FFCE56"
                        }]
                },
                options: {
                scales: {
                    yAxes: [{
                        type: 'logarithmic'
                    }]
                }
    }
            });  
              
/*VoIP*/
              
$('a[href="#voip"]').on('shown.bs.tab', function (e) {
    console.log($(e.target).text());
    if (!$("#voip-usochart").data('draw')) {
        var voip_pie = new Chart( $("#voip-usochart"), {
            type: 'pie',
            data: {
                labels: [
                    "Utilizzato",
                    "Non utilizzato"],
                datasets: [{
                    data:<?php echo $voip_percentage;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#FFCE56"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#FFCE56"]}]},
            options:{
                  legend:{
                      position:'bottom'}}}); 
        $("#voip-usochart").data('draw', true);
    }
    
    if (!$("#voip-piechart").data('draw')) {
        var voip_piechart = new Chart( $("#voip-piechart"), {
            type: 'doughnut',
            data: {
                labels: [
                        "0-5",
                        "5-25",
                        "25-60",
                        "60-100",
                        "100+"],
                datasets: [{
                    data:<?php echo $voip_piechart;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"]}]},
                options:{
                    legend:{
                      position:'bottom'}}}); 
        $("#voip-piechart").data('draw', true);
    }
              
    if (!$("#voip-barchart").data('draw')) {
        var voip_barchart = new Chart( $("#voip-barchart"), {
            type: 'bar',
            data: {
                labels: [
                        "0-10",
                        "10-50",
                        "50-100",
                        "100-1000",
                        "1000+"],
                datasets: [{
                    label:"Up",
                    data:<?php echo $voip_up;?>,
                            backgroundColor: "#FF6384",
                            hoverBackgroundColor: "#FF6384"},{
                    label:"Down",
                    data:<?php echo $voip_down;?>,
                            backgroundColor: "#FFCE56",
                            hoverBackgroundColor: "#FFCE56"}]},
                options: {
                    scales: {
                        yAxes: [{
                            type: 'logarithmic'}]}}});
        
        $("#voip-barchart").data('draw', true);
    }
});

/*Video*/
              
$('a[href="#video"]').on('shown.bs.tab', function (e) {
    console.log($(e.target).text());
    if (!$("#video-usochart").data('draw')) {
        var video_pie = new Chart( $("#video-usochart"), {
            type: 'pie',
            data: {
                labels: [
                    "Utilizzato",
                    "Non utilizzato"],
                datasets: [{
                    data:<?php echo $video_percentage;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#FFCE56"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#FFCE56"]}]},
            options:{
                  legend:{
                      position:'bottom'}}}); 
        $("#video-usochart").data('draw', true);
    }
    
    if (!$("#video-piechart").data('draw')) {
        var video_piechart = new Chart( $("#video-piechart"), {
            type: 'doughnut',
            data: {
                labels: [
                        "0-5",
                        "5-10",
                        "10-20",
                        "20-30",
                        "30+"],
                datasets: [{
                    data:<?php echo $video_piechart;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"]}]},
                options:{
                    legend:{
                      position:'bottom'}}}); 
        $("#video-piechart").data('draw', true);
    }
              
    if (!$("#video-barchart").data('draw')) {
        var video_barchart = new Chart( $("#video-barchart"), {
            type: 'bar',
            data: {
                labels: [
                        "0-5",
                        "5-10",
                        "10-20",
                        "20-30",
                        "30+"],
                datasets: [{
                    label:"Up",
                    data:<?php echo $video_up;?>,
                            backgroundColor: "#FF6384",
                            hoverBackgroundColor: "#FF6384"},{
                    label:"Down",
                    data:<?php echo $video_down;?>,
                            backgroundColor: "#FFCE56",
                            hoverBackgroundColor: "#FFCE56"}]},
                options: {
                    scales: {
                        yAxes: [{
                            type: 'logarithmic'}]}}});
        
        $("#video-barchart").data('draw', true);
    }
});
              
/*Security*/
              
$('a[href="#security"]').on('shown.bs.tab', function (e) {
    console.log($(e.target).text());
    if (!$("#security-usochart").data('draw')) {
        var security_pie = new Chart( $("#security-usochart"), {
            type: 'pie',
            data: {
                labels: [
                    "Utilizzato",
                    "Non utilizzato"],
                datasets: [{
                    data:<?php echo $security_percentage;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#FFCE56"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#FFCE56"]}]},
            options:{
                  legend:{
                      position:'bottom'}}}); 
        $("#security-usochart").data('draw', true);
    }
    
    if (!$("#security-piechart").data('draw')) {
        var security_piechart = new Chart( $("#security-piechart"), {
            type: 'doughnut',
            data: {
                labels: [
                        "0-5",
                        "5-20",
                        "20-50",
                        "50-100",
                        "100+"],
                datasets: [{
                    data:<?php echo $security_piechart;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"]}]},
                options:{
                    legend:{
                      position:'bottom'}}}); 
        $("#security-piechart").data('draw', true);
    }
              
    if (!$("#security-barchart").data('draw')) {
        var security_barchart = new Chart( $("#security-barchart"), {
            type: 'bar',
            data: {
                labels: [
                        "0-5",
                        "5-20",
                        "20-50",
                        "50-100",
                        "100+"],
                datasets: [{
                    label:"Up",
                    data:<?php echo $security_up;?>,
                            backgroundColor: "#FF6384",
                            hoverBackgroundColor: "#FF6384"},{
                    label:"Down",
                    data:<?php echo $security_down;?>,
                            backgroundColor: "#FFCE56",
                            hoverBackgroundColor: "#FFCE56"}]},
                options: {
                    scales: {
                        yAxes: [{
                            type: 'logarithmic'}]}}});
        
        $("#security-barchart").data('draw', true);
    }
});

/*Remote*/
              
$('a[href="#remote"]').on('shown.bs.tab', function (e) {
    console.log($(e.target).text());
    if (!$("#remote-usochart").data('draw')) {
        var remote_pie = new Chart( $("#remote-usochart"), {
            type: 'pie',
            data: {
                labels: [
                    "Utilizzato",
                    "Non utilizzato"],
                datasets: [{
                    data:<?php echo $remote_percentage;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#FFCE56"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#FFCE56"]}]},
            options:{
                  legend:{
                      position:'bottom'}}}); 
        $("#remote-usochart").data('draw', true);
    }
    
    if (!$("#remote-piechart").data('draw')) {
        var remote_piechart = new Chart( $("#remote-piechart"), {
            type: 'doughnut',
            data: {
                labels: [
                        "0-10",
                        "10-20",
                        "20-50",
                        "50-70",
                        "70+"],
                datasets: [{
                    data:<?php echo $remote_piechart;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"]}]},
                options:{
                    legend:{
                      position:'bottom'}}}); 
        $("#remote-piechart").data('draw', true);
    }
              
    if (!$("#remote-barchart").data('draw')) {
        var remote_barchart = new Chart( $("#remote-barchart"), {
            type: 'bar',
            data: {
                labels: [
                        "0-10",
                        "10-20",
                        "20-50",
                        "50-70",
                        "70+"],
                datasets: [{
                    label:"Up",
                    data:<?php echo $remote_up;?>,
                            backgroundColor: "#FF6384",
                            hoverBackgroundColor: "#FF6384"},{
                    label:"Down",
                    data:<?php echo $remote_down;?>,
                            backgroundColor: "#FFCE56",
                            hoverBackgroundColor: "#FFCE56"}]},
                options: {
                    scales: {
                        yAxes: [{
                            type: 'logarithmic'}]}}});
        
        $("#remote-barchart").data('draw', true);
    }
});
      
/*WebServer*/
              
$('a[href="#web"]').on('shown.bs.tab', function (e) {
    console.log($(e.target).text());
    if (!$("#web-usochart").data('draw')) {
        var web_pie = new Chart( $("#web-usochart"), {
            type: 'pie',
            data: {
                labels: [
                    "Utilizzato",
                    "Non utilizzato"],
                datasets: [{
                    data:<?php echo $web_percentage;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#FFCE56"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#FFCE56"]}]},
            options:{
                  legend:{
                      position:'bottom'}}}); 
        $("#web-usochart").data('draw', true);
    }
    
    if (!$("#web-piechart").data('draw')) {
        var web_piechart = new Chart( $("#web-piechart"), {
            type: 'doughnut',
            data: {
                labels: [
                        "0-5",
                        "5-15",
                        "15-50",
                        "50-100",
                        "100+"],
                datasets: [{
                    data:<?php echo $web_piechart;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"]}]},
                options:{
                    legend:{
                      position:'bottom'}}}); 
        $("#web-piechart").data('draw', true);
    }
              
    if (!$("#web-barchart").data('draw')) {
        var web_barchart = new Chart( $("#web-barchart"), {
            type: 'bar',
            data: {
                labels: [
                        "0-5",
                        "5-15",
                        "15-50",
                        "50-100",
                        "100+"],
                datasets: [{
                    label:"Up",
                    data:<?php echo $web_up;?>,
                            backgroundColor: "#FF6384",
                            hoverBackgroundColor: "#FF6384"},{
                    label:"Down",
                    data:<?php echo $web_down;?>,
                            backgroundColor: "#FFCE56",
                            hoverBackgroundColor: "#FFCE56"}]},
                options: {
                    scales: {
                        yAxes: [{
                            type: 'logarithmic'}]}}});
        
        $("#web-barchart").data('draw', true);
    }
});

/*MailServer*/
              
$('a[href="#mail"]').on('shown.bs.tab', function (e) {
    console.log($(e.target).text());
    if (!$("#mail-usochart").data('draw')) {
        var mail_pie = new Chart( $("#mail-usochart"), {
            type: 'pie',
            data: {
                labels: [
                    "Utilizzato",
                    "Non utilizzato"],
                datasets: [{
                    data:<?php echo $mail_percentage;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#FFCE56"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#FFCE56"]}]},
            options:{
                  legend:{
                      position:'bottom'}}}); 
        $("#mail-usochart").data('draw', true);
    }
    
    if (!$("#mail-piechart").data('draw')) {
        var mail_piechart = new Chart( $("#mail-piechart"), {
            type: 'doughnut',
            data: {
                labels: [
                        "0-15",
                        "15-30",
                        "30-50",
                        "50-100",
                        "100+"],
                datasets: [{
                    data:<?php echo $mail_piechart;?>,
                        backgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"],
                        hoverBackgroundColor: [
                                "#FF6384",
                                "#36A2EB",
                                "#FFCE56",
                                "#204469",
                                "#71d995"]}]},
                options:{
                    legend:{
                      position:'bottom'}}}); 
        $("#mail-piechart").data('draw', true);
    }
              
    if (!$("#mail-barchart").data('draw')) {
        var mail_barchart = new Chart( $("#mail-barchart"), {
            type: 'bar',
            data: {
                labels: [
                        "0-15",
                        "15-30",
                        "30-50",
                        "50-100",
                        "100+"],
                datasets: [{
                    label:"Up",
                    data:<?php echo $mail_up;?>,
                            backgroundColor: "#FF6384",
                            hoverBackgroundColor: "#FF6384"},{
                    label:"Down",
                    data:<?php echo $mail_down;?>,
                            backgroundColor: "#FFCE56",
                            hoverBackgroundColor: "#FFCE56"}]},
                options: {
                    scales: {
                        yAxes: [{
                            type: 'logarithmic'}]}}});
        
        $("#mail-barchart").data('draw', true);
    }
});
});
</script>
        
  </body>
</html>
