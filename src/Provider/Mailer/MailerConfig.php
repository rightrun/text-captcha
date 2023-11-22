<?php
declare(strict_types=1);
/**
 * This file is part of rightrun/text-captcha
 *
 * @link     https://github.com/rightrun/text-captcha
 * @contact  a07sky@126.com
 * @license  https://github.com/rightrun/text-captcha/blob/master/LICENSE
 *
 */


namespace Onetrue\TextCaptcha\Provider\Mailer;

use Onetrue\TextCaptcha\Contracts\CaptchaConfigInterface;

class MailerConfig implements CaptchaConfigInterface
{

    /**
     * smtp服务host
     * @var string
     */
    protected $smtpHost = '';


    /**
     * 发件人邮箱
     * @var string
     */
    protected $form = '';


    /**
     * 发件人名称
     * @var string
     */
    protected $formName = '';

    /**
     * 用户名
     * @var string
     */
    protected $username = '';


    /**
     * 模板code
     * @var string
     */
    protected $password = '';


    /**
     * 邮件主题
     * @var string
     */
    protected $subject = '系统邮件';


    public function __construct($host, $username, $password)
    {
        $this->smtpHost = $host;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getSmtpHost(): string
    {
        return $this->smtpHost;
    }

    /**
     * @param string $smtpHost
     */
    public function setSmtpHost(string $smtpHost): void
    {
        $this->smtpHost = $smtpHost;
    }

    /**
     * @return string
     */
    public function getForm(): string
    {
        return $this->form;
    }

    /**
     * @param string $form
     */
    public function setForm(string $form): void
    {
        $this->form = $form;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getFormName(): string
    {
        return $this->formName;
    }

    /**
     * @param string $formName
     */
    public function setFormName(string $formName): void
    {
        $this->formName = $formName;
    }


}