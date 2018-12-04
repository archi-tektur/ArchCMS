<?php

use \ArchFW\Controllers\Router;
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
    case 'GET':
        if (Router::getNthURI(2) === 'list') {
            if (isset($_GET['categoryID'])) {
                return [
                    'statusCode'    => 200,
                    'statusMessage' => 'OK',
                    'data'          => $Article->listByCategory($_GET['categoryID'])
                ];
            }
            return [
                'statusCode'    => 200,
                'statusMessage' => 'OK',
                'data'          => $Article->listArticles()
            ];
        }

        if (is_numeric(Router::getNthURI(2))) {
            return [
                'statusCode'    => 200,
                'statusMessage' => 'OK',
                'data'          => $Article->getArticle(Router::getNthURI(2))
            ];
        }
        return [
            'statusCode'    => 400,
            'statusMessage' => 'Bad Request: no ID'
        ];

        break;

    default:
        return [
            'statusCode'    => 405,
            'statusMessage' => 'Method not allowed'
        ];
}
