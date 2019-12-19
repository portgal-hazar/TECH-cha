<!DOCTYPE html>
<html lang = "ja">
	<head>
		<meta charset = "UTF-8">
	<title>募集一覧</title>
	</head>
	<body>
	<center><h1>＜復興ボランティア一覧＞</h1>
	<hr>
<strong><p>予約番号  |  募集者・団体名  |  場所  |  日時  |  アクセス  |  申し込み期限  |  その他  | </p></strong></center>
<hr>
	<?php
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = 'SELECT * FROM bosyu_test2';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();

foreach ($results as $row){

//	echo '<input type="checkbox" name="check" value="">';
	echo $row['id'].' | ';
	echo $row['name'].' | ';
	echo $row['naiyo'].' | ';
	echo $row['place'].' | ';
	echo $row['daytime'].' | ';
	echo $row['access'].' | ';
	echo $row['kigen'].' | ';
	echo $row['other'].' | ';
//	echo '<input type="submit" name="yoyaku" value="予約"><br>';
	echo "<hr>";
}
?>
	<form method="POST" action = "mission_7-1_yoyaku.php">
<br>
<center><input type="text" name="number" value="" placeholder="予約番号(1つのみ)">	
<input type="submit" name="yoyaku" value="予約する"><br><br>
	</form>
<?php
if(!empty($_POST['number'])){
echo "予約しました";

}else{
echo "エラーです。";
}

?>
</center>
</body>
</html>
