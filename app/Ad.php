<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    /**
         * The table associated with the model.
         *
         * @var string
         */
        protected $table = 'ads';

        /**
         * Indicates if the model should be timestamped.
         *
         * @var bool
         */
        public $timestamps = true;

        
        /**
         * The attributes that should be mutated to dates.
         *
         * @var array
         */
        protected $dates = ['created_at','updated_at'];

        protected $guarded = array('id');
}
