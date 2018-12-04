<?php

namespace ArchCMS\Controllers;

use ArchCMS\Models\ArticleData;
use ArchFW\Models\DatabaseFactory;

/**
 * Article related content
 * @package ArchCMS\Controllers
 */
class Article
{
    /**
     * @var \Medoo\Medoo database link
     */
    private $db;

    /**
     * @var bool $success flag holds information if query has been done correctly
     */
    private $success = false;

    /**
     * Creates database link
     */
    public function __construct()
    {
        $this->db = DatabaseFactory::getInstance();
    }

    /**
     * Adds article to database
     *
     * @param ArticleData $Data
     */
    public function add(ArticleData $Data): void
    {
        $result = $this->db->insert('articles', [
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

        // set success flag to true when successful
        if ($result->rowCount()) {
            $this->success = true;
        }
    }

    /**
     * @param int $articleID
     * @return array
     */
    public function getArticle(int $articleID): array
    {
        return $this->db->select('articles', [
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
        ], [
            'ID[=]' => $articleID
        ]);
    }

    /**
     * @return array
     */
    public function listArticles(): array
    {
        return $this->db->select('articles', [
            'ID',
            'authorID',
            'categoryID',
            'title',
            'contentShort',
            'relatedImagePath',
            'tags',
            'date',
            'lastEdit'
        ]);
    }

    /**
     * @param int $categoryID
     * @return array
     */
    public function listByCategory(int $categoryID): array
    {
        return $this->db->select('articles', [
            'ID',
            'authorID',
            'categoryID',
            'title',
            'contentShort',
            'relatedImagePath',
            'tags',
            'date',
            'lastEdit'
        ], [
            'categoryID[=]' => $categoryID
        ]);
    }

    /**
     * @param int $articleID
     * @return bool
     */
    public function delete(int $articleID): void
    {
        $result = $this->db->delete('articles', [
            'ID[=]' => $articleID
        ]);
        if ($result->rowCount()) {
            $this->success = true;
        }
    }

    /**
     * Checks success of previous operation
     *
     * @return bool
     */
    public function checkSuccess(): bool
    {
        return $this->success;
    }
}
