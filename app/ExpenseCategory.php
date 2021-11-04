<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table = "expense_categories";
    public function expenses(){
        return $this->belongsTo('App\Expense');
    }
}
