<?php

namespace XORLabs\XC\Core\View;

class Assets
{
    public static function get()
    {
        // The build task in Grunt renames production assets with a hash
        // Read the asset names from assets-manifest.json
        if (ENVIRONMENT === 'development') {
            $assets = [
              'main_css' => '/assets/css/main.css',
              'main_js' => '/assets/js/scripts.js',
            ];
        } else {
            $get_assets = file_get_contents(APPPATH.'../public_html/assets/manifest.json');
            $assets = json_decode($get_assets, true);
            $assets = [
              'main_css' => '/assets/css/main.min.css?'.$assets['assets/css/main.min.css']['hash'],
              'main_js' => '/assets/js/scripts.min.js?'.$assets['assets/js/scripts.min.js']['hash'],
            ];
        }

        return $assets;
    }
}
