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


<?php
	/****データベースへ接続****/
		session_start();
		$dsn = 'mysql:dbname=データベース名;host=localhost';
		$user = 'ユーザー名';
		$password = 'パスワード';
		$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	/*****変数の宣言*****/
		$error = "";
		$id = $_SESSION['DeleteNumber'];
		$date = date("Y-m-d H:i:s");
		$DelPas = $_SESSION['D_pas'];

	/*****削除したい番号のpasswordを取得*****/
		$sql = 'SELECT * FROM tbcha2 where id=:id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id',$id,PDO::PARAM_INT);
		$stmt->execute();

		$results = $stmt->fetchAll();
	foreach ($results as $row){
			$pass = $row['password'];
	}

	if($DelPas == $pass){  //フォームのパスワードとパスワードが等しいとき
		$error = "<strong>-------削除しました。-------</strong>";
		echo $error."<br><br>";
		echo "<hr>";
	/***********削除の実行**********/
			$newnum ="";
			$newname ="";
			$newcomment ="";
			$sql = 'delete from tbcha2 where id=:id';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

	}else{  //等しくないとき
			$error = "<font color = red><strong>※-------パスワードが違います。-------※</strong></font><br>";
			echo $error."<br>";
			echo "<hr>";
			$newnum ="";
			$newname ="";
			$newcomment ="";

	}

			$sql = 'SELECT * FROM tbcha2';
			$stmt = $pdo->query($sql);
			$results = $stmt->fetchAll();
	foreach ($results as $row){
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['date'].'<br>';
		echo "<hr>";
	}
		$pdo = NULL;
?>


	</body>
</html>
