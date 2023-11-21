<?php
declare(strict_types=1);
/**
 * This file is part of a07sky/text-captcha
 *
 * @link     https://github.com/a07sky/text-captcha
 * @contact  a07sky@126.com
 * @license  https://github.com/a07sky/text-captcha/blob/master/LICENSE
 *
 */


namespace Onetrue\TextCaptcha\Provider\Aliyun;

use Onetrue\TextCaptcha\Contracts\CaptchaConfigInterface;

class AliyunConfig implements CaptchaConfigInterface
{
    /**
     * 阿里访问keyId
     * @var string
     */
    protected $accessKeyId = '';


    /**
     * 密钥
     * @var string
     */
    protected $secretKey = '';

    /**
     * 签名名称
     * @var string
     */
    protected $signName = '';


    /**
     * 模板code
     * @var string
     */
    protected $templateCode = '';


    public function __construct($accessKeyId, $secretKey, $signName, $templateCode)
    {
        $this->accessKeyId = $accessKeyId;
        $this->secretKey = $secretKey;
        $this->signName = $signName;
        $this->templateCode = $templateCode;
    }


    /**
     * @return string
     */
    public function getAccessKeyId()
    {
        return $this->accessKeyId;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @return string
     */
    public function getSignName()
    {
        return $this->signName;
    }


    /**
     * @return string
     */
    public function getTemplateCode()
    {
        return $this->templateCode;
    }

}