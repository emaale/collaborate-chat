<?php
/**
 * Written by: Emanuel Alenius
 * Description: Example of a model in the database
 */
class User extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
    protected $table = "users";
}