<?php namespace Hammad\Clients\Models;

use Model;

/**
 * Model
 */
class Client extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'hammad_clients_';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
