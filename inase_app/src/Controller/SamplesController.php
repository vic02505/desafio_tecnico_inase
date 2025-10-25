<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Log\Log;


class SamplesController extends AppController
{
    public function index()
    {
        $samples = $this->fetchTable('Samples')
            ->find()
            ->contain(['LaboratoryAnalysis'])
            ->all();


        foreach ($samples as $sample) {
            Log::debug('Sample: ' . json_encode($sample->toArray()));
            $sample->has_lab_analysis = !empty($sample->laboratory_analysis);
        }

        $this->set(compact('samples'));

        $this->set('pageTitle', 'Módulo de Muestras');
    }

    public function add()
    {
        $samplesTable = $this->fetchTable('Samples');
        $sample = $samplesTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $sample = $samplesTable->patchEntity($sample, $this->request->getData());

            if ($samplesTable->save($sample)) {
                $this->Flash->success('Muestra guardada correctamente');
            } else {
                $this->Flash->error('No se pudo guardar la muestra');
            }

            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('sample'));
    }

    public function edit()
    {
        $this->request->allowMethod(['patch', 'post', 'put']);

        $uuid = $this->request->getData('uuid');
        $sample = $this->Samples->findByUuid($uuid)->first();

        if (!$sample) {
            $this->Flash->error(__('Muestra no encontrada.'));
            return $this->redirect(['action' => 'index']);
        }

        $sample = $this->Samples->patchEntity($sample, $this->request->getData());

        if ($this->Samples->save($sample)) {
            $this->Flash->success(__('La muestra fue actualizada correctamente.'));
        } else {
            $this->Flash->error(__('No se pudo actualizar la muestra.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete($uuid = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sample = $this->Samples->get($uuid);
        if ($this->Samples->delete($sample)) {
            $this->Flash->success(__('La muestra fue eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la muestra.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
