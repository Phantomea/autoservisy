<?php

namespace Phantomea\Autoservis\DB;

use App\Web\DB\City;
use Storm\Repository;
use Storm\Rows;

class CompanyRepository extends Repository
{
	public function getBranchTotalStatistic(Company $company, string $statisticName): int
	{
		return $this->fromSql('SELECT SUM(autoservis_branch.'.$statisticName.') as amount FROM autoservis_branch')
			->join('autoservis_branch', 'autoservis_company', 'fk_company', 'uuid')
			->where('autoservis_company.uuid', $company->getPK())
			->first()
			->amount;
	}
}