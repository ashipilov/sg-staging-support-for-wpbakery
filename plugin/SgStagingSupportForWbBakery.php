<?php

class SgStagingSupportForWbBakery
{
    protected $home_url;
    protected $isStaging;
    protected $baseHost;
    protected $stagingHost;
    
    public function __construct($home_url) {
        $this->home_url = $home_url;

        if (preg_match('/(http|https):\/\/(staging\d+\.([^\/]*))(\/)?/', $home_url, $matches)) {
            $this -> isStaging = true;
            $this -> stagingHost = $matches[2];
            $this -> baseHost = $matches[3];
        }
        else {
            $this -> isStaging = false;
        }
    }

    public function stage($content)
    {
        return $this->isStaging ? $this -> replace($content, $this->baseHost, $this->stagingHost) : $content;
    }

    public function unStage($content)
    {
        return $this->isStaging ? $this -> replace($content, $this->stagingHost, $this->baseHost) : $content;
    }

    protected function replace($content, $originalHost, $newHost) {
        return $this->replaceProtocol($this-> replaceProtocol($content, 'http',  $originalHost, $newHost),
            'https', $originalHost, $newHost);
    }

    protected function replaceProtocol($content, $protocol, $originalHost, $newHost) {
        $stringToReplace = $protocol . '%3A%2F%2F' . $originalHost;
        $newString = $protocol . '%3A%2F%2F' . $newHost;
        return str_replace($stringToReplace, $newString, $content);
    }
}