<?php

namespace Phantomea\Autoservis\DB\NxN;

use Storm\Model;

/**
 * @table{"name":"autoservis_nxn_branch_carBrand"}
 */
class BranchCarBrand extends Model
{
	/**
	 * @var \Phantomea\Autoservis\DB\Branch
	 * @relation{"\\Phantomea\\Autoservis\\DB\\Branch": "fk_company"}
	 * @constraint
	 * @column{"name": "fk_company"}
	 */
	public $branch;
	
	/**
	 * @var \Phantomea\Autoservis\DB\CarBrand
	 * @relation{"\\Phantomea\\Autoservis\\DB\\CarBrand": "fk_carBrand"}
	 * @constraint
	 * @column{"name": "fk_carBrand"}
	 */
	public $brand;
}