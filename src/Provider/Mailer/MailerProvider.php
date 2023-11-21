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


namespace Onetrue\TextCaptcha\Provider\Mailer;

use Onetrue\TextCaptcha\Exception\CaptchaException;
use Onetrue\TextCaptcha\Provider\Provider;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

/**
 * NetteMailer： https://packagist.org/packages/nette/mail
 */
class MailerProvider extends Provider
{


    /**
     * 获取配置信息
     * @return MailerConfig
     */
    public function getConfig(): MailerConfig
    {
        return $this->config;
    }


    public function send(string $email, string $content = null): bool
    {
        $this->validEmail($email);
        $content = $this->getContent($content);
        $smtpConfig = $this->getConfig();

        try {
            $host = $smtpConfig->getSmtpHost(); // SMTP server
            $username = $smtpConfig->getUsername();  // 邮箱用户名
            $password = $smtpConfig->getPassword(); //邮箱密码
            $from = $smtpConfig->getForm() ?? $smtpConfig->getUsername();

            $fromName = $smtpConfig->getFormName();
            $subject = $smtpConfig->getSubject();

            $transport = Transport::fromDsn('smtp://' . $username . ':' . $password . '@' . $host);
            $mailer = new Mailer($transport);
            //邮件
            $mail = (new Email())->from(new Address($from, $fromName))
                ->to($email)
                ->subject($subject)
                ->html($content);
            $mailer->send($mail);
        } catch (\Exception $error) {
            throw new CaptchaException($error->getMessage());
        }
        return true;
    }

    protected function validEmail($email)
    {
        if (!preg_match('/^\w+@([\da-z\.-]+)\.([a-z]{2,6}|[\x{4e00}-\x{9fa5}]{2,3})$/u', $email)) {
            throw new CaptchaException('电子邮箱格式不正确');
        }
        return true;
    }
}