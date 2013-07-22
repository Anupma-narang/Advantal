<?php

/**
 * Description of cp
 *
 * @author juan
 */
sfProjectConfiguration::getActive()->loadHelpers(array('Date', 'Url'));

class cp {

    static protected $table = array(
        'A Coruña' => array('15', '27', '36'),
        'Albacete' => array('02', '03', '13', '16', '18', '23', '30', '46'),
        'Alicante/Alacant' => array('03', '02', '30', '46'),
        'Almería' => array('04', '18', '30'),
        'Araba/Álava' => array('01', '09', '20', '26', '31', '48'),
        'Ávila' => array('05', '10', '28', '37', '40', '45', '47'),
        'Badajoz' => array('06', '10', '13', '14', '21', '41', '45'),
        'Barcelona' => array('08', '17', '25', '43'),
        'Bizkaia' => array('48', '01', '09', '20', '39'),
        'Burgos' => array('09', '01', '39', '26', '34', '40', '42', '47', '48'),
        'Cáceres' => array('10', '05', '06', '37', '45'),
        'Cádiz' => array('11', '21', '29', '41'),
        'Cantabria' => array('39', '09', '24', '33', '34', '48'),
        'Castellón/Castelló' => array('12', '43', '44', '46'),
        'Ceuta' => array('51'),
        'Ciudad Real' => array('13', '02', '06', '14', '16', '23', '45'),
        'Córdoba' => array('14', '06', '13', '18', '23', '29', '40'),
        'Cuenca' => array('16', '02', '13', '19', '28', '44', '45', '46'),
        'Girona' => array('17', '08', '25'),
        'Granada' => array('18', '02', '04', '14', '23', '29'),
        'Guadalajara' => array('19', '16', '28', '40', '42', '44', '50'),
        'Gipuzkoa' => array('20', '01', '31', '48'),
        'Huelva' => array('21', '06', '11', '41'),
        'Huesca' => array('22', '25', '31', '50'),
        'Illes Balears' => array('07'),
        'Jaén' => array('23', '02', '13', '14', '18'),
        'León' => array('24', '27', '32', '33', '34', '39', '47', '49'),
        'Lleida' => array('25', '08', '17', '22', '43', '50'),
        'La Rioja' => array('26', '01', '09', '31', '42', '50'),
        'Lugo' => array('27', '15', '24', '32', '33', '36'),
        'Madrid' => array('28', '05', '16', '19', '40', '45'),
        'Málaga' => array('29', '11', '14', '18', '41'),
        'Melilla' => array('52'),
        'Murcia' => array('30', '02', '03', '04', '18'),
        'Navarra/Nafarroa' => array('31', '01', '20', '22', '26', '50'),
        'Ourense' => array('32', '24', '27', '36', '49'),
        'Asturias' => array('33', '24', '27', '39'),
        'Palencia' => array('34', '09', '24', '39', '47'),
        'Las Palmas' => array('35', '38'),
        'Pontevedra' => array('36', '15', '27', '32'),
        'Salamanca' => array('37', '05', '10', '47', '49'),
        'Santa Cruz de Tenerife' => array('38', '35'),
        'Segovia' => array('40', '05', '09', '19', '28', '42', '47'),
        'Sevilla' => array('41', '06', '11', '14', '21', '29'),
        'Soria' => array('42', '09', '19', '26', '40', '50'),
        'Tarragona' => array('43', '08', '12', '25', '44', '50'),
        'Teruel' => array('44', '12', '16', '19', '43', '46', '50'),
        'Toledo' => array('45', '05', '06', '10', '13', '16', '28'),
        'Valencia/València' => array('46', '02', '03', '12', '16', '44'),
        'Valladolid' => array('47', '05', '09', '24', '34', '37', '40', '49'),
        'Zamora' => array('49', '24', '32', '37', '47'),
        'Zaragoza' => array('50', '19', '22', '25', '31', '42', '43', '44')
    );
    static protected $statetable = array(
        'Toda España' => 'Toda España',
        'A Coruña' => 'A Coruña',
        'Albacete' => 'Albacete',
        'Alicante/Alacant' => 'Alicante',
        'Almería' => 'Almería',
        'Araba/Álava' => 'Vitoria-Gasteiz',
        'Asturias' => 'Oviedo',
        'Ávila' => 'Ávila',
        'Badajoz' => 'Badajoz',
        'Barcelona' => 'Barcelona',
        'Bizkaia' => 'Bilbao',
        'Burgos' => 'Burgos',
        'Cáceres' => 'Cáceres',
        'Cádiz' => 'Cádiz',
        'Cantabria' => 'Santander',
        'Castellón/Castelló' => 'Castellón de la Plana',
        'Ceuta' => 'Ceuta',
        'Ciudad Real' => 'Ciudad Real',
        'Córdoba' => 'Córdoba',
        'Cuenca' => 'Cuenca',
        'Girona' => 'Girona',
        'Granada' => 'Granada',
        'Guadalajara' => 'Guadalajara',
        'Gipuzkoa' => 'Donostia-San Sebastián',
        'Huelva' => 'Huelva',
        'Huesca' => 'Huesca',
        'Illes Balears' => 'Palma',
        'Jaén' => 'Jaén',
        'León' => 'León',
        'Lleida' => 'Lleida',
        'La Rioja' => 'Logroño',
        'Lugo' => 'Lugo',
        'Madrid' => 'Madrid',
        'Málaga' => 'Málaga',
        'Melilla' => 'Melilla',
        'Murcia' => 'Murcia',
        'Navarra/Nafarroa' => 'Pamplona/Iruña',
        'Ourense' => 'Ourense',
        'Palencia' => 'Palencia',
        'Las Palmas' => 'Palmas de Gran Canaria (Las)',
        'Pontevedra' => 'Pontevedra',
        'Salamanca' => 'Salamanca',
        'Santa Cruz de Tenerife' => 'Santa Cruz de Tenerife',
        'Segovia' => 'Segovia',
        'Sevilla' => 'Sevilla',
        'Soria' => 'Soria',
        'Tarragona' => 'Tarragona',
        'Teruel' => 'Teruel',
        'Toledo' => 'Toledo',
        'Valencia/València' => 'Valencia',
        'Valladolid' => 'Valladolid',
        'Zamora' => 'Zamora',
        'Zaragoza' => 'Zaragoza'
    );

    public static function checkCpByStateName($cp, $name) {
        if (!empty($name) and isset(self::$table[$name])) {
            if (preg_match('/^(0[1-9]|5[0-2]|[0-4][0-9])[0-9]{3}$/', $cp)) {
                if (in_array(substr($cp, 0, 2), self::$table[$name])) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function isStateCapital($state, $city) {
        return (self::$statetable[$state] == $city) ? true : false;
    }

    public static function getModuleFromRefrel() {
        $url = parse_url(sfContext::getInstance()->getRequest()->getReferer());
        $path = trim($url['path'], '/');
        if (!sfConfig::get('sf_no_script_name') && $pos = strpos($path, '/')) {
            $path = substr($path, $pos + 1);
        }
        $path = ($path == 'backend.php' || $path == 'backend_dev.php') ? '' : $path;
        return $params = sfContext::getInstance()->getRouting()->findRoute('/' . $path);
    }

    public static function sendLetterActiveMail($cartas) {
        $username = $cartas->getProfesional()->getUser()->getUsername();
        $date = format_datetime($cartas->getCreatedAt(), "d/m/y");
        $ssProfFullName = $cartas->getProfesional()->getFirstName() . ' ' . $cartas->getProfesional()->getLastNameOne() . ' ' . $cartas->getProfesional()->getLastNameTwo();
        $activity = $cartas->getActivityName();
        $city = $cartas->getProfesional()->getCity()->getName();
        $city .= cp::isStateCapital($cartas->getProfesional()->getStates()->getName(), $cartas->getProfesional()->getCity()->getName()) ? ', ' : ' (' . $cartas->getProfesional()->getStates()->getName() . '), ';
        $to = $cartas->getProfesional()->getUser()->getEmailAddress();
        $from = sfConfig::get('app_default_mailfrom');
        $subject = 'Se recomienda o desaprueba a un profesional dado de alta por mí.';
        $prefix = sfContext::getInstance()->getRequest()->getUriPrefix();
        $link = '<a href="' . $prefic . '">aquí</a>';
        $inactiveLink = sfContext::getInstance()->getRequest()->getUriPrefix() . '/vosotros/baja_notificaciones?hash=' . $cartas->getProfesional()->getUser()->getUserNotification()->getHash() . '&tipo=publica_recomend_disaprov_value';

        if ($cartas->profesional_letter_type_id == 1) {
            $body = 'Hola ' . $username . '
<p>Te informamos de que el ' . $date . ', un colaborador ha recomendado al
profesional ' . $ssProfFullName . ' de la actividad ' . $activity . ' en ' . $city . ' dado de alta por ti.</p>

<p>Para verlo, por favor haz clic ' . $link . '.</p>

<p>¡Muchas gracias por contribuir!</p>

<p><a href="' . $inactiveLink . '">No quiero recibir más este mensaje.</a></p>';
        } else if ($cartas->profesional_letter_type_id == 2) {

            $body = 'Hola ' . $username . '
<p>Te informamos de que el ' . $date . ', un colaborador ha desaprobado al
profesional ' . $ssProfFullName . ' de la actividad ' . $activity . ' en ' . $city . ' dado de alta por ti.</p>

<p>Para verlo, por favor haz clic ' . $link . ' .</p>

<p>¡Muchas gracias por contribuir!</p>

<p>No quiero recibir más este mensaje.</p>';
        }
        self::sendMail($to, $from, $subject, $body);
    }

    public static function sendMail($to, $from, $subject, $body) {
        $mensaje = Swift_Message::newInstance();
        $mensaje->setFrom($from);
        $mensaje->setTo($to);
        $mensaje->setSubject($subject);
        $mensaje->setBody($body, 'text/html');

        $mensaje->setBody($body);

        sfContext::getInstance()->getMailer()->send($mensaje);
    }

}