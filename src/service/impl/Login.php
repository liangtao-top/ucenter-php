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
// | Version: 2.0 2021/2/24 15:50
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter\service\impl;

use top\liangtao\ucenter\abs\ApiService;
use top\liangtao\ucenter\enums\Errno;
use top\liangtao\ucenter\struct\Result;
use top\liangtao\ucenter\utils\HttpUtil;
use top\liangtao\ucenter\utils\SecureUtil;

/**
 * 用户登录 - 服务类
 */
class Login extends ApiService
{

    /**
     * 密码登录
     * passwordLogin
     * @param string $username
     * @param string $password
     * @param string $ip
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException

     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:11
     */
    public function passwordLogin(string $username, string $password, string $ip = ''): Result
    {
        $response = HttpUtil::post('/api/app/v1/login/password', compact('username', 'password', 'ip'), $this->headers);
        if ($response->getCode() !== 0) {
            return Result::error(Errno::UC_CODE_EXCEPTION, $response->getMsg() ?? 'UCenter服务器响应异常！');
        }
        return Result::success($response->getData() ?: '');
    }

    /**
     * 同步登录
     * @param string $uid
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException

     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:23
     */
    public function syncLogin(string $uid): Result
    {
        $result = (new App)->list();
        if (!$result->isValue()) {
            return $result;
        }
        $app_ls  = $result->getResult();
        $syn_str = '';
        if (!empty($app_ls) && is_array($app_ls)) {
            $time = time();
            foreach ($app_ls as $app) {
                $syn_str .= '<script type="text/javascript" src="' . $app['url'] . $app['api_filename'] . '?time=' . $time . '&code=' . urlencode(SecureUtil::encrypt('action=syncLogin&uid=' . $uid . "&time=" . $time, $app['app_secret'])) . '"></script>';
            }
        }
        return Result::success($syn_str);
    }

    /**
     * 同步退出
     * @param string $uid
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException

     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:24
     */
    public function syncLogout(string $uid): Result
    {
        $result = (new App)->list();
        if (!$result->isValue()) {
            return $result;
        }
        $app_ls  = $result->getResult();
        $syn_str = '';
        if (!empty($app_ls) && is_array($app_ls)) {
            $time = time();
            foreach ($app_ls as $app) {
                $syn_str .= '<script type="text/javascript" src="' . $app['url'] . $app['api_filename'] . '?time=' . $time . '&code=' . urlencode(SecureUtil::encrypt('action=syncLogout&uid=' . $uid . "&time=" . $time, $app['app_secret'])) . '"></script>';
            }
        }
        return Result::success($syn_str);
    }

}
