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

if (isset($_POST["surveyid"])) {
    $data["surveyid"]=$_POST["surveyid"];
}else
{
    echo "Invalid surveyid";
    exit();
}

if (isset($_POST["longtime"])) {
    $data["longtime"]=$_POST["longtime"];
}else
{
    echo "Invalid longtime";
    exit();
}

$search = $connection->load($prefix.'link_examination_survey',"(surveyid = ".$data["surveyid"].") AND (examinationid = ".$_POST["examinationid"].")");
if (count($search) > 0){
    $data["id"]=$search[0]["id"];
    $connection->update($prefix.'link_examination_survey',$data);
}
else{
    $data["id"] = $connection->insert($prefix.'link_examination_survey', $data);
}

echo "ok";

echo EncodingClass::fromVariable($data);

?>