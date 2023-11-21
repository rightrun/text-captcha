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


namespace Onetrue\TextCaptcha\Contracts;

interface ProviderInterface
{


    /**
     * 发送短信
     * @param string $phone
     * @param string $content
     * @return bool
     */
    public function send(string $phone, string $content = ''): bool;

    public function getCode(): string;
}