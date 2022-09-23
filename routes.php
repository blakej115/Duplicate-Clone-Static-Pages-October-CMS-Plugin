<?php

use Cms\Classes\Theme;
use Symfony\Component\Yaml\Yaml;

Route::get('/blakejones/clone-duplicate-static-page', function () {
    $loggedIn = BackendAuth::check();
    $input = Input::get('ids');

    if ($loggedIn) {
        $ids = explode('|||', $input);

        $activeThemeCode = Theme::getActiveThemeCode();
        $themePath = base_path() . '/themes/' . $activeThemeCode;
        $pathPrefix = $themePath . '/content/static-pages/';
        $yamlPath = $themePath . '/meta/static-pages.yaml';

        $yamlContents = Yaml::parse(file_get_contents($yamlPath));

        foreach ($ids as $id) {
            $newId = $id . '-' . rand();
            File::copy($pathPrefix . $id . '.htm', $pathPrefix . $newId . '.htm');
            $yamlContents['static-pages'][$newId] = [];
        }

        $yaml = Yaml::dump($yamlContents);
        file_put_contents($yamlPath, $yaml);

        return json_encode('{"status": "success"}');
    }

    return '{"status": "Not logged in"}';
})->middleware('web');
