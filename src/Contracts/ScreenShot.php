<?php

namespace Screenshot\Contracts;


interface ScreenShot
{
    public function isRunning();

    public function start();

    public function stop();
}