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
// | Version: 2.0 2022/6/21 9:00
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\enums;

enum Errno: int implements ErrnoInterface
{

    /**
     * 成功
     */
    case SUCCESS = 0;
    /**
     * 未知错误
     */
    case UNKNOWN = -1;
    /**
     * UC服务端返回状态码码异常
     */
    case UC_STATUS_CODE = 1;
    /**
     * UC服务端返回内容JSON解码异常
     */
    case UC_DECODE_JSON = 2;
    /**
     * UC服务端返回业务码异常
     */
    case UC_CODE_EXCEPTION = 4;
    /**
     * UC服务端返回业务数据码异常
     */
    case UC_DATA_EXCEPTION = 5;

    public function getCode(): int
    {
        return $this->value;
    }

    public function getMessage(): string
    {
        return match ($this) {
            Errno::SUCCESS => '成功',
            Errno::UNKNOWN => '未知错误',
            Errno::UC_STATUS_CODE => 'UC服务端返回状态码码异常',
            Errno::UC_DECODE_JSON => 'UC服务端返回内容JSON解码异常',
            Errno::UC_CODE_EXCEPTION => 'UC服务端返回业务码异常',
            Errno::UC_DATA_EXCEPTION => 'UC服务端返回业务数据码异常',
        };
    }

}
