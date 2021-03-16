<?php

if (! function_exists('markdown2html')
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
        return $converter->convertToHtml($markdown);
    }
}

if (! function_exists('domain')
    && class_exists(\Pdp\Rules::class)) {
    /**
     * Gets domain without subdomain etc
     *
     * @param  string $url
     * @param  string $path
     * @return string|null
     */
    function domain(string $url, string $path) : ?string
    {
        $publicSuffixList = \Pdp\Rules::fromPath($path);
        $host = null;

        try {
            $host = parse_url($url, PHP_URL_HOST);
        } catch (\Exception $e) {
            return null;
        }

        try {
            $result = $publicSuffixList->resolve($host);
        } catch (\Exception $e) {
            return null;
        }

        // If domain parsing worked
        if (! empty($result->registrableDomain()->toString()) && $result->suffix()->isICANN()) {
            return $result->registrableDomain()->toString();
        }

        return null;
    }
}
