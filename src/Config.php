<?php

namespace Screenshot;


class Config
{
    protected $port = 8181;

    protected $timeOut = 5000;

    protected $javascriptEnabled = false;

    protected $width = 750;

    protected $height = 1334;

    protected $logPath = '';

    public function getPort()
    {
        return $this->port;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    public function getTimeOut()
    {
        return $this->timeOut;
    }

    public function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    public function isJavascriptEnabled()
    {
        return $this->javascriptEnabled ? 'true' : 'false';
    }

    public function setJavascriptEnabled($javascriptEnabled)
    {
        $this->javascriptEnabled = $javascriptEnabled;

        return $this;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight()
    {
        return $this->height;

        return $this;
    }

    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogPath()
    {
        return $this->logPath;
    }

    /**
     * @param string $logPath
     */
    public function setLogPath($logPath)
    {
        $this->logPath = $logPath;

        return $this;
    }

    public function compileServer()
    {
        $script = <<<JS
var webserver = require('webserver');
var server = webserver.create();
var webpage = require('webpage');

var service = server.listen({$this->port}, function (request, response) {

    var page = webpage.create(), address;

    page.settings.resourceTimeout = {$this->timeOut};

    page.settings.javascriptEnabled = {$this->isJavascriptEnabled()};

    page.viewportSize = {width: {$this->width}, height: {$this->height}};

    address = request.url.substr(4);

    page.open(address, function (status) {
        if (status !== 'success') {
            console.log('Unable to load the address!');
            response.write(0);
        } else {
            console.log(address);
            response.write(page.renderBase64('PNG'));
        }
        response.close();
        page.close();
    });

});
JS;

        file_put_contents(dirname(__DIR__) . '/scripts/server.js', $script);
    }

}