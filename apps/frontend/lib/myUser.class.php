<?php

class myUser extends sfGuardSecurityUser {
    const LAST_STATE_NS = 'last_state';
    const ORDER_NS = 'order_attribute';

    public function hadVotedReferendum($contribucion) {
        if ($this->isAuthenticated()) {
            return Doctrine::getTable("ConcursoReferendum")->createQuery()
                            ->where("user_id=?", $this->getGuardUser()->getId())
                            ->andWhere("contribucion_id=?", $contribucion->id)
                            ->count() > 0;
        }
        return false;
    }

    public function hasVotedContribucion($contribucion_id) {
        if ($this->isAuthenticated()) {
            return Doctrine::getTable("ConcursoReferendum")->createQuery()
                            ->where("user_id=?", $this->getGuardUser()->getId())
                            ->andWhere("contribucion_id=?", $contribucion_id)
                            ->count() > 0;
        }
        return false;
    }

    public function canVotedConcurso($concurso_id) {
        if ($this->isAuthenticated()) {
            $query = Doctrine::getTable("Contribucion")
                    ->createQuery("a")
                    ->where("concurso_id=?", $concurso_id)
                    ->andWhere("contribucion_estado_id=?", 2)
                    ->andWhere("user_id=?", $this->getGuardUser()->getId());
            if ($query->count())
                return true;
        }

        return false;
    }

    public function canVotedContribucion($contribucion) {
        if ($this->canVotedConcurso($contribucion->Concurso->id) && ($contribucion->user_id != $this->getGuardUser()->getId()) && !$this->hadVotedReferendum($contribucion)) {
            return true;
        }

        return false;
    }

    public function getVoteContribution($contribucion) {
        $query = Doctrine::getTable("ConcursoReferendum")
                ->createQuery()
                ->where("user_id=?", $this->getGuardUser()->getId())
                ->andWhere("concurso_id=?", $contribucion->Concurso->id)
                ->andWhere("contribucion_id=?", $contribucion->id)
                ->execute();

        return $query[0];
    }

    public function updateMyRank($rank) {
        $query = Doctrine::getTable("Rank")->findOneById($rank);

        $profile = $this->getGuardUser()->getProfile();
        //ranking
        $newRank = $profile->rank + $query->value;
        $profile->setRank($newRank);

        //puntos canjeables
        $newPuntos = $profile->change_points + $query->value;
        $profile->setChange_points($newPuntos);

        $profile->save();
    }

    /*
     * devuelve la jerarquía del usuario según una serie de condiciones
     * @return Service Auditor, Service Consultant, Service Expert o Service Champion
     */

    public function getMyRankName() {
        if ($this->getGuardUser()->getProfile()->rank >= 50000) {
            return "Service Champion";
        } elseif ($this->getGuardUser()->getProfile()->rank >= 30000) {
            return "Service Expert";
        } elseif ($this->getGuardUser()->getProfile()->rank >= 10000) {
            return "Service Consultant";
        } elseif ($this->getGuardUser()->getProfile()->rank >= 2500) {
            return "Service Auditor";
        }

        return "Colaborador";
    }

    public function getConcursosActivos() {
        $query = Doctrine::getTable("Concurso")->createQuery()
                ->where("user_id=?", $this->getGuardUser()->getId())
                ->andWhere("concurso_estado_id=2");

        return $query->count();
    }

    public function getConcursosPendientes() {
        $query = Doctrine::getTable("Concurso")->createQuery()
                ->where("user_id=?", $this->getGuardUser()->getId())
                ->andWhere("concurso_estado_id=1");

        return $query->count();
    }

    /**
     * Store order preferences in session and in BD
     *
     * @param $key
     * @param $values
     */
    public function setOrderPreferences($key, $values) {
        $store = array_merge($this->getDefaultOrder($key), $values);
        if ($this->isAuthenticated()) {
            OrderPreferencesTable::setOrder($this->getGuardUser(), $key, $store);
        }
        $this->setAttribute($key, $store, self::ORDER_NS);
    }

    /**
     * Get order preferences. If stored in BD, returns it
     * @param $key
     * @return array
     */
    public function getOrderPreferences($key) {
        if (!$this->hasAttribute($key, self::ORDER_NS)) {
            if ($this->isAuthenticated()) {
                $values = OrderPreferencesTable::getOrder($this->getGuardUser(), $key);
                $ordenValues = unserialize($values['orden']);
                if (count($ordenValues) > 0) {
                    $this->setAttribute($key, $ordenValues, self::ORDER_NS);
                }
                $returnValue = $ordenValues ? $ordenValues : array();
            } else {

                $returnValue = $this->getDefaultOrder($key);
            }
        } else {
            $returnValue = $this->getAttribute($key, $this->getDefaultOrder($key), self::ORDER_NS);
        }

        return is_array($returnValue) ? $returnValue : array();
    }

    /**
     * Guarda el estado (filtros, página, buscador) para recuperarlo más tarde si hace falta, p.ej, después de auditar
     *
     * @param $order
     * @param $page
     * @param $key lb_empresas, lb_productos, ln_empresas, ln_productos
     */
    public function setLastState($key, $order, $page) {
        //pequeño parche para compensar errores de guardado en sesion anteriores
        if (!is_array($order)) {
            $order = array();
        }

        $store = array(
            'order' => array_merge($this->getDefaultOrder($key), $order),
            'page' => $page
        );
        $this->setAttribute($key, $store, self::LAST_STATE_NS);
    }

    public function isFirstCall($key) {
        if ($this->getAttribute($key)) {
            return false;
        } else {
            $this->setAttribute($key, 'YES');
            return true;
        }
    }

    /**
     * Get from the last_state attribute the key.
     * @param string $key lb_empresas, lb_productos, ln_empresas, ln_productos
     * @return mixed
     */
    public function getLastState($key, $item = null) {
        $lastState = $this->getAttribute($key, array('order' => array(), 'page' => 1), self::LAST_STATE_NS);
        if ($item) {
            return $lastState[$item];
        }

        return $lastState;
    }

    public function removeLastState() {
        $this->getAttributeHolder()->removeNamespace(self::LAST_STATE_NS);
    }

    /**
     * @param string $key lb_empresas, lb_productos, ln_empresas, ln_productos
     * @return mixed
     */
    public function hasLastState($key) {
        return $this->hasAttribute($key, self::LAST_STATE_NS);
    }

    /**
     * Activa/desactiva la acción de recuperar el estado guardado.
     *
     * @param bool $value
     */
    public function setRemember($value = true) {
        if ($value) {
            $this->setAttribute('remember_last_state', true, self::LAST_STATE_NS);
        } else {
            $this->attributeHolder->remove('remember_last_state', null, self::LAST_STATE_NS);
        }
    }

    public function hasToRemember() {
        return $this->hasAttribute('remember_last_state', self::LAST_STATE_NS);
    }

    public function getDefaultOrder($list) {
        $defaultEmpresas = array('order' => '', 'states_id' => '', 'localidad_id' => '', 'name' => '');
        $defaultProductos = array('order' => '', 'marca' => '', 'modelo' => '', 'name' => '');
        $defaultProfesionales = array('order' => '', 'states_id' => '', 'localidad_id' => '', 'name' => '', 'last_name_one' => '', 'last_name_two' => '', 'city_id' => '');
        switch ($list) {
            case 'lb_empresas':
                return $defaultEmpresas;
                break;

            case 'ln_empresas':
                return $defaultEmpresas;
                break;

            case 'lb_productos':
                return $defaultProductos;
                break;

            case 'ln_productos':
                return $defaultProductos;
                break;

            case 'lb_profesional':
                return $defaultProfesionales;
                break;
        }
    }

    /**
     * method returns hierarchy of logged in contributor
     * @return string
     */
    public function getHierarchy() {
        //if contributor is authenticated
        if ($this->isAuthenticated()) {
            //get hierarchy
            $hierarchy = $this->getGuardUser()->getProfile()->getHierarchy();
            return $hierarchy;
        }
        return '0';
    }

    /**
     *  method return money in european format
     * @param Float $money Money
     * @return String
     */
    public function getMoneyInFormat($money) {
        $poswer = 0;
        if (strpos($money, '.')) {
            $poswer = substr($money, strpos($money, '.') + 1, strlen($money));
            $poswer = str_replace('0', '', $poswer);

            $poswer = strlen($poswer);
        }
        if ($poswer) {
            return number_format($money, ($poswer == 1 ? 2 : ($poswer > 4 ? 4 : $poswer)), ',', '.');
        } else {
            return number_format($money, 0, ',', '.');
        }
    }

}
