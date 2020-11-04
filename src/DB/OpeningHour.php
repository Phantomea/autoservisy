<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;

/**
 * @table{"name":"autoservis_openingHour"}
 */
class OpeningHour extends Model
{
	/**
	 * @column{"name": "from_hour", "type":"timestamp"}
	 * @var \Nette\Utils\DateTime
	 */
	public $fromHour;
	
	/**
	 * @column{"name": "to_hour", "type":"timestamp"}
	 * @var \Nette\Utils\DateTime
	 */
	public $toHour;
	
	/**
	 * @column
	 * @var string
	 */
	public $other;
	
	/**
	 * @relation{"Branch": "fk_branch"}
	 * @constraint
	 * @column{"name": "fk_branch"}
	 * @var \Phantomea\Autoservis\DB\Branch
	 */
	public $branch;
	
	/**
	 * @relation{"Day": "fk_day"}
	 * @constraint
	 * @column{"name": "fk_day"}
	 * @var \Phantomea\Autoservis\DB\Day
	 */
	public $day;
	
	public function getOpeningHour(): string
	{
		if ($this->other) {
			return $this->other;
		}
		
		return $this->fromHour->format('hh:ii') .' - ' . $this->toHour->format('hh:ii');
	}
}