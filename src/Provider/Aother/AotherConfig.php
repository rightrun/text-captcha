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


namespace Onetrue\TextCaptcha\Provider\Aother;

use Onetrue\TextCaptcha\Contracts\CaptchaConfigInterface;

class AotherConfig implements CaptchaConfigInterface
{
    /**
     * 商户ID
     * @var string
     */
    protected $cid = '';


    /**
     * 密钥
     * @var string
     */
    protected $secretKey = '';


    public function __construct($cid, $secretKey)
    {
        $this->cid = $cid;
        $this->secretKey = $secretKey;

    }


    /**
     * @return string
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }


}