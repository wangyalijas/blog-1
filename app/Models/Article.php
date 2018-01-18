<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use App\Models\Traits\SoftDeletesAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends BaseModel
{
    use SoftDeletes, SoftDeletesAttribute;

    protected $fillable = [
        'title', 'summary', 'content', 'published_at',
    ];

    public $timestamps = [
        'published_at'
    ];

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getAttribute('title');
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->getAttribute('summary');
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getAttribute('content');
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return (int)$this->getAttribute('views');
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getPublishedAt()
    {
        return $this->getAttribute('published_at');
    }

}
