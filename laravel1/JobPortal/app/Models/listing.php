<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listing extends Model
{
    use HasFactory;

    //To fill the data and pass it to the database we have to 
    //Use Fillable variable as normally the table is kept safe from unwanted entries
    
    protected $fillable=['title','user_id','company','email','location','website','tags','logo','description'];
    
    //OR By removing the guard that protects the database adding 
    //Model::unguard(); on the AppServiceProvider.php file inside boot method
    //The later method is more sensitive as we must be aware what is going to the database

    public function scopeFilter($query, array $filters){
        //dd($filters['jobTag']);// The filters is variable(array of filters) and I had put it as the function
        //So use the above scope filter now as requirement
        if($filters['jobTag']?? false){ //The null coalescing operator:
            //used to check whether the given variable is null or not and returns the
            // non-null value from the pair of customized values which works similar to !empty()
           $query->where('tags','like','%'.request('jobTag').'%');// The first parameter is the column in db
        }
        if($filters['search']??false){
            $query->where('title','like','%'.request('search').'%')
            ->orWhere('description','like','%'.request('search').'%')
            ->orWhere('tags','like','%'.request('search').'%');

        }
    }
    //Define a relationship with the user= it is saying that it belongs to the user
    public function user(){//R->belongsTo
        //Here the second parameter is generally id and it's okay not mentioning the
        // user id but when the second parameter is other than the user_id it must be mentioned
        //Basicaly the user id gets stored in the user_id section
        return $this->belongsTo(User::class,'id'); 
    }
}
