<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\Log\Log;

class LaboratoryAnalysisController extends AppController {

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

    public function view($sample_uuid)
    {
        $this->request->allowMethod(['get']);

        $analysis = $this->fetchTable('LaboratoryAnalysis')->find()
            ->select(['germination_power', 'purity', 'inert_materials'])
            ->where(['sample_uuid' => $sample_uuid])
            ->first();

        if (!$analysis) {
            return $this->response->withStatus(404);
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'germination_power' => $analysis->germination_power,
                'purity' => $analysis->purity,
                'inert_materials' => $analysis->inert_materials
            ]));
    }

    public function delete($sample_uuid)
    {
        $this->request->allowMethod(['delete']);
        $this->viewBuilder()->setClassName('Json');

        // Busca SOLO en la tabla LaboratoryAnalysis
        $analysis = $this->fetchTable('LaboratoryAnalysis')->find()
            ->where(['sample_uuid' => $sample_uuid])
            ->first();

        if (!$analysis) {
            return $this->response
                ->withStatus(404)
                ->withType('application/json')
                ->withStringBody(json_encode(['message' => 'Análisis no encontrado']));
        }

        // Elimina ÚNICAMENTE ese registro de LaboratoryAnalysis
        if ($this->fetchTable('LaboratoryAnalysis')->delete($analysis)) {
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['message' => 'Análisis eliminado correctamente']));
        } else {
            return $this->response
                ->withStatus(500)
                ->withType('application/json')
                ->withStringBody(json_encode(['message' => 'Error al eliminar el análisis']));
        }
    }

}
