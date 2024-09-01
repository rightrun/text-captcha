<?php
declare(strict_types=1);
/**
 * This file is part of rightrun/text-captcha
 *
 * @link     https://github.com/rightrun/text-captcha
 * @contact  a07sky@126.com
 * @license  https://github.com/a07sky/text-captcha/blob/master/LICENSE
 *
 */


namespace Onetrue\TextCaptcha\Provider\Chuanglan;

use Onetrue\TextCaptcha\Contracts\CaptchaConfigInterface;
use Onetrue\TextCaptcha\Exception\CaptchaException;
use Onetrue\TextCaptcha\Provider\Provider;
use GuzzleHttp\Client;


/**
 * 未知供应商
 */
class ChuanglanProvider extends Provider
{

    /**
     * @return ChuanglanConfig|CaptchaConfigInterface
     */
    public function getConfig(): ChuanglanConfig
    {
        return $this->config;
    }


    public function send(string $phone, string $content = null): bool
    {
        $this->validPhone($phone);
        $content = $this->getContent($content);
        $verifyCode = $this->getCode();
        $config = $this->getConfig();

        try {
            $requestBody = [
                'account' => $config->getUsername(),
                'password' => $config->getPassword(),
                'msg' => $content,
                'phone' => $phone,
                'report' => true,
            ];

            $client = new Client([
                'timeout' => 3,
                'headers' => [
                    'Content-Type' => 'application/json; charset=utf-8',
                ]
            ]);

            $requestUrl = 'https://smssh1.253.com/msg/v1/send/json';
            $response = $client->post($requestUrl, ['json' => $requestBody]);
            $this->response = $response;
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $respBody = $response->getBody()->getContents();
                $json = json_decode($respBody, true);

                // //{"code":"117","msgId":"","time":"20240901161623","errorMsg":"客户端IP错误"}
                if ($json['code'] !== '0') {
                    throw new \Exception($json['message'] ?? $json['errorMsg']);
                }
            } else {
                throw  new \Exception('渠道网络异常！');
            }
        } catch (\Exception $exception) {
            throw  new \Exception($exception->getMessage());
        }
        return true;
    }


    protected function validPhone($phone)
    {
        if (!preg_match('/^1\d{10}$/', $phone)) {
            throw new CaptchaException('手机格式不正确');
        }
        return true;
    }
}