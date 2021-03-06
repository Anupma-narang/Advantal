<?php

/**
 * EmpresaDestacadaTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EmpresaDestacadaTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object EmpresaDestacadaTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('EmpresaDestacada');
    }

    public function existById($id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $id)
                ->andWhere('q.localidad_id IS NULL')
                ->andWhere('q.states_id IS NULL')
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO);

        return $q->count();
    }

    public function existByIdAndLocalidad($id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $id)
                ->andWhere('q.localidad_id IS NOT NULL')
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO);

        return $q->count();
    }

    public function existByIdAndProvincia($id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $id)
                ->andWhere('q.states_id IS NOT NULL')
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO);


        return $q->count();
    }

    public function existBySectorAndProvincia($empresa_id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $empresa_id)
                ->andwhere('q.combinado = ?', Empresa::COMBINADO_PROVINCIA);

        return $q->count();
    }

    public function existBySectorAndLocalidad($empresa_id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $empresa_id)
                ->andwhere('q.combinado = ?', Empresa::COMBINADO_LOCALIDAD);

        return $q->count();
    }

    public function findByEmpresaIdAndProvincia($id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $id)
                ->andWhere('q.states_id IS NOT NULL')
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO);


        return $q->execute();
    }

    public function findByEmpresaIdAndLocalidad($id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $id)
                ->andWhere('q.localidad_id IS NOT NULL')
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO);


        return $q->execute();
    }

    public function findByEmpresaIdAndSector($id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $id)
                ->andWhere('q.localidad_id IS NULL')
                ->andWhere('q.states_id IS NULL')
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO);


        return $q->execute();
    }

    public function findByEmpresaIdAndSectorProvincia($id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $id)
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_PROVINCIA);

        return $q->execute();
    }

    public function findByEmpresaIdAndSectorLocalidad($id) {
        $q = $this->createQuery('q')
                ->where('q.empresa_id = ?', $id)
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_LOCALIDAD);

        return $q->execute();
    }

    public function countEmpresaProvincia($states_id) {
        $q = $this->createQuery('q')
                ->where('q.states_id = ?', $states_id)
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO);


        return $q->count();
    }

    public function countEmpresaLocalidad($localidad_id) {
        $q = $this->createQuery('q')
                ->where('q.localidad_id = ?', $localidad_id)
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO);

        return $q->count();
    }

    public function countEmpresaSector(Empresa $empresa) {
        $q = $this->createQuery('q');

        if ($empresa->getEmpresaSectorTres()->getId()) {
            $q->where('q.empresa_sector_tres_id = ?', $empresa->getEmpresaSectorTresId());
        } else {
            $q->where('q.empresa_sector_dos_id = ?', $empresa->getEmpresaSectorDosId());
        }
        $q->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO);

        return $q->count();
    }

    public function countEmpresaSectorProvincia(Empresa $empresa) {
        $q = $this->createQuery('q');
        $q->where('q.combinado = ?', Empresa::COMBINADO_PROVINCIA);
        if ($empresa->getEmpresaSectorTresId() != "" && $empresa->getEmpresaSectorTres() && $empresa->getEmpresaSectorTres()->getId()) {
            $q->andWhere('q.empresa_sector_tres_id = ?', $empresa->getEmpresaSectorTresId());
        } else {
            $q->andWhere('q.empresa_sector_dos_id = ?', $empresa->getEmpresaSectorDosId());
        }
        $q->andWhere('q.states_id   = ?', $empresa->getStatesId());

        return $q->count();
    }

    public function countEmpresaSectorLocalidad(Empresa $empresa) {
        $q = $this->createQuery('q');
        $q->where('q.combinado = ?', Empresa::COMBINADO_LOCALIDAD);
        if ($empresa->getEmpresaSectorTresId() != "" && $empresa->getEmpresaSectorTres() && $empresa->getEmpresaSectorTres()->getId()) {
            $q->andWhere('q.empresa_sector_tres_id = ?', $empresa->getEmpresaSectorTresId());
        } else {
            $q->andWhere('q.empresa_sector_dos_id = ?', $empresa->getEmpresaSectorDosId());
        }
        $q->andWhere('q.localidad_id  = ?', $empresa->getLocalidadId());
        return $q->count();
    }

    public function getEmpresaSector(Empresa $empresa) {
        $q = $this->createQuery('q');
        if ($empresa->getEmpresaSectorTres()->getId()) {
            $q->where('q.empresa_sector_tres_id = ?', $empresa->getEmpresaSectorTresId());
        } else {
            $q->where('q.empresa_sector_dos_id = ?', $empresa->getEmpresaSectorDosId());
        }
        $q->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO)
                ->orderBy('rank');

        return $q->execute();
    }

    public function getEmpresaSectorAndProvincia(Empresa $empresa) {
        $q = $this->createQuery('q');
        if ($empresa->getEmpresaSectorTres()->getId()) {
            $q->where('q.empresa_sector_tres_id = ?', $empresa->getEmpresaSectorTresId());
        } else {
            $q->where('q.empresa_sector_dos_id = ?', $empresa->getEmpresaSectorDosId());
        }
        $q->andwhere('q.states_id = ?', $empresa->getStatesId())
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_PROVINCIA)
                ->orderBy('rank');

        return $q->execute();
    }

    public function getEmpresaSectorAndLocalidad(Empresa $empresa) {
        $q = $this->createQuery('q');
        if ($empresa->getEmpresaSectorTres()->getId()) {
            $q->where('q.empresa_sector_tres_id = ?', $empresa->getEmpresaSectorTresId());
        } else {
            $q->where('q.empresa_sector_dos_id = ?', $empresa->getEmpresaSectorDosId());
        }
        $q->andwhere('q.localidad_id = ?', $empresa->getLocalidadId())
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_LOCALIDAD)
                ->orderBy('rank');

        return $q->execute();
    }

    public function getEmpresaProvincia($states_id) {
        $q = $this->createQuery('q')
                ->where('q.states_id = ?', $states_id)
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO)
                ->orderBy('q.rank', 'ASC');

        return $q->execute();
    }

    public function getEmpresaLocalidad($localidad_id) {
        $q = $this->createQuery('q')
                ->where('q.localidad_id = ?', $localidad_id)
                ->andWhere('q.combinado = ?', Empresa::COMBINADO_NULO)
                ->orderBy('rank');

        return $q->execute();
    }

    /**
     * A partir un array de id de empresas crear el orden.
     * @param string tipo: empresa_sector_dos, empresa_sector_tres, provincia, localidad
     * @param array $empresas
     */
    public function setOrder($tipo, $id, $empresas) {
        $tipoOptions = array('empresa_sector_dos', 'empresa_sector_tres', 'states', 'localidad', 'combinadoProvincia', 'combinadoLocalidad');
        if (!in_array($tipo, $tipoOptions)) {
            throw new sfException(sprintf('El tipo enviado (%s) no es valido', $tipo));
        }
        // 1. borra registros anteriores del orden
        foreach ($empresas as $empresa_id) {
            $q = Doctrine_Query::create()->update('EmpresaDestacada')
                    ->set('rank', 0);
            if ($tipo == 'combinadoProvincia') {
                $q->where('combinado = ?', Empresa::COMBINADO_PROVINCIA);
            } elseif ($tipo == 'combinadoLocalidad') {
                $q->where('combinado = ?', Empresa::COMBINADO_LOCALIDAD);
            } else {
                $q->where($tipo . '_id = ?', $id);
            }
            $q->andWhere('empresa_id = ?', $empresa_id);
            $q->execute();
        }
        // 2. setea nuevo orden
        $i = 1;
        foreach ($empresas as $empresa_id) {
            $q = Doctrine_Query::create()->update('EmpresaDestacada')
                    ->set('rank', $i);
            if ($tipo == 'combinadoProvincia') {
                $q->where('combinado = ?', Empresa::COMBINADO_PROVINCIA);
            } elseif ($tipo == 'combinadoLocalidad') {
                $q->where('combinado = ?', Empresa::COMBINADO_LOCALIDAD);
            } else {
                $q->where($tipo . '_id = ?', $id);
            }
            $q->andWhere('empresa_id = ?', $empresa_id);
            $q->execute();
            $i++;
        }
    }

    /**
     * return the last rank for the conditions
     * @static
     *
     */
    public static function getLastRank($empresa, $tipo) {
        /** @var Doctrine_Query $q */
        $q = self::getInstance()->createQuery('q')
                ->select('MAX(rank)');
        switch ($tipo) {
            case 'sector';
                if ($empresa->hasActividad()) {
                    $q->where('q.empresa_sector_tres_id = ?', $empresa->getEmpresaSectorTresId());
                } else {
                    $q->where('q.empresa_sector_dos_id = ?', $empresa->getEmpresaSectorDosId());
                }
                break;
            case 'provincia':
                $q->where('q.states_id = ?', $empresa->getStatesId());
                break;
            case 'localidad':
                $q->where('q.localidad_id = ?', $empresa->getLocalidadId());
                break;

            case 'sector_provincia':
                $q->where('q.combinado = ?', Empresa::COMBINADO_PROVINCIA)
                        ->andWhere('q.states_id = ?', $empresa->getStatesId());
                break;
            case 'sector_localidad':
                $q->where('q.combinado = ?', Empresa::COMBINADO_LOCALIDAD)
                        ->andWhere('q.localidad_id = ?', $empresa->getLocalidadId());
                break;
        }
        $q->limit(1);

        $rank = $q->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY_SHALLOW);
        return $rank['MAX'];
    }

}
