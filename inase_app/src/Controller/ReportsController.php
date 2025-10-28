<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Log\Log;


class ReportsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
    {
        // Only renders the view.
    }

    public function data()
    {
        $this->request->allowMethod(['get']);

        try {
            $samplesTable = $this->fetchTable('Samples');

            $species = $this->request->getQuery('species');
            $startDate = $this->request->getQuery('start_date');
            $endDate = $this->request->getQuery('end_date');

            $page = (int)($this->request->getQuery('page') ?? 1);
            $limit = (int)($this->request->getQuery('limit') ?? 5);
            $offset = ($page - 1) * $limit;

            $query = $samplesTable->find()
                ->select([
                    'uuid' => 'Samples.uuid',
                    'code' => 'Samples.seal_number',
                    'company' => 'Samples.company',
                    'species' => 'Samples.species',
                    'germination_power' => 'LaboratoryAnalysis.germination_power',
                    'purity' => 'LaboratoryAnalysis.purity',
                    'inert_materials' => 'LaboratoryAnalysis.inert_materials',
                    'analysis_date' => 'LaboratoryAnalysis.analysis_date'
                ])
                ->innerJoinWith('LaboratoryAnalysis'); // <<< solo trae los que tienen análisis

            if (!empty($species)) {
                $query->where(['Samples.species LIKE' => "%$species%"]);
            }
            if (!empty($startDate)) {
                $query->where(['LaboratoryAnalysis.analysis_date >=' => $startDate]);
            }
            if (!empty($endDate)) {
                $query->where(['LaboratoryAnalysis.analysis_date <=' => $endDate]);
            }

            $total = $query->count();

            $rows = $query->limit($limit)->offset($offset)->all();

            $results = [];
            foreach ($rows as $row) {
                $results[] = [
                    'uuid' => $row->uuid,
                    'code' => $row->code,
                    'company' => $row->company,
                    'species' => $row->species,
                    'germination_power' => $row->germination_power,
                    'purity' => $row->purity,
                    'inert_materials' => $row->inert_materials,
                    'date' => $row->analysis_date,
                ];
            }

            $response = [
                'results' => $results,
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
            ];

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode(['response' => $response], JSON_UNESCAPED_UNICODE));

        } catch (\Throwable $e) {
            Log::error('Error en ReportsController::data(): ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'error' => 'Ocurrió un error al obtener los datos'
                ], JSON_UNESCAPED_UNICODE));
        }
    }

}
