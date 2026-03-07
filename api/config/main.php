<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers', // Assicurati che sia api\controllers
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            // Forza la risposta sempre in JSON
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false, // Le API sono stateless (senza sessione)
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'urlManager' => [
            /*'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,*/
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/post'],
            ],
        ],
    ],
];