<?php

if (!function_exists('markdown2html')
&& class_exists(\League\CommonMark\CommonMarkConverter::class)) {
    /**
     * Converts Markdown text into HTML code with `league/commonmark`
     *
     * @param  string $markdown
     * @return string
     */
    function markdown2html(string $markdown) : string
    {
        $converter = new \League\CommonMark\CommonMarkConverter;
        return strip_tags($converter->convertToHtml($markdown), 'p');
    }
}

if (!function_exists('domain') &&
class_exists(\LayerShifter\TLDExtract\Extract::class)) {
    /**
     * Gets domain without subdomain etc
     *
     * @param  string $url
     * @return string|null
     */
    function domain(string $url) : ?string
    {
        $extract = new \LayerShifter\TLDExtract\Extract();
        $result = $extract->parse($url);

        // If domain parsing worked
        if (!empty($result->getRegistrableDomain()) && $result->isValidDomain()) {
            return $result->getRegistrableDomain();
        }

        return null;
    }
}
