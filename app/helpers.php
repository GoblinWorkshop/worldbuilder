<?php
if (!function_exists('html')) {
    function html($unsafeHtml) {
        $config = HTMLPurifier_HTML5Config::createDefault();
        $config->set('Cache.SerializerPath', storage_path('framework/cache'));
        $HTMLPurifier = new \HTMLPurifier($config);
        return $HTMLPurifier->purify($unsafeHtml);
    }
}