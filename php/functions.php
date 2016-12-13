<?php

$configuration = array(
    "db_name"=> "tesidb",
    "db_host"=> "localhost",
    "db_user"=> "root",
    "db_password"=> "");
$boolean = [true=>"true",false=>"false"];

 
/**
 * This file is part of the array_column library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey (http://benramsey.com)
 * @license http://opensource.org/licenses/MIT MIT
 */

if (!function_exists('array_column')) {
    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();

        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }

        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }

        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;

        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }

        $resultArray = array();

        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;

            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }

            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }

            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }

        }

        return $resultArray;
    }

}

function open_db() {
    global $configuration;
    $sql_connection = @new mysqli( $configuration['db_host'],  $configuration['db_user'],  $configuration['db_password'], $configuration['db_name']);
    return $sql_connection;
}

function checkValidEmail($email){
		 return filter_var($email, FILTER_VALIDATE_EMAIL);
} 
	 

function mempty(){
    foreach(func_get_args() as $arg)
        if(empty($arg))
            continue;
        else
            return false;
    return true;
}

function findKey($array, $keySearch)
{
    foreach ($array as $key => $item) {
        if ($key == $keySearch) {
            return true;
        }
        else {
            if (is_array($item) && findKey($item, $keySearch)) {
               return true;
            }
        }
    }

    return false;
}

function faqLink($string) {
    $pageName=str_replace(".php", "",  substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1));
    echo <<<EOF
        <div class="col-lg-offset-2">
            <span class="label label-primary">Tips</span>&nbsp;&nbsp;<a href="faq.php?anchor={$pageName}Link" style="color:#2c3e50;" target="_blank">{$string}</a>
        </div>
        
EOF;
                  
}

function createUser($username, $password) {
    /*Funzione fittizia per il login*/  
    if(!mempty($username, $password)){
        $_SESSION['userName']=$username;
        $_SESSION['loggedIn']=true;
        if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false)
            header('Location: ../index.php');
        else
            header('Location: index.php');
    }else
        return false;
}

function register($username, $password, $repeat) {
    /*Funzione fittizia per la registrazione*/  
    if(!mempty($username, $password) && $password==$repeat){
        
        /*Qui ci va l'inserimento dati*/
        
        $_SESSION['userName']=$username;
        $_SESSION['loggedIn']=true;
        if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false)
            header('Location: ../index.php');
        else
            header('Location: index.php');
    }else
        return false;
}

function login($username, $password) {
    /*Funzione fittizia per il login*/  
    if(!mempty($username, $password)){
        $_SESSION['userName']=$username;
        $_SESSION['loggedIn']=true;
        if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false)
            header('Location: ../index.php');
        else
            header('Location: index.php');
    }else
        return false;
}


function checkLoggedIn(){
    
    /*Verifica se l'utente si è già loggato oppure no, funzione utilizzata nella navbar*/
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
        return true;
    else
        return false;

}

function redirect(){
    
    /*Se l'utente non è loggato viene rimandato alla pagina di login*/
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
        return;
    else
         if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false)
            header('Location: login.php');
        else
            header('Location: /php/login.php');

}


function query_db($sql_connection, $tableName, $tableCollumn, $searchedValue){
    
    /*Verifico la presenza di problemi nella connesione al db*/
    if (mysqli_connect_errno()){
        show_dialog("Abbiamo problemi con la connessione al db", true);
        exit();
        return null;
    }
    
    /*Effettuo la query*/
    $query ="SELECT * FROM	".$tableName." WHERE ".$tableCollumn."='".$searchedValue."'";
    $resultQ = mysqli_query($sql_connection, $query);
    
    if (!$resultQ) {
        /*Verifico la presenza di ulteriori errori*/
        show_dialog("Errore nella comunicazione con il database", true);
        return null;
    }else{
        /*Salvo il risultato della query in un array multi-dimensionale e lo restituisco*/
        $i=0;
        while ($row = mysqli_fetch_array($resultQ,MYSQL_ASSOC)){
            $array[$i]=$row;
            $i++;
        }
        return $array;
    }
}

function debug_to_console($data) {
    if(is_array($data) || is_object($data))
	{   echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
	} else {
		echo("<script>console.log('PHP: ".$data."');</script>");
	}
}

function kush_gauge($width, $height, $fps, $hParameter, $factor=1){
    
    /*SPIEGAZIONE VARIABILI*/
    /*$hParameter: indice di movimento dell'immagine ripresa, può essere pari a 1, 2 o 4*/
	/*$width: larghezza in pixel del frame*/
	/*$height: altezza in pixel del frame*/
	/*$fps: frames per second*/
	/*$factor: fattore moltiplicativo extra*/
    
    if(!mempty($width, $height, $fps, $hParameter, $factor)){
        /*Kush gauge: frame width x height x fps x hParameter x 0.07 ÷ 1000 = bit rate in kbps*/
        $bitrate=($width*$height*$fps*$hParameter)*0.07/1000;

        /*Aggiunto 20% per gli headers del protocolli */
        $bitrate=$bitrate*1.2;

        /*Prodotto del risultato per una fattore moltiplicativo*/
        $bitrate=$bitrate*$factor;

        /*Return del risultato*/
        return $bitrate;
        
    } else
        
        return 0;
}

function webBand($pageSize, $nUsers, $pagesLoadTime){
    
    /*SPIEGAZIONE VARIABILI*/
    /*$pageSize: dimensione pagina web inKB*/
    /*$nUsers: numero visite contemporanee*/
    /*$pagesLoadTime: tempo di caricamento di una pagina in secondi*/
    
    if(!mempty($pageSize, $nUsers, $pagesLoadTime)){
        
        return $pageSize*8*$nUsers/$pagesLoadTime;
        
    } else
        
        return 0;
}

function voipBand($payload, $bitRate, $rtp, $l2, $concurrent){
    
    /*SPIEGAZIONE VARIABILI*/
    /*$payload: dimensione payload del codec scelto in Bytes*/
    /*$bitrate: bitrate del codec scelto in Kbps*/
    /*$rtp: dimensione dell'header del protocollo RTP in Bytes*/
    /*$l2: dimensione dell'header del protocollo di secondo livello scelto in Bytes*/
    /*$concurrent: numero di sessioni contemporanee*/
    
    if(!mempty($payload, $bitRate, $rtp, $l2, $concurrent)){
        /*Calcolo del TOTAL PACKET SIZE*/
        $tps=($l2 + $rtp + $payload)*8;

        /*Calcolo del PACKETS PER SECOND*/
        $PPS=$bitRate/($payload*8);

        /*Calcolo e return della banda*/
        return $concurrent*$tps*$PPS;
        
    } else
        
        return 0;
}

function remoteBand($array, $nRemTemp){
    
    /*mempty() verifica che gli argomenti siano definiti e non nulli*/
    /*La funzione somma tutti gli elementi dell'$array se sono attive le relative checkbox*/
    if(!mempty($array, $nRemTemp)){
        $remoteBand=0;
        
        foreach ($array as $key => $value)            
            if(isset($_POST[strtolower($key)])) {
                
                $remoteBand+=$value;
            }
        $remoteBand=$remoteBand*$nRemTemp;
        return $remoteBand; 
        
    } else
        
        return 0;
}

function weightedAvg($occursArray, $bandsArray){
    
    $weightedSum=0;
    
    foreach( $occursArray as $key => $value){
        $bandValue=$bandsArray[$key];
        foreach($value as $subKey => $subElement){
            $occursArray[$key][$subKey]=$bandValue;
        }
    }
    
    for ($x = 0; $x < 24; $x++) {
        if(findKey($occursArray, $x))
            $new[$x]=array_sum(array_column($occursArray, $x));
        else
            $new[$x]=0;
    }
    
    $avgArray=array_count_values($new);
    
    foreach($avgArray as $key => $value)
        $weightedSum+=$key*$value;
    
    return $weightedSum/24;
}

function echoChecked($needle, $haystack, $empty=false,$reverse=false) {
    checkAndPrint($needle, $haystack,"checked=\"checked\"",$empty,$reverse);
}
function echoSelected($needle, $haystack, $empty=false,$reverse=false) {
    checkAndPrint($needle, $haystack,"selected=\"selected\"",$empty,$reverse);
}

function checkAndPrint($needle, $haystack, $string, $empty=false,$reverse=false) {
    if (is_array($haystack)) {
        
        if ( !$reverse && (in_array($needle,$haystack) || (!!$empty && empty($needle)))) {
            
            echo $string;
        }
        if ( $reverse && !(in_array($needle,$haystack) || ($empty && empty($needle)))) {
            echo $string;            
        }
    } else {
        
        if ($needle === $haystack || ($empty && empty($needle))) {
            echo $string;
        }        
    }
}

function echo_navbar(){
   
echo <<<EOF
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>

EOF;
    
    if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false){
echo <<<EOF
            <a class="navbar-brand" href="../index.php">Fiber Bandwidth Tool</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">Getting started</a></li>
                    <li><a href="statistics.php">Reports</a></li>
                    <li><a href="faq.php">F.A.Q.</a></li>
                    <li><a href="credits.php">Credits</a></li>
                </ul>
EOF;
    }else{
echo <<<EOF
            <a class="navbar-brand" href="index.php">Fiber Bandwidth Tool</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Getting started</a></li>
                    <li><a href="/php/statistics.php">Reports</a></li>
                    <li><a href="/php/faq.php">F.A.Q.</a></li>
                    <li><a href="/php/credits.php">Credits</a></li>
                </ul>
EOF;
    }
        
    if(checkLoggedIn()){
echo <<<EOF
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Utente <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        
EOF;
        if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false){
echo <<<EOF
                        <li><a href="profile.php"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Profilo</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Logout</a></li>
                      </ul>
                    </li>
                </ul>
EOF;
        }else{
echo <<<EOF
                        <li><a href="/php/profile.php"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Profilo</a></li>
                        <li class="divider"></li>
                        <li><a href="/php/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Logout</a></li>
                      </ul>
                    </li>
                </ul>
EOF;
        }
    
    }else{
echo <<<EOF
        <ul class="nav navbar-nav navbar-right">
            <ul class="nav navbar-nav navbar-right">
EOF;
        if (strpos($_SERVER['REQUEST_URI'], '/php/') !== false){
echo <<<EOF
                <li><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Login</a></li>
            </ul>
        </ul>
EOF;
        } else{
echo <<<EOF
                <li><a href="/php/login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Login</a></li>
            </ul>
        </ul>
EOF;
        }
    }

echo <<<EOF
                </div><!--/.nav-collapse -->
          </div>
    </nav>
EOF;
}


function echo_alert($label, $flag, $class){
   
    if($flag){
        switch ($class) {
            case "alert-danger":
echo <<<EOF
    <div class="alert {$class} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Alert!</strong> {$label}
    </div>
EOF;
				break;
            case "alert-success":
echo <<<EOF
    <div class="alert {$class} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Yeah!</strong> {$label}
    </div>
EOF;
				break;
            case "alert-info":
echo <<<EOF
    <div class="alert {$class} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Hei!</strong> {$label}
    </div>
EOF;
				break;
            case "alert-warning":
echo <<<EOF
    <div class="alert {$class} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong>Ops!</strong> {$label}
    </div>
EOF;
				break;

        }

    }
}

function echo_button($p) {
	$class_size="";
	switch ($p["size"]) {
		case "small":
			$class_size = "btn-sm";
			break;
		case "large":
			$class_size = "btn-lg";
			break;
	}
	$class_collapse="";
	$parameter_collapse="";
	if ($p["collapse"]) {
			$class_collapse="btn-collapse";
			$parameter_collapse='data-toggle="collapse" data-target="' . $p["collapse"] . '"';
	}
    echo <<<EOF
        <button type="{$p["button_type"]}" class="btn $class_size $class_collapse {$p["class"]}" $parameter_collapse>{$p["label"]}</button>
EOF;
}

function echo_faq($p) {
echo <<<EOF
	<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed faq" data-toggle="collapse" data-parent="#accordion" id="{$p["id"]}Link" href="#{$p["id"]}"><strong>{$p["title"]}</strong></a>
                </h4>
            </div>
            <div id="{$p["id"]}" class="panel-collapse collapse">
                <div class="panel-body">
                    <span class="label label-success" >Answer</span><br /><br />
                    <p style="text-align:justify;">{$p["body"]}</p>
                </div>
            </div>
        </div>
EOF;
}


                        
function echo_text($p) {
    $defval="";
    if (isset($p["default_value"])) {
        $defval=$p["default_value"];
    }
echo <<<EOF
	<div class="form-group">
		<label for="{$p["name"]}" class="col-lg-2 control-label">{$p["label"]}</label>
		<div class="col-lg-10">
			<input type="text" class="form-control {$p["class"]}" value="$defval" name="{$p["name"]}" id="{$p["name"]}" placeholder="{$p["placeholder"]}">
		</div>
	</div>
EOF;
}

function echo_password($p) {
echo <<<EOF
	<div class="form-group">
		<label for="{$p["name"]}" class="col-lg-2 control-label">{$p["label"]}</label>
		<div class="col-lg-10">
			<input type="password" class="form-control {$p["class"]}" name="{$p["name"]}" id="{$p["name"]}" placeholder="{$p["placeholder"]}">
		</div>
	</div>
EOF;
}

function echo_slider($p) {
	echo <<<EOF
		  <div class="form-group">
				 <label for="mailBoxLatency" class="col-lg-2 control-label">{$p["label"]}</label>
                 <div class="col-lg-10">
				    <input id="{$p["name"]}" class="{$p["class"]}" name="{$p["name"]}" type="text" data-slider-min="{$p["min_value"]}" data-slider-max="{$p["max_value"]}" data-slider-step="{$p["step"]}" data-slider-value="{$p["default"]}"/>
                 </div>
		  </div>
    <script>
        $( document ).ready(function() {
			new Slider("#{$p["name"]}");
        });
    </script>
EOF;
}



function echo_radio($p) {
echo <<<EOF
	                    <div class="form-group">
                        <label class="col-lg-2 control-label">{$p["label"]}</label>
                        <div class="col-lg-10">
EOF;
	foreach ( $p["items"] as $i=>$v ){
        $default="";
        if (isset($v["default"]) && $v["default"] == true)
            $default='checked="checked"';
		echo <<<EOF
				<div class="radio">
                            <label>
                              <input type="radio" name="{$p["name"]}" id="{$p["name"]}-$i" value="{$v["value"]}" $default>
                              {$v["label"]}
                            </label>
                          </div> 
EOF;
	}
	echo "</div></div>";
	echo "<script>$(\"input[type=radio][name=" . $p["name"]. "]\").change(function(){";
    foreach ( $p["items"] as $i=>$v ){
            
            if (isset($v["disable"])) {
                echo "if (this.value == " . $v["value"] . ") {\n $('" . $v["disable"] . "').attr(\"disabled\",true);}\n";

            }
            if (isset($v["enable"])) {
                echo "if (this.value == " . $v["value"] . ") {\n $('" . $v["enable"] . "').attr(\"disabled\",false);}\n";			
            }
        }
        echo "});</script>";
    }

function echo_submit($p) {
echo <<<EOF
		  <div class="form-group">
             <div class="{$p["outerClass"]}">
				 <button type="submit" class="{$p["class"]}" name="{$p["name"]}">{$p["label"]}</button>
             </div>
		  </div>
EOF;
}

function echo_diagram($p){
echo <<<EOF
    <div class="form-group">
        <label class="col-lg-2 control-label">{$p['label']}<br /><input type="checkbox" id="{$p['name']}All" autocomplete="off"><span style="font-size:0.9em">&nbsp;Seleziona tutto</span></label>
        <div class="btn-group col-lg-10" data-toggle="buttons">
EOF;
    for ($x = 0; $x < 24; $x++) {
        $n=str_pad($x+1, 2, '0', STR_PAD_LEFT);
echo <<<EOF
            <label class="btn-hours btn btn-default btn-sm {$p['name']}">
                <input type="checkbox" class="{$p['name']}class" name="{$p['name']}[{$x}]" autocomplete="off"> {$n}
             </label>
EOF;
}

echo <<<EOF
        </div>
    </div>
EOF;

}

function write_section($controls) {
	foreach($controls as $control)
		switch ($control["type"]) {
            case "password":
                echo_password($control["parameters"]);
				break;
			case "text":
				echo_text($control["parameters"]);
				break;
			case "group":
				echo '<div id="' . $control["parameters"]["name"] . '" class="' . $control["parameters"]["class"] . '">';
					write_section($control["controls"]);
				echo '</div>';
				break;
			case "button":
				echo_button($control["parameters"]);
				break;
			case "slider":
				echo_slider($control["parameters"]);
				break;
			case "radio":
				echo_radio($control["parameters"]);
                break;
            case "submit":
				echo_submit($control["parameters"]);
                break;
            case "faq":
				echo_faq($control["parameters"]);
                break;
            case "diagram":
				echo_diagram($control["parameters"]);
                break;
		}
}

?>
