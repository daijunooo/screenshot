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
                throw new ScreenServerException('暂不支持此操作系统');
        }
    }

    public function isRunning()
    {
        return $this->server->isRunning();
    }

    public function start()
    {
        $this->config->compileServer();
        $this->server->start();
    }

    public function stop()
    {
        $this->server->stop();
    }

}