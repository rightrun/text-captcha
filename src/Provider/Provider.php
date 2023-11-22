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

namespace Onetrue\TextCaptcha\Provider;

use Onetrue\TextCaptcha\Contracts\CaptchaConfigInterface;
use Onetrue\TextCaptcha\Contracts\ProviderInterface;
use Onetrue\TextCaptcha\Exception\CaptchaException;

abstract class Provider implements ProviderInterface
{

    /**
     * @var  CaptchaConfigInterface
     */
    protected $config;

    /**
     * @var string
     */
    protected $content = '【标记】您的验证码是：${code}，5分钟内有效，请勿泄露。';

    /**
     * 验证码
     * @var string
     */
    protected $code = '';

    public function __construct(CaptchaConfigInterface $config)
    {
        $this->config = $config;
    }


    public abstract function getConfig(): CaptchaConfigInterface;


    protected function randomCode()
    {
        $this->code = strval(rand(100000, 999999));
        return $this->code;
    }


    protected function getContent($content)
    {
        // TODO: Implement send() method.
        $content = $content ?? $this->content;
        $randomCode = $this->randomCode();
        $content = str_replace('${code}', $randomCode, $content);
        return $content;
    }

    public function getCode(): string
    {
        return $this->code;
    }


}