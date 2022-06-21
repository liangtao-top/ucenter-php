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
// | Version: 2.0 2022/6/20 15:24
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\utils;

/**
 * 字符串工具类
 */
class StringUtil
{

    /**
     * isJson
     * @param string    $string
     * @param bool|null $assoc
     * @return false|object|array
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 15:27
     */
    public static function isJson(string $string, ?bool $assoc = false): false|object|array
    {
        $decrypt = json_decode($string, $assoc);
        if (!empty($data) && (is_object($decrypt) || is_array($data))) {
            return $data;
        }
        return false;
    }

}
