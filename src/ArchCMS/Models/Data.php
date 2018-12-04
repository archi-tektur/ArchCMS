<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 16 August 2018
 * Time: 21:36
 */

namespace ArchCMS\Models;

use ArchCMS\Interfaces\ValidateInterface;
use Exception;

/**
 * Class Data
 *
 * @package PasswordManager\Model
 */
abstract class Data implements ValidateInterface
{
    /**
     * Validates fully entered data
     *
     * @return bool true if everything went OK while verifying
     * @throws Exception when given data are not valid
     */
    abstract public function validate(): bool;
}
