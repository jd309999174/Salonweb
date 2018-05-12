<?php
$id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
$sub = isset($_POST['sub']) ? htmlspecialchars($_POST['sub']) : '';

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=company", $username, $password);
    $conn->exec("set names utf8");
    echo "连接成功";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
if(!$sub || $sub=="%分类%"){
$stmt = $conn->prepare("SELECT prodphoto1, prodtitle, prodprice, prodoriginal FROM product where salnumber=".$id." or salnumber=0");
}else
{
    //$stmt = $conn->prepare("SELECT prodphoto1, prodtitle, prodprice, prodoriginal FROM product where prodtitle like '%'".$sub."'%' and salnumber=".$id." or salnumber=0");
    $stmt = $conn->prepare("SELECT prodphoto1, prodtitle, prodprice, prodoriginal FROM product where salnumber in ('0','".$id."') and prodtitle like '".$sub."'");
}
$stmt->execute();
?>
<div class="list">
<?php foreach ($stmt->fetchAll() as $k=>$v): ?>
    <a class="item item-thumbnail-left" href="#">
      <img src="<?php echo "/salon/".$id."/".$v[0]; ?>">
      <h2><?php echo $v[1]; ?></h2>
      <p style="color:red"><?php echo $v[2]; ?></p>
    </a>
<?php endforeach; ?>
</div>

