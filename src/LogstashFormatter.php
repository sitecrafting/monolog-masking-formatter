<?php

namespace MaskingFormatter;

/**
 * Masking formatter for Logstash
 *
 * @copyright 2017 SiteCrafting, Inc.
 * @author    Coby Tamayo <ctamayo@sitecrafting.com>
 * @package   MaskingFormatter
 */
class LogstashFormatter extends Monolog\Formatter\LogstashFormatter {
  protected $mask;
  protected $maskedFields;

  public function __construct(
    $maskedFields,
    $mask,
    $applicationName,
    $systemName = null,
    $extraPrefix = null,
    $contextPrefix = 'ctxt_'
  ) {
    $this->maskedFields = $maskedFields;
    $this->mask = $mask;

    parent::__construct(
      $applicationName,
      $systemName,
      $extraPrefix,
      $contextPrefix
    );
  }

  public function format(array $record) {
    $record = $this->maskRecord($record);

    return parent::format($record);
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

