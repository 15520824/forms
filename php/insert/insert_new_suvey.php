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

if (isset($_POST["below"])) {
    $data["below"]=$_POST["below"];
}
if (isset($_POST["average"])) {
    $data["average"]=$_POST["average"];
}
if (isset($_POST["rather"])) {
    $data["rather"]=$_POST["rather"];
}
if (isset($_POST["great"])) {
    $data["great"]=$_POST["great"];
}

if (isset($_POST["available"])) {
    $data["available"]=$_POST["available"];
}

if (isset($_POST["ramdom"])) {
    $data["ramdom"]=$_POST["ramdom"];
}

if (isset($_POST["userid"])) {
    $data["userid"]=$_POST["userid"];
}

if (isset($_POST["userlist"])) {
    $userlist=json_decode($_POST["userlist"]);
}

$data["id"] = $connection->insert($prefix.'survey', $data);

$count = count($userlist);
for($i =0;$i<$count;$i++)
{
    $dataTemp = array(
        "surveyid"=>$data["id"],
        "userid"=>$userlist[$i],
    );
    $connection->insert($prefix.'link_survey_user', $dataTemp);
}


echo "ok";

echo EncodingClass::fromVariable($data);

?>