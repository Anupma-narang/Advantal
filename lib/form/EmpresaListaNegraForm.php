<?php

class EmpresaListaNegraForm extends EmpresaForm
{
    public function configure()
    {
        parent::configure();
        $this->widgetSchema['concurso_id']->setOption('query', ConcursoTable::getConcursosRechazadosQuery($this->getObject()));

    }


}
