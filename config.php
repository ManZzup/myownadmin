<?php
/**
 * my own Admin config page
 * @author: manujith
 * @date  : 28/10/13
 * Edit the necessary variable to ge the required db action
 * 
 */

global $host,$db_user,$db_pwd,$db_type,$db_name;
$host = "127.0.0.1";
$db_user = "root";
$db_pwd = "root";
$db_type = "mysql";
$db_name = "moa";

function getConnect(){
    global $host,$db_user,$db_pwd,$db_type,$db_name;
    
    $conn = mysql_connect($host, $db_user, $db_pwd);

    if($conn){
        if(mysql_select_db($db_name)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }    
}

function query($q){
    if(mysql_ping() || getConnect()){
       return mysql_query($q);
    }    
}

function fetch_array($r){
    return mysql_fetch_array($r);
}

function num_rows($r){
    return mysql_num_rows($r);
}
?>
