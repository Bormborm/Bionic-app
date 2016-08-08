<?php

namespace Bormborm\Controller;


class TemplateController
{
    const VIEWS_DIR = __DIR__ . '/../Views';
    const CACHE_DIR = __DIR__ . '/../../cache/views';
    /**
     * @var \Twig_Environment
     */
    protected $templater;

    public function __construct()
    {
        $this->templater = new \Twig_Environment(
            new \Twig_Loader_Filesystem((self::VIEWS_DIR),
        array('cache' => self::CACHE_DIR, 'auto_reload' => true)));
    }
}
