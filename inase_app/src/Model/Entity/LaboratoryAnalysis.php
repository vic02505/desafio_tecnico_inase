<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class LaboratoryAnalysis extends Entity
{

    protected array $_accessible = [
        '*' => true,
        'sample_uuid' => true
    ];
}
