<?php

/**
 * ArchCMS is Content Management System basics on ArchFW
 *
 * 
 *
 * PHP version 7.2
 *
 * @category  CMS
 * @package   ArchCMS
 * @author    Michał Malinowski <malk@int.pl>
 * @copyright archi_tektur group
 * @license   MIT
 * @version   4.0
 * @link       
 */

use ArchAPI\Controller\CMS;

if(isset($_POST['data']))
    $json = $_POST['data'];
else
    return ["error" => "Data read problem"];

switch($json['operation']){
    case 'add': return CMS::addPost($json); break;
    case 'get':  return CMS::getPosts(); break;
    case 'getEdited': return CMS::getEditedPost($json['id']); break;
    default: return ["error" => "unknown operation"];
}

