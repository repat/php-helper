<?php

if (! function_exists('str_icontains')) {
    /**
     * `str_contains()` case insensitive
     *
     * @param  string $haystack
     * @param  string $needle
     * @return bool
     */
    function str_icontains(string $haystack, string $needle): bool
    {
        if (empty($needle)) {
            return false;
        }

        return (strpos(strtolower($haystack), strtolower($needle)) !== false);
    }
}

if (! function_exists('str_replace_once')) {
    /**
     * Replaces a string only once (vs. `str_replace()`)
     *
     * @param  string $search
     * @param  string $replace
     * @param  string $subject
     * @return string
     */
    function str_replace_once(string $search, string $replace, string $subject): string
    {
        $firstChar = strpos($subject, $search);
        if ($firstChar !== false) {
            $beforeStr = substr($subject, 0, $firstChar);
            $afterStr = substr($subject, $firstChar + strlen($search));
            return $beforeStr . $replace . $afterStr;
        } else {
            return $subject;
        }
    }
}

if (! function_exists('str_bytes')) {
    /**
     * Returns size of any text in bytes
     * Strings are expected to be in UTF-8 (incl ASCII) format
     *
     * @param string $str
     * @return int
     */
    function str_bytes(string $str): int
    {

        // Number of characters in string
        $strlen_var = strlen($str);

        // string bytes counter
        $d = 0;

        /*
         * Iterate over every character in the string,
         * escaping with a slash or encoding to UTF-8 where necessary
         */
        for ($c = 0; $c < $strlen_var; ++$c) {
            $ord_var_c = ord($str[$c]);
            switch (true) {
                case (($ord_var_c >= 0x20) && ($ord_var_c <= 0x7F)):
                    // characters U-00000000 - U-0000007F (same as ASCII)
                    $d++;
                    break;
                case (($ord_var_c & 0xE0) == 0xC0):
                    // characters U-00000080 - U-000007FF, mask 110XXXXX
                    $d += 2;
                    break;
                case (($ord_var_c & 0xF0) == 0xE0):
                    // characters U-00000800 - U-0000FFFF, mask 1110XXXX
                    $d += 3;
                    break;
                case (($ord_var_c & 0xF8) == 0xF0):
                    // characters U-00010000 - U-001FFFFF, mask 11110XXX
                    $d += 4;
                    break;
                case (($ord_var_c & 0xFC) == 0xF8):
                    // characters U-00200000 - U-03FFFFFF, mask 111110XX
                    $d += 5;
                    break;
                case (($ord_var_c & 0xFE) == 0xFC):
                    // characters U-04000000 - U-7FFFFFFF, mask 1111110X
                    $d += 6;
                    break;
                default:
                    $d++;
            };
        }
        return $d;
    }
}

if (! function_exists('to_ascii')) {
    /**
     * Filters a raw string and only lets ACII characters through
     *
     * @param  string $rawstring
     * @return string
     */
    function to_ascii(string $rawstring): string
    {
        return filter_var($rawstring, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    }
}

if (! function_exists('title_case_wo_underscore')) {
    /**
     * `title_case` but with every underscore replaced by a space
     *
     * @param  string $string
     * @return string
     */
    function title_case_wo_underscore(?string $string): string
    {
        return str_replace('_', ' ', title_case($string));
    }
}

if (! function_exists('hyphen2_')) {
    /**
     * Replaces every hyphen("-") with underscore("_")
     *
     * @param  string $string
     * @return string
     */
    function hyphen2_(string $string): string
    {
        return str_replace('-', '_', $string);
    }
}

if (! function_exists('_2hyphen')) {
    /**
     * Replaces every underscore("_") with hyphen("-")
     *
     * @param  string $string
     * @return string
     */
    function _2hyphen(string $string): string
    {
        return str_replace('_', '-', $string);
    }
}
if (! function_exists('regex_list')) {
    /**
     * Regex string pipe separated for an array
     *
     * @param  array  $array
     * @return string
     */
    function regex_list(array $array): string
    {
        return REGEX_WORD_BOUNDARY . implode('|' . REGEX_WORD_BOUNDARY, $array);
    }
}

if (! function_exists('base64_url_decode')) {
    /**
     * Decodes a base64 encoded url
     *
     * Source: https://developers.facebook.com/docs/apps/delete-data
     *
     * @param  string $input
     * @return string
     */
    function base64_url_decode(string $input) : string
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}

if (! function_exists('lorem_ipsum')) {
    /**
     * Returns a very basic version of Lorem Ipsum placeholder text
     *
     * @return string
     */
    function lorem_ipsum() : string
    {
        return 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.';
    }
}

if (! function_exists('sluggify_domain')) {
    /**
     * Creates a slug string especially for domains
     * because str_slug doesn't work for subdomains (. => _)
     *
     * @param  string $domain
     * @return string
     */
    function sluggify_domain(string $domain)
    {
        return str_replace('.', '_', strtolower($domain));
    }
}

if (! function_exists('str_remove')) {
    /**
     * Removes given string(s), syntactic sugar for str_replace
     * Returns null on error
     *
     * @param  string $string
     * @param  int|float|string|array $remove
     * @return null|string
     */
    function str_remove(string $string, $remove) : ?string
    {
        if (! (is_array($remove) || is_string($remove) || is_numeric($remove))) {
            return null;
        }
        return str_replace($remove, '', $string);
    }
}

if (! function_exists('str_right')) {
    /**
     * Syntactic sugar for `str_after()`
     *
     * @param  string $string
     * @param  string $until
     * @return string
     */
    function str_right(string $string, string $until) : string
    {
        return str_after($string, $until);
    }
}

if (! function_exists('str_left')) {
    /**
     * Syntactic sugar for `str_before()`
     *
     * @param  string $string
     * @param  string $before
     * @return string
     */
    function str_left(string $string, string $before) : string
    {
        return str_before($string, $before);
    }
}

if (! function_exists('uuid')) {
    /**
     * Syntactic sugar `\Illuminate\Support\Str::uuid()->toString()`
     *
     * @return string
     */
    function uuid() : string
    {
        return \Illuminate\Support\Str::uuid()->toString();
    }
}

if (! function_exists('normalize_nl')) {
    /**
     * Normalizes all new lines to \n
     *
     * @return string
     */
    function normalize_nl(string $string) : string
    {
        return str_replace(CR, LF, str_replace(CRLF, LF, $string));
    }
}

if (! function_exists('str_count_upper')) {
    /**
     * Counts uppercase case characters in string
     *
     * @return string
     */
    function str_count_upper(string $string) : int
    {
        return strlen(preg_replace('/[^A-Z]+/', '', $string));
    }
}

if (! function_exists('str_count_lower')) {
    /**
     * Counts lowercase case characters in string
     *
     * @return string
     */
    function str_count_lower(string $string) : int
    {
        return strlen(preg_replace('/[^a-z]+/', '', $string));
    }
}

if (! function_exists('str_insert_bindings')) {
    /**
     * Inserts bindings into SQL query
     *
     * @param  string $sql
     * @param array $bindings
     * @return string
     */
    function str_insert_bindings(string $sql, array $bindings) : string
    {
        $querySql = str_replace(['?'], ['\'%s\''], $sql);
        return vsprintf($querySql, $bindings);
    }
}

if (! function_exists('contains_uppercase')) {
    /**
     * If string contains uppercase ASCII characters
     *
     * @param  string $string
     * @return bool
     */
    function contains_uppercase(string $string) : bool
    {
        return (bool) preg_match_all(REGEX_UPPERCASE_ASCII, $string);
    }
}

if (! function_exists('contains_lowercase')) {
    /**
     * If string contains lowercase ASCII characters
     *
     * @param  string $string
     * @return bool
     */
    function contains_lowercase(string $string) : bool
    {
        return (bool) preg_match_all(REGEX_LOWERCASE_ASCII, $string);
    }
}

if (! function_exists('contains_numbers')) {
    /**
     * If string contains numbers
     *
     * @param  mixed $string
     * @return bool
     */
    function contains_numbers($string) : bool
    {
        return (bool) preg_match_all(REGEX_NUMBERS, strval($string));
    }
}

if (! function_exists('country_name')) {
    /**
     * Converts ISO 3166-1 alpha 2 code to name, potentially in `$locale` language
     *
     * @param string $iso
     * @param string|null $locale
     * @return string
     */
    function country_name(string $iso3166, ?string $locale = null) : string
    {
        if (strlen($iso3166) !== 2) {
            throw new \Exception('ISO code is not 2 characters long');
        }
        if (is_string($locale)) {
            return locale_get_display_region('-' . $iso3166, substr($locale, 0, 2));
        }
        return locale_get_display_region('-' . $iso3166);
    }
}
