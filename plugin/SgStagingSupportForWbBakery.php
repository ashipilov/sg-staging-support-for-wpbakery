<?php

class SgStagingSupportForWbBakery
{
    protected $isStaging;
    protected $baseHost;
    protected $stagingHost;
    
    public function __construct($home_url) {

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
        $regex = '/(http|https)%3A%2F%2F' . preg_quote($originalHost) . '/';
        $replaceWith = '${1}%3A%2F%2F' . $newHost;
        return preg_replace($regex, $replaceWith, $content);
    }
}