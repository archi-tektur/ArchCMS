<?php

use \ArchFW\Controllers\Router;
use ArchCMS\Models\ArticleData;
use ArchCMS\Controllers\Article;

$Article = new Article();

switch (Router::getNthURI(2)) {
    case 'add':
        $ArticleData = new ArticleData(
            $_POST['authorID'],
            $_POST['cateogryID'],
            $_POST['title'],
            $_POST['contentShort'],
            $_POST['relatedImagePath'],
            $_POST['contentHTML'],
            $_POST['tags']
        );
        $Article->add($ArticleData);
        break;
}

return [];
