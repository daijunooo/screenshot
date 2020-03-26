<?php

namespace Screenshot\ScreenShotServer;


use Screenshot\Abstracts\ScreenShot;

class ScreenShotWINNT extends ScreenShot implements \Screenshot\Contracts\ScreenShot
{
    public function isRunning()
    {
        exec('wmic process where name="phantomjs.exe" get name', $output);

        return (bool) array_shift($output);
    }

    public function start()
    {
        $shell = "start /B %sphantomjs %sserver.js >> %s";

        $command = sprintf($shell, $this->binPath(), $this->scriptPath(), $this->logFile());

        exec($command);
    }

    public function stop()
    {
        exec('wmic process where name="phantomjs.exe" delete');
    }
}