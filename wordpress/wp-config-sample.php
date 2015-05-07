<?php
// ** MySQL データベース設定 ** //
define('DB_NAME', 'putyourdbnamehere');    // データベース名
define('DB_USER', 'usernamehere');     // ユーザー名
define('DB_PASSWORD', 'yourpasswordhere'); // パスワード
define('DB_HOST', 'localhost');    // データベースサーバ (ほとんどの場合変更する必要はありません)
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// テーブルの接頭語を指定します。複数設置する場合など適宜変更してください。
$table_prefix  = 'wp_';   // 半角英数、アンダースコアが使用できます。

// こちらを変更することで WordPress をローカライズできます。対応する
// mo ファイルを wp-content/languages 以下にアップロードしてください。
// 例えば、ja.mo を wp-content/languages にアップロードし、WPLANG に 'ja'
// と設定すると、日本語 (UTF-8) がサポートされます。
// このパッケージでは日本語 (UTF-8) が設定されているので、そのままお使いの場合は
// 変更する必要はありません。
define ('WPLANG', 'ja');

/* 編集はここまでです。WordPress でブログをお楽しみください ! */

define('ABSPATH', dirname(__FILE__).'/');
require_once(ABSPATH.'wp-settings.php');
?>