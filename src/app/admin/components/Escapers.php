<?php

namespace Multiple\Admin\Component;
use Phalcon\Escaper;



class Escapers extends Escaper
{
    public function escape($var)
    {
        $escaper = new Escaper();
        return $escaper->escapeHtml($var);
    }
    
}