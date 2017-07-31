<?php

namespace MaskingFormatter;

/**
 * Masking formatter for Logstash
 *
 * @copyright 2017 SiteCrafting, Inc.
 * @author    Coby Tamayo <ctamayo@sitecrafting.com>
 * @package   MaskingFormatter
 */
interface MaskingFormatterInterface {
  public function setMask($mask);
  public function maskFields(array $fields);
}
