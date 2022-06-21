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
// | Version: 2.0 2021/2/24 9:12
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter;

use top\liangtao\ucenter\abs\ApiAbstract;
use top\liangtao\ucenter\abs\ApiInterface;
use top\liangtao\ucenter\config\Config;
use top\liangtao\ucenter\struct\ConfigStruct;
use top\liangtao\ucenter\service\impl\Check;
use top\liangtao\ucenter\service\impl\Login;
use top\liangtao\ucenter\service\impl\Register;
use top\liangtao\ucenter\service\impl\User;
use top\liangtao\ucenter\struct\Result;
use top\liangtao\ucenter\utils\SecureUtil;

/**
 * UCenter客户端
 */
class Client extends ApiAbstract implements ApiInterface
{

    /**
     * @var \top\liangtao\ucenter\struct\ConfigStruct
     */
    private ConfigStruct $configStruct;

    public function __construct(array $config)
    {
        $this->configStruct = Config::instance()->setConfig(new ConfigStruct($config))->getConfig();
    }

    /**
     * 授权码
     * @param string $code
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 10:19
     */
    public function authCode(string $code): Result
    {
        return Result::success(SecureUtil::decrypt($code, $this->configStruct->getAppSecret()));
    }

    /**
     * 是否超管
     * @param string $uid
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 18:11
     */
    public function checkRoot(string $uid): Result
    {
        return (new Check)->isRoot($uid);
    }

    /**
     * 是否为后台用户
     * @param string $uid
     * @return \top\liangtao\ucenter\struct\Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:56
     */
    public function isAdmin(string $uid): Result
    {
        return (new Check)->isAdmin($uid);
    }

    /**
     * 用户名注册
     * @param string $username
     * @param string $password
     * @param array  $extra
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 18:11
     */
    public function usernameRegister(string $username, string $password, array $extra): Result
    {
        return (new Register)->usernameRegister($username, $password, $extra);
    }

    /**
     * 邮箱注册
     * @param string $email
     * @param string $password
     * @param array  $extra
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 11:51
     */
    public function emailRegister(string $email, string $password, array $extra): Result
    {
        //TODO::待开发
        return Result::success();
    }

    /**
     * 手机号注册
     * @param string $mobile
     * @param string $password
     * @param array  $extra
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 11:51
     */
    public function mobileRegister(string $mobile, string $password, array $extra): Result
    {
        //TODO::待开发
        return Result::success();
    }

    /**
     * openID注册
     * @param string $open_id
     * @param string $type 第三方登录类型 例如：wechat|sina|alibaba
     * @param array  $extra
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 11:52
     */
    public function openIDRegister(string $open_id, string $type, array $extra): Result
    {
        //TODO::待开发
        return Result::success();
    }

    /**
     * 密码登录
     * @param string $username
     * @param string $password
     * @param string $ip
     * @return \top\liangtao\ucenter\struct\Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:49
     */
    public function passwordLogin(string $username, string $password, string $ip = ''): Result
    {
        return (new Login)->passwordLogin($username, $password, $ip);
    }

    /**
     * 邮箱登录
     * @param string $email
     * @param string $password
     * @param string $ip
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 13:30
     */
    public function emailLogin(string $email, string $password, string $ip = ''): Result
    {
        //TODO::待开发
        return Result::success();
    }

    /**
     * 手机号登录
     * @param string $mobile
     * @param string $password
     * @param string $ip
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 13:34
     */
    public function mobileLogin(string $mobile, string $password, string $ip = ''): Result
    {
        //TODO::待开发
        return Result::success();
    }

    /**
     * openID登录
     * @param string $open_id
     * @param string $type
     * @param string $ip
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 13:34
     */
    public function openIDLogin(string $open_id, string $type, string $ip = ''): Result
    {
        //TODO::待开发
        return Result::success();
    }

    /**
     * 同步登陆
     * @param string $uid
     * @return \top\liangtao\ucenter\struct\Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:50
     */
    public function syncLogin(string $uid): Result
    {
        return (new Login)->syncLogin($uid);
    }

    /**
     * 同步退出
     * @param string $uid
     * @return \top\liangtao\ucenter\struct\Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:51
     */
    public function syncLogout(string $uid): Result
    {
        return (new Login)->syncLogout($uid);
    }

    /**
     * 更新用户字段
     * @param string $uid
     * @param array  $update
     * @return \top\liangtao\ucenter\struct\Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:52
     */
    public function updateUser(string $uid, array $update): Result
    {
        return (new User)->update($uid, $update);
    }

    /**
     * 用户资料
     * @param string $uid
     * @param string $field
     * @return \top\liangtao\ucenter\struct\Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:53
     */
    public function getUserInfo(string $uid, string $field = '*'): Result
    {
        return (new User)->info($uid, $field);
    }

    /**
     * 删除用户
     * @param string $uid
     * @return \top\liangtao\ucenter\struct\Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:54
     */
    public function deleteUser(string $uid): Result
    {
        return (new User)->delete($uid);
    }

    /**
     * 是否登录
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/3/18 16:26
     */
    public function checkLogin(): Result
    {
        return (new Check)->isLogin();
    }

    /**
     * 验证用户名
     * @param string $username
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 10:17
     */
    public function checkUsername(string $username): Result
    {
        //TODO::待开发
        return Result::success();
    }

    /**
     * 验证邮箱
     * @param string $email
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 10:17
     */
    public function checkEmail(string $email): Result
    {
        //TODO::待开发
        return Result::success();
    }

    /**
     * 验证手机号
     * @param string $mobile
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 10:18
     */
    public function checkMobile(string $mobile): Result
    {
        //TODO::待开发
        return Result::success();
    }

    /**
     * 验证密码
     * @param string $uid
     * @param string $password
     * @return \top\liangtao\ucenter\struct\Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:55
     */
    public function checkPassword(string $uid, string $password): Result
    {
        return (new Check)->password($uid, $password);
    }
}
