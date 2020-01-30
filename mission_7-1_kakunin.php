<!DOCTYPE html>
<html lang = "ja">
	<head>
		<meta charset = "UTF-8">
	<title>予約確認画面</title>
	</head>
	<body>
	<center><h1>予約確認</h1>
	<hr>

<?php
	session_start();
	$yoyaku_id = $_SESSION['yoyaku_id'];
	$mail2 = $_SESSION['mail'];
	$name2 = $_SESSION['gaku_name'];


	$dsn = 'mysql:dbname=データベース名;host=localhost';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	$sql = 'SELECT * FROM Rec_kansei5 where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id',$yoyaku_id, PDO::PARAM_INT);
	$stmt->execute();

	$results = $stmt->fetchAll();
	foreach ($results as $row){
		$id = $row['id'];
		$name = $row['name'];
		$naiyo = $row['naiyo'];
		$place = $row['place'];
		$daytime = $row['daytime'];
		$access = $row['access'];
		$line = $row['line'];
		$other = $row['other'];
	}
	$pdo=NULL;


?>
	<form method="POST" action = "mission_7-1_kakunin_kouyou.php">
	<table border="1">
		<tr>
			<th bgcolor=b0c4de>予約番号</th>
			<td><input type="text" name="id" value=<?php echo $id ?> placeholder="予約番号"></td>
		</tr>
		<tr>
			<th bgcolor=b0c4de>募集者・団体名</th>
			<td><input type="text" name="name" value=<?php echo $name ?> placeholder="募集者名・団体名"></td>

		</tr>
		<tr>
			<th bgcolor=b0c4de>内容</th>
			<td><input type="text" name="naiyo" value=<?php echo $naiyo ?> placeholder="内容"></td>

		</tr>
		<tr>
			<th bgcolor=b0c4de>場所</th>
			<td><input type="text" name="place" value=<?php echo $place ?> placeholder="場所"></td>

		</tr>

		<tr>
			<th bgcolor=b0c4de>日時</th>
			<td><input type="text" name="daytime" value=<?php echo $daytime ?> placeholder="日時"></td>

		</tr>
		<tr>
			<th bgcolor=b0c4de>アクセス</th>
			<td><input type="text" name="access" value=<?php echo $access ?> placeholder="アクセス"></td>

		</tr>
		<tr>
			<th bgcolor=b0c4de>募集者連絡先</th>
			<td><input type="text" name="line" value=<?php echo $line ?> placeholder="募集者連絡先"></td>

		</tr>

		<tr>
			<th bgcolor=b0c4de>その他</th>
			<td><input type="text" name="other" value=<?php echo $other ?> placeholder="持ち物など"></td>

		</tr>
		<tr>
			<th bgcolor=b0c4de>お名前</th>
			<td><input type="text" name="name2" value=<?php echo $name2 ?> placeholder="本人名前"></td>

		</tr>
		<tr>
			<th bgcolor=b0c4de>メールアドレス(半角)</th>
			<td><input type="text" name="mail2" value=<?php echo $mail2 ?> placeholder="メールアドレス"></td>

		</tr>
		<tr>
			<th bgcolor=b0c4de>電話番号(半角)</th>
			<th><input type="text" name="phone_number" value="" placeholder="電話番号"></th>
		</tr>

		<tr>
			<th bgcolor=b0c4de>性別</th>
			<th><select name="seibetu" seibetu="seibetu" id="pref">
				<option value="what">--- 選択してください ---</option>
				<option value="男性">男性</option>
				<option value="女性">女性</option>
				<option value="その他">その他</option>
			</select>
		</tr>

	</table>
		
<br><br><input type="submit" name="kakutei" value="確定する"><br><br>
	</form>

<?php 



$name=" ";
$mail=" ";



if(empty($_POST["phone_number"])){
	echo "「電話番号」と「性別」を入力してください!!";
}else{
$name=" ";
$mail=" ";

$dsn = 'mysql:dbname=tb210621db;host=localhost';
$user = 'tb-210621';
$password = '32FyTj7yt7';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//sessionでログイン情報獲得
$usermail = $_POST["mail2"];
$sql = "SELECT*FROM gaku_hontouroku2 WHERE newmail=:newmail"; 
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(":newmail", $usermail, PDO::PARAM_STR);
	$results=$stmt->fetchall();
foreach($results as $row){
	$name=$row["nicname"];
}


/*変数定義*/
	$yoyaku_number = $_POST['id'];
	$nitiji = $_POST['daytime'];
	$bosyu_dan = $_POST['name'];
	$bosyu_mail = $_POST['line'];
	$gaku_name = $_POST['name2'];
	$dennwa = $_POST['phone_number'];
	$address = $_POST['mail2'];
/*テーブルに挿入*/
	$sql = $pdo -> prepare("INSERT INTO kakunin_gamen2 (id, daytime, b_name, g_name, phone_number, mail) VALUES (:id, :daytime, :b_name, :g_name, :phone_number, :mail)");
            $sql -> bindParam(':id', $yoyaku_number, PDO::PARAM_STR);
            $sql -> bindParam(':daytime', $nitiji, PDO::PARAM_STR);
            $sql -> bindParam(':b_name', $bosyu_dan, PDO::PARAM_STR);
            $sql -> bindParam(':g_name', $gaku_name, PDO::PARAM_STR);
            $sql -> bindParam(':phone_number', $dennwa, PDO::PARAM_STR);
            $sql -> bindParam(':mail', $address, PDO::PARAM_STR);

            $sql->execute();


	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		$id=$_POST["id"];
		$sql="SELECT * FROM mission7 WHERE id=:id";
		$send=$pdo->prepare($sql);
		$send->bindParam(":id", $id, PDO::PARAM_INT);
		$newmail=$send->fetchall();
	foreach($newmail as $host){
		$host_name=$host["nicname"];
		$host_mail=$host["newmail"];
	}
		
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'setting.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();  
    $mail->SMTPAuth = true;
    $mail->Host = MAIL_HOST;  
    $mail->Username = MAIL_USERNAME;  
    $mail->Password = MAIL_PASSWORD;  
    $mail->SMTPSecure = MAIL_ENCRPT;  
    $mail->Port = SMTP_PORT; 

    // メール内容設定
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "base64";
    $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
    $mail->addAddress($address, $gaku_name.'さん');
    $mail->AddCC($line,$bosyu_dan.'さん'); 
/**///$mail->addAddress($host_mail,$host_name);/*ここの部分*/
    $mail->Subject = MAIL_SUBJECT; 
    $mail->isHTML(true);  
    $body = "以下の内容で予約されました！確認してください<br><br>"
		."氏名：".$_POST['name2']."<br>"
		."日時:".$_POST['daytime']."<br>"
		."場所：".$_POST['place']."<br>"
		."内容：".$_POST['naiyo']."<br>"
		."アクセス：".$_POST['access']."<br>"
		."募集者連絡先：".$_POST['line']."<br>"
		."その他：".$_POST['other']."<br>";
	    

    $mail->Body  = $body; // メール本文
    // メール送信の実行
    if(!$mail->send()) {
    	echo 'メッセージは送られませんでした！';
    	echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    	echo 'メールをおくりました。確認してください!!<br>';
	echo '<a href="mission_7-1_yoyaku2.php">ボランティア一覧画面へ戻る</a> ';
    }

}
?>

</center>
