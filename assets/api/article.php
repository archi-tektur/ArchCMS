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
    /*
     * GET METHOD SERVES DATA READ FUNCTIONALITY
     */
    case 'GET':
        // if user wants header without content
        if (Router::getNthURI(2) === 'list') {
            // if user gave post category ID
            if (isset($_GET['categoryID'])) {
                return [
                    'statusCode'    => 200,
                    'statusMessage' => 'OK',
                    'data'          => $Article->listByCategory($_GET['categoryID'])
                ];
            }
            // if user did not gave any category
            return [
                'statusCode'    => 200,
                'statusMessage' => 'OK',
                'data'          => $Article->listArticles()
            ];
        }

        // if only numeric given, return full article details
        if (is_numeric(Router::getNthURI(2))) {
            $result = $Article->getArticle(Router::getNthURI(2));
            // if there's no article with selected ID
            if (empty($result)) {
                return [
                    'statusCode'    => 404,
                    'statusMessage' => 'Not Found'
                ];
            }
            return [
                'statusCode'    => 200,
                'statusMessage' => 'OK',
                'data'          => $result
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
