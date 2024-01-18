# Livedebug PHP Helper

Use in conjunction with [guillaumedevreese/livedebug](https://github.com/gdevreese/livedebug-docker) docker image.
This allows you to debug PHP code without XDEBUG, print Kint output to external UI without stopping the process execution.

## Installation

```bash
composer require --dev gdv/livedebug
```

## Configuration

Available environment variables:
* LIVEDEBUG_INTERNAL_PORT: Internal exposed port to listen on (default: 3030)
* LIVEDEBUG_INTERNAL_HOST: Host to send data on (default: host.docker.internal)
* LIVEDEBUG_INTERNAL_PROTOCOL: Protocol to use (default: http)


## Usage

```php
<?php
use Gdv\Livedebug;

...
LD::$depth_limit = 2; // default set to 3
LD::dump($var);
LD::dump($var1, $var2, $var3);
...
