<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    function user(){
        return $this->belongsToMany(
        	'App\User', 'users_docs', 
        	'doc_id', 'user_id');
    }

    function reqt(){
        return $this->belongsToMany(
        	'App\Doc', 'docs_reqts', 
        	'doc_id', 'reqt_id');
    }
}