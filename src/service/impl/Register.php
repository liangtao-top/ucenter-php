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
use top\liangtao\ucenter\enums\NoteAction;
use top\liangtao\ucenter\struct\Result;
use top\liangtao\ucenter\utils\HttpUtil;

/**
 * 用户注册服务类
 */
class Register extends ApiService
{

    /**
     * 帐号密码注册
     * @param string $username
     * @param string $password
     * @param array  $extra
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:32
     */
    public function usernameRegister(string $username, string $password, array $extra): Result
    {
        $response = HttpUtil::post('/api/app/v1/register/username', array_merge(compact("username", "password"), $extra), $this->headers);
        if ($response->getCode() !== 0) {
            return Result::error(Errno::UC_CODE_EXCEPTION, $response->getMsg() ?? 'UCenter服务器响应异常！');
        }
        $member = $response['data'] ?? '';
        if (empty($member['id'])) {
            return Result::error(Errno::UC_DATA_EXCEPTION, $response->getMsg() ?? 'UCenter服务端注册成功后返回值缺少用户ID！');
        }
        $result = (new App)->notice(NoteAction::CREATE_USER, ['uid' => $member['id'], 'username' => $member['username']], true);
        if (!$result->isValue()) {
            return $result;
        }
        return Result::success($member);
    }

}
