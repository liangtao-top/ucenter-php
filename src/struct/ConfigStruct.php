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
// | Version: 2.0 2022/6/20 11:28
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\struct;

use top\liangtao\struct\Struct;
use top\liangtao\ucenter\enums\AppType;

/**
 * 配置结构体
 */
class ConfigStruct extends Struct
{
    // 服务端API地址
    private string $ucApi = 'http://localhost:8080';
    // 应用ID
    private string $appId = '';
    // 应用秘钥
    private string $appSecret = '';
    // 应用编码
    private string $charset = 'UTF-8';
    // 允许访问的IP
    private array $allowIps = [];
    // 应用 IP
    private string $ip = '127.0.0.1';
    // 是否接受通知
    private bool $recvNot = true;
    // 是否开启同步登录
    private bool $sysLogin = false;
    // 应用类型
    private AppType $type = AppType::DM;
    // 应用主 URL
    private string $url = 'http://localhost';
    // 数据库编码
    private string $dbCharset = 'utf8';
    // 附加参数，格式为序列化后的数组
    private array $extra = [];
    // 应用名称
    private string $name = 'abon';
    // 接口文件名称
    private string $apiFilename = '/uc';
    // 应用的物理路径
    private string $appPath = '/admin';

    /**
     * @return string
     */
    public function getUcApi(): string
    {
        return $this->ucApi;
    }

    /**
     * @param string $ucApi
     */
    public function setUcApi(string $ucApi): void
    {
        $this->ucApi = $ucApi;
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @param string $appId
     */
    public function setAppId(string $appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     */
    public function setAppSecret(string $appSecret): void
    {
        $this->appSecret = $appSecret;
    }

    /**
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }

    /**
     * @param string $charset
     */
    public function setCharset(string $charset): void
    {
        $this->charset = $charset;
    }

    /**
     * @return array
     */
    public function getAllowIps(): array
    {
        return $this->allowIps;
    }

    /**
     * @param array $allowIps
     */
    public function setAllowIps(array $allowIps): void
    {
        $this->allowIps = $allowIps;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return bool
     */
    public function isRecvNot(): bool
    {
        return $this->recvNot;
    }

    /**
     * @param bool $recvNot
     */
    public function setRecvNot(bool $recvNot): void
    {
        $this->recvNot = $recvNot;
    }

    /**
     * @return bool
     */
    public function isSysLogin(): bool
    {
        return $this->sysLogin;
    }

    /**
     * @param bool $sysLogin
     */
    public function setSysLogin(bool $sysLogin): void
    {
        $this->sysLogin = $sysLogin;
    }

    /**
     * @return \top\liangtao\ucenter\enums\AppType
     */
    public function getType(): AppType
    {
        return $this->type;
    }

    /**
     * @param \top\liangtao\ucenter\enums\AppType $type
     */
    public function setType(AppType $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getDbCharset(): string
    {
        return $this->dbCharset;
    }

    /**
     * @param string $dbCharset
     */
    public function setDbCharset(string $dbCharset): void
    {
        $this->dbCharset = $dbCharset;
    }

    /**
     * @return array
     */
    public function getExtra(): array
    {
        return $this->extra;
    }

    /**
     * @param array $extra
     */
    public function setExtra(array $extra): void
    {
        $this->extra = $extra;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getApiFilename(): string
    {
        return $this->apiFilename;
    }

    /**
     * @param string $apiFilename
     */
    public function setApiFilename(string $apiFilename): void
    {
        $this->apiFilename = $apiFilename;
    }

    /**
     * @return string
     */
    public function getAppPath(): string
    {
        return $this->appPath;
    }

    /**
     * @param string $appPath
     */
    public function setAppPath(string $appPath): void
    {
        $this->appPath = $appPath;
    }

}
