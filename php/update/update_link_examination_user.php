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

if (isset($_POST["arrValue"])) {
    $data["arrValue"]=EncodingClass::toVariable($_POST["arrValue"]);
}else
{
    exit();
}

if (isset($_POST["examinationid"])) {
    $data["examinationid"]=$_POST["examinationid"];
    $search = $connection->load($prefix.'link_examination_user',"(examinationid = ".$data["examinationid"].")");
    $check = array();
    for($i = 0 ;$i<count($search);$i++)
    {
        $check[$search[$i]["user_id"]] = $search[$i];
    }  
}else
{
    exit();
}

for($i = 0 ;$i<count($data["arrValue"]);$i++)
{
    if (isset($data["arrValue"][$i]["start"])) {
        $data["arrValue"][$i]["start"]=EncodingClass::toVariable($data["arrValue"][$i]["start"]);
    }
    
    if (isset($data["arrValue"][$i]["end"])) {
        $data["arrValue"][$i]["end"]=EncodingClass::toVariable($data["arrValue"][$i]["end"]);
    }

    $data["arrValue"][$i]["examinationid"] = $data["examinationid"];
    if (isset($check[$data["arrValue"][$i]["user_id"]])){
        $data["arrValue"][$i]["id"] = $check[$data["arrValue"][$i]["user_id"]]["id"];
        $connection->update($prefix.'link_examination_user',$data["arrValue"][$i]);
        unset($check[$data["arrValue"][$i]["user_id"]]);
    }
    else{
        $data["id"] = $connection->insert($prefix.'link_examination_user', $data["arrValue"][$i]);
    }
}

foreach($check as $param=>$value)
{
    $connection->query("DELETE FROM ".$prefix."link_examination_user WHERE id = ".$value["id"]);
    $connection->query("DELETE FROM ".$prefix."record WHERE record_testid = ".$value["id"]);
}

echo "ok";

echo EncodingClass::fromVariable($data);

?>