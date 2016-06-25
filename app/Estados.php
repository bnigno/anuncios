<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    /**
         * The table associated with the model.
         *
         * @var string
         */
        protected $table = 'estados';

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
