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
 * 用户服务类
 */
class User extends ApiService
{

    /**
     * 同步删除
     * @param string $uid
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:37
     */
    public function delete(string $uid): Result
    {
        $response = HttpUtil::delete('/api/app/v1/user/delete', ['uid' => $uid], $this->headers);
        if ($response->getCode() !== 0) {
            return Result::error(Errno::UC_CODE_EXCEPTION, $response->getMsg() ?? 'UCenter服务器响应异常！');
        }
        return (new App)->notice(NoteAction::DELETE_USER, ['uid' => $uid], true);
    }

    /**
     * 同步更新
     * @param string $uid
     * @param array  $update
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 18:02
     */
    public function update(string $uid, array $update): Result
    {
        $update['uid'] = $uid;
        $response      = HttpUtil::put('/api/app/v1/user/update', $update, $this->headers);
        if ($response->getCode() !== 0) {
            return Result::error(Errno::UC_CODE_EXCEPTION, $response->getMsg() ?? 'UCenter服务器响应异常！');
        }
        return (new App)->notice(NoteAction::UPDATE_USER, $update, true);
    }

    /**
     * 用户详情
     * @param string $uid
     * @param string $field
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 18:08
     */
    public function info(string $uid, string $field = '*'): Result
    {
        $response = HttpUtil::get('/api/app/v1/user/info', ['uid' => $uid, 'field' => $field], $this->headers);
        if ($response->getCode() !== 0) {
            return Result::error(Errno::UC_CODE_EXCEPTION, $response->getMsg() ?? 'UCenter服务器响应异常！');
        }
        return Result::success($response['data'] ?? '');
    }
}
