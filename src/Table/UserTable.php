<?php

namespace App\Table;

use App\Models\Users;
use App\Table\Table;

class UserTable extends Table{

	protected $class = Users::class;
	protected $table = 'users';

}