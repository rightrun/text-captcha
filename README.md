### 一、 文本验证码服务

> 文本验证码服务包含多种：短信验证和邮箱验证码
#### 1. 设计方式
- 发送验证码
  - 短信验证码
    - 短信渠道
      - 阿里云
      - 华为
      - 梦网
      - 创蓝
  - 邮箱验证码
    - stmp


### 二、使用说明

#### 1. 短信验证码
```php


```

#### 2. 邮箱验证码
```php



```

#### 1. 安装phpunit

```shell


$ curl -LO https://phar.phpunit.de/phpunit-9.6.phar
$ chmod +x phpunit-9.6.phar
$ sudo mv phpunit-9.6.phar /usr/local/bin/phpunit
$ phpunit --version
```

#### 2. 运行单元测试

```shell

phpunit --bootstrap tests/bootstrap.php tests/Cases/TextCaptchaTest.php

```
