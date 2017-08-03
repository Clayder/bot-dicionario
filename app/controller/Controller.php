<?php
/**
 * @author Peter Clayder
 */

namespace app\controller;

/**
 * Class Controller
 * @package app\controller
 */
abstract class Controller
{

    public function __construct()
    {
        /* Verifica se tem mensagem de alerta */
        flashDataVerifica();
    }

    /**
     * @param string $view
     */
    protected function view($view)
    {
        include PASTA_BASE_VIEW . "/" . $view . ".php";
    }
}