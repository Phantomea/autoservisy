<?php

namespace Phantomea\Autoservis\DB;

use Storm\Repository;
use Storm\Rows;

class CityRepository extends Repository
{
	public function getCitiesForHomepage(): Rows
	{
		return $this->many()->where('homepage', true)
			->orderBy(['priority'])
			->take(15);
	}
}
