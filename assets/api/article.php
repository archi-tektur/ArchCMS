<?php

use ArchCMS\Models\ArticleData;
use ArchCMS\Controllers\Article;

$Article = new Article();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':

        // raise an error when fields are not set
        if (!isset(
            $_POST['authorID'],
            $_POST['categoryID'],
            $_POST['title'],
            $_POST['contentShort'],
            $_POST['relatedImagePath'],
            $_POST['contentHTML'],
            $_POST['tags']
        )) {
            return [
                'statusCode'    => 401,
                'statusMessage' => 'Bad Request'
            ];
        }

        $ArticleData = new ArticleData(
            $_POST['authorID'],
            $_POST['categoryID'],
            $_POST['title'],
            $_POST['contentShort'],
            $_POST['relatedImagePath'],
            $_POST['contentHTML'],
            $_POST['tags']
        );
        $Article->add($ArticleData);
        if ($Article->checkSuccess()) {
            return [
                'statusCode'    => 201,
                'statusMessage' => 'Created'
            ];
        }
        return [
            'statusCode'    => 500,
            'statusMessage' => 'Database query problem'
        ];
        break;

    default:
        return [
            'statusCode'    => 405,
            'statusMessage' => 'Method not allowed'
        ];
}

return [];
