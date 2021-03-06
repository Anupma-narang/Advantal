<?php

/**
 * ProfesionalTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProfesionalTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object ProfesionalTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Profesional');
    }

    /**
     * Devuelve la query con la lista de profesional
     *
     * @param string $sector1
     * @param string $sector2
     * @param string $sector3
     * @return Doctrine_Query
     */
    public function getListaQuery($sector1 = null, $sector2 = null, $sector3 = null, Doctrine_Collection $profesionalDestacadas = null) {
        $q = $this->createQuery('q');

        if ($sector1 && is_string($sector1)) {
            $q->leftJoin('q.ProfesionalTipoUno s1')
                    ->andWhere('s1.slug = ?', $sector1);
        }
        if ($sector2 && is_string($sector2)) {
            $q->leftJoin('q.ProfesionalTipoDos s2')
                    ->andWhere('s2.slug = ?', $sector2);
        }

        if ($sector3 && is_string($sector3)) {
            $q->leftJoin('q.ProfesionalTipoTres s3')
                    ->andWhere('s3.slug = ?', $sector3);
        }

        if (!is_null($profesionalDestacadas)) {
            $ids = array();
            foreach ($profesionalDestacadas as $profesional) {
                $ids[] = $profesional->getId();
            }

            $q->andWhereNotIn('q.id', $ids);
        }

        return $q;
    }

    /**
     * Devuelve la lista de profesional.
     *
     */
    public function getListaProfesionalQuery($sector1 = false, $sector2 = false, $sector3 = false, Doctrine_Collection $profesionalDestacadas = null) {
        return $this->getListaQuery($sector1, $sector2, $sector3, $profesionalDestacadas);
    }

    public function getAutocompleteDireccion($q, $limit = 10) {
        return $this->createQuery('q')
                        ->select('q.id, q.address')
                        ->where("address LIKE '%{$q}%' ")
                        ->limit($limit)
                        ->fetchArray();
    }

    public function getAutocompleteName($q, $limit = 10) {
        return $this->createQuery('q')
                        ->select('q.id, q.first_name')
                        ->where("first_name LIKE '%{$q}%' ")
                        ->limit($limit)
                        ->fetchArray();
    }

    /**
     * Devuelve las profesionales destacadas según el sector, localidad o provincia
     *
     * @return Doctrine_Collection
     */
    public function getListaDestacados(array $options) {
        $q = Doctrine_Query::create()->from('Profesional e')
                ->innerJoin('e.ProfesionalDestacada ed')
                ->orderBy('ed.rank ASC');
        $filter = false;
//print_r($options);
        $include_filter = true;
        if ($include_filter &&  (!empty($options['name']) && !empty($options['localidad'])) || (!empty($options['name']) && !empty($options['states_id'])) ) {
            $filterName = false;
            $q->where('e.first_name LIKE ?', '%' . $options['name'] . '%');

            if(isset($options['last_name_one']) && !empty($options['last_name_one'])){
                $q->andWhere('e.last_name_one LIKE ?', '%' . $options['last_name_one'] . '%');
            }
            if(isset($options['last_name_two']) && !empty($options['last_name_two'])){
                $q->andWhere('e.last_name_two LIKE ?', '%' . $options['last_name_two'] . '%');
            }

            if (!empty($options['sector3'])) {
                $q->leftJoin('ed.ProfesionalTipoTres s3')
                        ->andWhere('s3.slug = ?', $options['sector3']);
                $filterName = true;
            } elseif (!empty($options['sector2'])) {
                $q->leftJoin('ed.ProfesionalTipoDos s2')
                        ->andWhere('s2.slug = ?', $options['sector2']);
                $filterName = true;
            } elseif (!empty($options['sector1'])) {
                return new Doctrine_Collection('ProfesionalDestacada');
            }

            if (!empty($options['localidad'])) {
                $q->andWhere('ed.city_id = ?', $options['localidad']);
                if ($filterName) {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_LOCALIDAD);
                } else {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
                }
            } elseif (!empty($options['states_id'])) {
                $q->andWhere('ed.states_id = ?', $options['states_id']);
                if ($filterName) {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_PROVINCIA);
                } else {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
                }
            }
            //al buscar por nombre ordena alfabéticamente...
            $q->orderBy('e.first_name ASC');
            //echo $q->getSqlQuery();
            return $q->execute();
        }

        if ($include_filter &&  (!empty($options['last_name_one']) && !empty($options['localidad'])) || (!empty($options['last_name_one']) && !empty($options['states_id'])) ) {
            $filterName = false;
            if(isset($options['last_name_one']) && !empty($options['last_name_one'])){
                $q->andWhere('e.last_name_one LIKE ?', '%' . $options['last_name_one'] . '%');
            }
            if(isset($options['last_name_two']) && !empty($options['last_name_two'])){
                $q->andWhere('e.last_name_two LIKE ?', '%' . $options['last_name_two'] . '%');
            }

            if (!empty($options['sector3'])) {
                $q->leftJoin('ed.ProfesionalTipoTres s3')
                        ->andWhere('s3.slug = ?', $options['sector3']);
                $filterName = true;
            } elseif (!empty($options['sector2'])) {
                $q->leftJoin('ed.ProfesionalTipoDos s2')
                        ->andWhere('s2.slug = ?', $options['sector2']);
                $filterName = true;
            } elseif (!empty($options['sector1'])) {
                return new Doctrine_Collection('ProfesionalDestacada');
            }

            if (!empty($options['localidad'])) {
                $q->andWhere('ed.city_id = ?', $options['localidad']);
                if ($filterName) {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_LOCALIDAD);
                } else {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
                }
            } elseif (!empty($options['states_id'])) {
                $q->andWhere('ed.states_id = ?', $options['states_id']);
                if ($filterName) {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_PROVINCIA);
                } else {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
                }
            }
            //al buscar por nombre ordena alfabéticamente...
            $q->orderBy('e.first_name ASC');
            //echo $q->getSqlQuery();
            return $q->execute();
        }

        if ($include_filter &&  (!empty($options['last_name_two']) && !empty($options['localidad'])) || (!empty($options['last_name_two']) && !empty($options['states_id'])) ) {
            $filterName = false;
            if(isset($options['last_name_one']) && !empty($options['last_name_one'])){
                $q->andWhere('e.last_name_one LIKE ?', '%' . $options['last_name_one'] . '%');
            }
            if(isset($options['last_name_two']) && !empty($options['last_name_two'])){
                $q->andWhere('e.last_name_two LIKE ?', '%' . $options['last_name_two'] . '%');
            }

            if (!empty($options['sector3'])) {
                $q->leftJoin('ed.ProfesionalTipoTres s3')
                        ->andWhere('s3.slug = ?', $options['sector3']);
                $filterName = true;
            } elseif (!empty($options['sector2'])) {
                $q->leftJoin('ed.ProfesionalTipoDos s2')
                        ->andWhere('s2.slug = ?', $options['sector2']);
                $filterName = true;
            } elseif (!empty($options['sector1'])) {
                return new Doctrine_Collection('ProfesionalDestacada');
            }

            if (!empty($options['localidad'])) {
                $q->andWhere('ed.city_id = ?', $options['localidad']);
                if ($filterName) {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_LOCALIDAD);
                } else {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
                }
            } elseif (!empty($options['states_id'])) {
                $q->andWhere('ed.states_id = ?', $options['states_id']);
                if ($filterName) {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_PROVINCIA);
                } else {
                    $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
                }
            }
            //al buscar por nombre ordena alfabéticamente...
            $q->orderBy('e.first_name ASC');
            //echo $q->getSqlQuery();
            return $q->execute();
        }

        if (!empty($options['sector3'])) {
            $q->leftJoin('ed.ProfesionalTipoTres s3')
                    ->andWhere('s3.slug = ?', $options['sector3']);
            $filter = true;
        } elseif (!empty($options['sector2'])) {
            $q->leftJoin('ed.ProfesionalTipoDos s2')
                    ->andWhere('s2.slug = ?', $options['sector2']);

            $filter = true;
        } elseif (!empty($options['sector1'])) {
            $filter = true;
        }



        // si se filtra por sector, no se filtra destacados por nada más, sinó que se filtran los resultados de ese sector destacado
        if ($filter) {
            if (!empty($options['sector1']) && empty($options['sector2'])) {
                return new Doctrine_Collection('ProfesionalDestacada');
            }
            if (!empty($options['localidad'])) {
                $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_LOCALIDAD)
                        ->andWhere('ed.city_id = ?', $options['localidad']);
            } elseif (!empty($options['states_id'])) {
                $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_PROVINCIA)
                        ->andWhere('ed.states_id = ?', $options['states_id']);
            } else {
                $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
            }


            return $q->execute();
        }

        //si no se filtra por sector, filtramos por localidad o provincia en destacados
        if ($options['order'] == 'localidad') {
            //casos especiales Ceuta, Melilla y Toda España
            if ($options['states_id'] == 16 || $options['states_id'] == 35 || $options['states_id'] == 1) {
                $q->andWhere('ed.states_id = ?', $options['states_id'])
                        ->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
                return $q->execute();
            }
        }

        if ($options['localidad'] != '') {
             //echo $options['localidad']; exit;
            $q->andWhere('ed.city_id = ?', $options['localidad'])
                    ->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
            return $q->execute();
        } elseif (!empty($options['provincia']) && $options['localidad'] == '') {
            $q->andWhere('ed.states_id = ?', $options['provincia'])
                    ->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
            return $q->execute();
        }

        return new Doctrine_Collection('ProfesionalDestacada');







        //  if (!empty($options['name'])) {
        //      $filterName = false;
        //      $q->where('e.first_name LIKE ?', '%' . $options['name'] . '%');
        /*            if (!empty($options['sector3'])) {
          $q->leftJoin('ed.ProfesionalTipoTres s3')
          ->andWhere('s3.slug = ?', $options['sector3']);
          $filterName = true;
          } *//* elseif (!empty($options['sector2'])) {
          $q->leftJoin('ed.ProfesionalTipoDos s2')
          ->andWhere('s2.slug = ?', $options['sector2']);
          $filterName = true;
          }

          if (!empty($options['localidad'])) {
          $q->andWhere('ed.city_id = ?', $options['localidad']);
          if ($filterName) {
          $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_LOCALIDAD);
          }

          } elseif (!empty($options['provincia'])) {
          $q->andWhere('ed.states_id = ?', $options['provincia']);
          if ($filterName) {
          $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_PROVINCIA);
          }
          } */
        //return $q->execute();
        //  }

        /*  if (!empty($options['sector3']) && !empty($options['localidad'])) {
          $q->leftJoin('ed.ProfesionalTipoTres s3')
          ->andWhere('s3.slug = ?', $options['sector3'])
          ->andWhere('ed.city_id = ?', $options['localidad'])
          ->andWhere('ed.combinado = ?', Profesional::COMBINADO_LOCALIDAD);
          return $q->execute();
          } else if (!empty($options['sector3']) && !empty($options['provincia']) && empty($options['localidad'])) {
          $q->leftJoin('ed.ProfesionalTipoTres s3')
          ->andWhere('s3.slug = ?', $options['sector3'])
          ->andWhere('ed.states_id = ?', $options['provincia'])
          ->andWhere('ed.combinado = ?', Profesional::COMBINADO_PROVINCIA);
          $filter = true;
          return $q->execute();
          } else if (empty($options['sector3']) && !empty($options['provincia']) && !empty($options['localidad'])) {
          $q->andWhere('ed.city_id = ?', $options['localidad'])
          ->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
          $filter = true;
          return $q->execute();
          } else if (empty($options['sector3']) && empty($options['localidad']) && !empty($options['provincia'])) {
          $q->andWhere('ed.states_id = ?', $options['provincia'])->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
          $filter = true;
          return $q->execute();
          } else if (!empty($options['sector3']) && empty($options['localidad']) && empty($options['provincia'])) {
          $q->leftJoin('ed.ProfesionalTipoTres s3')
          ->andWhere('s3.slug = ?', $options['sector3'])
          ->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
          $filter = true;
          return $q->execute();
          } */

//echo "<prE>";print_r($options);exit;
//         elseif (!empty($options['sector2'])) {
//             $q->leftJoin('ed.ProfesionalTipoDos s2')
//                 ->andWhere('s2.slug = ?', $options['sector2']);
//
//             $filter = true;
//
//         } elseif (!empty($options['sector1'])) {
//             $filter = true;
//         }
//         // si se filtra por sector, no se filtra destacados por nada más, sinó que se filtran los resultados de ese sector destacado
//         if ($filter) {
//             if (!empty($options['sector1']) && empty($options['sector2'])) {
//                 return new Doctrine_Collection('ProfesionalDestacada');
//             }
//             if (!empty($options['localidad'])) {
//                 $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_LOCALIDAD)
//                     ->andWhere('ed.city_id = ?', $options['localidad']);
//
//             } elseif (!empty($options['provincia'])) {
//                 $q->andWhere('ed.combinado = ?', Profesional::COMBINADO_PROVINCIA)
//                     ->andWhere('ed.states_id = ?', $options['provincia']);
//             }
//
//             return $q->execute();
//         }
//
//         //si no se filtra por sector, filtramos por localidad o provincia en destacados
//         if ($options['order'] == 'localidad') {
//             $q->andWhere('ed.city_id = ?', $options['localidad'])
//                 ->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
//             return $q->execute();
//
//         } elseif (!empty($options['provincia'])) {
//             $q->andWhere('ed.states_id = ?', $options['provincia'])
//                 ->andWhere('ed.combinado = ?', Profesional::COMBINADO_NULO);
//
//             return $q->execute();
//         }
        //return new Doctrine_Collection('ProfesionalDestacada');
    }

    /**
     * Function for ordering in listitng page of 'Actividade profesionals'
     * @static
     * @param $query
     */
    public static function doSelectJoinForListing($query) {
        return $query->select('r.*, ptu.name, ptd.name, c.name, s.name, sf.username')
                        ->leftJoin('r.ProfesionalTipoUno ptu')
                        ->leftJoin('r.ProfesionalTipoDos ptd')
                        ->leftJoin('r.ProfesionalTipoTres ptt')
                        ->leftJoin('r.User sf')
                        ->leftJoin('r.City c')->leftJoin('r.States s');
    }

    public function sendContactMail($thisObj) {
        $user = Doctrine::getTable("sfGuardUser")->findOneById($thisObj->form->getValue("user_id"));
        $profesional = Doctrine::getTable("Profesional")->findOneById($thisObj->form->getValue("profesional_id"));
        $to = array($user->email_address);
        $from = sfConfig::get('app_default_mailfrom');
        $subject = $thisObj->form->getValue("subject");
        $body = $thisObj->form->getValue("body");
        self::sendMail($to, $from, $subject, $body, $thisObj);
        $thisObj->getUser()->setFlash('notice', 'Se ha enviado el correo electrónico a la/el usuaria/o ' . $thisObj->username);
        return $profesional;
    }

    public static function sendMail($to, $from, $subject, $body, $thisObj) {
        $mensaje = Swift_Message::newInstance();
        $mensaje->setFrom($from);
        $mensaje->setTo($to);
        $mensaje->setSubject($subject);
        $mensaje->setBody($body, 'text/html');

        $mensaje->setBody($body);

        $thisObj->getMailer()->send($mensaje);
    }

    public function getLetters($id, $type) {
        $query = Doctrine::getTable("ProfesionalLetter")->createQuery('q')->where('q.profesional_id=?', $id)->andWhere("q.profesional_letter_type_id=?", $type)->andWhere('q.profesional_letter_estado_id = ?', 2)->execute();

        if ($query->count())
            return true;
        else
            return false;
    }

    public function getLettersCount($id, $type) {
        $query = Doctrine::getTable("ProfesionalLetter")->createQuery('q')->where('q.profesional_id=?', $id)->andWhere("q.profesional_letter_type_id=?", $type)->andWhere('q.profesional_letter_estado_id = ?', 2)->execute();
        return $query->count();
    }

    /**
     * fetch query object for draft contest created by given user
     * @param String $user_id User id
     * @param Array $contest_status_array Contest Status Array records
     * @return Doctrine_Query object
     */
    public function getDraftProfesional($user_id, $profesional_status_array) {
        //create draft contest query
        $draft_query = Doctrine_Query::create()
                ->from('Profesional p')
                ->leftJoin('p.ProfesionalEstado pe')
                ->where('p.user_id =?', $user_id)
                ->andWhereIn('pe.name', $profesional_status_array)
                ->orderBy('p.created_at DESC');
        //return draft contest query
        return $draft_query;
    }

    /**
     * Fetch the profesional featured limit
     * It will help Admin to publish profesional on home page
     * if profesional featured limit is not more than 10
     * @param $list_type List Type
     * @return Array
     */
    public function getFeatreudLimit($list_type = 'lb') {
        //create profesional featured limit query
        $profesional_feature_limit_query = Doctrine_Query::create()
                ->select('COUNT(p.id) profesional_limit')
                ->from('Profesional p')
                ->where('p.featured = 1');
        //fetch limit
        return $profesional_feature_limit_query->fetchArray();
    }

    /**
     * Fetch user's professional record query for given user id
     * @param String $user_id  User Id
     * @return Doctrine_Query
     */
    public function getMyProfessionalListQuery($user_id) {
        //create professional list query
        $professional_list_query = Doctrine_Query::create()
                ->from('Profesional p')
                ->where('p.user_id =?', $user_id)
                //following codition could be wrong beacuse in exsiting code for professional
                //beacuse this value is set statically
                ->andWhere('p.profesional_estado_id = 2');
        return $professional_list_query;
    }

    /**
     * Fetch user's professional record query for recommended or disapproved letter
     * @param String $user_id User Id
     * @param String $letter_type Letter Type
     * @return Doctrine_Query
     */
    public function getProfessionalLettersQuery($user_id, $letter_type) {
        //create professional list query
        $professional_list_query = Doctrine_Query::create()
                ->select('p.*, pl.description description')
                ->from('Profesional p')
                ->leftJoin('p.ProfesionalLetter pl')
                ->where('pl.user_id =?', $user_id)
                //following codition could be wrong beacuse in exsiting code for professional
                //beacuse this value is set statically
                ->andWhere('pl.profesional_letter_estado_id =?', $letter_type)
                ->andWhere('p.profesional_estado_id = 2');
        return $professional_list_query;
    }

    /**
     * Fetch featured professionals records
     * @return Doctrine Records
     */
    public function getFeaturedProfessionalList() {
        //create professional list query
        $professional_list_query = Doctrine_Query::create()
                ->from('Profesional p')
                ->where('p.featured = 1')
                ->orderBy('p.featured_order ASC, p.created_at DESC');
        $professional_list_records = $professional_list_query->execute();
        return $professional_list_records;
    }

}
