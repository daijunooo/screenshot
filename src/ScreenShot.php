<?php

namespace Screenshot;


use Screenshot\Exceptions\ScreenServerException;
use Screenshot\ScreenShotServer\ScreenShotLinux;
use Screenshot\ScreenShotServer\ScreenShotWINNT;

class ScreenShot
{
    private $config;

    private $server;

    /**
     * ScreenShot constructor.
     */
    public function __construct(Config $config = null)
    {
        $this->config = $config === null ? new Config() : $config;

        $this->server = $this->setServer();
    }

    protected function setServer()
    {
        switch (PHP_OS) {
            case 'WINNT':
                return new ScreenShotWINNT($this->config);
            case 'Linux':
                return new ScreenShotLinux($this->config);
            default:
                throw new ScreenServerException('暂不支持此操作系统', 400);
        }
    }

    public function isRunning()
    {
        return $this->server->isRunning();
    }

    public function start()
    {
        if ($this->isRunning()) return;

        $this->config->compileServer();

        $this->server->start();
    }

    public function stop()
    {
        $this->server->stop();
    }

    public function shot($url)
    {
        $this->start();

        header("content-type: image/png");

        $img = file_get_contents('http://127.0.0.1:' . $this->config->getPort() . '/?a=' . $url);

        echo base64_decode($img);
    }

}