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
    $id=$_POST["examinationid"];
}else
{
    echo "Invalid examinationid";
    exit();
}

$connection->query("DELETE FROM ".$prefix."link_examination_survey WHERE examinationid=".$id);

echo "ok";

?>