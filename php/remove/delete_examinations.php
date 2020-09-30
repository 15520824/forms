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


if (isset($_POST["id"])) {
    $id=$_POST["id"];
}else
{
    echo "Invalid id";
    exit();
}

$connection->query("DELETE FROM ".$prefix."link_examination_survey WHERE examinationid=".$id);

$connection->query("DELETE FROM ".$prefix."link_examination_user WHERE examinationid=".$id);

$connection->query("DELETE FROM ".$prefix."examination WHERE id=".$id);

echo "ok";

echo EncodingClass::fromVariable($id);

?>