<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\Log\Log;

class LaboratoryAnalysisController extends AppController {

    public function add()
    {
        Log::debug("HOLA!");

        $analysesTable = $this->fetchTable('LaboratoryAnalysis');
        $analysis = $analysesTable->newEmptyEntity();

        $postData = $this->request->getData();
        Log::debug('POST recibido en LaboratoryAnalysis::add(): ' . json_encode($postData));

        if ($this->request->is('post')) {
            $analysis = $analysesTable->patchEntity($analysis, $this->request->getData());

            if ($analysesTable->save($analysis)) {
                $this->Flash->success('Análisis guardado correctamente.');
            } else {
                Log::debug('Errores al guardar: ' . json_encode($analysis->getErrors()));
                $this->Flash->error('No se pudo guardar el análisis.');
            }

            return $this->redirect($this->referer());
        }

        $this->set(compact('analysis'));
    }

}
