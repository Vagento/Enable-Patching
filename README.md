<h1 align="center">Vagento - Enable Patching</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0.1-blue.svg?cacheSeconds=2592000" />
  <a href="https://opensource.org/licenses/MIT" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/badge/License-MIT-yellow.svg" />
  </a>
  <a href="https://twitter.com/WWoshid" target="_blank">
    <img alt="Twitter: WWoshid" src="https://img.shields.io/twitter/follow/WWoshid.svg?style=social" />
  </a>
</p>

> This package adds { 'extra': { 'enable-patching': true } } to the composer.json file. Needed for the cweagans/composer-patches package, so that sub-packages can automatically install patches, without forcing the user to add 'enable-patching' to the file manually.

## Installation

```sh
composer require vagento/enable-patching
```

## Usage

That's it. You will be asked to run composer update/install again, so already existing patches in sub-packages can be installed.

## Show your support

Give a ⭐️ if this project helped you!

## 📝 License

Copyright © 2021 [Valentin Wotschel](https://github.com/WalterWoshid).<br />
This project is [MIT](https://opensource.org/licenses/MIT) licensed.
