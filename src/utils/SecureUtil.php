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
// | Version: 2.0 2022/6/20 11:07
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\utils;

/**
 * 加密算法工具类
 */
class SecureUtil
{

    /**
     * 加密
     * @param string $data   要加密的字符串
     * @param string $key    加密密钥
     * @param int    $expire 过期时间 (单位:秒)
     * @return string
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 11:08
     */
    public static function encrypt(string $data, string $key, int $expire = 0): string
    {
        $key  = md5($key);
        $data = base64_encode($data);
        $x    = 0;
        $len  = strlen($data);
        $l    = strlen($key);
        $char = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        $str = sprintf('%010d', $expire ? $expire + time() : 0);
        for ($i = 0; $i < $len; $i++) {
            $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
        }
        return str_replace('=', '', base64_encode($str));
    }

    /**
     * 解密
     * @param string $data 要解密的字符串
     * @param string $key  加密密钥
     * @return string
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 11:08
     */
    public static function decrypt(string $data, string $key): string
    {
        $key    = md5($key);
        $x      = 0;
        $data   = base64_decode($data);
        $expire = substr($data, 0, 10);
        $data   = substr($data, 10);
        if ($expire > 0 && $expire < time()) {
            return '';
        }
        $len  = strlen($data);
        $l    = strlen($key);
        $char = $str = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            } else {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return base64_decode($str);
    }

}
