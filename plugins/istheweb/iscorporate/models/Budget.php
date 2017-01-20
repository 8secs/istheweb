<?php namespace Istheweb\IsCorporate\Models;


use October\Rain\Database\Traits\Validation;

/**
 * Budget Model
 */
class Budget extends Base
{
    use Validation;

    const BUDGET_TEMPLATE_CODE = 'budget-template';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_iscorporate_budgets';

    /**
     * @var array
     */
    public $implement = [
        'Istheweb.IsCorporate.Behaviors.BudgetModel'
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'estado',
        'fecha_entrega',
        'motivo',
        'observaciones_entrega',
        'motivo_no_aceptacion',
        'options',
        'project_types'
    ];

    /**
     * @var array
     */
    public $rules = [
        'estado'        => 'required',
        'motivo'        => 'required',
        'fecha_entrega' => 'required'
    ];

    /**
     * @var array
     */
    protected $dates = ['fecha_entrega'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'client'           => 'Istheweb\IsCorporate\Models\Client'
    ];
    public $belongsToMany = [
        'options' => ['Istheweb\IsCorporate\Models\ProjectOption',
            'table' => 'istheweb_iscorporate_pivots',
        ],
        'project_types' => ['Istheweb\IsCorporate\Models\ProjectType',
            'table' => 'istheweb_iscorporate_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [
        'variants'      => ['Istheweb\IsCorporate\Models\Variant', 'name' => 'projectable']
    ];
    public $attachOne = [];
    public $attachMany = [];

    public function getEstadoOptions()
    {
        return [
            '1' => 'Solicitado',
            '2' => 'Aceptado',
            '3' => 'Rechazado',
            '4' => 'Entregado',
            '5' => 'Contactado',
            '6' => 'Low-Cost'
        ];
    }

    public function scopeInvoice($query){
        $query->where('invoice', '<>', '');
    }

}