<?php

class GcmToken extends \Eloquent {
	protected $fillable = ['id_user', 'token'];
	public $timestamps = false;
	protected $table = 'gcm_tokens';

}