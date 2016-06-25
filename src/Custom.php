<?php
namespace We7Mp;

class Custom extends Base
{
    public $errmsg;

    private $mpid;
    private $openid;

    public function text($content)
    {
        $token = $this->getAccessToken($this->mpid);

        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$token['token']}";

        $res = Curl::httpPost($url, json_encode([
            'touser'  => $this->openid,
            'msgtype' => 'text',
            'text'    => ['content' => $content]
        ]));

        $res = json_decode($res);

        if ($res->errcode === 0) {
            return true;
        } else {
            $this->errmsg = $res->errmsg;

            return false;
        }
    }

    public function __call($name, $args)
    {
        if (in_array($name, ['openid', 'mpid'])) {
            $this->$name = $args[0];

            return $this;
        }
    }
}