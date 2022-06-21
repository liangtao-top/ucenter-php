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
// | Version: 2.0 2021/3/19 18:02
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter\service\impl;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use top\liangtao\ucenter\abs\ApiService;
use top\liangtao\ucenter\enums\Errno;
use top\liangtao\ucenter\enums\NoteAction;
use top\liangtao\ucenter\struct\Result;
use top\liangtao\ucenter\utils\HttpUtil;
use top\liangtao\ucenter\utils\SecureUtil;

/**
 * 应用服务类
 */
class App extends ApiService
{

    /**
     * 应用列表
     * @param bool $exclude 是否排除当前应用 默认：false
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:02
     */
    public function list(bool $exclude = false): Result
    {
        $response = HttpUtil::get('/api/app/v1/app/index', [], $this->headers);
        if ($response->getCode() !== 0) {
            return Result::error(Errno::UC_CODE_EXCEPTION, $response->getMsg() ?? 'UCenter服务器响应异常！');
        }
        $appList = $response['data'] ?? [];
        if (!empty($appList) && is_array($appList)) {
            foreach ($appList as $key => $app) {
                if ($exclude && $app['app_id'] === $this->configStruct->getAppId()) {
                    unset($appList[$key]);
                }
            }
        }
        return Result::success($appList);
    }

    /**
     * 应用通知
     * @param \top\liangtao\ucenter\enums\NoteAction $action
     * @param array                                  $data    通知内容
     * @param bool                                   $exclude 是否排除当前应用 默认：false
     * @return Result
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 17:59
     */
    public function notice(NoteAction $action, array $data = [], bool $exclude = false): Result
    {
        $result = $this->list($exclude);
        if (!$result->isValue()) {
            return $result;
        }
        $appList = $result->getResult();
        if (!empty($appList) && is_array($appList)) {
            $time   = time();
            $client = new Client();
            $params = [...$data, ...['action' => $action->value, 'time' => $time]];
            foreach ($appList as $app) {
                $url = $app['url'] . $app['api_filename'] . '?time=' . $time . '&code=' . urlencode(SecureUtil::encrypt(http_build_query($params), $app['app_secret']));
                // 发送一个异步请求
                $request = new Request('GET', $url, $this->headers);
                $client->sendAsync($request)->wait();
            }
        }
        return Result::success();
    }

}
