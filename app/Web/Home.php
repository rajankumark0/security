<?php

namespace App\Web;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
class Home extends Model 
{
	protected  $table = 'plans'; 
    public function planprice() {
						return $this->hasMany(PlanPrice::class, 'plan_id', 'id');
					}
}
