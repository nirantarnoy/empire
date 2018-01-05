<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => 'dashboard/index',
    'modules' => [
             'gridview' => ['class' => 'kartik\grid\Module']
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'view'=>[
                'theme'=>[
                  'pathMap'=>[
                       '@app/views' => '@backend/views/layouts/layouts/yii2-app'
                       //'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                             ]
                 ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
         'authClientCollection'=>[
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook'=>[
                    'class'=>'yii\authclient\clients\Facebook',
                    'authUrl'=>'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '828260794001696',
                    'clientSecret'=>'521d404ede1614a805b02731d459c17f',
                ]
            ]
        ],
    ],
    'params' => $params,
];
