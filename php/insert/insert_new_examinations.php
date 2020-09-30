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

if (isset($_POST["name"])) {
$data["name"]=$_POST["name"];
}

if (isset($_POST["surveyid"])) {
    $data["surveyid"]=$_POST["surveyid"];
}

if (isset($_POST["start"])) {
    $data["start"]=EncodingClass::toVariable($_POST["start"]);
}

if (isset($_POST["end"])) {
    $data["end"]=EncodingClass::toVariable($_POST["end"]);
}

if (isset($_POST["userid"])) {
    $data["userid"]=$_POST["userid"];
}

$data["id"] = $connection->insert($prefix.'examination', $data);

echo "ok";

echo EncodingClass::fromVariable($data);

?>