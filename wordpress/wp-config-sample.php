<?php
// ** MySQL settings ** //
define('DB_NAME', 'putyourdbnamehere');    // データベース名
define('DB_USER', 'usernamehere');     // ユーザー名
define('DB_PASSWORD', 'yourpasswordhere'); // パスワード
define('DB_HOST', 'localhost');    // データベースサーバ (ほとんどの場合変更する必要はありません)
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// それぞれの KEY を独自のフレーズに変更してください。あとで思い出す必要はないので長くて複雑なものにしてください。
// http://api.wordpress.org/secret-key/1.1/ を訪れればフレーズを生成してくれます。
// もしくは適当なフレーズをご自分でお作りください。
// それぞれの KEY は異なるフレーズにしてください。
define('AUTH_KEY', 'put your unique phrase here'); // 固有のフレーズに変更してください。
define('SECURE_AUTH_KEY', 'put your unique phrase here'); // 固有のフレーズに変更してください。
define('LOGGED_IN_KEY', 'put your unique phrase here'); // 固有のフレーズに変更してください。

// テーブルの接頭辞を指定します。複数設置する場合など適宜変更してください。
$table_prefix  = 'wp_';   // 半角英数字と下線のみが使用できます。

// こちらを変更することで WordPress をローカライズできます。対応する
// mo ファイルを wp-content/languages 以下にアップロードしてください。
// 例えば、ja.mo を wp-content/languages にアップロードし、WPLANG に 'ja'
// と設定すると、日本語 (UTF-8) がサポートされます。
// (訳注: このパッケージでは日本語 (UTF-8) が設定されているので、そのままお使いの場合は
// 変更する必要はありません。)
define ('WPLANG', 'ja');

/* 編集はここまでです ! WordPress でブログをお楽しみください。 */

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');
?>
