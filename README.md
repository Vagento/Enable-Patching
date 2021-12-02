# Enable-Patching
This package adds { 'extra' => { 'enable-patching' => true } } to the composer.json file. Needed for the cweagans/composer-patches package, so that sub-packages can automatically install patches, without forcing the user to add 'enable-patching' to the file manually.

# Installation
Run `composer require vagento/enable-patching`

That's it. You will be asked to run composer update/install again, so already existing patches in sub-packages can be installed.
