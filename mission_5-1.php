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
		<h4>【 編集フォーム 】----------</h4>
		 <input type="text" name="Edit" value="" placeholder = "編集番号"><br>
		 <input type="password" name="E_pas" value="" placeholder = "パスワード">
		                 <input type="submit" name="submit3" value="編集"><br><br>
---------------------------------------------------------------------------
	</form>


<?php

		
		$error = "";
	session_start();
	if(empty($_POST["name"]) && (empty($_POST["comment"]) && (empty($_POST["DeleteNumber"]) && (empty($_POST["Edit"]) && (empty($_POST["T_num"])))))){
	
		echo "<strong>投稿フォーム：</strong>名前とコメント，パスワードを埋めてください。<br>";
		echo "<font color='red'>※投稿した際のパスワードは削除と編集する際に必要です※</font><br>";
		echo "<strong>削除フォーム：</strong> 削除したい投稿番号とパスワードを入力！<br>";
		echo "<strong>編集フォーム：</strong> 編集したい投稿番号とパスワードを入力！<br>";

	}elseif(!empty($_POST["T_num"]) && (!empty($_POST["NC_pas"]) && (!empty($_POST["name"]) && (!empty($_POST["comment"]))))){
		$error = "";
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['comment'] = $_POST['comment'];
		$_SESSION['T_num'] = $_POST['T_num'];
		$_SESSION['NC_pas'] = $_POST['NC_pas'];
		header("Location: mission_5-1-5.php");

	}elseif(!empty($_POST["name"]) && (!empty($_POST["comment"]) && (!empty($_POST["NC_pas"])))){  //フォームが空でないとき
		$error = "";
		$_SESSION['name'] = $_POST['name']; //SESSIONは一時的にデータベースに保存される
 		$_SESSION['comment'] = $_POST['comment'];
		$_SESSION['NC_pas'] = $_POST['NC_pas'];
 		header("Location: mission_5-1-2.php"); //hedder関数＝別のページに移動するための関数

 	}elseif(!empty($_POST["DeleteNumber"]) && (!empty($_POST["D_pas"]))){
		$error = "";
		$_SESSION['DeleteNumber'] = $_POST['DeleteNumber'];
		$_SESSION['D_pas'] = $_POST['D_pas'];
		header("Location: mission_5-1-3.php");

	}elseif(!empty($_POST["Edit"]) && (!empty($_POST["E_pas"]))){
		$error = "";
		$_SESSION['Edit'] = $_POST['Edit'];
		$_SESSION['E_pas'] = $_POST['E_pas'];
		header("Location: mission_5-1-4.php");
	}else{
		$error = "<strong>入力内容をご確認ください。</strong><br>"."パスワードも<strong>必ず</strong>埋めてください。<br>";
		echo $error;
	}
?>

	</body>
</html>