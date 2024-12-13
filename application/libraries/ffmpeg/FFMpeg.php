<?php

require_once(APPPATH . 'libraries/ffmpeg/vendor/autoload.php');

use FFMpeg\FFMpeg as FFMpegLib;

class FFMpeg
{
    private $ffmpeg;

    public function __construct()
    {
        $this->ffmpeg = FFMpegLib::create();
    }

    public function open($path)
    {
        return $this->ffmpeg->open($path);
    }
}
