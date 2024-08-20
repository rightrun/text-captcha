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


namespace Onetrue\TextCaptcha\Provider\Aliyun;

use Onetrue\TextCaptcha\Contracts\CaptchaConfigInterface;
use Onetrue\TextCaptcha\Exception\CaptchaException;
use Onetrue\TextCaptcha\Provider\Provider;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use AlibabaCloud\Tea\Exception\TeaUnableRetryError;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use Darabonba\OpenApi\Models\Config as DarabonbaConfig;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;

/**
 * 阿里文档： https://next.api.aliyun.com/api-tools/sdk/Dysmsapi?version=2017-05-25&language=php-tea
 */
class AliyunProvider extends Provider
{

    /**
     * @var string
     */
    protected $endpoint = null;


    /**
     * @return AliyunConfig|CaptchaConfigInterface
     */
    public function getConfig(): AliyunConfig
    {
        return $this->config;
    }

    public function getEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function send(string $phone, string $content = null): bool
    {
        $this->validPhone($phone);
        $content = $this->getContent($content);
        $verifyCode = $this->getCode();
        $aliConfig = $this->getConfig();

        $config = new DarabonbaConfig([
            // 您的AccessKey ID
            "accessKeyId" => $aliConfig->getAccessKeyId(),
            // 您的AccessKey Secret
            "accessKeySecret" => $aliConfig->getSecretKey()
        ]);
        // 访问的域名
        $config->endpoint = $this->endpoint ?? "dysmsapi.aliyuncs.com";
        $aliClient = new Dysmsapi($config);
        $sendSmsRequest = new SendSmsRequest([
            "signName" => $aliConfig->getSignName(),
            "templateCode" => $aliConfig->getTemplateCode(),
            "phoneNumbers" => $phone,
            "templateParam" => json_encode(['code' => $verifyCode], JSON_UNESCAPED_UNICODE)]);

        try {
            $runtime = new RuntimeOptions([]);
            // 复制代码运行请自行打印 API 的返回值
            $response = $aliClient->sendSmsWithOptions($sendSmsRequest, $runtime);
            if ($response->body->code !== 'OK' || $response->body->message != 'OK') {
                throw new CaptchaException($response->body->code . ',' . $response->body->message);
            }
        } catch (TeaUnableRetryError $error) {
            $exception = $error->getLastException();
            throw new CaptchaException($exception->getMessage());
        } catch (\Exception $error) {
            throw new CaptchaException($error->getMessage());
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