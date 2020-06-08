<?php

class Orszag {

    private $orszag;
    private $ev;
    
    function __construct($orszag, $ev) {
        $this->orszag = $orszag;
        $this->ev = $ev;
    }
    function getOrszag() {
        return $this->orszag;
    }

    function getEv() {
        return $this->ev;
    }

    function setOrszag($orszag): void {
        $this->orszag = $orszag;
    }

    function setEv($ev): void {
        $this->ev = $ev;
    }



}
