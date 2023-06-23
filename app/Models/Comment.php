<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

   /**
     * Sécurité : ici, on liste les variales qui sont autorisées à être rajouté dans la table post via le postController
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'tags',
        'content',
        'user_id',
        'post_id',
    ];

    // je charge automatiquement l'utilisateur, et les comments associés à chaque fois que je récupère un message ;  
    // à chaque fois que je crécupère un post, qu'il soit seul ou sur une liste,
    //   je récupère automatiquement le user qui l'a posté et les comments associé(s)
    // protected $with = ['user','post'];

    // nom de la fonction au singulier car 1 seul message en relation
    // cardinalité 1,1
    public function post(){
        return $this->belongsTo(Post::class);
    }

    // idem
    public function user(){
        return $this->belongsTo(User::class);
    }

}
