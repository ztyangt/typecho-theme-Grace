<?php 

Typecho_Plugin::factory('Widget_Feedback')->finishComment = array("Mail", 'sendMail');
Typecho_Plugin::factory('Widget_Comments_Edit')->finishComment = array("Mail", 'sendMail');
class Mail {
    public static function sendMail($comment)
    {
        if (0 < $comment->parent) {
            $parentComment = self::getWidget('Comments', 'coid', $comment->parent);
            if (isset($parentComment->coid) && $comment->authorId != $parentComment->authorId) {
                self::send($parentComment->mail, $comment, $parentComment);
            }
            return;
        }

        if ($comment->authorId != $comment->ownerId) {
            $author = self::getWidget('Users', 'uid', $comment->ownerId);
            self::send($author->mail, $comment, NULL);
        }
    }

    private static function getWidget($name, $key, $val)
    {
        $className = 'Widget_Abstract_' . $name;
        $widget = new $className(new Typecho_Request(), new Typecho_Response(), NULL);
        $db = Typecho_Db::get();
        $select = $widget->select()->where($key . ' = ?', $val)->limit(1);
        $db->fetchRow($select, array($widget, 'push'));
        return $widget;
    }

    private static function send($mail, $comment, $parentComment)
    {
        $options = Helper::options();
        $data = array(
            'fromName'  => (!isset($options->smtp_name) || $options->smtp_name === null || empty($options->smtp_name)) ? trim($options->title) : $options->smtp_name,
            'from'      => $options->smtp_mail,
            'to'        => $mail,
            'replyTo'   => $options->smtp_replyto,
        );
        if ($parentComment !== null) {
            $data['subject'] = '您在 [' . $options->title . '] 的评论有了新的回复！';
            $html = file_get_contents(__DIR__ . '/theme/reply.html');
            $post = self::getWidget('Contents', 'cid', $parentComment->cid);
            $data['html'] = str_replace(array(
                '{blogUrl}',
                '{blogName}',
                '{description}',
                '{author}',
                '{permalink}',
                '{title}',
                '{text}',
                '{replyAuthor}',
                '{replyText}',
                '{commentUrl}'
            ), array(
                trim($options->siteUrl),
                trim($options->title),
                trim($options->description),
                trim($parentComment->author),
                trim($post->permalink),
                trim($post->title),
                str_replace(PHP_EOL, '<br>', trim($parentComment->text)),
                trim($comment->author),
                str_replace(PHP_EOL, '<br>', trim($comment->text)),
                trim($comment->permalink)
            ), $html);
        } else {
            $data['subject'] = '您在 [' . $options->title . ']  发表的文章有新评论！';
            $html = file_get_contents(__DIR__  . '/theme/author.html');
            $data['html'] = str_replace(array(
                '{blogUrl}',
                '{blogName}',
                '{description}',
                '{author}',
                '{permalink}',
                '{title}',
                '{text}'
            ), array(
                trim($options->siteUrl),
                trim($options->title),
                trim($options->description),
                trim($comment->author),
                trim($comment->permalink),
                trim($comment->title),
                str_replace(PHP_EOL, '<br>', trim($comment->text))
            ), $html);
        }
        $data['smtp'] = "邮件";
        $data['smtp_host'] = $options->smtp_host;
        $data['smtp_port'] = $options->smtp_port;
        $data['smtp_user'] = $options->smtp_user;
        $data['smtp_pass'] = $options->smtp_pass;
        $data['smtp_auth'] = $options->smtp_auth;
        $data['smtp_secure'] = $options->smtp_secure;
        return self::smtp($data);
    }

    private static function smtp($param)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,Helper::options()->siteUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_exec($ch);
        curl_close($ch);
        return true;
    }
}
