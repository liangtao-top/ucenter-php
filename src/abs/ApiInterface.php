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
// | Version: 2.0 2021/2/24 9:19
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter\abs;

use top\liangtao\ucenter\struct\Result;

interface  ApiInterface
{
    /**
     * 授权码
     * @param string $code
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 10:19
     */
    public function authCode(string $code): Result;

    /**
     * 是否超管
     * @param string $uid
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 9:28
     */
    public function checkRoot(string $uid): Result;

    /**
     * 是否管理
     * @param string $uid
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 9:28
     */
    public function isAdmin(string $uid): Result;

    /**
     * 用户名注册
     * @param string $username
     * @param string $password
     * @param array  $extra
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 11:28
     */
    public function usernameRegister(string $username, string $password, array $extra): Result;

    /**
     * 邮箱注册
     * @param string $email
     * @param string $password
     * @param array  $extra
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 11:51
     */
    public function emailRegister(string $email, string $password, array $extra): Result;

    /**
     * 手机号注册
     * @param string $mobile
     * @param string $password
     * @param array  $extra
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 11:51
     */
    public function mobileRegister(string $mobile, string $password, array $extra): Result;

    /**
     * openID注册
     * @param string $open_id
     * @param string $type 第三方登录类型 例如：wechat|sina|alibaba
     * @param array  $extra
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 11:52
     */
    public function openIDRegister(string $open_id, string $type, array $extra): Result;

    /**
     * 密码登录
     * @param string $username
     * @param string $password
     * @param string $ip
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 12:31
     */
    public function passwordLogin(string $username, string $password, string $ip = ''): Result;

    /**
     * 邮箱登录
     * @param string $email
     * @param string $password
     * @param string $ip
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 13:30
     */
    public function emailLogin(string $email, string $password, string $ip = ''): Result;

    /**
     * 手机号登录
     * @param string $mobile
     * @param string $password
     * @param string $ip
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 13:34
     */
    public function mobileLogin(string $mobile, string $password, string $ip = ''): Result;

    /**
     * openID登录
     * @param string $open_id
     * @param string $type
     * @param string $ip
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 13:34
     */
    public function openIDLogin(string $open_id, string $type, string $ip = ''): Result;

    /**
     * 同步登陆
     * @param string $uid
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 9:39
     */
    public function syncLogin(string $uid): Result;

    /**
     * 同步退出
     * @param string $uid
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 9:41
     */
    public function syncLogout(string $uid): Result;

    /**
     * 更新用户字段
     * @param string $uid
     * @param array  $update
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 14:04
     */
    public function updateUser(string $uid, array $update): Result;

    /**
     * 用户资料
     * @param string $uid
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 13:51
     */
    public function getUserInfo(string $uid): Result;

    /**
     * 删除用户
     * @param string $uid
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 10:17
     */
    public function deleteUser(string $uid): Result;

    /**
     * 验证用户名
     * @param string $username
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 10:17
     */
    public function checkUsername(string $username): Result;

    /**
     * 验证邮箱
     * @param string $email
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 10:17
     */
    public function checkEmail(string $email): Result;

    /**
     * 验证手机号
     * @param string $mobile
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 10:18
     */
    public function checkMobile(string $mobile): Result;

    /**
     * 验证密码
     * @param string $uid
     * @param string $password
     * @return Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/2/24 14:07
     */
    public function checkPassword(string $uid, string $password): Result;
}
