<?php

// Copyright 2009 P'unk Ave, LLC. Released under the MIT license.

/**
 * pkWidgetFormInputFilePersistentContactanos represents an upload HTML input tag
 * that doesn't lose its contents when the form is redisplayed due to
 * a validation error in an unrelated field. Instead, the previously
 * submitted and successfully validated file is kept in a cache
 * managed on behalf of each user, and automatically reused if the
 * user doesn't choose to upload a new file but rather simply corrects
 * other fields and resubmits.
 */
class pkWidgetFormInputFilePersistentContactanos extends sfWidgetForm {

    /**
     * @param array $options     An array of options
     * @param array $attributes  An array of default HTML attributes
     *
     * @see sfWidgetFormInput
     *
     * In reality builds an array of two controls using the [] form field
     * name syntax
     */
    protected function configure($options = array(), $attributes = array()) {
        parent::configure($options, $attributes);

        $this->addOption('type', 'file');
        $this->addOption('existing-html', false);
        $this->setOption('needs_multipart', true);
    }

    /**
     * @param  string $name        The element name
     * @param  string $value       The value displayed in this widget
     *                             (i.e. the browser-side filename submitted
     *                             on a previous partially successful
     *                             validation of this form)
     * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
     * @param  array  $errors      An array of errors for the field
     *
     * @return string An HTML tag string
     *
     * @see sfWidgetForm
     */
    public function render($name, $value = null, $attributes = array(), $errors = array()) {
        $exists = false;
        if (isset($value['persistid']) && strlen($value['persistid'])) {
            $persistid = $value['persistid'];
            $info = pkValidatorFilePersistent::getFileInfo($persistid);
            if ($info) {
                $exists = true;
            }
        } else {
            $persistid = $this->createGuid();
        }

        preg_match('/contactanos\[fichero(\d)\]/', $name, $matches);
        $result = '';
        if ($exists) {
            exit('ok');

            $filename = $info['name'];
            if (strlen($filename) > 25) {
                $filename = substr($filename, 0, 22) . '...';
            }
            return
                    '<input type="hidden" name="contactanos[fichero' . $matches[1] . '][status]" id="contactanos_fichero' . $matches[1] . '_status" value="true" /> ' .
                    '<span id="filename_uploaded' . $matches[1] . '" style="display: inline-block;width:310px;">' .
                    '<label for="contactanos_fichero' . $matches[1] . '_status">' . sprintf('%s (%.2f KB)', $filename, $info['size'] / 1024) . '</label></span><br/>' .
                    '<span id="file_' . $matches[1] . '">' .
                    $this->renderTag('input', array_merge(
                                    array(
                                'type' => $this->getOption('type'),
                                'class' => 'file_' . $matches[1],
                                'name' => $name . '[newfile]'), $attributes)) .
                    '</span>' .
                    $this->renderTag('input', array(
                        'type' => 'hidden',
                        'name' => $name . '[persistid]',
                        'value' => $persistid));
        } else {
            $result = '<input type="hidden" name="contactanos[fichero' . $matches[1] . '][status]" id="contactanos_fichero' . $matches[1] . '_status" value="true" /> ';
        }

        if ($value) {
            $result.='<strong>' . $value . '</strong><br/>';
        }

        return $result .
                $this->renderTag('input', array_merge(
                                array(
                            'type' => $this->getOption('type'),
                            'class' => 'file_' . $matches[1],
                            'name' => $name . '[newfile]'), $attributes)) .
                $this->renderTag('input', array(
                    'type' => 'hidden',
                    'name' => $name . '[persistid]',
                    'value' => $persistid));
    }

    static private function createGuid() {
        $guid = "";
        for ($i = 0; ($i < 8); $i++) {
            $guid .= sprintf("%02x", mt_rand(0, time()));
            //$guid .= sprintf("%02x", mt_rand(0, 255));
        }
        return $guid;
    }

}
