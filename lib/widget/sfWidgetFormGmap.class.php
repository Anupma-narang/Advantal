<?php

class sfWidgetFormGmap extends sfWidgetFormSchema
{
    public function __construct($fields = null, $options = array(), $attributes = array(), $labels = array(), $helps = array())
    {
//        $fields = array(
//            'address' => new sfWidgetFormInput(),
//            'lat' => new sfWidgetFormInput(array(), array('readonly' => true)),
//            'lng' => new sfWidgetFormInput(array(), array('readonly' => true)),
//        );

        parent::__construct($fields, $options, $attributes, $labels, $helps);
    }

    public function configure($options = array(), $attributes = array())
    {
        $this->addOption('address.options', array('placeholder' => 'Introduce la dirección a buscar', 'style' => 'width:400px'));

        $this->setOption('default', array(
            'address' => 'Madrid',
            'lat' => '-3.70034540000006',
            'lng' => '40.41669090000005',
            'zoom' => 10
        ));

        $this->addOption('map.lng');
        $this->addOption('map.lat');
        $this->addOption('map.address');
        $this->addOption('map.zoom');
        $this->addOption('div.class', 'sf-gmap-widget');
        $this->addOption('map.height', '300px');
        $this->addOption('map.width', '500px');
        $this->addOption('map.width', '500px');
        $this->addOption('map.style', "");
        $this->addOption('lookup.name', "Buscar");

        $this->addOption('template.html', '
       {div.error}
      <div id="{div.id}" class="{div.class}">
        {input.search} <input type="button" value="{input.lookup.name}"  id="{input.lookup.id}" /> <br />
        {input.longitude}
        {input.latitude}
        {input.zoom}
        <div id="{map.id}" style="width:{map.width};height:{map.height};{map.style}"></div>
      </div>
    ');

        $this->addOption('template.javascript', '
      <script type="text/javascript">
        $(document).ready(function() {
          new sfGmapWidgetWidget({
            longitude: "{input.longitude.id}",
            latitude: "{input.latitude.id}",
            address: "{input.address.id}",
            lookup: "{input.lookup.id}",
            map: "{map.id}",
            zoom: "{input.zoom.id}"
          });
        })
      </script>
    ');
    }

    public function getJavascripts()
    {
        return array(
            '/js/sf_widget_gmap_address.js',
            'https://maps.google.com/maps/api/js?sensor=false'
        );
    }

    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        // define main template variables
        $template_vars = array(
            '{div.id}' => $this->generateId($name),
            '{div.class}' => $this->getOption('div.class'),
            '{map.id}' => $this->generateId($name . '[map]'),
            '{map.style}' => $this->getOption('map.style'),
            '{map.height}' => $this->getOption('map.height'),
            '{map.width}' => $this->getOption('map.width'),
            '{input.lookup.id}' => $this->generateId($name . '[lookup]'),
            '{input.lookup.name}' => $this->getOption('lookup.name'),
            '{input.address.id}' => $this->generateId($name . '[address]'),
            '{input.latitude.id}' => $this->generateId($name . '[lat]'),
            '{input.longitude.id}' => $this->generateId($name . '[lng]'),
            '{input.zoom.id}' => $this->generateId($name . '[zoom]'),
        );

        if ($errors) {
            $template_vars['{div.error}'] = '<div class="error">' . $errors->getMessage() . '</div>';
        } else {
            $template_vars['{div.error}'] = '';
        }

        // avoid any notice errors to invalid $value format
        $value = !is_array($value) ? array() : $value;
        $default = $this->getOption('default');
        $value['address'] = $value['address'] ? $value['address'] : null;
        $value['longitude'] = $value['lng'] ? $value['lng'] : $default['lng'];
        $value['latitude'] = $value['lat'] ? $value['lat'] : $default['lat'];
        $value['zoom'] = $value['zoom'] ? $value['zoom'] : $default['zoom'];

        // define the address widget
        $address = new sfWidgetFormInputText(array(), $this->getOption('address.options'));
        $template_vars['{input.search}'] = $address->render($name . '[address]', $value['address']);
        // define the longitude and latitude fields
        $hidden = new sfWidgetFormInputHidden();
        $template_vars['{input.longitude}'] = $hidden->render($name . '[lng]', $value['longitude']);
        $template_vars['{input.latitude}'] = $hidden->render($name . '[lat]', $value['latitude']);
        $template_vars['{input.zoom}'] = $hidden->render($name . '[zoom]', $value['zoom']);

        // merge templates and variables
        return strtr(
            $this->getOption('template.html') . $this->getOption('template.javascript'),
            $template_vars
        );
    }
}
