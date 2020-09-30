<?php 
include_once "../../jsdb.php";
include_once "../../jsencoding.php";
include_once "../../prefix.php";
include_once "../../connection.php";


$connection = DatabaseClass::init($host, $username, $password, $dbname);
if ($connection == null){
    echo "Can not connect to database!";
    exit();
}

$data = array(
);

if (isset($_POST["examinationid"])) {
    $data["examinationid"]=$_POST["examinationid"];
}else
{
    echo "Invalid examinationid";
    exit();
}

if (isset($_POST["user_id"])) {
    $data["user_id"]=$_POST["user_id"];
}else
{
    echo "Invalid user_id";
    exit();
}


if (isset($_POST["start"])) {
    $data["start"]=EncodingClass::toVariable($_POST["start"]);
}

if (isset($_POST["end"])) {
    $data["end"]=EncodingClass::toVariable($_POST["end"]);
}

$search = $connection->load($prefix.'link_examination_user',"(user_id = ".$data["user_id"].") AND (examinationid = ".$_POST["examinationid"].")");
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