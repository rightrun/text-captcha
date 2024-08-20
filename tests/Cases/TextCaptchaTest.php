<?php

namespace TextCaptchaTest\Cases;

use Onetrue\TextCaptcha\CaptchaCodes;
use Onetrue\TextCaptcha\CaptchaManager;
use Onetrue\TextCaptcha\Provider\Aliyun\AliyunConfig;
use Onetrue\TextCaptcha\Provider\Aliyun\AliyunProvider;
use Onetrue\TextCaptcha\Provider\Aother\AotherConfig;
use Onetrue\TextCaptcha\Provider\Aother\AotherProvider;
use Onetrue\TextCaptcha\Provider\Chuanglan\ChuanglanConfig;
use Onetrue\TextCaptcha\Provider\Chuanglan\ChuanglanProvider;
use Onetrue\TextCaptcha\Provider\Mailer\MailerConfig;
use Onetrue\TextCaptcha\Provider\Mailer\MailerProvider;
use PHPUnit\Framework\TestCase;

class TextCaptchaTest extends TestCase
{

    public function testSMScaptcha()
    {
        pr('---------------------------------------------');
        echo '短信验证码';
        pr('---------------------------------------------');

        /*
        //阿里云
        $accessKeyId = '';
        $accessKeySecret = '';
        $signName = '';
        $templateCode = '';

        $signName = "阿里云短信测试";
        $templateCode = "SMS_154950909";
        $phone = '';

        $config = new AliyunConfig($accessKeyId, $accessKeySecret, $signName, $templateCode);


        $captchaManager = new CaptchaManager();
        //发送短信验证码
        $captchaManager->setCaptchaType(CaptchaCodes::SMS_TYPECODE);
        //设置发送供应商
        $provider = $captchaManager->makeProvider(AliyunProvider::class, ['config' => $config]);*/
        //发送验证码由供应商发送
        //$provider->send($phone);

        //Aother
        //$config = new AotherConfig('xxxx', 'xxxx');
        //$captchaManager = new CaptchaManager();
        //发送短信验证码
        //$captchaManager->setCaptchaType(CaptchaCodes::SMS_TYPECODE);
        //$provider = $captchaManager->makeProvider(AotherProvider::class, ['config' => $config]);
        //$content = '【游戏】您的验证码是：${code}，验证码5分钟内有效，请勿泄露。';
        //$provider->send('xxx', $content);
        // $code = $provider->getCode();


        //创蓝
        $config = new ChuanglanConfig('xxx', 'xxx');
        $captchaManager = new CaptchaManager();
        //发送短信验证码
        $captchaManager->setCaptchaType(CaptchaCodes::SMS_TYPECODE);
        $provider = $captchaManager->makeProvider(ChuanglanProvider::class, ['config' => $config]);
        $content = '【xxx】验证码：{s}，5分钟内有效，注意保密喔。若非本人操作，请忽略。';
        $provider->send('xxx', $content);
        $code = $provider->getCode();
        pr('code => ' . $code);

        $this->assertEmpty(true);
    }


    public function testEmailCaptcha()
    {
        /*pr('---------------------------------------------');
        echo '邮箱验证码';
        pr('---------------------------------------------');
        $host = '';
        $username = '';
        $password = '';
        $toEmail = '';

        $config = new MailerConfig($host, $username, $password);
        $config->setForm($username);
        $config->setFormName('信息科技');
        $config->setSubject('服务邮件');

        $captchaManager = new CaptchaManager();
        //发送短信验证码
        $captchaManager->setCaptchaType(CaptchaCodes::EMAIL_TYPECODE);
        //设置发送供应商
        $provider = $captchaManager->makeProvider(MailerProvider::class, ['config' => $config]);
        $ret = $provider->send($toEmail);
        var_dump($ret);*/

        $this->assertEmpty(true);
    }
}