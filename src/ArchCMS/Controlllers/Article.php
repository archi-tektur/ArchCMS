<?php

namespace ArchCMS\Controllers;

use ArchCMS\Models\ArticleData;
use ArchFW\Models\DatabaseFactory;

class Article
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseFactory::getInstance();
    }

    public function add(ArticleData $Data): void
    {
        $this->db->insert('articles', [
            'ID'               => null,
            'authorID'         => $Data->getAuthorID(),
            'categoryID'       => $Data->getCategoryID(),
            'title'            => $Data->getTitle(),
            'contentShort'     => $Data->getContentShort(),
            'contentHTML'      => $Data->getContentHTML(),
            'relatedImagePath' => $Data->getRelatedImagePath(),
            'tags'             => $Data->getTags(),
            'date'             => date('Y-m-d H:i:s'),
            'lastEdit'         => null
        ]);
    }
}
