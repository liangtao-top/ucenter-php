<?php
declare(strict_types=1);
// +----------------------------------------------------------------------
// | CodeEngine
// +----------------------------------------------------------------------
// | Copyright 艾邦
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: TaoGe <liangtao.gz@foxmail.com>
// +----------------------------------------------------------------------
// | Version: 2.0 2021/3/11 16:45
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter\utils;

use DateTime;
use DateTimeZone;
use RuntimeException;
use top\liangtao\ucenter\abs\ApiAbstract;
use top\liangtao\ucenter\config\Config;
use top\liangtao\ucenter\struct\AccessToken;

/**
 * Token 工具类
 */
class TokenUtil extends ApiAbstract
{

    /**
     * AccessToken 缓存Key
     */
    const ACCESS_TOKEN_CACHE_KEY = 'access_token';

    /**
     * getAccessToken
     * @return \top\liangtao\ucenter\struct\AccessToken
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:58
     */
    public static function getAccessToken(): AccessToken
    {
        $token = self::getLocalAccessToken();
        if (empty($token)) {
            $token = self::getRemoteAccessToken();
        }
        return $token;
    }

    /**
     * refreshToken
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:56
     */
    public static function refreshToken(): void
    {
        self::getRemoteAccessToken();
    }

    /**
     * getLocalAccessToken
     * @return \top\liangtao\ucenter\struct\AccessToken|null
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:55
     */
    public static function getLocalAccessToken(): ?AccessToken
    {
        $token = CacheUtil::get(self::ACCESS_TOKEN_CACHE_KEY);
        if (empty($token)) {
            return null;
        }
        return unserialize($token);
    }

    /**
     * getRemoteAccessToken
     * @return \top\liangtao\ucenter\struct\AccessToken
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:53
     */
    public static function getRemoteAccessToken(): AccessToken
    {
        $config   = Config::instance()->getConfig();
        $query    = ['app_id' => $config->getAppId(), 'app_secret' => $config->getAppSecret()];
        $response = HttpUtil::get('/api/auth/accessToken', $query);
        if (isset($response['code'])
            && $response['code'] === 0
            && isset($response['data'])
            && is_array($response['data'])
            && isset($response['data']['access_token'])
            && !empty($response['data']['access_token'])) {
            $token = new AccessToken();
            $token->setToken($response['data']['access_token']);
            $date = new DateTime;
            $date->setTimezone(new DateTimeZone('Asia/Shanghai'));
            $date->modify("+{$response['data']['expire']} seconds");
            $token->setExpires($date);
            CacheUtil::set(self::ACCESS_TOKEN_CACHE_KEY, serialize($token), $response['data']['expire']);
            return $token;
        }
        throw new RuntimeException($response['msg'] ?? 'UCenter服务器响应异常，' . $response->__toString());
    }

}
