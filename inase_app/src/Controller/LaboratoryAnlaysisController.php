<?php

declare(strict_types=1);

namespace App\Controller;
use Cake\Http\Exception\NotFoundException;

class LaboratoryAnlaysisController extends AppController {

    public function add()
    {
        $analysesTable = $this->fetchTable('LaboratoryAnalysis');
        $analysis = $analysesTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $analysis = $analysesTable->patchEntity($analysis, $this->request->getData());

            if ($analysesTable->save($analysis)) {
                $this->Flash->success('Análisis guardado correctamente.');
            } else {
                $this->Flash->error('No se pudo guardar el análisis.');
            }

            return $this->redirect($this->referer());
        }

        $this->set(compact('analysis'));
    }

}
