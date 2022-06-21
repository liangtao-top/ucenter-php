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
// | Version: 2.0 2021/3/12 9:57
// +----------------------------------------------------------------------

namespace top\liangtao\ucenter\abs;

use top\liangtao\ucenter\config\Config;
use top\liangtao\ucenter\struct\AccessToken;
use top\liangtao\ucenter\struct\ConfigStruct;
use top\liangtao\ucenter\utils\TokenUtil;

abstract class ApiService extends ApiAbstract
{

    /**
     * @var \top\liangtao\ucenter\struct\AccessToken|null
     */
    protected ?AccessToken $accessToken = null;

    /**
     * @var \top\liangtao\ucenter\struct\ConfigStruct|null
     */
    protected ?ConfigStruct $configStruct = null;

    /**
     * @var array
     */
    protected array $headers = [];

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException

     */
    public function __construct()
    {
        $this->accessToken  = TokenUtil::getAccessToken();
        $this->configStruct = Config::instance()->getConfig();
        if (!empty($this->accessToken)) {
            $this->headers['Authorization'] = $this->accessToken->getToken();
        }
    }

}
