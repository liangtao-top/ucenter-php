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
// | Version: 2.0 2022/6/20 11:47
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\config;

use top\liangtao\single\Singleton;
use top\liangtao\ucenter\struct\ConfigStruct;

class Config
{
    use Singleton;

    /**
     * 配置
     * @var \top\liangtao\ucenter\struct\ConfigStruct
     */
    private ConfigStruct $config;

    /**
     * @return \top\liangtao\ucenter\struct\ConfigStruct
     */
    public function getConfig(): ConfigStruct
    {
        return $this->config;
    }

    /**
     * setConfig
     * @param \top\liangtao\ucenter\struct\ConfigStruct $config
     * @return $this
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 16:46
     */
    public function setConfig(ConfigStruct $config): static
    {
        $this->config = $config;
        return $this;
    }

}
