<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorString validates a string. It also converts the input value to a string.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Chintan Mirani <chintan.mirani@virtueinfo.com>
 * @version
 */
class mySfValidatorString extends sfValidatorString
{

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    $clean = (string) $value;
    $rep_clean = preg_replace("/(<([^>]+)>)/i","",(string) $value);
    $rep_clean = preg_replace("/&nbsp;/","",$rep_clean);
    $rep_clean = str_replace("\r", '', $rep_clean);    // --- replace with empty space
    $rep_clean = str_replace("\n", '', $rep_clean);   // --- replace with space
    $rep_clean = str_replace("\t", '', $rep_clean);
    $rep_clean = trim($rep_clean);

    $length = function_exists('mb_strlen') ? mb_strlen($clean, $this->getCharset()) : strlen($clean);

    $rep_length = function_exists('mb_strlen') ? mb_strlen($rep_clean, $this->getCharset()) : strlen($rep_clean);

    if ($this->hasOption('max_length') && $length > $this->getOption('max_length'))
    {
      throw new sfValidatorError($this, 'max_length', array('value' => $value, 'max_length' => $this->getOption('max_length')));
    }

    if ($this->hasOption('max_rep_length') && $rep_length > $this->getOption('max_rep_length'))
    {
    	throw new sfValidatorError($this, 'max_rep_length', array('value' => $value, 'max_rep_length' => $this->getOption('max_rep_length')));
    }

    if ($this->hasOption('min_length') && $length < $this->getOption('min_length'))
    {
      throw new sfValidatorError($this, 'min_length', array('value' => $value, 'min_length' => $this->getOption('min_length')));
    }
    return $clean;
  }
}
