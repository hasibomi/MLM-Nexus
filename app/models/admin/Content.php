<?php

class Content extends Eloquent
{
    protected $fillable = array('id', 'title', 'description', 'call_name');
    
    protected $table = 'contents';
}
