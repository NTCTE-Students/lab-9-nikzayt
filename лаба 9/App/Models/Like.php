<?php

namespace App\Models;

class Like extends Model {
    protected $fillable = [
        'user_id', 
        'likeable_type', 
        'likeable_id'
    ];

    protected $hidden = [
        'created_at'
    ];
    
    public function author(): User
    {
        return new User($this->getAttribute('user_id'));
    }
   
    public function getRelated(): Model|\Exception
    {
        $type = $this -> getAttribute('likeable_type');
        $id = $this -> getAttribute('likeable_id');

        return match ($type) {
            'post' => new Post($id),
            'comment' => new Comment($id),
            default => throw new \Exception("Unknown likeable type: {$type}"),
        };
    }
}