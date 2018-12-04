<?php

namespace ArchCMS\Controllers;

use ArchFW\Models\DatabaseFactory;

class Article
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseFactory::getInstance();
    }

    public function add(): void
    {
        $this->db->insert('articles', [
           'ID',
           'authorID',
           'categoryID',
           'title',
           'contentShort',
           'contentHTML',
           'relatedImagePath',
           'tags',
           'date',
           'lastEdit'
        ]);
    }
}
