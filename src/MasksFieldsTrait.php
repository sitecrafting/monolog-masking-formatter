<?php

namespace MaskingFormatter;

/**
 * Masking formatter for Logstash
 *
 * @copyright 2017 SiteCrafting, Inc.
 * @author    Coby Tamayo <ctamayo@sitecrafting.com>
 * @package   MaskingFormatter
 */
trait MasksFieldsTrait {
  protected $mask;
  protected $maskedFields;

  /**
   * @inheritdoc
   */
  public function format(array $record) {
    $record = $this->maskRecord($record);

    return parent::format($record);
  }

  /**
   * Indicate which keys the formatter should recursively search for and mask.
   * @param array $fields an array of keys (strings) whose values to mask
   */
  public function maskFields(array $fields) {
    $this->maskedFields = $fields;
  }

  /**
   * Set the mask string to use in log files
   * @param string $mask the mask to use to replace sensitive strings
   */
  public function setMask($mask) {
    $this->mask = $mask;
  }

  protected function maskRecord($record) {
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

?>
