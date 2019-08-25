<?php
define('ACCESS_database','123');
session_start();

$not_aloowed=array("users");


function ADMIN(){ //давать данный параметр тем функциям, которые обязательно должны иметь ключ
    if(!isset($_SESSION["id"]))
        SUPER_ERROR();

}

function CheckSession(){
    if(isset($_SESSION["id"]) && isset($_SESSION["login"]) && isset($_SESSION["password"])){
        echo '{"id":'.$_SESSION["id"].',"login":'.$_SESSION["login"].',"password":'.$_SESSION["password"].'}';
    }
    else
        echo '{"result":"null session"}';
}

function SUPER_ERROR(){
     session_unset();
     session_destroy();
     echo '{"result":"session error"}';
  
     exit;
}

if(isset($_GET["operation"]))
    $_GET["operation"]();
else
    echo "what do u want from me?!";
 
function SelectSome(){
    global $not_aloowed;
   
    if(array_search($_GET["table"],$not_aloowed)!==false){
        echo '{"result":"not allowed"}';
        exit;
    }
    
    
    include_once "../database/database.php";
  
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO(HOST_DBNAME_public,USERNAME_public,PASSWORD_public,$opt);

    
    
    
    $table = $_GET["table"];
    $order_by=false;
    
    if(isset($_GET["order_by"])){
        $order_by=$_GET["order_by"];
        unset($_GET["order_by"]);
    }
    
    
    unset($_GET["operation"]);
   
    unset($_GET["table"]);
    
    
    foreach ($_GET as $key => $value) {
        switch($_GET[$key]){
                
                case "session_id":$_GET[$key]=$_SESSION['id'];break;
                case "session_login":$_GET[$key]=$_SESSION['login'];break;
                case "session_password":$_GET[$key]=$_SESSION['password'];break;
        }
    }
    
    
    $array=array();
    
    $sql = 'select * from '.$table.' where ';
    
    
        $ferst=true;
        foreach ($_GET as $key => $value) {
            if($ferst)
                $ferst=false;
            else{
               $sql=$sql.' and ';

            }
            $sql=$sql.$key;
            switch($_GET[$key]){
                    case "now()":
                    case "curdate()":
                    case "curtime()":
                        $sql=$sql."=".$_GET[$key]; 
                    break;
                default:
                    $sql=$sql."=:".$key;
                    $array+=[":".$key => $_GET[$key]];  
                break;

            }
            
        }
    if($order_by!=false)
        $sql=$sql." order by ".$order_by;
    
//echo $sql;
    $sth  = $db->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    
    //print_r($array);
    $sth->execute($array);
   
    $emparray = array();
        while($row = $sth->fetch()) {
            
             array_push($emparray,$row);
            
        }
   
     echo '{"result":'.json_encode($emparray,JSON_UNESCAPED_UNICODE)."}";   
}

function DeleteSome(){
    global $not_aloowed;
   
    if(array_search($_GET["table"],$not_aloowed)!==false){
        echo '{"result":"not allowed"}';
        exit;
    }
    
    
    include_once "../database/database.php";
  
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO(HOST_DBNAME_public,USERNAME_public,PASSWORD_public,$opt);

    
    
    
    $table = $_GET["table"];
   
    
    unset($_GET["operation"]);
   
    unset($_GET["table"]);
    
    
    foreach ($_GET as $key => $value) {
        switch($_GET[$key]){
                
                case "session_id":$_GET[$key]=$_SESSION['id'];break;
                case "session_login":$_GET[$key]=$_SESSION['login'];break;
                case "session_password":$_GET[$key]=$_SESSION['password'];break;
        }
    }
    
    
    $array=array();
    
    $sql = 'delete from '.$table.'  ';
    
    
        $ferst=true;
        foreach ($_GET as $key => $value) {
            
            if($ferst){
                $ferst=false;
                $sql=$sql." where ";
            }else{
               $sql=$sql.' and ';

            }
            $sql=$sql.$key;
            switch($_GET[$key]){
                    case "now()":
                    case "curdate()":
                    case "curtime()":
                        $sql=$sql."=".$_GET[$key]; 
                    break;
                default:
                    $sql=$sql."=:".$key;
                    $array+=[":".$key => $_GET[$key]];  
                break;

            }
            
        }
   
    $sth  = $db->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    
    //print_r($array);
    $sth->execute($array);
   
    
   
     echo '{"result":"ok"}';   
}



function CreateUpdateSome(){
    ADMIN();
    global $not_aloowed;
   
    if(array_search($_GET["table"],$not_aloowed)!==false){
        echo '{"result":"not allowed"}';
        exit;
    }
    
    include_once "../database/database.php";
    
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO(HOST_DBNAME_public,USERNAME_public,PASSWORD_public,$opt);
    
    //print_r($_GET);
    
    
    
   
    
    $table = $_GET["table"];
    
    
    unset($_GET["operation"]);
    unset($_GET["p"]);
    unset($_GET["table"]);
    
    
    foreach ($_GET as $key => $value) {
        switch($_GET[$key]){
                case "session_id":$_GET[$key]=$_SESSION['id'];break;
                case "session_login":$_GET[$key]=$_SESSION['login'];break;
                case "session_password":$_GET[$key]=$_SESSION['password'];break;
        }
    }
    
    
    $array=array();
    
   
    
    if(!isset($_GET["table_key"]) || !isset($_GET["table_key_val"])){
        
        
        $sql_part1="(";
        $sql_part2="(";
        $ferst=true;
        foreach ($_GET as $key => $value) {
           if($ferst)
                $ferst=false;
           else{
               $sql_part1=$sql_part1.',';
               $sql_part2=$sql_part2.',';
           }
            $sql_part1=$sql_part1.$key;
            switch($_GET[$key]){
                    case "now()":
                    case "curdate()":
                    case "curtime()":
                        $sql_part2=$sql_part2.$_GET[$key]; 
                    break;
                default:
                    $sql_part2=$sql_part2.":".$key;
                    $array+=[":".$key => $_GET[$key]];  
                break;

            }
            
        }
        //print_r($array);
        
        $sql_part1=$sql_part1.")";
        $sql_part2=$sql_part2.")";
        
        $sql = 'insert into '.$table." ".$sql_part1." values ".$sql_part2;
        //echo $sql;
            

        
    }else{
        
        
        
        
        $array+=[":".$_GET["table_key"] => $_GET["table_key_val"]];
        $table_key=$_GET["table_key"];
        //$table_key_val=$_GET["table_key_val"];
        
        unset($_GET["table_key"]);
        unset($_GET["table_key_val"]);
        
        $sql_part="";
        $ferst=true;
        foreach ($_GET as $key => $value) {
            if($ferst)
                $ferst=false;
            else{
               $sql_part=$sql_part.',';

            }
            $sql_part=$sql_part.$key;
            switch($_GET[$key]){
                    case "now()":
                    case "curdate()":
                    case "curtime()":
                        $sql_part=$sql_part."=".$_GET[$key]; 
                    break;
                default:
                    $sql_part=$sql_part."=:".$key;
                    $array+=[":".$key => $_GET[$key]];  
                break;

            }
            
        }
        
        
        
        $sql = 'update '.$table.' set '.$sql_part.' where '.$table_key.'=:'.$table_key;
       
    }
    
    //echo $sql;
    $sth  = $db->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    if($sth->execute($array))
        echo '{"result":"ok"}';
    else
        echo '{"result":"not ok"}';
}


function login(){
    
    include_once "../database/database.php";
  
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO(HOST_DBNAME_public,USERNAME_public,PASSWORD_public,$opt);

    
    
    $sql = 'select * from users where login=:login and password=:password';
    
    
    $sth  = $db->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    
    //print_r($array);
    $sth->execute(array(
        ":login"=>$_GET["login"],
        ":password"=>$_GET["password"]
    ));
   
    $emparray = array();
        while($row = $sth->fetch()) {
            
             array_push($emparray,$row);
            $_SESSION["login"]=$row["login"];
            $_SESSION["password"]=$row["password"];
            $_SESSION["id"]=$row["id"];
            
        }
   
     echo '{"result":'.json_encode($emparray,JSON_UNESCAPED_UNICODE)."}";   
}



?>