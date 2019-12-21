<!DOCTYPE html>
<html lang = "ja">
	<head>
		<meta charset = "UTF-8">
	<title>募集登録</title>
	</head>
	<body>
	<center><h1>＜ボランティア募集登録＞</h1>
	<hr>
	<form method="POST" action = "mission_7-1_bosyu.php">
	<table border="1">
	<tr>
		<th bgcolor=b0c4de>募集者・団体名</th>
		<th><input type="text" name="name" value="" placeholder="例：募集太郎"></th>
	</tr>
	<tr>
		<th bgcolor=b0c4de>内容</th>
		<th><textarea name="naiyo" value=""  style="width:200px; height:100px;" cols="40" rows="8">
		</textarea></th>
	</tr>
	<tr>
		<th bgcolor=b0c4de>場所</th>
		<th><input type="text" name="place" value="" placeholder="例：○○県○○市○○区"></th>
	</tr>
	<tr>
		<th bgcolor=b0c4de>日時</th>
		<th><input type="text" name="daytime" value="" placeholder="例：2019年12月20日 10：00～13：00"></th>
	</tr>

	<tr>
		<th bgcolor=b0c4de>交通アクセス</th>
		<th><input type="text" name="access" value="" placeholder="交通アクセス"></th>
	</tr>
	<tr>
		<th bgcolor=b0c4de>募集期限</th>
		<th><input type="text" name="kigen" value="" placeholder="例：2019/12/20"></th>
	</tr>

	<tr>
		<th bgcolor=b0c4de>その他</th>
		<th><textarea name="other" value="" style="width:200px; height:100px;" cols="40" rows="8">
		</textarea></th>
	</tr>
	</table>
<br><br><input type="submit" name="yoyaku" value="募集する"></center>
	</form>

<?php
if(!empty($_POST["name"]) && (!empty($_POST["naiyo"]) && (!empty($_POST["place"]) && (!empty($_POST["daytime"]) && (!empty($_POST["access"]) && (!empty($_POST["kigen"]) && (!empty($_POST["other"])))))))){

$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$name = $_POST['name'];
$naiyo = $_POST['naiyo'];
$place = $_POST['place'];
$daytime = $_POST['daytime'];
$access = $_POST['access'];
$kigen = $_POST['kigen'];
$other = $_POST['other'];
$sql = $pdo -> prepare('INSERT INTO bosyu_test2 (name, naiyo, place, daytime, access, kigen, other) VALUES(:name, :naiyo, :place, :daytime, :access, :kigen, :other)');
$sql -> bindParam(':name', $name, PDO::PARAM_STR);  //登録する文字列の固定
$sql -> bindParam(':naiyo', $naiyo, PDO::PARAM_STR); //上に同じ
$sql -> bindParam(':place', $place, PDO::PARAM_STR);
$sql -> bindParam(':daytime', $daytime, PDO::PARAM_STR);
$sql -> bindParam(':access', $access, PDO::PARAM_STR);
$sql -> bindParam(':kigen', $kigen, PDO::PARAM_STR);
$sql -> bindParam(':other', $other, PDO::PARAM_STR);
$sql -> execute(); //データベースの登録を実行

$sql = 'SELECT * FROM bosyu_test2';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
echo "<strong>募集しました。</strong><br><br>";
echo "<hr>";
?>

<table  border="1">
<tr>
<th scope="col">予約番号</th>
<th scope="col">募集者・団体名</th>
<th scope="col">場所</th>
<th scope="col">日時</th>
<th scope="col">アクセス</th>
<th scope="col">申し込み期限</th>
<th scope="col">その他</th>
</tr>		
		
<?php		
foreach ($results as $row){
?>
	
<tr>
<td><?php echo $row['id']; ?> </td>
<td><?php echo $row['name'] ; ?> </td>
<td><?php echo $row['naiyo'] ; ?> </td>
<td><?php echo $row['place'] ; ?> </td>
<td><?php echo $row['daytime'] ; ?> </td>
<td><?php echo $row['kigen'] ; ?> </td>
<td><?php echo $row['other'] ; ?> </td>
</tr>

<?php
}
?>
</table>
		
<?php
}else{
echo "すべて埋めてください。";
}

$pdo = NULL;

?>
</body>
</html>
