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
    && class_exists(\Pdp\Cache::class)
    && class_exists(\Pdp\CurlHttpClient::class)
    && class_exists(\Pdp\Manager::class)) {
    /**
     * Gets domain without subdomain etc
     *
     * @param  string $url
     * @return string|null
     */
    function domain(string $url) : ?string
    {
        $manager = new \Pdp\Manager(new \Pdp\Cache(), new \Pdp\CurlHttpClient());
        $rules = $manager->getRules();

        try {
            $result = $rules->resolve($url);
        } catch (\Exception $e) {
            return null;
        }

        // If domain parsing worked
        if (! empty($result->getRegistrableDomain()) && $result->isICANN()) {
            return $result->getRegistrableDomain();
        }

        return null;
    }
}
