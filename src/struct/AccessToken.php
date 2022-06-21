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
// | Version: 2.0 2022/6/20 15:49
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\struct;

use DateTime;
use top\liangtao\struct\Struct;

class AccessToken extends Struct
{

    /**
     * 令牌
     * @var string
     */
    private string $token;

    /**
     * 过期时间
     * @var DateTime
     */
    private DateTime $expires;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return \DateTime
     */
    public function getExpires(): DateTime
    {
        return $this->expires;
    }

    /**
     * @param \DateTime $expires
     */
    public function setExpires(DateTime $expires): void
    {
        $this->expires = $expires;
    }

}
