<?php

namespace Phantomea\Autoservis\DB;

use Storm\Collection;
use Storm\Repository;
use Storm\Rows;

class BranchStatisticRepository extends Repository
{
	public function getCompanyStatistics(Company $company): Rows
	{
		return $this->many()
			->join('autoservis_branchstatistic', 'autoservis_branch', 'fk_branch', 'uuid')
			->where('autoservis_branch.fk_company', $company->getPK());
	}
	
	public function getCompanyViewStatistics(Company $company): Rows
	{
		return $this->getCompanyStatistics($company)
			->where('type', BranchStatistic::TYPE['view']);
	}
	
	public function getCompanySearchStatistics(Company $company): Rows
	{
		return $this->getCompanyStatistics($company)
			->where('type', BranchStatistic::TYPE['show']);
	}
	
	public function getCompanyClickStatistics(Company $company): Rows
	{
		return $this->getCompanyStatistics($company)
			->where('type', BranchStatistic::TYPE['phoneClicked']);
	}
	
	public function getCompanyAmountStatistics(Company $company): Collection
	{
		return $this->fromSql('SELECT SUM(autoservis_branchstatistic.amount) as countAmount FROM autoservis_branchstatistic')
			->join('autoservis_branchstatistic', 'autoservis_branch', 'fk_branch', 'uuid')
			->where('autoservis_branch.fk_company', $company->getPK());
	}
}