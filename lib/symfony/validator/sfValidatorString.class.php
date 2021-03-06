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
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorString.class.php 12641 2008-11-04 18:22:00Z fabien $
 */
class sfValidatorString extends sfValidatorBase
{
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * max_length: The maximum length of the string
   *  * min_length: The minimum length of the string
   *
   * Available error codes:
   *
   *  * max_length
   *  * min_length
   *
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('max_length', '"%value%" es demasiado largo (%max_length% caracteres max).');
    $this->addMessage('max_rep_length', '"%value%" es demasiado largo (%max_length% caracteres max).');
    $this->addMessage('min_length', '"%value%" es demasiado corto (%min_length% carateres min).');

    $this->addOption('max_length');
    $this->addOption('max_rep_length');
    $this->addOption('min_length');

    $this->setOption('empty_value', '');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    $clean = (string) $value;
    $rep_clean = preg_replace("/(<([^>]+)>)/i","",(string) $value);

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
