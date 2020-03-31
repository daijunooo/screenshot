# screenshot
网页截图服务，用于生成小程序海报。(mac系统暂未适配)

## 安装

```
composer require tommy-dai/screenshot
```

## 使用
#### 快速上手

```php
$screenshot = new \Screenshot\ScreenShot();
$screenshot->shot('http://image.baidu.com');
```

> 注意：第一次访问图片有可能不出来，后面就不会出现了

##### 不出意外就可以获得百度图片的网页截图
![](http://daijunooo-img.test.upcdn.net/blog/baiduimg.png)

#### 可选配置项

```php
//截图服务端口号
port = 8181;

//超时时间（毫秒）
timeOut = 5000;

//是否解析页面中的JavaScript代码
javascriptEnabled = false;

//图片宽度（单位像素）
width = 750;

//图片高度（单位像素）
height = 1334;

//截图日志文件存放路径（绝对路径）
logPath = '';
```

#### 修改默认配置项

```php
//获取默认配置
$config = new \Screenshot\Config();

//修改默认端口号（修改配置）
$config->setPort(8080);

//修改默认端图片宽度
$config->setWidth(600);

//修改默认端图片高度
$config->setHeight(800);

//开启JavaScript支持（开启后将可以解析页面中js代码，对于js生成的页面可以截取）
$config->setJavascriptEnabled(true);

//用配置文件初始化截图服务（不传$config会走默认配置）
$screenshot = new \Screenshot\ScreenShot($config);

//生成截图服务并截取百度图片
$screenshot->shot('http://image.baidu.com');
```

> 注意：修改配置项需要关闭当前截图服务，重新开启。

#### 关闭步骤

- 改为下面代码然后通过浏览器访问一次就可以关闭服务了

```php
$screenshot = new \Screenshot\ScreenShot();

//关闭截图服务
$screenshot->stop();
```



#### 特殊用法

```php
$screenshot = new \Screenshot\ScreenShot();

//开启截图服务
$screenshot->start();
```

#### 开启截图服务 $screenshot->start() 之后能干什么
1. 可以通过访问 http://127.0.0.1:8181/?a=http://image.baidu.com 获取截图的 base64 字符串
2. 可以部署多台截图服务用nginx做负载均衡

#### 更多疑问请提 issues