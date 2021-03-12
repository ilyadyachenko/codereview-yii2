<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
	    'mailer' => [
		    'class' => 'yii\swiftmailer\Mailer',
		    'useFileTransport' => false,
		    'transport' => [
			    'class' => 'Swift_SmtpTransport',
			    'host' => 'smtp.mailtrap.io',
			    'username' => 'insert_username',
			    'password' => 'insert_password',
			    'port' => '2525',
			    'encryption' => 'tls',
		    ],
	    ],
    ],
];
