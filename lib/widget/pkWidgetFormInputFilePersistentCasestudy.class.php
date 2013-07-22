<?php

// Copyright 2009 P'unk Ave, LLC. Released under the MIT license.

/**
 * pkWidgetFormInputFilePersistent represents an upload HTML input tag
 * that doesn't lose its contents when the form is redisplayed due to
 * a validation error in an unrelated field. Instead, the previously
 * submitted and successfully validated file is kept in a cache
 * managed on behalf of each user, and automatically reused if the
 * user doesn't choose to upload a new file but rather simply corrects
 * other fields and resubmits.
 */
class pkWidgetFormInputFilePersistentCasestudy extends sfWidgetForm {

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
         $this->addOption('template', 'true');
        //$this->setOption('file_src', '/images/' . basename(sfConfig::get('sf_upload_dir')) . '/' . basename(sfConfig::get('sf_users_dir')) . '/' .(!$this->getObject()->getImage()?'default.png':$this->getObject()->getImage()));
        $this->addOption('file_src', 'true');
        $this->addOption('is_image', true);
        $this->addOption('edit_mode', true);
        $this->addOption('with_delete', false);
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
        global $archivo;
        $exists = false;

        if ((isset($value['persistid']) && strlen($value['persistid']))) {
            $persistid = $value['persistid'];
            $info = pkValidatorFilePersistent::getFileInfo($persistid);

            if ($info) {
                $exists = true;
            }
        } elseif ($archivo != '') {
            $persistid = $value['persistid'] = $archivo;
            $info = pkValidatorFilePersistent::getFileInfo($persistid);
            if ($info) {
                $exists = true;
            }
        } else {
            $persistid = $this->createGuid();
        }

        if (preg_match('/user_company_case_study_request/i', $name) == 1) {
            preg_match('/user_company_case_study_request\[file(\d)\]/', $name, $matches);
            $pwname = 'user_company_case_study_request';
        } elseif(preg_match('/user_product_case_study_request/i', $name) == 1) {
            preg_match('/user_product_case_study_request\[file(\d)\]/', $name, $matches);
            $pwname = 'user_product_case_study_request';
        } elseif(preg_match('/company_case_study/i', $name) == 1) {
            preg_match('/company_case_study\[file(\d)\]/', $name, $matches);
            $pwname = 'company_case_study';
        } elseif(preg_match('/product_case_study/i', $name) == 1) {
            preg_match('/product_case_study\[file(\d)\]/', $name, $matches);
            $pwname = 'product_case_study';
        }
        
        

        $result = '';
        if ($exists) {
            $filename = $info['name'];
            if (strlen($filename) > 25) {
                $filename = substr($filename, 0, 22) . '...';
            }

            $result = '<span id="filename_uploaded' . $matches[1] . '" style="padding-left:90px;"><input type="checkbox" name="concurso[file' . $matches[1] . '][status]" id="concurso_file' . $matches[1] . '_status" value="1" checked="true" /> ' .
                    '<label for="' . $pwname . '_file' . $matches[1] . '_status">' . $info['name'] . ' (' . sprintf('%.2f KB', $info['size'] / 1000) . ')</label></span><br/>';
            return
                    '<input type="hidden" name="' . $pwname . '[file' . $matches[1] . '][status]" id="' . $pwname . '_file' . $matches[1] . '_status" value="true" /> ' .
                    '<span id="filename_uploaded' . $matches[1] . '" style="display: inline-block;width:395px;">' .
                    '<label for="' . $pwname . '_file' . $matches[1] . '_status" style="width:300px;color:#000;line-height: 16px;"><strong>' . sprintf('%s (%.2f KB)', $filename, $info['size'] / 1024) . '</strong></label></span></br>' .
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
            $result = '<input type="hidden" name="' . $pwname . '[file' . $matches[1] . '][status]" id="' . $pwname . '_file' . $matches[1] . '_status" value="true" /> ';
        }
        if (!is_array($value) && !empty($value)) {
            $result.='<strong>' . $value . '</strong><br/>';
        }
        return
                /* $this->renderTag('input',
                  array_merge(
                  array(
                  'type' => $this->getOption('type'),
                  'class'=>'file_'.$matches[1],
                  'name' => $name . '[newfile]'),
                  $attributes)) .
                  $result .
                  $this->renderTag('input',
                  array(
                  'type' => 'hidden',
                  'name' => $name . '[persistid]',
                  'value' => $persistid)); */
                $result .
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
