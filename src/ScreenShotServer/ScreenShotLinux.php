<?php

namespace Screenshot\ScreenShotServer;


use Screenshot\Abstracts\ScreenShot;

class ScreenShotLinux extends ScreenShot implements \Screenshot\Contracts\ScreenShot
{

    public function isRunning()
    {
        exec('ps | grep phantomjs', $output);

        return count($output);
    }

    public function start()
    {
        $shell = "%sphantomjs %sserver.js >> %s";

        $command = sprintf($shell, $this->binPath(), $this->scriptPath(), $this->logFile());

        exec($command);
    }

    public function stop()
    {
        exec('pkill -f "phantomjs"');
    }
}