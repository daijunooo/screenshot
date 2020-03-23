<?php

namespace Screenshot\Abstracts;


use Screenshot\Config;

abstract class ScreenShot
{
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    protected function basePath()
    {
        return realpath(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR;
    }

    protected function binPath()
    {
        return $this->basePath() . 'bin' . DIRECTORY_SEPARATOR;
    }

    protected function scriptPath()
    {
        return $this->basePath() . 'scripts' . DIRECTORY_SEPARATOR;
    }

    protected function logPath()
    {
        if ($logPath = $this->config->getLogPath()) {
            return $logPath;
        }
        return $this->basePath() . 'logs' . DIRECTORY_SEPARATOR;
    }

}