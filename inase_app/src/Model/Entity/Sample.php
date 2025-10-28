<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Sample extends Entity
{
    // Campos accesibles para asignación masiva
    protected array $_accessible = [
        '*' => true,  // todos los campos asignables
        'uuid' => false // el UUID no se puede modificar manualmente
    ];

}
