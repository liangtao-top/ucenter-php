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
// | Version: 2.0 2022/6/21 11:24
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\tests\utils;

use DateInterval;
use DateTime;
use DateTimeZone;
use top\liangtao\ucenter\struct\AccessToken;
use top\liangtao\ucenter\utils\CacheUtil;
use PHPUnit\Framework\TestCase;
use top\liangtao\ucenter\utils\TokenUtil;

class CacheUtilTest extends TestCase
{

    public function testGet()
    {
        $value = CacheUtil::get(TokenUtil::ACCESS_TOKEN_CACHE_KEY);
        $this->assertNotNull($value);
        $token = unserialize($value);
        print_r($token);
    }

    public function testHas()
    {
        $res = CacheUtil::has(TokenUtil::ACCESS_TOKEN_CACHE_KEY);
        var_dump($res);
        $this->assertTrue($res);
    }

    public function testDel()
    {
        $res = CacheUtil::del(TokenUtil::ACCESS_TOKEN_CACHE_KEY);
        var_dump($res);
        $this->assertTrue($res);
    }

    public function testSet()
    {
        $token = new AccessToken();
        $token->setToken('123');
        $datetime = new DateTime();
        $datetime->setTimezone(new DateTimeZone('Asia/Shanghai'));
        $datetime->modify("+160 seconds");
        $token->setExpires($datetime);
        CacheUtil::set(TokenUtil::ACCESS_TOKEN_CACHE_KEY, serialize($token), 10);
        $this->assertTrue(CacheUtil::has(TokenUtil::ACCESS_TOKEN_CACHE_KEY));
    }

    public function testClear()
    {
        $this->assertTrue(CacheUtil::clear());
    }
}
