<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class SamplesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('samples');

        $this->setPrimaryKey('uuid');

        $this->hasOne('LaboratoryAnalysis', [
            'foreignKey' => 'sample_uuid',
            'bindingKey' => 'uuid',
            'propertyName' => 'laboratory_analysis',
            'dependent' => true,
            'joinType' => 'LEFT'
        ]);
    }
}
