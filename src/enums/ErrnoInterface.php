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
// | Version: 2.0 2022/6/21 9:32
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\enums;

interface ErrnoInterface
{

    public function getCode(): int;

    public function getMessage(): string;

}
