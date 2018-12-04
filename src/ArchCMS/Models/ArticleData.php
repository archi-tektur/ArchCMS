<?php

namespace ArchCMS\Models;

class ArticleData extends Data
{
    private $authorID;
    private $categoryID;
    private $title;
    private $contentShort;
    private $contentHTML;
    private $relatedImagePath;
    private $tags;
    private $date;

    public function __construct(
        $authorID,
        $categoryID,
        $title,
        $contentShort,
        $relatedImagePath,
        $contentHTML,
        $tags,
        $date
    ) {
        $this->authorID = $authorID;
        $this->categoryID = $categoryID;
        $this->title = $title;
        $this->contentShort = $contentShort;
        $this->relatedImagePath = $relatedImagePath;
        $this->contentHTML = $contentHTML;
        $this->tags = $tags;
        $this->date = $date;
    }

    public function validate(): bool
    {
        return true;
    }

    /* GETTERS ZONE */

    /**
     * @return mixed
     */
    public function getAuthorID()
    {
        return $this->authorID;
    }

    /**
     * @return mixed
     */
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContentShort()
    {
        return $this->contentShort;
    }

    /**
     * @return mixed
     */
    public function getRelatedImagePath()
    {
        return $this->relatedImagePath;
    }

    /**
     * @return mixed
     */
    public function getContentHTML()
    {
        return $this->contentHTML;
    }


    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }
}
