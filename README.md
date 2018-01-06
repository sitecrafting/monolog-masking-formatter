# MaskingFormatter

Library for masking sensitive info in Monolog.

Currently only `LineFormatter` (the Monolog default) and Logstash formats are supported.

## Usage

```php
<?php

use Monolog\Handler\RotatingFileHandler;
use MaskingFormatter\LogstashFormatter as MaskingLogstashFormatter;

// configure a formatter
$formatter = new MaskingLogstashFormatter('my-app');
$formatter->maskFields(['sensitive', 'context', 'keys']);
$formatter->setMask('********');

// instantiate a handler and add our formatter
$handler = new RotatingFileHandler('./log/app.log', 7, Logger::DEBUG);
$handler->setFormatter($formatter);

// create a logger and push the handler per usual...
```

## Installation

Add the private repo and require the library

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:sitecrafting/monolog-masking-formatter.git"
    }
  ],
  "sitecrafting/monolog-masking-formatter"
  ...
}
```

Then just run `composer install` or `composer udpate` per usual.

## License

MIT

