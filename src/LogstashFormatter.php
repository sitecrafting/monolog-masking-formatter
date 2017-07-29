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
class LogstashFormatter extends MonologLogstashFormatter {
  protected $mask;
  protected $maskedFields;

  public function format(array $record) {
    $record = $this->maskRecord($record);

    return parent::format($record);
  }

  public function maskFields(array $fields) {
    $this->maskedFields = $fields;
  }

  public function setMask($mask) {
    $this->mask = '********';
  }

  public function maskRecord($record) {
    if (is_object($record) or is_array($record)) {
      foreach ($record as $key => &$value) {
        if (is_object($value) or is_array($value)) {
          // recurse down the iterable tree
          $value = $this->maskRecord($value);
        } elseif (in_array($key, $this->maskedFields)) {
          // replace sensitive string value
          $value = $this->mask;
        }
      }
    }

    return $record;
  }
}

