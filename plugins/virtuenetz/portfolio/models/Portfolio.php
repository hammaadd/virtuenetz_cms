<?php namespace Virtuenetz\Portfolio\Models;

use Model;

/**
 * Model
 */
class Portfolio extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'virtuenetz_portfolio_';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsToMany = [
        'categories'=>[
            'Virtuenetz\Portfolio\Models\Category',
            'table' => 'virtuenetz_portfolio_cat',
            'order' => 'category_title'

            ]
        ];
}
