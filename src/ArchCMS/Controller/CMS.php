<?php
/**
 * ArchCMS is Content Management System basics on ArchFW
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

namespace ArchAPI\Controller;

use ArchFW\Model\DatabaseFactory;

class CMS
{

    private $_db;

    public static function addPost($data)
    {

        if (isset($data)) {
            $_db = DatabaseFactory::getInstance();
            $_db->insert(
                "article", [
                             "title"     => $data['title'],
                             // "header_img" => $data['header_img'],
                             "meta_tags" => $data['meta_tags'],
                             // "category" => $data['category'],
                             "content"   => $data['editorContent'],
                             "time"      => date("y:m:d")
                             // "author" => $data['author']
                         ]
            );
            if ($_db->error()[1] != null) {
                print_r(["error" => "Database error"]);
            } else {
                print_r(["status" => "Done"]);
            }

        } else {
            print_r(["error" => "Wrong Data"]);
        }
    }

    public static function getPosts()
    {
        $_db = DatabaseFactory::getInstance();
        $result = [];

        $_data = $_db->select(
            'article', [
                         'id',
                         'title',
                         'time',
                     ]
        );

        foreach ($_data as $item) {
            $result[] = $item;
        }
        return json_encode($result);
    }

    public static function getEditedPost($id)
    {
        $_db = DatabaseFactory::getInstance();
        $result = [];

        $_data = $_db->select(
            'article',
            ['id', 'title', 'content', 'time'],
            ['id' => $id]
        );

        foreach ($_data as $item) {
            $result[] = $item;
        }
        return json_encode($result);
    }
}