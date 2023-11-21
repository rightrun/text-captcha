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

namespace Onetrue\TextCaptcha;

use Onetrue\TextCaptcha\Provider\Provider;

class CaptchaManager
{

    /**
     * 验证码类型
     * @var int
     */
    protected $captchaType = CaptchaCodes::SMS_TYPECODE;

    /**
     * @param integer $type 验证码类型（短信或邮箱验证码） CaptchaCodes::SMS_TYPECODE | CaptchaCodes::EMAIL_TYPECODE
     * @param int $type
     * @return void
     */
    public function setCaptchaType(int $type)
    {
        $this->captchaType = $type;
    }

    public function getCaptchaType()
    {
        return $this->captchaType;
    }

    public function makeProvider($provider, $parameters): Provider
    {

        return new $provider(...$parameters);
    }
}

