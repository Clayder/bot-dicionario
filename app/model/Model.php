<?php

/**
 * @author Peter Clayder
 */

namespace app\model;

use app\banco\Bd;

/**
 * Class Model
 * @package app\model
 */
abstract class Model
{
    /**
     * @var Bd Bd
     */
    protected $db;

    /**
     * Model constructor.
     */
    function __construct()
    {
        $this->db = new Bd();
    }


}