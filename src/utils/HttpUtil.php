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
// | Version: 2.0 2021/3/4 17:11
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter\utils;

use RuntimeException;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use top\liangtao\ucenter\abs\ApiAbstract;
use top\liangtao\ucenter\config\Config;
use top\liangtao\ucenter\enums\Errno;
use top\liangtao\ucenter\struct\ServerResponse;

/**
 * Http客户端工具类
 */
class HttpUtil extends ApiAbstract
{

    /**
     * client
     * @return \GuzzleHttp\Client
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:17
     */
    private static function client(): Client
    {
        return new Client(['base_uri' => Config::instance()->getConfig()->getUcApi()]);
    }

    /**
     * get
     * @param string $uri
     * @param array  $params
     * @param array  $header
     * @return \top\liangtao\ucenter\struct\ServerResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:44
     */
    public static function get(string $uri, array $params, array $header = []): ServerResponse
    {
        $options = ['query' => $params];
        if (!empty($header)) {
            $options['headers'] = $header;
        }
        $response = self::client()->get($uri, $options);
        return self::response($response);
    }

    /**
     * post
     * @param string $uri
     * @param array  $params
     * @param array  $header
     * @return \top\liangtao\ucenter\struct\ServerResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 10:49
     */
    public static function post(string $uri, array $params, array $header = []): ServerResponse
    {
        $options = ['json' => $params];
        if (!empty($header)) {
            $options['headers'] = $header;
        }
        $response = self::client()->post($uri, $options);
        return self::response($response);
    }

    /**
     * put
     * @param string $uri
     * @param array  $params
     * @param array  $header
     * @return \top\liangtao\ucenter\struct\ServerResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:43
     */
    public static function put(string $uri, array $params, array $header = []): ServerResponse
    {
        $options = ['json' => $params];
        if (!empty($header)) {
            $options['headers'] = $header;
        }
        $response = self::client()->put($uri, $options);
        return self::response($response);
    }

    /**
     * patch
     * @param string $uri
     * @param array  $params
     * @param array  $header
     * @return \top\liangtao\ucenter\struct\ServerResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:45
     */
    public static function patch(string $uri, array $params, array $header = []): ServerResponse
    {
        $options = ['json' => $params];
        if (!empty($header)) {
            $options['headers'] = $header;
        }
        $response = self::client()->patch($uri, $options);
        return self::response($response);
    }

    /**
     * delete
     * @param string $uri
     * @param array  $params
     * @param array  $header
     * @return \top\liangtao\ucenter\struct\ServerResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:42
     */
    public static function delete(string $uri, array $params, array $header = []): ServerResponse
    {
        $options = ['json' => $params];
        if (!empty($header)) {
            $options['headers'] = $header;
        }
        $response = self::client()->delete($uri, $options);
        return self::response($response);
    }

    /**
     * response
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \top\liangtao\ucenter\struct\ServerResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 9:07
     */
    private static function response(ResponseInterface &$response): ServerResponse
    {
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('UCenter服务器响应码异常，StatusCode：' . $response->getStatusCode(), Errno::UC_STATUS_CODE->getCode());
        }
        $jsonStr = $response->getBody()->getContents(); //获取响应体
        // 字符串转json
        $body = StringUtil::isJson($jsonStr, true);
        if ($body === false) {
            throw new RuntimeException('UCenter服务器响应内容异常，Content：' . $jsonStr, Errno::UC_DECODE_JSON->getCode());
        }
        if (isset($body['code']) && $body['code'] === 40003) {
            TokenUtil::refreshToken();
        }
        return new ServerResponse($body);
    }

}
