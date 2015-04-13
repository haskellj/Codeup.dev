<?php

	require_once 'model.php';

	class User extends Model
	{
		protected static $table = 'users';
	}

	// Test classes:
	echo User::getTableName();