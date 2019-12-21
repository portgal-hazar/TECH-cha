<!DOCTYPE html>
<html lang = "ja">
	<head>
		<meta charset = "UTF-8">
	<title>募集一覧</title>
	</head>
	<body>
	<center><h1>＜復興ボランティア一覧＞</h1>
	<hr>

	<?php
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = 'SELECT * FROM bosyu_test2';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
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
	<form method="POST" action = "mission_7-1_kakunin.php">
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
