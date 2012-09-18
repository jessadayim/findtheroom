<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SourcecodeEx
 * Date: 17/9/2555
 * Time: 15:48 น.
 * To change this template use File | Settings | File Templates.
 */

namespace FTR\AdminBundle\Helper;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\IntrospectionProcessor;

class LoggerHelper extends Logger
{
    protected  function getAppLogDir()
    {
        return __DIR__.'/../../../../app/logs/';
    }

    public function __construct($channelName = 'FTR')
    {
        $this->name = $channelName;

        $logHandler = new StreamHandler($this->getAppLogDir().'findtheroom.log', Logger::INFO);
        $rotateHandler = new RotatingFileHandler($this->getAppLogDir().'ftrdaily.log', 90, Logger::DEBUG);

        $webProcessor = new WebProcessor();
        $introspectionProcessor = new IntrospectionProcessor();

        $logHandler->pushProcessor($webProcessor);

        $rotateHandler->pushProcessor($webProcessor);
        $rotateHandler->pushProcessor($introspectionProcessor);

        $this->pushHandler($logHandler);
        $this->pushHandler($rotateHandler);
    }
}