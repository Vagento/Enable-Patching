<?php

namespace Vagento\EnablePatching;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;
use JetBrains\PhpStorm\ArrayShape;

class EnablePatchingPlugin implements PluginInterface, EventSubscriberInterface
{
    /**
     * @var Composer
     */
    public Composer $composer;

    /**
     * @var IOInterface
     */
    public IOInterface $io;

    /**
     * Apply plugin modifications to Composer
     *
     * @param Composer    $composer
     * @param IOInterface $io
     *
     * @return void
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io       = $io;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array
     */
    #[ArrayShape([ScriptEvents::POST_AUTOLOAD_DUMP => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            ScriptEvents::POST_AUTOLOAD_DUMP => 'enablePatching',
        ];
    }

    /**
     * Adds 'enable-patching' to composer.json file
     *
     * @return void
     */
    public function enablePatching(): void
    {
        // Check if 'enable-patching' is added to composer.json
        $extra = $this->composer->getPackage()->getExtra();
        if (!isset($extra['enable-patching']) || $extra['enable-patching'] !== true) {
            // Get composer.json file path
            $composerJsonPath = $this->composer->getConfig()->getConfigSource()->getName();
            $composerJson = json_decode(file_get_contents($composerJsonPath), true);

            // Add 'enable-patching' to composer.json
            $composerJson['extra']['enable-patching'] = true;
            file_put_contents(
                $composerJsonPath,
                json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            );

            // "vagento/enable-patching" package added { "extra": { "enable-patching": true } } to composer.json.
            // Please run "composer install/update/dump-autoload" again.
            // TODO: maybe there is a better way to do this?
            echo "\e[33m"; // Yellow
            echo "\"vagento/enable-patching\" package added ";
            echo "\e[36m"; // Cyan
            echo "{ \"extra\": { \"enable-patching\": true } } ";
            echo "\e[33m"; // Yellow
            echo "to composer.json.\r\nPlease run \"composer install/update/dump-autoload\" again.\r\n";
            echo "\e[39m"; // Reset

            exit(1);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function deactivate(Composer $composer, IOInterface $io) {}

    /**
     * {@inheritdoc}
     */
    public function uninstall(Composer $composer, IOInterface $io) {}
}