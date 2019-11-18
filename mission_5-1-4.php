
<?php

/*****データベースへ接続*****/
session_start();
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

/*****変数の宣言*****/
$error = "";
$id = $_SESSION['Edit'];
$EdiPas = $_SESSION['E_pas'];

/**/
$sql = 'SELECT * FROM tbcha2 where id=:id ';//どのようにして選択されたidを持ってくる？
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetchAll();
foreach($results as $row){
$pass = $row['password'];
}
/***/
if($EdiPas == $pass){
	$error = "";

$sql = 'SELECT * FROM tbcha2 where id=:id ';//どのようにして選択されたidを持ってくる？
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
//$stmt = $pdo->query($sql);//これはなんのため？
$results = $stmt->fetchAll();
foreach ($results as $row){

$newnum =$row['id'];
$newname =$row['name'];
$newcomment =$row['comment'];
}

echo "<strong>--編集画面--</strong>";

}else{
$error = "<font color=red><strong>※-------パスワードが違います-------※</strong></font><br>";
echo $error."<br>";
echo "<hr>";

$newnum ="";
$newname ="";
$newcomment ="";
}
?>


<!DOCTYPE html>
<html lang = "ja">
	<head>
		<meta charset = "UTF-8">
		<title>WEB掲示板_DB</title>
	</head>
	<body>

	<form method="POST" action = "mission_5-1.php"><br>
	<h4>	【 投稿フォーム 】----------</h4>
		  <input type="text" name="name" value="<?php echo $newname; ?>" placeholder ="名前"><br>
		  <input type ="text" name="comment" value="<?php echo $newcomment; ?>" placeholder = "コメント"><br>
		  <input type = "password" name="NC_pas" value="" placeholder = "パスワード">
		   <input type="submit" name="submit" value="送信"><br><br>

		<input type="hidden" name="T_num" value="<?php echo $newnum; ?>"><!--編集機能--!>

	<h4>	【 削除フォーム 】----------</h4>
		 <input type="text" name="DeleteNumber" value="" placeholder = "削除番号"><br>
		 <input type="password" name="D_pas" value="" placeholder = "パスワード">
                 <input type="submit" name="submit2" value="削除"><br><br>
	<h4>	【 編集フォーム 】----------</h4>
		 <input type="text" name="Edit" value="" placeholder = "編集番号"><br>
		 <input type="password" name="E_pas" value="" placeholder = "パスワード">
		                 <input type="submit" name="submit3" value="編集"><br><br>
---------------------------------------------------------------------------
	</form>

	</body>
</html>






