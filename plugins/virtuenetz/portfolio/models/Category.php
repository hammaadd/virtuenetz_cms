<?php namespace Virtuenetz\Portfolio\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'virtuenetz_portfolio_category';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsToMany = [
        'portfolios'=>[
            'Virtuenetz\Portfolio\Models\Portfolio',
            'table' => 'virtuenetz_portfolio_cat',
            'order' => 'project_name'

            ]
        ];
}
