<?php

function link_to_contribuye($obj, $wrapper_class = 'box_right_contribuye_dos') {
  if (sfContext::getInstance()->getUser()->hasFlash('nueva_contribucion'))
    return '';

  $contribucion_id = null;
  if (get_class($obj) === 'Contribucion' or (method_exists($obj, 'getRawValue') and get_class($obj->getRawValue()) === 'Contribucion')) {
    if ($obj->contribucion_estado_id != 2) {
      return '';
    }
    $contribucion_id = $obj->getId();
    $obj = $obj->getConcurso();
  }

  if ($obj->getConcursoEstadoId() == 10) {
    $link = link_to_function(__('contribuye'), "alert('No puedes contribuir en este concurso. Está en Revisión. Por favor inténtalo más adelante.')");
  } elseif ($obj->getConcursoEstadoId() == 2) {
    if ($contribucion_id) {
      $link = link_to(__('contribuye'), 'contribucionuno/new?concurso_id=' . $obj->getId() . '&contribucion_id=' . $contribucion_id, array('title' => 'Contribuye en un concurso de ideas', 'absolute' => true, 'class' => 'login_required', 'message' => 'Para contribuir en un concurso <strong>necesitas ser colaborador</strong>.'));
    } else {
      $link = link_to(__('contribuye'), 'contribucionuno/new?concurso_id=' . $obj->getId(), array('title' => 'Contribuye en un concurso de ideas', 'absolute' => true, 'class' => 'login_required', 'message' => 'Para contribuir en un concurso <strong>necesitas ser colaborador</strong>.'));
    }
  } else {
    return '';
  }

  return empty($wrapper_class) ? $link : '<span class="' . $wrapper_class . '">' . $link . '</span>';
}

function link_to_concurso($concurso, $from = null) {
  return link_to(__('Ver concurso'), url_for_concurso($concurso, $from), array('title' => 'Ver concurso de ideas'));
}

function link_to_contest($concurso, $title = 'Ver concurso', $from = null, $contribution = null) {
  return link_to($title, url_for_concurso($concurso, $from, $contribution));
}

function url_for_concurso($concurso, $from = null, $contribution = null) {
  //url for company contest
  if ($concurso->getEmpresaId()) {
    //return url
    $title = $concurso->getSlug();
    
    $param_array = array('company' => $concurso->getEmpresa()->getSlug(),
       /* 'location' => strtolower(str_replace(' ', '-', ($concurso->getCity() ? $concurso->getCity()->getName() : ''))),
        'road' => strtolower(($concurso->getRoadType() ? $concurso->getRoadType()->getName() : '') . '-' . $concurso->getConcursoAddress() . '-' . $concurso->getConcursoNumero()),*/
        'title' => $title,
        'date' => date('d-m-Y', strtotime($concurso->getCreatedAt())));
    if ($from) {
      $param_array['from'] = $from;
    }
    if ($contribution) {
      
      $param_array['cnt'] = $contribution;
    }
    return url_for('company-contest-show', $param_array);
  }
  //url for product contest
  else {
    //get product model record
    $product_record = $concurso->getProducto();
    $title =  $concurso->getSlug();
    
    //return url
    $param_array = array('product' => $product_record->getSlug(),
        /*'brand' => strtolower(str_replace(' ', '-', $product_record->getMarca() . ' ' . $product_record->getModelo())),*/
        'title' => $title,
        'date' => date('d-m-Y', strtotime($concurso->getCreatedAt()))
        );
    if ($from) {
      $param_array['from'] = $from;
    }
    if ($contribution) {
      $param_array['cnt'] = $contribution;
    }
    return url_for('product-contest-show', $param_array);
  }
  /* return url_for(array(
    'module' => 'concurso',
    'action' => 'urlaliasshow',
    'nombre' => $concurso->getProducto_or_Empresa_NameSlug(),
    'date' => $concurso->getDateTimeObject('created_at')->format('d-m-Y'),
    'time' => $concurso->getDateTimeObject('created_at')->format('H-i-s'),
    'slug' => $concurso->getSlug())); */
}

function url_for_concurso_incidencia($concurso) {

  //url for company contest
  if ($concurso->getEmpresaId()) {
    $contribution = $concurso->getContribuciones();
    //return url
    return url_for('company-contest-incident', array('company' => $concurso->getEmpresa()->getSlug(),
                /*'location' => strtolower(str_replace(' ', '-', is_object($concurso->getCity()) ? $concurso->getCity()->getName() : '')),
                'road' => strtolower($concurso->getRoadType()->getName() . '-' . $concurso->getConcursoAddress() . '-' . $concurso->getConcursoNumero()),*/
                'title' => $concurso->getSlug(),
                'date' => date('d-m-Y', strtotime($concurso->getCreatedAt())),
                'contribution' => $contribution[count($contribution) - 1]->getNumero()
            ));
  }
  //url for product contest
  else {
    //get product model record
    $product_record = $concurso->getProducto();
    $contribution = $concurso->getContribuciones();
    $title = $concurso->getSlug();
   
    //return url
    return url_for('product-contest-incident', array('product' => $product_record->getSlug(),
                'brand' => strtolower(str_replace(' ', '-', $product_record->getMarca() . ' ' . $product_record->getModelo())),
                'title' => $title,
                'date' => date('d-m-Y', strtotime($concurso->getCreatedAt())),
                'contribution' => $contribution[count($contribution) - 1]->getNumero()
            ));
  }
  /* return url_for(array(
    'module' => 'concurso',
    'action' => 'showIncidencia',
    'nombre' => $concurso->getProducto_or_Empresa_NameSlug(),
    'slug'   => $concurso->getSlug(),
    'date'   => $concurso->getDateTimeObject('created_at')->format('d-m-Y'),
    'time'   => $concurso->getDateTimeObject('created_at')->format('H-i-s'),
    'numero' => 1)); */
}

function url_for_plan_accion($contribucion, $is_contest = false) {
  if ($is_contest == true) {
    $concurso = $contribucion;
  } else {
    $concurso = $contribucion->getConcurso();
  }
  //url for company contest
  if ($concurso->getEmpresaId()) {
    //get contribution
    $contribution = $concurso->getContribuciones();
    //return url
    return url_for('company-contest-action-plan', array('company' => $concurso->getEmpresa()->getSlug(),
                /*'location' => strtolower(str_replace(' ', '-', $concurso->getCity()->getName())),
                'road' => strtolower($concurso->getRoadType()->getName() . '-' . $concurso->getConcursoAddress() . '-' . $concurso->getConcursoNumero()),*/
                'title' => $concurso->getSlug(),
                'date' => date('d-m-Y', strtotime($concurso->getCreatedAt())),
                'contribution' => $contribution[count($contribution) - 1]->getNumero()
            ));
  }
  //url for product contest
  else {
    //get product model record
    $product_record = $concurso->getProducto();
    $title = $concurso->getSlug();
    
    //get contribution
    $contribution = $concurso->getContribuciones();
    //return url
    return url_for('product-contest-action-plan', array('product' => $product_record->getSlug(),
                /*'brand' => strtolower(str_replace(' ', '-', $product_record->getMarca() . ' ' . $product_record->getModelo())),*/
                'title' => $title,
                'date' => date('d-m-Y', strtotime($concurso->getCreatedAt())),
                'contribution' => $contribution[count($contribution) - 1]->getNumero()
            ));
  }
  /* $concurso = $contribucion->getConcurso();
    return url_for(array(
    'module' => 'concurso',
    'action' => 'showPlanDeAccion',
    'nombre' => $concurso->getProducto_or_Empresa_NameSlug(),
    'slug'   => $concurso->getSlug(),
    'date'   => $concurso->getDateTimeObject('created_at')->format('d-m-Y'),
    'time'   => $concurso->getDateTimeObject('created_at')->format('H-i-s'),
    'numero'     => $contribucion->getNumero())); */
}

function url_for_incidencia($contribucion) {
  $concurso = $contribucion->getConcurso();
  $concurso = $contribucion->getConcurso();
  //url for company contest
  if ($concurso->getEmpresaId()) {
    //get contribution
    $contribution = $concurso->getContribuciones();
    //return url
    return url_for('company-contest-incident', array('company' => $concurso->getEmpresa()->getSlug(),
                /*'location' => strtolower(str_replace(' ', '-', $concurso->getCity()->getName())),
                'road' => strtolower($concurso->getRoadType()->getName() . '-' . $concurso->getConcursoAddress() . '-' . $concurso->getConcursoNumero()),*/
                'title' => $concurso->getSlug(),
                'date' => date('d-m-Y', strtotime($concurso->getCreatedAt())),
                'contribution' => $contribution[count($contribution) - 1]->getNumero()
            ));
  }
  //url for product contest
  else {
    //get product model record
    $product_record = $concurso->getProducto();
    $title = $concurso->getSlug();
    
    //get contribution
    $contribution = $concurso->getContribuciones();
    //return url
    return url_for('product-contest-incident', array('product' => $product_record->getSlug(),
                /*'brand' => strtolower(str_replace(' ', '-', $product_record->getMarca() . ' ' . $product_record->getModelo())),*/
                'title' => $title,
                'date' => date('d-m-Y', strtotime($concurso->getCreatedAt())),
                'contribution' => $contribution[count($contribution) - 1]->getNumero()
            ));
  }
  /* return url_for(array(
    'module' => 'concurso',
    'action' => 'showIncidencia',
    'nombre' => $concurso->getProducto_or_Empresa_NameSlug(),
    'slug' => $concurso->getSlug(),
    'date' => $concurso->getDateTimeObject('created_at')->format('d-m-Y'),
    'time' => $concurso->getDateTimeObject('created_at')->format('H-i-s'),
    'numero' => $contribucion->getNumero())); */
}

/* Truncate HTML, close opened tags, based on Søren Løvborg function at http://stackoverflow.com/a/8868742
 *
 * @param int, maxlength of the string
 * @param string, html
 * @param string, Link to be added if the html got really truncated
 * @return $html
 */

function html_truncate($maxLength, $html, $view_more_link = '', $truncate_mark = ' ... ', $maxlines = 7) {
  mb_internal_encoding("UTF-8");
  $printedLength = 0;
  $position = 0;
  $tags = array();
  $out = "";
  $chars_per_line = floor($maxLength / $maxlines);

  // to make it work properly with utf-8 chars in tag attributes you need mb_preg_match function, listed below.
  while ($printedLength < $maxLength && mb_preg_match('{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}', $html, $match, PREG_OFFSET_CAPTURE, $position)) {
    list($tag, $tagPosition) = $match[0];

    // Print text leading up to the tag.
    $str = mb_substr($html, $position, $tagPosition - $position);
    $str_len = mb_strlen($str);
    if ($printedLength + $str_len >= $maxLength) {
      $out .= mb_substr($str, 0, $maxLength - $printedLength);
      $out .= $truncate_mark . $view_more_link;
      $printedLength = $maxLength;
      break;
    }

    $out .= $str;
    $printedLength += $str_len;
    if ($tag[0] == '&') {
      // Handle the entity.
      $out .= $tag;
      $printedLength++;
    } else {
      // Handle the tag.
      $tagName = $match[1][0];
      if ($tag[1] == '/') {
        // This is a closing tag.
        $openingTag = array_pop($tags);
        assert($openingTag == $tagName); // check that tags are properly nested.
        $out .= $tag;
        if ($tagName == 'p' || $tagName == 'li') {
          $printedLength += $chars_per_line - ($printedLength % $chars_per_line);
        }
      } else if ($tag[mb_strlen($tag) - 2] == '/') {
        // Self-closing tag.
        $out .= $tag;
        if ($tagName == 'br') {
          $printedLength += $chars_per_line - ($printedLength % $chars_per_line);
        }
      } else {
        // Opening tag.
        $out .= $tag;
        $tags[] = $tagName;
        if ($tagName == 'br') {
          $printedLength += $chars_per_line - ($printedLength % $chars_per_line);
        }
      }
    }

    // Continue after the tag.
    $position = $tagPosition + mb_strlen($tag);
  }

  // Print any remaining text.
  if ($printedLength < $maxLength && $position < mb_strlen($html)) {
    $str = mb_substr($html, $position, $maxLength - $printedLength);
    $out .= $str;
    $printedLength += mb_strlen($str);
    if ($printedLength == $maxLength)
      $out .= $truncate_mark . $view_more_link;
  }

  // Close any open tags.
  while (!empty($tags))
    $out .= sprintf('</%s>', array_pop($tags));

  return $out;
}

function mb_preg_match($ps_pattern, $ps_subject, &$pa_matches, $pn_flags = 0, $pn_offset = 0, $ps_encoding = NULL) {
  // WARNING! - All this function does is to correct offsets, nothing else:
  //(code is independent of PREG_PATTER_ORDER / PREG_SET_ORDER)

  if (is_null($ps_encoding))
    $ps_encoding = mb_internal_encoding();

  $pn_offset = strlen(mb_substr($ps_subject, 0, $pn_offset, $ps_encoding));
  $ret = preg_match($ps_pattern, $ps_subject, $pa_matches, $pn_flags, $pn_offset);

  if ($ret && ($pn_flags & PREG_OFFSET_CAPTURE))
    foreach ($pa_matches as &$ha_match) {
      $ha_match[1] = mb_strlen(substr($ps_subject, 0, $ha_match[1]), $ps_encoding);
    }

  return $ret;
}
