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
// | Version: 2.0 2022/6/21 8:50
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\struct;

use top\liangtao\struct\Struct;
use top\liangtao\ucenter\enums\Errno;

class Result extends Struct
{

    /**
     * 错误码
     * @var Errno
     */
    private Errno $errno = Errno::UNKNOWN;

    /**
     * 结果
     * @var mixed
     */
    private mixed $result = null;

    /**
     * 成功或失败
     * @var bool
     */
    private bool $value = false;

    /**
     * 附加信息
     * @var mixed|null
     */
    private mixed $attached = null;

    /**
     * success
     * @param mixed $result
     * @param mixed $attached
     * @return \top\liangtao\ucenter\struct\Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 9:25
     */
    public static function success(mixed $result = '', mixed $attached = ''): Result
    {
        return (new Result)->setErrno(Errno::SUCCESS)->setValue(true)->setResult($result)->setAttached($attached);
    }

    /**
     * error
     * @param \top\liangtao\ucenter\enums\Errno $errno
     * @param mixed                             $attached
     * @return \top\liangtao\ucenter\struct\Result
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/21 9:29
     */
    public static function error(Errno $errno, mixed $attached = ''): Result
    {
        return (new Result)->setErrno($errno)->setValue(false)->setAttached($attached);
    }

    /**
     * @return \top\liangtao\ucenter\enums\Errno
     */
    public function getErrno(): Errno
    {
        return $this->errno;
    }

    /**
     * @param \top\liangtao\ucenter\enums\Errno $errno
     * @return \top\liangtao\ucenter\struct\Result
     */
    public function setErrno(Errno $errno): static
    {
        $this->errno = $errno;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     * @return \top\liangtao\ucenter\struct\Result
     */
    public function setResult(mixed $result): static
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValue(): bool
    {
        return $this->value;
    }

    /**
     * @param bool $value
     * @return \top\liangtao\ucenter\struct\Result
     */
    public function setValue(bool $value): static
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getAttached(): mixed
    {
        return $this->attached;
    }

    /**
     * @param mixed|null $attached
     */
    public function setAttached(mixed $attached): static
    {
        $this->attached = $attached;
        return $this;
    }

}
