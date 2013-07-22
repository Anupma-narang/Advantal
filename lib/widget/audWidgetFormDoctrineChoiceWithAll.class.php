<?php
class audWidgetFormDoctrineChoiceWithAll extends sfWidgetFormDoctrineChoice
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