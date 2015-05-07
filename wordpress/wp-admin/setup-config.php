<?php
define('WP_INSTALLING', true);

require_once('../wp-includes/compat.php');
require_once('../wp-includes/functions.php');
require_once('../wp-includes/classes.php');

if (!file_exists('../wp-config-sample.php'))
	wp_die('wp-config-sample.php が見つかりません。WordPress インストールファイルから再アップロードしてください。');

$configFile = file('../wp-config-sample.php');

if ( !is_writable('../')) 
	wp_die("インストールディレクトリに書き込めません。インストールするディレクトリの属性を変更するか、手動で wp-config.php を作成してください。");

// Check if wp-config.php has been created
if (file_exists('../wp-config.php'))
	wp_die("<p>'wp-config.php' ファイルは既に作成済みです。このファイル内の設定項目をリセットする必要があるのなら、このファイルを削除してください。その後で <a href='install.php'>インストールを実行してください</a>。</p>");

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 0;

function display_header(){
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WordPress &rsaquo; セットアップ設定ファイル</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style media="screen" type="text/css">
	<!--
	html {
		background: #eee;
	}
	body {
		background: #fff;
		color: #000;
		font-family: Georgia, "Times New Roman", Times, serif;
		margin-left: 20%;
		margin-right: 20%;
		padding: .2em 2em;
	}

	h1 {
		color: #006;
		font-size: 18px;
		font-weight: lighter;
	}

	h2 {
		font-size: 16px;
	}

	p, li, dt {
		line-height: 140%;
		padding-bottom: 2px;
	}

	ul, ol {
		padding: 5px 5px 5px 20px;
	}
	#logo {
		margin-bottom: 2em;
	}
	.step a, .step input {
		font-size: 2em;
	}
	td input {
		font-size: 1.5em;
	}
	.step, th {
		text-align: right;
	}
	#footer {
		text-align: center;
		border-top: 1px solid #ccc;
		padding-top: 1em;
		font-style: italic;
	}
	-->
	</style>
</head>
<body>
<h1 id="logo"><img alt="WordPress" src="images/wordpress-logo.png" /></h1>
<?php
}//end function display_header();

switch($step) {
	case 0:
		display_header();
?>

<p>WordPress へようこそ。あらかじめデータベースに関する若干の情報を用意してください。作業を進める前に以下のデータベース情報を知っている必要があります。</p>
<ol>
	<li>データベース名</li>
	<li>データベースのユーザー名</li>
	<li>データベースのパスワード</li>
	<li>データベースのホスト名</li>
	<li>テーブル接頭語 (あなたが 1 つのデータベースで複数の WordPress を構築する場合)</li>
</ol>
<p><strong>もし何かが原因で自動ファイル生成が動作しなくても心配しないでください。その場合は設定ファイルにデータベース情報を記入することです。テキストエディタで <code>wp-config-sample.php</code> を開き、データベース接続の詳細を記入してこのファイルの名前を <code>wp-config.php</code> として保存します。</strong></p>
<p>これらのデータベース情報はインターネットサービスプロバイダが提供しています。データベース情報がわからない場合、作業を続行する前にプロバイダーと連絡を取る必要があります。すべての準備が整っているなら、<a href="setup-config.php?step=1">次に進みましょう !</a></p>
<?php
	break;

	case 1:
		display_header();
	?>
</p>
<form method="post" action="setup-config.php?step=2">
	<p>以下にデータベース接続のためのデータを入力してください。これらのデータについて分からない点があれば、あなたのホストに連絡を取ってください。</p>
	<table>
		<tr>
			<th scope="row">データベース名</th>
			<td><input name="dbname" type="text" size="25" value="wordpress" /></td>
			<td>WP を稼動させたいデータベースの名前</td>
		</tr>
		<tr>
			<th scope="row">ユーザー名</th>
			<td><input name="uname" type="text" size="25" value="username" /></td>
			<td>MySQL のユーザー名</td>
		</tr>
		<tr>
			<th scope="row">パスワード</th>
			<td><input name="pwd" type="text" size="25" value="password" /></td>
			<td>MySQL のパスワード</td>
		</tr>
		<tr>
			<th scope="row">データベースのホスト名</th>
			<td><input name="dbhost" type="text" size="25" value="localhost" /></td>
			<td>この値は 99% 変える必要はないでしょう</td>
		</tr>
		<tr>
			<th scope="row">テーブル接頭語</th>
			<td><input name="prefix" type="text" id="prefix" value="wp_" size="25" /></td>
			<td>1 つのデータベースで複数の WordPress を動かすときに変更します</td>
		</tr>
	</table>
	<h2 class="step">
	<input name="submit" type="submit" value="作成する" />
	</h2>
</form>
<?php
	break;

	case 2:
	$dbname  = trim($_POST['dbname']);
	$uname   = trim($_POST['uname']);
	$passwrd = trim($_POST['pwd']);
	$dbhost  = trim($_POST['dbhost']);
	$prefix  = trim($_POST['prefix']);
	if (empty($prefix)) $prefix = 'wp_';

	// Test the db connection.
	define('DB_NAME', $dbname);
	define('DB_USER', $uname);
	define('DB_PASSWORD', $passwrd);
	define('DB_HOST', $dbhost);

	// We'll fail here if the values are no good.
	require_once('../wp-includes/wp-db.php');
	if ( !empty($wpdb->error) )
		wp_die($wpdb->error->get_error_message());

	$handle = fopen('../wp-config.php', 'w');

	foreach ($configFile as $line_num => $line) {
		switch (substr($line,0,16)) {
			case "define('DB_NAME'":
				fwrite($handle, str_replace("putyourdbnamehere", $dbname, $line));
				break;
			case "define('DB_USER'":
				fwrite($handle, str_replace("'usernamehere'", "'$uname'", $line));
				break;
			case "define('DB_PASSW":
				fwrite($handle, str_replace("'yourpasswordhere'", "'$passwrd'", $line));
				break;
			case "define('DB_HOST'":
				fwrite($handle, str_replace("localhost", $dbhost, $line));
				break;
			case '$table_prefix  =':
				fwrite($handle, str_replace('wp_', $prefix, $line));
				break;
			default:
				fwrite($handle, $line);
		}
	}
	fclose($handle);
	chmod('../wp-config.php', 0666);
	
	display_header();
?>
<p>インストールの一部が完了しました。WordPress は現在データベースと通信できる状態にあります。準備ができているならば、<a href="install.php">インストールを実行しましょう !</a></p>
<?php
	break;
}
?>
<p id="footer"><a href="http://wordpress.org/">WordPress</a>, personal publishing platform.</p>
</body>
</html>
