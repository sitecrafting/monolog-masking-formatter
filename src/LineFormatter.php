<?php

namespace MaskingFormatter;

use Monolog\Formatter\LineFormatter as MonologLineFormatter;

/**
 * Masking formatter for simple flat-file line format
 *
 * @copyright 2017 SiteCrafting, Inc.
 * @author    Coby Tamayo <ctamayo@sitecrafting.com>
 * @package   MaskingFormatter
 */
class LineFormatter extends MonologLineFormatter {
  use MasksFieldsTrait;
}

?>
