<?php

// Check if composer.json has 'enable-patching' in it
$composerJson = json_decode(file_get_contents('composer.json'), true);
if (!isset($composerJson['extra']['enable-patching']) || $composerJson['extra']['enable-patching'] !== true) {
    // Add 'enable-patching' to composer.json
    $composerJson['extra']['enable-patching'] = true;
    file_put_contents('composer.json', json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    if (php_sapi_name() === 'cli') echo "\e[33m"; // Yellow
    echo "\"vagento/enable-patching\" package requires ";
    if (php_sapi_name() === 'cli') echo "\e[36m"; // Cyan
    echo "{\"extra\": {\"enable-patching\" => true}} ";
    if (php_sapi_name() === 'cli') echo "\e[33m"; // Yellow
    echo "in composer.json.\nWe have added it for you. Please run composer update/install again.\n";
    if (php_sapi_name() === 'cli') echo "\e[39m"; // Reset

    // Unload this file
    $composerJson = json_decode(file_get_contents(__DIR__ . '/composer.json'), true);
    unset($composerJson['autoload']);
    file_put_contents(__DIR__ . '/composer.json', json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

    exit(1);
}

// TODO: Maybe there is a better way to do this
// Adding 'enable-patching' via a composer plugin runs too late