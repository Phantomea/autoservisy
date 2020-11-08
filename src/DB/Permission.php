<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_permission"}
 */
class Permission extends Model
{
	/**
	 * @column
	 */
	public $resource = '';
	
	/**
	 * @column
	 */
	public $privilage = '';
	
	/**
	 * @relation{"Role":"fk_role"}
	 * @constraint
	 * @column{"name":"fk_role","nullable":true}
	 * @var \Phantomea\Autoservis\DB\Role
	 */
	public $role = null;
}