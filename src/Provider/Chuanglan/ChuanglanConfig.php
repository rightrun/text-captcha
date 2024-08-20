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


namespace Onetrue\TextCaptcha\Provider\Chuanglan;

use Onetrue\TextCaptcha\Contracts\CaptchaConfigInterface;


/**
 * https://www.chuanglan.com/control/login
 * 创蓝供应商
 */
class ChuanglanConfig implements CaptchaConfigInterface
{
    /**
     * 用户名
     * @var string
     */
    protected $username = '';


    /**
     * 密码
     * @var string
     */
    protected $password = '';


    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


}