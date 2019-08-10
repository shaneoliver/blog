<?php

namespace App;

use App\Scopes\ArticleScope;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];
    
    protected $dates = [
        'published_at',
    ];    

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ArticleScope);
    }

    /**
     * Get the model by the slug instead of the id
     */
    public function getRouteKeyName()
    {
        return 'slug';   
    }

    /**
     * The author of the article
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Check if the article is published
     */
    public function published()
    {
        return $this->published_at !== NULL;
    }

    /**
     * Check if the article is unpublished
     */
    public function unpublished()
    {
        return $this->published_at === NULL;
    }
}
