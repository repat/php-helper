<?php
/*
|--------------------------------------------------------------------------
| Misc
|--------------------------------------------------------------------------
*/

if (! defined('PARETO_HIGH')) {
    /**
     * Pareto Principle/Distribution aka 80/20 rule
     * @var int
     */
    define('PARETO_HIGH', 80);
}

if (! defined('PARETO_LOW')) {
    /**
     * Pareto Principle/Distribution aka 80/20 rule
     * @var int
     */
    define('PARETO_LOW', 20);
}

if (! defined('MARIADB_DEFAULT_STRLEN')) {
    /**
     * MariaDB (or older MySQL) default String Length
     * https://laravel-news.com/laravel-5-4-key-too-long-error
     *
     * @var int
     */
    define('MARIADB_DEFAULT_STRLEN', 191);
}

if (! defined('ONE_HUNDRED_PERCENT')) {
    /**
     * To avoid 100 being a Magic Number
     *
     * @var int
     */
    define('ONE_HUNDRED_PERCENT', 100);
}

if (! defined('KILO')) {
    /**
     * From Greek = thousand, e.g. Kilogramm or Kilobyte
     *
     * @var int
     */
    define('KILO', 1000);
}

if (! defined('KIBI')) {
    /**
     * To tell apart KiloByte (1000 Byte) and KibiByte (1024 Byte)
     *
     * @var int
     */
    define('KIBI', 1024);
}

/*
|--------------------------------------------------------------------------
| Characters
|--------------------------------------------------------------------------
*/

if (! defined('NBSP')) {
    /**
     * Non-Breaking Space, hard to spot invisible char
     * @var string
     */
    define('NBSP', "\xc2\xa0");
}

if (! defined('CR')) {
    /**
     * Carriage Return (MacOS)
     *
     * @var string
     */
    define('CR', "\r");
}

if (! defined('LF')) {
    /**
     * Line Feed (*nix)
     *
     * @var string
     */
    define('LF', "\n");
}

if (! defined('CRLF')) {
    /**
     * Carriage Return + Line Feed (Windows)
     *
     * @var string
     */
    define('CRLF', "\r\n");
}

/*
|--------------------------------------------------------------------------
| Networking
|--------------------------------------------------------------------------
*/

if (! defined('HTTP_1_0_VERBS')) {
    /**
     * HTTP 1.0 Verbs (rfc1945)
     * @var array
     */
    define('HTTP_1_0_VERBS', ['get', 'head', 'post']);
}

if (! defined('HTTP_1_1_VERBS')) {
    /**
     * HTTP 1.1 Verbs (rfc2616)
     * @var array
     */
    define('HTTP_1_1_VERBS', array_merge(HTTP_1_0_VERBS, ['connect', 'delete', 'options', 'put', 'trace']));
}

if (! defined('HTTP_VERBS')) {
    /**
     * All HTTP Verbs including PATCH (rfc5789)
     * @var array
     */
    define('HTTP_VERBS', array_merge(HTTP_1_1_VERBS, ['patch']));
}

if (! defined('WEAK_CIPHERS')) {
    /**
     * Ciphers that should not be used
     * @var array
     */
    define('WEAK_CIPHERS', [
        'TLS_DHE_RSA_WITH_AES_256_GCM_SHA384',
        'TLS_DHE_RSA_WITH_AES_256_CBC_SHA256',
        'TLS_DHE_RSA_WITH_AES_256_CBC_SHA',
        'TLS_DHE_RSA_WITH_CAMELLIA_256_CBC_SHA',
        'TLS_DHE_RSA_WITH_CAMELLIA_128_CBC_SHA',
        'TLS_DHE_RSA_WITH_AES_128_CBC_SHA256',
        'TLS_DHE_RSA_WITH_AES_128_CBC_SHA',
        'TLS_DHE_RSA_WITH_AES_128_GCM_SHA256',
        'TLS_DHE_RSA_WITH_3DES_EDE_CBC_SHA',
        'SSL_DHE_RSA_WITH_AES_128_CBC_SHA',
        'SSL_DHE_RSA_WITH_AES_256_CBC_SHA',
        'SSL_DHE_RSA_WITH_CAMELLIA_256_CBC_SHA',
        'SSL_DHE_RSA_WITH_CAMELLIA_128_CBC_SHA',
        'SSL_DHE_RSA_WITH_3DES_EDE_CBC_SHA'
    ]);
}

if (! defined('INET_ADDRSTRLEN')) {
    /**
     * Length of the string form for IP
     * @var int
     */
    define('INET_ADDRSTRLEN', 16);
}

if (! defined('INET6_ADDRSTRLEN')) {
    /**
     * Length of the string form for IPv6
     * @var int
     */
    define('INET6_ADDRSTRLEN', 46);
}

/*
|--------------------------------------------------------------------------
| Regex
|--------------------------------------------------------------------------
*/

if (! defined('REGEX_WORD_BOUNDARY')) {
    /**
     * Word boundry
     * @var string
     */
    define('REGEX_WORD_BOUNDARY', '\b');
}

if (! defined('REGEX_FIRST_RESULT_KEY')) {
    /**
     * Key for the first result of `preg_match_all`
     * @var int
     */
    define('REGEX_FIRST_RESULT_KEY', 1);
}

if (! defined('REGEX_UPPERCASE_ASCII')) {
    /**
     * Uppercase ASCII characters
     * @var string
     */
    define('REGEX_UPPERCASE_ASCII', '/([A-Z])/');
}

if (! defined('REGEX_LOWERCASE_ASCII')) {
    /**
     * Lowercase ASCII characters
     * @var string
     */
    define('REGEX_LOWERCASE_ASCII', '/([a-z])/');
}

if (! defined('REGEX_NUMBERS')) {
    /**
     * Numbers
     * @var string
     */
    define('REGEX_NUMBERS', '/([0-9])/');
}

if (! defined('REGEX_NEWLINES')) {
    /**
     * Any kind of newline (`\r`, `\n`, `\r\n`)
     * @var string
     */
    define('REGEX_NEWLINES', '/\n|\r\n?/');
}

/*
|--------------------------------------------------------------------------
| Operating Systems
|--------------------------------------------------------------------------
*/

if (! defined('MACOS')) {
    /**
     * Operating System: MacOS(Darwin)
     * @var string
     */
    define('MACOS', 'macos');
}

if (! defined('WINDOWS')) {
    /**
     * Operating System: Windows
     * @var string
     */
    define('WINDOWS', 'windows');
}

if (! defined('LINUX')) {
    /**
     * Operating System: Linux
     * @var string
     */
    define('LINUX', 'linux');
}

if (! defined('BSD')) {
    /**
     * Operating System: BSD
     * @var string
     */
    define('BSD', 'bsd');
}

if (! defined('EXIT_SUCCESS')) {
    /**
     * Constant used by C/C++ for Success of Operation
     * @var int
     */
    define('EXIT_SUCCESS', 0);
}

if (! defined('EXIT_FAILURE')) {
    /**
     * Constant used by C/C++ for Failure of Operation
     * @var int
     */
    define('EXIT_FAILURE', 1);
}

/*
|--------------------------------------------------------------------------
| Hex Colors
|--------------------------------------------------------------------------
*/

if (! defined('HEX_RED')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_RED', '#ff0000');
}

if (! defined('HEX_GREEN')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_GREEN', '#00ff00');
}

if (! defined('HEX_BLUE')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_BLUE', '#0000ff');
}

if (! defined('HEX_WHITE')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_WHITE', '#ffffff');
}

if (! defined('HEX_BLACK')) {
    /**
     * Hex Color for red
     * @var string
     */
    define('HEX_BLACK', '#000000');
}
