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

    protected function logFile()
    {
        $logFile = $this->logPath() . 'screenshot.log';

        if (!is_dir(dirname($logFile))) mkdir(dirname($logFile), 0777, true);

        if (!file_exists($logFile)) file_put_contents($logFile, '', FILE_APPEND);

        return $logFile;
    }

}