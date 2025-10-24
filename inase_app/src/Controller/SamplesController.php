<?php

declare(strict_types=1);

namespace App\Controller;

class SamplesController extends AppController
{
    public function index()
    {
        $samples = $this->fetchTable('Samples')
            ->find()
            ->contain(['LaboratoryAnalysis'])
            ->all();

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

}
