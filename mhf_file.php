<?php

if (isset($_GET['key'])) {
    $platform = "00"; // デフォルトのプラットフォームコード
	$zero = "00";
    $userAgent = $_SERVER['HTTP_USER_AGENT']; // ユーザーエージェントの値を取得

    // 日本語版クライアントからのリクエストをチェック
    if (strpos($userAgent, "Monster Hunter Frontier Online Launcher Release Jpn.  1.500") !== false) {
        $platform = "JP"; // 日本語版用のプラットフォームコードに設定
    }

    // 英語版クライアントからのリクエストをチェック
    if (strpos($userAgent, "Monster Hunter Frontier Online Launcher Release Eng.  ENG") !== false) {
        $platform = "EN"; // 英語版用のプラットフォームコードに設定
    }

    // ファイル名を指定してコンテンツを送信
    $filename = sprintf('MHFUP_%s.DAT', $zero);
    $filepath = sprintf('key%s.txt', $platform);
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($filepath));
    header('Connection: close');
    header('Content-Type: application/octet-stream');
    readfile($filepath);
}

if (isset($_GET['chk'])||isset($_GET['chksha'])) {
	header('Content-Length: '.filesize('chk.txt'));
	header('Connection: close');
	header('Content-Type: application/octet-stream');
	readfile('chk.txt');
}
