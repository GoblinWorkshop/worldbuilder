<?php
if (!function_exists('html')) {
    function html($unsafeHtml) {
        $config = HTMLPurifier_HTML5Config::createDefault();
        $HTMLPurifier = new \HTMLPurifier($config);
        return $HTMLPurifier->purify($unsafeHtml);
    }
}