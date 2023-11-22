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


namespace Onetrue\TextCaptcha\Provider\Aother;

use Onetrue\TextCaptcha\Exception\CaptchaException;
use Onetrue\TextCaptcha\Provider\Provider;
use GuzzleHttp\Client;


/**
 * 未知供应商
 */
class AotherProvider extends Provider
{

    /**
     * @var string
     */
    protected $endpoint = null;


    /**
     * @return AotherConfig
     */
    public function getConfig(): AotherConfig
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
            $callback = '';
            $orderNumber = date('YmdHis') . uniqid();
            $string = 'channelCallbackUrl=' . $callback . '&channelOrderId=' . $orderNumber . '&cid=' . $config->getCid() . '&number=[' . $phone . ']&key=' . $config->getSecretKey();
            $sign = md5($string);
            $requestBody = [
                'channelOrderId' => $orderNumber,
                'number' => [$phone],
                'channelCallbackUrl' => $callback,
                'cid' => $config->getCid(),
                'sendText' => $content,
                'sign' => $sign,
            ];

            $client = new Client([
                'timeout' => 3,
                'headers' => [
                    'Content-Type' => 'application/json; charset=utf-8',
                ]
            ]);
            $requestUrl = 'http://1.14.234.197:9092/SMS/signText/SMS/';
            $response = $client->post($requestUrl, ['json' => $requestBody]);
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $respBody = $response->getBody()->getContents();
                $json = json_decode($respBody, true);
                if ($json['code'] != 200) {
                    throw new \Exception($json['message'] . '-' . $json['order_id']);
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