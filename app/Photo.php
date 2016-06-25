<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
         * The table associated with the model.
         *
         * @var string
         */
        protected $table = 'photos';

        /**
         * Indicates if the model should be timestamped.
         *
         * @var bool
         */
        public $timestamps = false;

        
        /**
         * The attributes that should be mutated to dates.
         *
         * @var array
         */
        protected $dates = [];

        protected $guarded = array('id');
}
