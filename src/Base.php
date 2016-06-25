<?php
namespace We7Mp;

use We7Mp\We7;

class Base
{
    public function getAccessToken($mpid)
    {
        $weChart = We7\AccountWechats::mpid($mpid)->first();
        $access  = We7\CoreCache::accessToken($weChart->acid)->first();

        $token = unserialize($access->value);

        if (time() >= $token['expire']) {
            $url = sprintf('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',
                $weChart->key,
                $weChart->secret
            );

            $accessToken = json_decode(Curl::httpGet($url), true);

            $token['token']  = $accessToken['access_token'];
            $token['expire'] = $accessToken['expires_in'] + time() - 100;
            $access->value   = serialize($token);
            $access->save();
        }

        return $token;
    }

    public static function instance() {
        return new static;
    }
}