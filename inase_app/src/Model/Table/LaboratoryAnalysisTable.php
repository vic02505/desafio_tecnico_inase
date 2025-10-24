<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class LaboratoryAnalysisTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('laboratory_analysis');

        $this->belongsTo('Samples', [
            'foreignKey' => 'sample_uuid',
            'joinType' => 'INNER',
        ]);
    }
}
