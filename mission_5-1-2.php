<?php
		$newname = "";
		$newcomment = "";
		$newnum = "";

?>


<!DOCTYPE html>
<html lang = "ja">
	<head>
		<meta charset = "UTF-8">
		<title>WEB掲示板_DB</title>
	</head>
	<body>

	<form method="POST" action = "mission_5-1.php"><br>
	<h4>【 投稿フォーム 】----------</h4>
		  <input type="text" name="name" value="<?php echo $newname; ?>" placeholder ="名前"><br>
		  <input type ="text" name="comment" value="<?php echo $newcomment; ?>" placeholder = "コメント"><br>
		  <input type = "password" name="NC_pas" value="" placeholder = "パスワード">
		   <input type="submit" name="submit" value="送信"><br><br>

		<input type="hidden" name="T_num" value="<?php echo $newnum; ?>"><!--編集機能--!>

	<h4>【 削除フォーム 】----------</h4>
		 <input type="text" name="DeleteNumber" value="" placeholder = "削除番号"><br>
		 <input type="password" name="D_pas" value="" placeholder = "パスワード">
                 <input type="submit" name="submit2" value="削除"><br><br>
	<h4>	【 編集フォーム 】----------</h4>
		 <input type="text" name="Edit" value="" placeholder = "編集番号"><br>
		 <input type="password" name="E_pas" value="" placeholder = "パスワード">
		                 <input type="submit" name="submit3" value="編集"><br><br>
---------------------------------------------------------------------------
	</form>




<?php
session_start();
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


//↓tbcha内にある(name や comment)という列にnameやcommentという変数に入れた値を挿入する
$name = $_SESSION['name'];
$comment = $_SESSION['comment'];
$pass = $_SESSION['NC_pas'];
$date = date("Y-m-d H:i:s");
$sql = $pdo -> prepare('INSERT INTO tbcha2 (name, comment,date,password) VALUES(:name, :comment, :date, :password)'); //登録準備
$sql -> bindParam(':name', $name, PDO::PARAM_STR);  //登録する文字列の固定
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR); //上に同じ
$sql -> bindParam(':date', $date, PDO::PARAM_STR);
$sql -> bindParam(':password', $pass, PDO::PARAM_STR);
$sql -> execute(); //データベースの登録を実行
//$pdo = NULL; //データベース接続を解除

$sql = 'SELECT * FROM tbcha2';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
echo "<strong>ありがとうございます。 コメントを追加しました！</strong><br><br>";
echo "<hr>";
$newnum ="";
$newname ="";
$newcomment ="";
foreach ($results as $row){
	echo $row['id'].' ';
	echo $row['name'].' ';
	echo $row['comment'].' ';
	echo $row['date'].'<br>';
echo "<hr>";
}

$pdo = NULL;
?>


	</body>
</html>