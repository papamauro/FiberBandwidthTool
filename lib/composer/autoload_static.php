<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4ccb0d3133d43af5b7bbade87e99ddc7
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\Yaml\\' => 23,
            'Symfony\\Component\\Validator\\' => 28,
            'Symfony\\Component\\Translation\\' => 30,
            'Symfony\\Component\\Finder\\' => 25,
            'Symfony\\Component\\Filesystem\\' => 29,
            'Symfony\\Component\\Debug\\' => 24,
            'Symfony\\Component\\Console\\' => 26,
            'Symfony\\Component\\Config\\' => 25,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Symfony\\Component\\Validator\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/validator',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Symfony\\Component\\Filesystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/filesystem',
        ),
        'Symfony\\Component\\Debug\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/debug',
        ),
        'Symfony\\Component\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Symfony\\Component\\Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/config',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Propel' => 
            array (
                0 => __DIR__ . '/..' . '/propel/propel/src',
            ),
        ),
    );

    public static $classMap = array (
        'Base\\Generic' => __DIR__ . '/../..' . '/php/models/Base/Generic.php',
        'Base\\GenericQuery' => __DIR__ . '/../..' . '/php/models/Base/GenericQuery.php',
        'Base\\Mail' => __DIR__ . '/../..' . '/php/models/Base/Mail.php',
        'Base\\MailQuery' => __DIR__ . '/../..' . '/php/models/Base/MailQuery.php',
        'Base\\Remote' => __DIR__ . '/../..' . '/php/models/Base/Remote.php',
        'Base\\RemoteQuery' => __DIR__ . '/../..' . '/php/models/Base/RemoteQuery.php',
        'Base\\Requests' => __DIR__ . '/../..' . '/php/models/Base/Requests.php',
        'Base\\RequestsQuery' => __DIR__ . '/../..' . '/php/models/Base/RequestsQuery.php',
        'Base\\Security' => __DIR__ . '/../..' . '/php/models/Base/Security.php',
        'Base\\SecurityQuery' => __DIR__ . '/../..' . '/php/models/Base/SecurityQuery.php',
        'Base\\User' => __DIR__ . '/../..' . '/php/models/Base/User.php',
        'Base\\UserQuery' => __DIR__ . '/../..' . '/php/models/Base/UserQuery.php',
        'Base\\Video' => __DIR__ . '/../..' . '/php/models/Base/Video.php',
        'Base\\VideoQuery' => __DIR__ . '/../..' . '/php/models/Base/VideoQuery.php',
        'Base\\Voip' => __DIR__ . '/../..' . '/php/models/Base/Voip.php',
        'Base\\VoipQuery' => __DIR__ . '/../..' . '/php/models/Base/VoipQuery.php',
        'Base\\Web' => __DIR__ . '/../..' . '/php/models/Base/Web.php',
        'Base\\WebQuery' => __DIR__ . '/../..' . '/php/models/Base/WebQuery.php',
        'Base\\remoteBand' => __DIR__ . '/../..' . '/php/models/Base/remoteBand.php',
        'Base\\remoteBandQuery' => __DIR__ . '/../..' . '/php/models/Base/remoteBandQuery.php',
        'Base\\voipCodec' => __DIR__ . '/../..' . '/php/models/Base/voipCodec.php',
        'Base\\voipCodecQuery' => __DIR__ . '/../..' . '/php/models/Base/voipCodecQuery.php',
        'Generic' => __DIR__ . '/../..' . '/php/models/Generic.php',
        'GenericQuery' => __DIR__ . '/../..' . '/php/models/GenericQuery.php',
        'Mail' => __DIR__ . '/../..' . '/php/models/Mail.php',
        'MailQuery' => __DIR__ . '/../..' . '/php/models/MailQuery.php',
        'Map\\GenericTableMap' => __DIR__ . '/../..' . '/php/models/Map/GenericTableMap.php',
        'Map\\MailTableMap' => __DIR__ . '/../..' . '/php/models/Map/MailTableMap.php',
        'Map\\RemoteTableMap' => __DIR__ . '/../..' . '/php/models/Map/RemoteTableMap.php',
        'Map\\RequestsTableMap' => __DIR__ . '/../..' . '/php/models/Map/RequestsTableMap.php',
        'Map\\SecurityTableMap' => __DIR__ . '/../..' . '/php/models/Map/SecurityTableMap.php',
        'Map\\UserTableMap' => __DIR__ . '/../..' . '/php/models/Map/UserTableMap.php',
        'Map\\VideoTableMap' => __DIR__ . '/../..' . '/php/models/Map/VideoTableMap.php',
        'Map\\VoipTableMap' => __DIR__ . '/../..' . '/php/models/Map/VoipTableMap.php',
        'Map\\WebTableMap' => __DIR__ . '/../..' . '/php/models/Map/WebTableMap.php',
        'Map\\remoteBandTableMap' => __DIR__ . '/../..' . '/php/models/Map/remoteBandTableMap.php',
        'Map\\voipCodecTableMap' => __DIR__ . '/../..' . '/php/models/Map/voipCodecTableMap.php',
        'Remote' => __DIR__ . '/../..' . '/php/models/Remote.php',
        'RemoteQuery' => __DIR__ . '/../..' . '/php/models/RemoteQuery.php',
        'Requests' => __DIR__ . '/../..' . '/php/models/Requests.php',
        'RequestsQuery' => __DIR__ . '/../..' . '/php/models/RequestsQuery.php',
        'Security' => __DIR__ . '/../..' . '/php/models/Security.php',
        'SecurityQuery' => __DIR__ . '/../..' . '/php/models/SecurityQuery.php',
        'User' => __DIR__ . '/../..' . '/php/models/User.php',
        'UserQuery' => __DIR__ . '/../..' . '/php/models/UserQuery.php',
        'Video' => __DIR__ . '/../..' . '/php/models/Video.php',
        'VideoQuery' => __DIR__ . '/../..' . '/php/models/VideoQuery.php',
        'Voip' => __DIR__ . '/../..' . '/php/models/Voip.php',
        'VoipQuery' => __DIR__ . '/../..' . '/php/models/VoipQuery.php',
        'Web' => __DIR__ . '/../..' . '/php/models/Web.php',
        'WebQuery' => __DIR__ . '/../..' . '/php/models/WebQuery.php',
        'remoteBand' => __DIR__ . '/../..' . '/php/models/remoteBand.php',
        'remoteBandQuery' => __DIR__ . '/../..' . '/php/models/remoteBandQuery.php',
        'voipCodec' => __DIR__ . '/../..' . '/php/models/voipCodec.php',
        'voipCodecQuery' => __DIR__ . '/../..' . '/php/models/voipCodecQuery.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4ccb0d3133d43af5b7bbade87e99ddc7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4ccb0d3133d43af5b7bbade87e99ddc7::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit4ccb0d3133d43af5b7bbade87e99ddc7::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit4ccb0d3133d43af5b7bbade87e99ddc7::$classMap;

        }, null, ClassLoader::class);
    }
}