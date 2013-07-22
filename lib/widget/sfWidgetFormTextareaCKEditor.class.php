<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWidgetFormTextareaCKEditor represents a CKEditor widget.
 *
 * You must include the CKEditor JavaScript file by yourself.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Calambrenet <calambrenet@codefriends.es>
 */
class sfWidgetFormTextareaCKEditor extends sfWidgetFormTextarea
{
    /**
     * Constructor.
     *
     * Available options:
     *
     *  * theme:  The Tiny MCE theme
     *  * width:  Width
     *  * height: Height
     *  * config: The javascript configuration
     *
     * @param array $options     An array of options
     * @param array $attributes  An array of default HTML attributes
     *
     * @see sfWidgetForm
     */
    protected function configure($options = array(), $attributes = array())
    {
        $this->addOption('width');
        $this->addOption('height');
        $this->addOption('err_id');
        $this->addOption('max_length');
    }

    /**
     * @param  string $name        The element name
     * @param  string $value       The value selected in this widget
     * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
     * @param  array  $errors      An array of errors for the field
     *
     * @return string An HTML tag string
     *
     * @see sfWidgetForm
     */
    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $textarea = parent::render($name, $value, $attributes, $errors);

        $js = sprintf(<<<EOF
<script type="text/javascript">
	CKEDITOR.replace("%s",{
        width: "%s",
    	height: "%s",
        txtMaxLength: "%s",
        resize_enabled:false,
    	//removePlugins: 'elementspath',
    	forcePasteAsPlainText: true,
        toolbar: [['CharCount'],['Cut','Copy','Paste','PasteText', 'Link'],['Undo', 'Redo'],['TextColor'],
            ['SelectAll'],['Bold', 'Italic','Underline', '-', 'NumberedList', 'BulletedList'],['Smiley']]
	});

	CKEDITOR.instances.%s.on('key', checkLength);
	CKEDITOR.instances.%s.on('paste', checkLength);
        CKEDITOR.instances.%s.on('dataReady', checkLength);
        CKEDITOR.instances.%s.on('blur', checkLength);
        CKEDITOR.instances.%s.on('keypress', checkLength);
        CKEDITOR.instances.%s.on('focus', checkLength);

	function getCurrentCount(editor)
	{
		var currentLength = editor.getData()
                    .replace(/<[^>]*>/g, '')
                    .replace(/\s+/g, ' ')
                    .replace(/&\w+;/g ,'X')
                    .replace(/^\s*/g, '')
                    .replace(/\s*$/g, '')
                    .length;

                return currentLength;
	}

	function checkLength(evt)
	{
		var stopHandler = false;
		var currentLength = getCurrentCount(evt.editor);
		var maximumLength = %s;

		if(evt.editor.config.MaxLength)
		{
			maximumLength = evt.editor.config.MaxLength;
		}

		if(!evt.editor.config.LockedInitialized)
		{
			evt.editor.config.LockedInitialized = 1;
			evt.editor.config.Locked = 0;
		}

		if(evt.data)
		{
			if(evt.data.html)
			{
				currentLength += evt.data.html.length;
			}
			else if(evt.data.text)
			{
				currentLength += evt.data.text.length;
			}
		}
        remainingLength = maximumLength - currentLength;
        $("#cke_path_%s").after("<span id='charCnt_%s' class='charCnt'>Caracteres: "+ remainingLength + "</span>");
        $("#cke_path_%s").remove();
        $("#charCnt_%s").html("Caracteres: "+remainingLength);

		if(!stopHandler && currentLength >= maximumLength)
		{
			$("#%s").show();

			if ( !evt.editor.config.Locked )
			{
				// Record the last legal content.
				evt.editor.fire( 'saveSnapshot' );
				evt.editor.config.Locked = 1;
				// Cancel the keystroke.
				evt.cancel();
			}
			else
				// Check after this key has effected.
				setTimeout( function()
				{
					// Rollback the illegal one.
					if( getCurrentCount(evt.editor) > maximumLength ){
						evt.editor.execCommand( 'undo' );
					}else{
						evt.editor.config.Locked = 0;
                                        }
				}, 0);
		}
		else{
			$("#%s").hide();
		}

	}
</script>
EOF
            ,
            $this->generateId($name),
            $this->getOption('width'),
            $this->getOption('height'),
            $this->getOption('max_length'),
            $this->generateId($name),
            $this->generateId($name),
            $this->generateId($name),
            $this->generateId($name),
            $this->generateId($name),
            $this->generateId($name),
            $this->getOption('max_length'),
            $this->generateId($name),
            $this->generateId($name),
            $this->generateId($name),
            $this->generateId($name),
            $this->getOption('err_id'),
            $this->getOption('err_id')
        );

        if(sfConfig::get("sf_app") == "backend"){
            $css = '<style type="text/css">
                    .cke_wrapper{ min-height: 254px !important;}
                    .cke_skin_kama .cke_path, .charCnt { margin: 2px 0 2px 3px !important; }
                    .charCnt { display: block;font-weight: bold; }
                    </style>';
        } else {
            $css = '<style type="text/css">
                    .cke_wrapper{ min-height: 251px !important;}
                    .cke_skin_kama .cke_path { margin: 5px 0 0 !important; }
                    .charCnt { display: block; margin: 5px 0 0 !important; font-weight: bold; }
                    </style>';
        }
        return $textarea . $js . $css;
    }
}