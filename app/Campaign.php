<?php

namespace App;
use Auth;
use App\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Campaign extends Model
{

    use SoftDeletes;
    protected $fillable = ['name','description','template_id','bunch_id'];

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

    public function bunches(){
        return $this->hasMany(Bunch::class,'id','bunch_id');
    }
    public function templates(){
        return $this->hasMany(Template::class,'id','template_id');
    }



}
