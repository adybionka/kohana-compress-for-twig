<?php defined('SYSPATH') or die('No direct script access.');

class Twig_Extension_Compress extends Twig_Extension {

    public function getTokenParsers()
    {
        return array(
            new Twig_TokenParser_Compress(),
        );
    }

    public function getName()
    {
        return 'Compress';
    }
}