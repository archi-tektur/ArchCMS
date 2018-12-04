<?php

use \ArchFW\Controllers\Router;
use ArchCMS\Models\ArticleData;
use ArchCMS\Controllers\Article;

$Article = new Article();

switch ($_SERVER['REQUEST_METHOD']) {
    /*
     * SERVES DATA INSERT FUNCTIONALITY
     */
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
     * SERVES RESOURCE READ FUNCTIONALITY
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
    /*
     * SERVES DATA WITHDRAWAL FUNCTIONALITY
     */
    case 'DELETE':
        // if articleID is given - delete
        if (is_numeric(Router::getNthURI(2))) {
            $Article->delete(Router::getNthURI(2));
            if ($Article->checkSuccess()) {
                return [
                    'statusCode'    => '200',
                    'statusMessage' => 'OK'
                ];
            }
            return [
                'statusCode'    => '404',
                'statusMessage' => 'Not Found'
            ];

        }
        // return 404 is theres nothing to delete
        return [
            'statusCode'    => '404',
            'statusMessage' => 'Not Found'
        ];
        break;

    // When used different method than specified above
    default:
        return [
            'statusCode'    => 405,
            'statusMessage' => 'Method not allowed'
        ];
}
