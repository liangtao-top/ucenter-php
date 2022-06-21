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
    protected ConfigStruct $configStruct;

    /**
     * @param ConfigStruct $config
     */
    public function __construct(ConfigStruct $config)
    {
        $this->configStruct = Config::instance()->setConfig($config)->getConfig();
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
     * @param array $params
     * @return int
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 14:32
     */
    public function syncLogin(array $params): int
    {
        if (!$this->configStruct->isSysLogin()) {
            return ApiReturn::FORBIDDEN->value;
        }
        $user = new User;
        if (!$user->info($params['uid'])) {
            return ApiReturn::FAILED->value;
        }
        $member  = $user->getResult();
        $options = [
            'path'     => $this->configStruct->getAppPath(),
            //            'domain'   => $_SERVER['SERVER_NAME'],
            'samesite' => 'None',
            'secure'   => true
        ];
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        setcookie(CookieKey::AUTH_CODE->value, SecureUtil::encrypt("{$member['id']}", $this->configStruct->getAppSecret()), $options);
        return ApiReturn::SUCCEED->value;
    }

    /**
     * syncLogout
     * @param array $params
     * @return int
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 14:33
     */
    public function syncLogout(array $params): int
    {
        unset($params);
        if (!$this->configStruct->isSysLogin()) {
            return ApiReturn::FORBIDDEN->value;
        }
        $options = [
            'expires'  => time() - 1,
            'path'     => $this->configStruct->getAppPath(),
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
