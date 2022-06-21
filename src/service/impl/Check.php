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
// | Version: 2.0 2021/3/17 9:52
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter\service\impl;

use top\liangtao\ucenter\abs\ApiService;
use top\liangtao\ucenter\enums\CookieKey;
use top\liangtao\ucenter\enums\Errno;
use top\liangtao\ucenter\struct\Result;
use top\liangtao\ucenter\utils\CacheUtil;
use top\liangtao\ucenter\utils\HttpUtil;
use top\liangtao\ucenter\utils\SecureUtil;

/**
 * 检测服务类
 */
class Check extends ApiService
{

    /**
     * 是否登录
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:15
     */
    public function isLogin(): Result
    {
        if (isset($_COOKIE[CookieKey::AUTH_CODE->value]) || !empty($_COOKIE[CookieKey::AUTH_CODE->value])) {
            $cookie_string = $_COOKIE[CookieKey::AUTH_CODE->value];
            $uid           = SecureUtil::decrypt($cookie_string, $this->configStruct->getAppSecret());
            if (strlen($uid) === 36) {
                return Result::success(true, $uid);
            }
        }
        return Result::success(false);
    }

    /**
     * 检测用户是否为超级管理员
     * @param string $uid
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:04
     */
    public function isRoot(string $uid): Result
    {
        $cache = CacheUtil::get($uid . '|root');
        if (is_null($cache)) {
            $response = HttpUtil::get('/api/app/v1/check/root', ['uid' => $uid], $this->headers);
            if ($response->getCode() !== 0) {
                return Result::error(Errno::UC_CODE_EXCEPTION, $response->getMsg() ?? 'UCenter服务器响应异常！');
            }
            $cache = $response->getData() ?: '';
            CacheUtil::set($uid . '|root', $cache, 600);
        }
        return Result::success($cache);
    }

    /**
     * 检测用户是否为后台用户
     * @param string $uid
     * @return \top\liangtao\ucenter\struct\Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:26
     */
    public function isAdmin(string $uid): Result
    {
        //TODO::暂时只支持后台
        unset($uid);
        return Result::success(true);
    }

    /**
     * password
     * @param string $uid
     * @param string $password
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:06
     */
    public function password(string $uid, string $password): Result
    {
        $response = HttpUtil::post('/api/app/v1/check/password', compact('uid', 'password'), $this->headers);
        if ($response->getCode() !== 0) {
            return Result::error(Errno::UC_CODE_EXCEPTION, $response->getMsg() ?? 'UCenter服务器响应异常！');
        }
        return Result::success($response->getData() ?: '');
    }

}
