<?php

namespace App;

use Auth;
use App\Traits\Selectable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Template extends Model
{
    use SoftDeletes;
    use Selectable;

    protected $fillable = ['name','content'];

    
    public static function boot()
    {
        parent::boot();
        static::updating(function ($table) {
            $table->updated_by = Auth::user()->id;
        });
        static::creating(function ($table) {
            $table->created_by = Auth::user()->id;
            $table->updated_by = Auth::user()->id;
        });
    }

    public function scopeOwned($query){
    return $query->where('created_by',Auth::user()->id)->orderBy('id', 'asc');
}

    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }


}
