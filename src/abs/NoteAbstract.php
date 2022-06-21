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
// | Version: 2.0 2021/3/18 13:55
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter\abs;

use top\liangtao\ucenter\config\Config;
use top\liangtao\ucenter\enums\ApiReturn;
use top\liangtao\ucenter\enums\CookieKey;
use top\liangtao\ucenter\service\impl\User;
use top\liangtao\ucenter\struct\ConfigStruct;
use top\liangtao\ucenter\utils\SecureUtil;

/**
 * 通知抽象类
 */
abstract class NoteAbstract implements NoteInterface
{

    /**
     * 配置
     * @var \top\liangtao\ucenter\struct\ConfigStruct
     */
    protected ConfigStruct $config;

    /**
     * @param array $config

     */
    public function __construct(array $config = [])
    {
        $this->config = Config::instance()->setConfig(new ConfigStruct($config))->getConfig();
    }

    /**
     * test
     * @return int
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 16:48
     */
    public function test(): int
    {
        return ApiReturn::SUCCEED->value;
    }

    /**
     * syncLogin
     * @param $param
     * @return int
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 11:00
     */
    public function syncLogin($param): int
    {
        if (!$this->config->isSysLogin()) {
            return ApiReturn::FORBIDDEN->value;
        }
        $user = new User;
        if (!$user->info($param['uid'])) {
            return ApiReturn::FAILED->value;
        }
        $member  = $user->getResult();
        $options = [
            'path'     => $this->config->getAppPath(),
            //            'domain'   => $_SERVER['SERVER_NAME'],
            'samesite' => 'None',
            'secure'   => true
        ];
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        setcookie(CookieKey::AUTH_CODE->value, SecureUtil::encrypt("{$member['id']}", $this->config->getAppSecret()), $options);
        return ApiReturn::SUCCEED->value;
    }

    /**
     * syncLogout
     * @param $param
     * @return int
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 11:01
     */
    public function syncLogout($param): int
    {
        unset($param);
        if (!$this->config->isSysLogin()) {
            return ApiReturn::FORBIDDEN->value;
        }
        $options = [
            'expires'  => time() - 1,
            'path'     => $this->config->getAppPath(),
            //            'domain'   => $_SERVER['SERVER_NAME'],
            'samesite' => 'None',
            'secure'   => true
        ];
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        setcookie(CookieKey::AUTH_CODE->value, "", $options);
        return ApiReturn::SUCCEED->value;
    }

    /**
     * __call
     * @param string $name
     * @param array  $arguments
     * @return int
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 16:53
     */
    public final function __call(string $name, array $arguments): int
    {
        return ApiReturn::FORBIDDEN->value;
    }

}
