<?php
/*
 * This file is part of the sfDependentSelect package.
 * (c) 2010 Sergio Flores <sercba@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormDoctrineDependentSelect represents an select widget rendered by
 * SelectDependiente javascript class optimized for doctrine objects.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Sergio Flores <sercba@gmail.com>
 */
class audWidgetFormDoctrineDependentSelect extends sfWidgetFormDoctrineDependentSelect
{

    protected function  configure($options = array(), $attributes = array())
    {
        $this->addOption('add_all', false);
        parent::configure($options, $attributes);

    }

    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $js = '';
        if ($this->getOption('add_all')) {
            $js = sprintf(<<<EOF
<script type="text/javascript">
    $(document).ready(function() {
        $('#%s option').eq(1).before($('<option>').attr('value', '').html('%s'));
    });
</script>
EOF
                , $this->generateId($name),
                $this->getOption('add_all')
            );

        }

        return $js . parent::render($name, $value, $attributes, $errors);
    }
}
