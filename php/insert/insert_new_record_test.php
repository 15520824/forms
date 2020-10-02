<?php 
include_once "../../jsdb.php";
include_once "../../jsencoding.php";
include_once "../../prefix.php";
include_once "../../connection.php";
session_start();
if (!isset($_SESSION[$prefix."userid"])) {
    echo "Not logged in";
    exit();
}

$connection = DatabaseClass::init($host, $username, $password, $dbname);
if ($connection == null){
    echo "Can not connect to database!";
    exit();
}

$data = array(
);

if (isset($_POST["user_id"])) {
    $data["user_id"]=$_POST["user_id"];
}

if (isset($_POST["times"])) {
    $data["times"]=$_POST["times"];
}else
{

    $time = $connection->load($prefix.'link_examination_user',"(user_id = ".$data["user_id"].") AND (surveyid = ".$_POST["surveyid"].")");
    $data["times"] = count($time)+1;
}

if (isset($_POST["surveyid"])) {
    $data["surveyid"]=$_POST["surveyid"];
}



$search = $connection->load($prefix.'link_examination_user',"(user_id = ".$data["user_id"].") AND (times = ".$data["times"].") AND (surveyid = ".$data["surveyid"].")");

if (count($search) > 0){
    $data["id"]=$search[0]["id"];
    $connection->update($prefix.'link_examination_user',$data);
}
else{
    $data["id"] = $connection->insert($prefix.'link_examination_user', $data);
}

echo "ok";

echo EncodingClass::fromVariable($data);

?>