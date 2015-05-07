<?php

if (! isset($wp_did_header)):
if ( !file_exists( dirname(__FILE__) . '/wp-config.php') ) {
	if (strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) $path = '';
	else $path = 'wp-admin/';

	require_once( dirname(__FILE__) . '/wp-includes/classes.php');
	require_once( dirname(__FILE__) . '/wp-includes/functions.php');
	require_once( dirname(__FILE__) . '/wp-includes/plugin.php');
	wp_die("<p><code>wp-config.php</code> ファイルが見つかりません。インストールを開始するには wp-config.php ファイルが必要です。お困りでしたら<a href='http://codex.wordpress.org/Editing_wp-config.php'>こちら</a> を参照してください。ウィザード形式で <code>wp-config.php</code> ファイルを作成することもできますが、すべてのサーバーにおいて正常に動作するわけではありません。最も安全な方法は手動でファイルを作成することです。</p><p><a href='{$path}setup-config.php' class='button'><code>wp-config.php</code> ファイルを作成する</a></p>", "WordPress &rsaquo; エラー");
}

$wp_did_header = true;

require_once( dirname(__FILE__) . '/wp-config.php');

wp();

require_once(ABSPATH . WPINC . '/template-loader.php');

endif;

?>
