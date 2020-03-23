<?php

namespace Screenshot\ScreenShotServer;


use Screenshot\Abstracts\ScreenShot;

class ScreenShotWINNT extends ScreenShot implements \Screenshot\Contracts\ScreenShot
{
    public function isRunning()
    {
        return 'winnt';
    }

    public function start()
    {
        $shell = "start /b %sphantomjs %sserver.js > %sscreenshot.log";
        $binPath = $this->binPath();
        $scriptPath = $this->scriptPath();
        $logPath = $this->logPath();
        $command = sprintf($shell, $binPath, $scriptPath, $logPath);
        exec(escapeshellcmd($command));
    }

    public function stop()
    {
        // TODO: Implement stop() method.
    }
}