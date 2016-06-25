<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    /**
         * The table associated with the model.
         *
         * @var string
         */
        protected $table = 'cover';

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

        //protected $guarded = array('id');
}

