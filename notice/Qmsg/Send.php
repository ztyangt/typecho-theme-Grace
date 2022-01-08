<?php 

Typecho_Plugin::factory('Widget_Feedback')->finishComment = array("Qmsg", 'sendQmsg');
Typecho_Plugin::factory('Widget_Comments_Edit')->finishComment = array("Qmsg", 'sendQmsg');
class Qmsg {
    public static function sendQmsg($comment)
    {
        if ($comment->authorId != $comment->ownerId) {
            self::send($comment);
        }
    }

    private static function send($comment)
    {
    	$options = Helper::options();
        $msg = '【网站评论提醒】' . PHP_EOL . PHP_EOL
            . '标题：《' . $comment->title . '》' . PHP_EOL
            . '访客：' . $comment->author . PHP_EOL
            . '邮箱：' . $comment->mail . PHP_EOL
            . '链接：' . $comment->permalink . PHP_EOL
            . '内容：' . $comment->text ;
        $api = "https://qmsg.zendee.cn/send/";
        $params = [
            'qq' => $options->Qmsg_qq,
            'msg' => $msg
        ];
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($params)
            ]
        ]);
        $result = file_get_contents($api.$options->Qmsg_key, false, $context);
    }
}
