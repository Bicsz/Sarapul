<?php
define('ACCESS_database','123');
session_start();




function ADMIN(){ //давать данный параметр тем функциям, которые обязательно должны иметь ключ
    if(!isset($_SESSION["id"]))
        SUPER_ERROR();

}
 ADMIN();
   
   
    //print_r($_FILES);
//print_r($_POST);
    
    
    include_once "../database/database.php";
    
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO(HOST_DBNAME_public,USERNAME_public,PASSWORD_public,$opt);
    
    //print_r($_GET);
    

    $sql  = "insert into articles 
    (title,text,date,flore,max_flore,rooms_count,ploshad,harakter,mouns_coasts,need_zalog,photoCount)
    values
    (:title,:text,:date,:flore,:max_flore,:rooms_count,:ploshad,:harakter,:mouns_coasts,:need_zalog,:photoCount)";
    
    $isok=false;
    $sth  = $db->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    
    if($sth->execute(array(
        ":title"=>$_POST["title"],
        ":text"=>$_POST["text"],
        ":date"=>$_POST["date"],
        ":flore"=>$_POST["flore"],
        ":max_flore"=>$_POST["max_flore"],
        ":rooms_count"=>$_POST["rooms_count"],
        ":ploshad"=>$_POST["ploshad"],
        ":harakter"=>$_POST["harakter"],
        ":mouns_coasts"=>$_POST["mouns_coasts"],
        ":need_zalog"=>$_POST["need_zalog"],
        ":photoCount"=>count($_FILES["file"]["name"])
    )))
        $isok=true;
   
    
    $sql  = "select id from articles where
    title=:title and text=:text and date=:date
    order by id desc limit 1";
    
    $id=false;
    $sth  = $db->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    
    $sth->execute(array(
        ":title"=>$_POST["title"],
        ":text"=>$_POST["text"],
        ":date"=>$_POST["date"]
    ));
     while($row = $sth->fetch()) {
          $id=$row["id"];
        }
   
   // echo "id is=".$id;

    
    for($i=0;$i<count($_FILES["file"]["name"]);$i++){
        $destiation_dir = '../uploads/article_img_'.$id.'_N'.$i.".jpg";
         move_uploaded_file($_FILES["file"]['tmp_name'][$i], $destiation_dir );
        //echo '{"result":"File Uploaded"}';
    }

    echo '{"result":"ok"}';

    

?>