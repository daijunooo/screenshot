<?php

namespace Screenshot\ScreenShotServer;


use Screenshot\Abstracts\ScreenShot;

class ScreenShotLinux extends ScreenShot implements \Screenshot\Contracts\ScreenShot
{

    public function isRunning()
    {
        return 'linux';
    }

    public function start()
    {
        // TODO: Implement start() method.
    }

    public function stop()
    {
        // TODO: Implement stop() method.
    }
}