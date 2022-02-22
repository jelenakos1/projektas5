<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = ['id', 'name', 'surname', 'category_id' ];

    public function categoryPost() {
        return $this->belongsTo(Post::class, 'category_id', 'id');
}
}