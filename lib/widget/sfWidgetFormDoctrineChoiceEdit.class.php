<?php

/**
 * sfWidgetFormDoctrineChoiceEdit represents a choice widget for a model with an edit button to edit related object.
 *
 */
class sfWidgetFormDoctrineChoiceEdit extends sfWidgetFormDoctrineChoice
{
    /**
     * @see sfWidget
     */
    public function __construct($options = array(), $attributes = array())
    {
        $this->addRequiredOption('url');

        parent::__construct($options, $attributes);
    }

    /**
     * @see sfWidgetFormDoctrineChoiceEdit
     */
    protected function configure($options = array(), $attributes = array())
    {

        parent::configure($options, $attributes);
    }

    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        sfApplicationConfiguration::getActive()->loadHelpers(array('Url'));

        return parent::render($name, $value, $attributes, $errors) .
            sprintf('<ul class="sf_admin_actions block-inline"><li class="sf_admin_action_edit"><a class="edit_choice" id="edit_%s" href="#" >Editar</a></li>',
                $this->generateId($name)
            ) .
            sprintf('<li class="sf_admin_action_show"><a class="preview_choice" id="preview_%s" href="#">Ver</a></li>',
                $this->generateId($name)

            ) .

            sprintf('<li class="sf_admin_action_new"><a class="new_choice" id="new_%s" href="#">Nuevo</a></li></ul>',
                $this->generateId($name)

            ) .
            sprintf(<<<EOF
<script type="text/javascript">
  edit_choice('%s');
</script>
EOF
                , url_for($this->getOption('url') . '?id=__ID__')
            );


    }

    public function getJavascripts()
    {
        return array("/js/edit_choice.js", "/js/fancybox/jquery.fancybox.pack.js");
    }

    public function getStylesheets()
    {
        return array('/css/fancybox/jquery.fancybox.css' => 'screen');
    }

}