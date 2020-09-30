<?php 
include_once "../../jsdb.php";
include_once "../../jsencoding.php";
include_once "../../prefix.php";
include_once "../../connection.php";

$prefixlocal = $prefix;
if (isset($_POST["dbname"])) {
    $dbnamehost=$_POST["dbname"];
    $connection = DatabaseClass::init($host, $username, $password, $dbnamehost);
}else
$connection = DatabaseClass::init($host, $username, $password, $dbname);

if (isset($_POST["prefix"])) {
    $prefixlocal=$_POST["prefix"];
}

if ($connection == null){
    echo "Can not connect to database!";
    exit();
}

if (isset($_POST["id"])) {
    $surveyid=$_POST["id"];
}else
{
    echo "Invalid surveyid";
    exit();
}

$data = $connection->load($prefixlocal.'link_survey_user', "surveyid=".$surveyid);
$count = count($data);
$result = array();
for($i = 0;$i<$count;$i++)
{
    array_push($result,$data[$i]["userid"]);
}

echo "ok";
echo EncodingClass::fromVariable($result);
?>