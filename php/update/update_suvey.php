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

if (isset($_POST["id"])) {
    $data["id"]=$_POST["id"];
}else
{
    echo "Invalid id";
    exit();
}

if (isset($_POST["value"])) {
$data["value"]=$_POST["value"];
}

if (isset($_POST["type"])) {
    $data["type"]=$_POST["type"];
}

if (isset($_POST["show_feedback"])) {
    $data["show_feedback"]=$_POST["show_feedback"];
}

if (isset($_POST["show_result"])) {
    $data["show_result"]=$_POST["show_result"];
}

if (isset($_POST["practice"])) {
    $data["practice"]=$_POST["practice"];
}

if (isset($_POST["available"])) {
    $data["available"]=$_POST["available"];
}

$datetime_variable = new DateTime();

$data["lastmodifiedtime"] = $datetime_variable;

$connection->update($prefix.'survey', $data);

echo "ok";

echo EncodingClass::fromVariable($data);

?>