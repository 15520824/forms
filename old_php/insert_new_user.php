<?php 
include_once "../jsdb.php";
include_once "../jsencoding.php";
include_once "../prefix.php";
include_once "../connection.php";

$connection = DatabaseClass::init($host, $username, $password, $dbname);
if ($connection == null){
    echo "Can not connect to database!";
    exit();
}

// if (!isset($_SESSION[$prefixhome."userid"])) {
//     echo "Bạn đã đăng xuất, bạn cần đăng nhập lại để tiếp tục sử dụng phần mềm
// Để đăng nhập lại bạn nhấn F5 hoặc tải lại trang web";
//     exit();
// }

$data = array(
);
if (isset($_POST["homeid"])) {
    $data["homeid"]=(int)$_POST["homeid"];
}
if (isset($_POST["privilege"])) {
    $data["privilege"]=(int)$_POST["privilege"];
}
if (isset($_POST["language"])) {
    $data["language"]=$_POST["language"];
}
if (isset($_POST["available"])) {
    $data["available"]=(int)$_POST["available"];
}
if (isset($_POST["comment"])) {
    $data["comment"]=$_POST["comment"];
}
if (isset($_POST["theme"])) {
    $data["theme"]=(int)$_POST["theme"];
}

$data["id"] = $connection->insert($prefix.'users', $data);
echo "ok";

echo EncodingClass::fromVariable($data);

?>