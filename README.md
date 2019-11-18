# php-helper
[![Latest Version on Packagist](https://img.shields.io/packagist/v/repat/php-helper.svg?style=flat-square)](https://packagist.org/packages/repat/php-helper)
[![Total Downloads](https://img.shields.io/packagist/dt/repat/php-helper.svg?style=flat-square)](https://packagist.org/packages/repat/php-helper)

**php-helper** is a package full of helper functions I found useful when developing applications in PHP. All functions are wrapped with a `functions_exists()` in case of conflicts.

> ⚠️Some of these functions used to be in `repat/laravel-helper`, which now has this package as a dependency.

Also have a look at
* https://laravel.com/docs/6.x/helpers
* http://calebporzio.com/11-awesome-laravel-helper-functions
* https://packagist.org/packages/illuminated/helper-functions
* https://packagist.org/packages/laravel/helper-functions

Ideas what should go in here? Write a pull request or email!

## Installation
`$ composer require repat/php-helper`

## Documentation

### Array
#### `array_equal($arr1, $arr2)`
Determines if 2 arrays have the same items, independent of order.
```php
$arr1 = [1, 2, 3];
$arr2 = [3, 2, 1];

array_equal($arr1, $arr2);
// returns: true

$arr3 = [4, 5, 6];
array_equal($arr1, $arr3);
// returns: false
```

#### `array_key2value($array)`
Returns an array where key == value. Syntactic sugar for  `array_combine($array, $array);`
```php
$array = [1, 3, 5];

print_r(array_key2value($array));
// returns: Array( [1] => 1, [3] => 3, [5] => 5 )
```

#### `array_delete_value($array, $value)`
Deletes all elements from `$array` that have value `$value`. Essentially syntactic sugar for `array_diff()`.

```php
$array = ['foo', 'bar'];

print_r(array_delete_value($array, 'foo'));
// returns  Array( [1] => "bar" )
```

#### `contains_duplicates($array)`
Checks if there are duplicates in given array.

```php
contains_duplicates([1, 1]);
// returns: true
contains_duplicates([1, 2]);
// returns: false
```

#### `array_change_keys($array, $keys)`
Changes the keys recursively for an associative array. The second parameter is an array with the old key (of `$array`) as the key and the new key as the value.

```php
$array = [
        'bar' => 'foo',
        'sub' => [
            'some' => 'thing',
        ],
];

$keys = [
    'bar' => 'biz', // change all 'bar' keys to 'biz' keys
    'some' => 'any',
];

array_change_keys($array, $keys);
// returns:[
//         'biz' => 'foo',
//         'sub' => [
//             'any' => 'thing',
//         ],
// ];

```

#### `array_key_replace($array, $oldKey, $newKey)`
Similar to `array_change_keys()` but it only works for one-dimensional arrays.

```php
array_key_replace(['bar' => 'foo'], 'bar', 'bizz');
// returns : ['bizz' => 'foo']
```

### Date
#### `days_in_month($month = null, $year = null)`
Returns amount of days in given month or year. Defaults to current month and year.

```php
days_in_month();
// returns: 31 (for e.g. May)

days_in_month($april = 4);
// returns: 30

days_in_month($feb = 2, $year = 2020);
// returns: 29 (2020 is a leap year)
```

#### `days_this_month()`
Returns amount of days of the current month.

```php
days_this_month();
// returns: 31 (for e.g. May)
```

#### `days_next_month()`
Returns amount of days of the next month.

```php
days_next_month();
// returns: 30 (for e.g. May because June has 30)
```

#### `days_this_year()`
Returns amount of days of the current year.

```php
days_this_year();
// returns: 365 (because it's not a leap year)
```

#### `days_left_in_month()`
Returns amount of days left in current month.

```php
days_left_in_month();
// returns: 29 (on 1st April)
```

#### `days_left_in_year()`
Returns amount of days left in current year.

```php
days_left_in_year();
// returns: 274 (on 1st April 2019)
```

#### `timezone_list()`
Returns a list of all timezones.

```php
timezone_list();
// returns:
// [
// "Pacific/Pago_Pago" => "(UTC-11:00) Pacific/Pago_Pago",
// "Pacific/Niue" => "(UTC-11:00) Pacific/Niue",
// "Pacific/Midway" => "(UTC-11:00) Pacific/Midway",
// ...
// "Pacific/Chatham" => "(UTC+13:45) Pacific/Chatham",
// "Pacific/Kiritimati" => "(UTC+14:00) Pacific/Kiritimati",
// "Pacific/Apia" => "(UTC+14:00) Pacific/Apia",
// ];
```

#### `tomorrow()`
Similar to `today()` or `now()`, this function returns a Carbon instance for tomorrow.

```php
tomorrow();
// returns: Carbon\Carbon @1554156000 {#5618
//     date: 2019-04-20 00:00:00.0 Europe/Amsterdam (+02:00),
//   }
```

#### `yesterday()`
Similar to `today()` or `now()`, this function returns a Carbon instance for yesterday.

```php
yesterday();
// returns: Carbon\Carbon @1554156000 {#5618
//     date: 2019-04-19 00:00:00.0 Europe/Amsterdam (+02:00),
//   }
```

#### `seconds2minutes($seconds)`
Returns `i:s` string with 60+ minutes instead of showing the hours as well.

```php
seconds2minutes(42);
// returns: 00:42

seconds2minutes(90);
// returns: 01:30

seconds2minutes(4223);
// returns: 70:23
```


#### `diff_in_days($start, $end)`
Uses Carbons `diffInDays()` and `parse()` methods to return the difference in days.

```php
diff_in_days('2018-04-19', '2018-04-21');
// returns: 2

diff_in_days(today(), yesterday());
// returns: 1
```

### Object
#### `object2array($object)`
Array representation of an object, e.g. an Eloquent Model.

```php
use App\Models\User;

object2array(User::first());
// returns: [
//      "casts" => [
//        "someday_at" => "datetime",
//       // ...
//      ],
//      "incrementing" => true,
//      "exists" => true,
//      "wasRecentlyCreated" => false,
//      "timestamps" => true,
// ]
```

#### `filepath2fqcn($filepath, $prefix = '')`
Will turn a filepath into a Fully Qualified Class Name.

```php
filepath2fqcn('/Users/john/code/app/Models/User.php', '/Users/john/code/');
// returns: App\Models\User

filepath2fqcn('/Users/john/code/app/Models/User.php', '/Users/john/code');
// returns: App\Models\User

filepath2fqcn('app/Models/User.php');
// returns: App\Models\User

filepath2fqcn('/Users/john/code/app/Models/User.php');
// returns: \Users\john\code\app\Models\User
```

### Misc
#### `toggle($switch)`
If given `true`, returns `false` and vice-versa.

```php
toggle(false);
// returns: true

toggle(true);
// returns: false
```

#### `generate_password($size = 15)`
Returns a random password. Syntactic sugar for `str_random()`.

```php
generate_password();
// returns: IZeJx3MeUdDhzE2
```

#### `auto_cast($value)`
Returns the value with the right type so e.g. you can compare type safe with `===`.

```php
gettype(auto_cast('42'));
// returns: integer
gettype(auto_cast('42.0'));
// returns: double
gettype(auto_cast('true'));
// returns: boolean
```

#### `human_filesize($size)`
Returns a human readable form for given bytes. Goes up to [Yottabyte](https://en.wikipedia.org/wiki/Yottabyte).

```php
human_filesize(4223);
// returns: 4.12kB
```

#### `permutations($array)`
Returns a generator with all possible permutations of given array values.

Based on [eddiewoulds port](https://stackoverflow.com/a/43307800/2517690) port of [python code](https://docs.python.org/2/library/itertools.html#itertools.permutations).

```php
$gen = permutations(['foo', 'bar', 'biz']);

iterator_to_array($gen)
// returns: [
   //   [
   //     "foo",
   //     "bar",
   //     "biz",
   //   ],
   //   [
   //     "foo",
   //     "biz",
   //     "bar",
   //   ],
   //   [
   //     "bar",
   //     "foo",
   //     "biz",
   //   ],
   //   [
   //     "bar",
   //     "biz",
   //     "foo",
   //   ],
   //   [
   //     "biz",
   //     "foo",
   //     "bar",
   //   ],
   //   [
   //     "biz",
   //     "bar",
   //     "foo",
   //   ],
   // ]
```

#### `zenith($type)`
Wrapper around magic numbers for the [Zenith](https://en.wikipedia.org/wiki/Zenith). The types can be:

* `astronomical`: 108.0
* `nautical`: 102.0
* `civil`: 96.0
* default: 90+50/60 (~90.83)

```php
zenith('civil');
// returns: 96.0
```

#### `operating_system()`
Returns on of the following constants (also see under constants):

* `macos`
* `windows`
* `linux`
* `bsd`

```php
operating_system();
// returns: linux
LINUX
// returns: linux
```

#### `wikipedia($lemma, $lang = 'en', $return = '')`
Link URL to wikipedia for a certain language

```php
wikipedia('Towel Day');
// returns: https://en.wikipedia.org/wiki/Towel_Day

wikipedia('Paris', 'fr', '#')
// returns: https://fr.wikipedia.org/wiki/Paris

wikipedia('Pariz', 'fr', '#')
// returns: #
```

### Networking
#### `scrub_url($url)`
Removes the protocol, www and trailing slashes from a URL. You can then e.g. test HTTP vs. HTTPS connections.

```php
scrub_url('https://www.repat.de/');
// returns: 'repat.de'

scrub_url('https://blog.fefe.de/?ts=a262bcdf');
// returns: 'blog.fefe.de/?ts=a262bcdf'
```

#### `http_status_code($url, $follow = true, $userAgent = null)`
Returns just the status code by sending an empty request with [curl](https://curl.haxx.se/). By default, it follows redirect so it will only return the last status code and not e.g. 301 Redirects. Disable following by setting the second parameter to `false`. Some sites require a User-Agent and then return another status code. A string can be passed to `$userAgent`.
Requires `ext-curl`.

```php
http_status_code('httpstat.us/500');
// returns: 500

http_status_code('http://repat.de'); // with 301 redirect to https://repat.de
// returns: 200

http_status_code('http://repat.de', false);
// returns: 301
```

#### `parse_signed_request($request, $clientSecret, $algo)`
Parses a HMAC signed request. Copied from [Data Deletion Request Callback - Facebook for Developers](https://developers.facebook.com/docs/apps/delete-data). `$algo` defaults to `sha256`.

```php
$requestString = null; // TODO
parse_signed_request($requestString, env('FACEBOOK_CLIENT_SECRET'));
```

#### `domain_slug($domain)`
Validates a domain and creates a slug. Does not work for subdomains, see `sluggify_domain()` instead. Returns `null` on a parsing error.

```php
domain_slug('blog.fefe.de')
//returns: blogfefede
domain_slug('blogfefe.de')
//returns: blogfefede
```

##### `gethostbyname6($domain)`
Returns a IPv6 address for given domain by using the DNS AAAA records. If none is found, the input domain is returned, much like `gethostbyname()` is doing for IPv4.

```php
gethostbyname6('ipv4onlydomain.tld');

// returns: ipv4onlydomain.tld

gethostbyname6('example.com')

// returns: 2606:2800:220:1:248:1893:25c8:1946
```

##### `is_public_ip($ip)`
Returns if given IP is a public IPv4 or IPv6 address (vs. private or reserved)

```php
is_public_ip('127.0.0.1'); // localhost

// returns: false

is_public_ip('::1/128'); // localhost

// returns: false

is_public_ip('192.168.1.42') // private network

// returns: false

$ipv4 = gethostbyname('example.com');
is_public_ip($ipv4);

// returns: true

$ipv6 = gethostbyname6('example.com');
is_public_ip($ipv6);

// returns true;
```

##### `final_redirect_target($url)`
Follows all 301/302 redirects and returns the URL at the end of the chain, or `null`.

```php
final_redirect_target('http://google.com');
// returns http://www.google.com
```

### String
#### `str_icontains($haystack, $needle)`    
Similar to [Str::contains()](https://laravel.com/docs/5.7/helpers#method-str-contains) but case _insensitive_.

```php
str_icontains('FOOBAR', 'foo');
// returns: true

str_icontains('foobar', 'foo');
// returns: true

str_icontains('foobar', 'FOO');
// returns: true

str_icontains('foobar', 'test');
// returns: false
```

#### `to_ascii($string)`
Removes all non [ASCII](https://en.wikipedia.org/wiki/ASCII) characters and returns the rest.

```php
to_ascii('René');
// returns: Ren
```

#### `hyphen2_($string)`
Replaces all hyphen ("-") characters with underscore ("\_")

```php
hyphen2_('foo-bar');
// returns: foo_bar
```

#### `_2hypen($string)`
Replaces all underscore ("\_") characters with hyphen ("-")

```php
_2hypen('foo_bar');
// returns: foo-bar
```

#### `str_replace_once($search, $replace, $string)`
Same signature as `str_replace()`, but as name suggests, replaces only the first occurrence of `$search`.

```php
str_replace_once('foo', 'bar', 'foofoo');
// returns: 'barfoo'
```

#### `title_case_wo_underscore($string)`
[Title Case](https://en.wikipedia.org/wiki/Letter_case#Title_case) but without underscores.

```php
title_case_wo_underscore('foo_bar');
// returns: Foo Bar

// vs.
// title_case('foo_bar')
// returns: Foo_Bar
```

#### `lorem_ipsum()`
Returns an example of the [Lorem Ipsum](https://en.wikipedia.org/wiki/Lorem_ipsum) placeholder text.

```php
lorem_ipsum();
// returns:
// Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
```

#### `sluggify_domain($domain)`
Returns a slug version of the domain by exchanging full stops with underscores. `str_slug()` does not work with subdomains, as it removes full stops completely.

```php
sluggify_domain('blog.fefe.de');
// returns: blog_fefe_de
str_slug('blog.fefe.de');
// returns: blogfefede

sluggify_domain('blogfefe.de');
// returns: blogfefe_de
str_slug('blogfefe.de');
// returns: blogfefede // same as subdomain on fefe.de
```

#### `str_remove($string, $remove)`
Removes given string(s), numbers or array of strings. Syntactic sugar for `str_replace($remove, '', $string)`.

```php
str_remove('foobar', 'bar');
// returns: foo
str_remove('foobar42', ['foo', 'bar']);
// returns: 42
str_remove('foobar42', 42);
// returns: foobar
```

#### `str_bytes($string)`
Returns the amount of bytes in a string.

```php
str_bytes('foobar');
// returns: 6
str_bytes('fooßar');
// returns: 8
```

#### `regex_list($array)`
Creates a string with regex for an OR separated list.

```php
regex_list(['foo', 'bar', '42'])
// returns: \bfoo|\bbar|\b42
```

#### `base64_url_decode($url)`
Decodes a base64-encoded URL. Copied from [Data Deletion Request Callback - Facebook for Developers](https://developers.facebook.com/docs/apps/delete-data)

```php
base64_url_decode('aHR0cHM6Ly9yZXBhdC5kZQ==');
// returns: https://repat.de
```

#### `str_right($string, $until)`
Syntactic sugar for [`str_after`](https://laravel.com/docs/5.8/helpers#method-str-after).

```php
str_right('https://vimeo.com/165053513', '/');
// returns: 165053513
```

#### `str_left($string, $before)`
Syntactic sugar for [`str_before`](https://laravel.com/docs/5.8/helpers#method-str-before).

```php
str_left('https://vimeo.com/165053513', '165053513');
// returns: https://vimeo.com/
```

#### `normalize_nl($string)`
Normalizes all new lines characters (`\r`, `\n`, `\r\n`) to the UNIX newline `\n`.

```php
normalize_nl('foobar\r\n'); // Windows
// returns: foobar\n

normalize_nl('foobar\r'); // MacOS
// returns: foobar\n

normalize_nl('foobar\n'); // *nix
// returns: foobar\n
```

#### `str_count_upper($string)`
Counts upper case characters in a string. See also `str_count_lower()`.

```php
str_count_upper('FoObAr');
// returns: 3

str_count_upper('foobar');
// returns: 0

str_count_upper('FOOBAR');
// returns: 6
```

#### `str_count_lower($string)`
Counts lower case characters in a string. See also `str_count_upper()`.

```php
str_count_lower('FoObAr');
// returns: 3

str_count_lower('foobar');
// returns: 6

str_count_lower('FOOBAR');
// returns: 0
```

#### `str_insert_bindings($sql, $bindings)`
Inserts bindings for `?` characters in the SQL string. See also `insert_bindings()` of [`repat/laravel-helper`](https://packagist.org/packages/repat/laravel-helper).

```php
str_insert_bindings('SELECT * FROM `table` WHERE id = ?', [42]);
// returns: SELECT * FROM `table` WHERE id = '42'
```

#### `contains_uppercase($string)`
If the given string contains at least one uppercase ASCII character.

```php
contains_uppercase('Foobar');
// returns: true

contains_uppercase('foobar');
// returns: false

contains_uppercase('FOOBAR');
// returns: true
```

#### `contains_lowercase($string)`
If the given string contains at least one lowercase ASCII character.

```php
contains_lowercase('Foobar');
// returns: true

contains_lowercase('foobar');
// returns: true

contains_lowercase('FOOBAR');
// returns: false
```

#### `contains_numbers($string)`
If the given string (or number) contains at least one number.

```php
contains_numbers('Foobar');
// returns: false

contains_numbers('Foobar42');
// returns: true

contains_numbers('42');
// returns: true

contains_numbers(42); // uses strval()
// returns: true
```

##### Wordpress
These functions were pulled in from the [Open Source](https://en.wikipedia.org/wiki/Open-source_model) [Content Management System](https://en.wikipedia.org/wiki/Content_management_system) [Wordpress](https://wordpress.org), released under the [GPL 2](https://en.wikipedia.org/wiki/GNU_General_Public_License) (or later).

* `mbstring_binary_safe_encoding()`
* `reset_mbstring_encoding()`
* `seems_utf8()`

###### `remove_accents($string)`
Removes special characters and replaces them with their ASCII counterparts

```php
remove_accents('á');
// returns: a

remove_accents('René')
// returns: Rene
```

### Optional Packages
Optional packages suggested by this are required for these functions to work.

#### `markdown2html($markdown)`
Uses [league/commonmark](https://commonmark.thephpleague.com/) to transform Markdown into HTML.

* `$ composer require league/commonmark`

```php
markdown2html('# Header');
// returns: <h1>Header</h1>\n
```

#### `domain($url)`
Uses [layershifter/tld-extract](https://github.com/layershifter/tld-extract) to return the domain only from a URL, removing protocol, subdomain and path.

* `$ composer require layershifter/tld-extract`

```php
domain('https://repat.de/about?foo=bar');
// returns: repat.de
```

### HTML
#### `linkify($string, $protocols = ['http', 'https', 'mail'], $attributes)`
Returns the string with all URLs for given protocols made into links. Optionally, attributes for the [a tag](https://www.w3.org/TR/html4/struct/links.html) can be passed.

```php
linkify('https://google.com is a search engine');
// returns: <a  href="https://google.com">google.com</a> is a search engine

linkify('https://google.com is a search engine', ['https'], ['target' => '_blank']);
// returns: <a target="_blank" href="https://google.com">google.com</a> is a search engine
```

#### `embedded_video_url($url)`
Returns the embedded version of a given [YouTube](https://youtube.com) or [Vimeo](https://vimeo.com) URL.

```php
embedded_video_url('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
// returns: https://www.youtube.com/embed/dQw4w9WgXcQ

embedded_video_url('https://vimeo.com/50491748');
// returns: https://player.vimeo.com/video/50491748
```

#### `ul_li_unpack($array, $separator)`
Unpacks an associated array into an [unordered list](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/ul). Default separator is `:`.

```php
ul_li_unpack(['foo' => 'bar']);
// returns: <ul><li>foo: bar</li></ul>

ul_li_unpack(['foo' => 'bar'], '=>');
// returns: <ul><li>foo=> bar</li></ul>
```

#### `contrast_color($bgColor)`
Uses the Luminosity Contrast algorithm to determine if white or black
would be the best contrast color for a given hex background color.

Source: [tomloprod on stackoverflow](https://stackoverflow.com/a/42921358/2517690)

```php
contrast_color('b9b6b6');
// returns: #000000

contrast_color('#496379');
// returns: #ffffff
```

### Constants
* `PARETO_HIGH`: 80
* `PARETO_LOW`: 20
* `MARIADB_DEFAULT_STRLEN`: 191
* `ONE_HUNDRED_PERCENT`: 100
* `KILO`: 1000
* `KIBI`: 1024
* `NBSP`: `\xc2\xa0`
* `CR`: `\r`
* `LF`: `\n`
* `CRLF`: `\r\n`
* `HTTP_1_0_VERBS`: [get, head, post]
* `HTTP_1_1_VERBS`: [get, head, post, connect, delete, options, put, trace]
* `HTTP_VERBS`: [get, head, post, connect, delete, options, put, trace, patch]
* `REGEX_WORD_BOUNDARY`: \\b
* `REGEX_FIRST_RESULT_KEY`: 1
* `REGEX_UPPERCASE_ASCII`: (A-Z)
* `REGEX_LOWERCASE_ASCII`: (a-z)
* `REGEX_NUMBERS`: (0-9)
* `MACOS`: macos
* `WINDOWS`: windows
* `LINUX`: linux
* `BSD`: bsd
* `EXIT_SUCCESS`: 0
* `EXIT_FAILURE`: 1
* `HEX_RED`: #ff0000
* `HEX_GREEN`: #00ff00
* `HEX_BLUE`: #0000ff
* `HEX_WHITE`: #ffffff
* `HEX_BLACK`: #000000
* `WEAK_CIPHERS` : [
TLS_DHE_RSA_WITH_AES_256_GCM_SHA384, TLS_DHE_RSA_WITH_AES_256_CBC_SHA256, TLS_DHE_RSA_WITH_AES_256_CBC_SHA, TLS_DHE_RSA_WITH_CAMELLIA_256_CBC_SHA, TLS_DHE_RSA_WITH_CAMELLIA_128_CBC_SHA, TLS_DHE_RSA_WITH_AES_128_CBC_SHA256, TLS_DHE_RSA_WITH_AES_128_CBC_SHA, TLS_DHE_RSA_WITH_AES_128_GCM_SHA256, TLS_DHE_RSA_WITH_3DES_EDE_CBC_SHA, SSL_DHE_RSA_WITH_AES_128_CBC_SHA, SSL_DHE_RSA_WITH_AES_256_CBC_SHA, SSL_DHE_RSA_WITH_CAMELLIA_256_CBC_SHA, SSL_DHE_RSA_WITH_CAMELLIA_128_CBC_SHA, SSL_DHE_RSA_WITH_3DES_EDE_CBC_SHA]
* `INET_ADDRSTRLEN`: 16
* `INET6_ADDRSTRLEN`: 46

## Contributors
* https://github.com/bertholf

## License
* MIT, see [LICENSE](https://github.com/repat/php-helper/blob/master/LICENSE)

## Version
* Version 0.1.12

## Contact
#### repat
* Homepage: https://repat.de
* e-mail: repat@repat.de
* Twitter: [@repat123](https://twitter.com/repat123 "repat123 on twitter")

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=repat&url=https://github.com/repat/php-helper&title=php-helper&language=&tags=github&category=software)
