<?php

namespace App;
use Auth;
use App\Traits\Selectable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Bunch extends Model
{
    use SoftDeletes;
    use Selectable;
    protected $fillable = ['name','description'];

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

    public function scopeOwned1($query){
        return $query->where('created_by',Auth::user()->id)->orderBy('id', 'asc');
    }

    public function subscribers(){
        return $this->hasMany(Subscriber::class);
    }

    public function campaign1(){
        return $this->belongsTo(Campaign::class);
    }
}
