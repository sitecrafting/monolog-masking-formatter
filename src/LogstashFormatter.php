<?php

namespace MaskingFormatter;

use Monolog\Formatter\LogstashFormatter as MonologLogstashFormatter;

/**
 * Masking formatter for Logstash
 *
 * @copyright 2017 SiteCrafting, Inc.
 * @author    Coby Tamayo <ctamayo@sitecrafting.com>
 * @package   MaskingFormatter
 */
class LogstashFormatter extends MonologLogstashFormatter implements MaskingFormatterInterface {
  use MasksFieldsTrait;
}

?>
