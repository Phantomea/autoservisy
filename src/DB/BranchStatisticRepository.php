<?php

namespace Phantomea\Autoservis\DB;

use Storm\Collection;
use Storm\Repository;
use Storm\Rows;

class BranchStatisticRepository extends Repository
{
	public function getCompanyStatistics(Company $company): Rows
	{
		return $this->many()->join('autoservis_branchstatistic', 'autoservis_branch', 'fk_branch', 'uuid')
			->where('autoservis_branch.fk_company', $company->getPK());
	}
	
	public function getCompanySumStatistics(Company $company): Rows
	{
		$query = "SELECT SUM(autoservis_branchstatistic.view) as view, SUM(autoservis_branchstatistic.show) as sshow, SUM(autoservis_branchstatistic.phoneClicked) as phoneClicked FROM autoservis_branchstatistic ";
		$query .= "JOIN autoservis_branch ON autoservis_branchstatistic.fk_branch = autoservis_branch.uuid ";
		$query .= "WHERE autoservis_branch.fk_company = '".$company->getPK()."'";
		
		return $this->fromSql($query);
	}
	
	public function getCompanyTodayStatistics(Company $company): BranchStatistic
	{
		$query = "SELECT SUM(autoservis_branch.view) as view, SUM(autoservis_branch.show) as sshow, SUM(autoservis_branch.phoneClicked) as phoneClicked FROM autoservis_branch ";
		$query .= "WHERE autoservis_branch.fk_company = '".$company->getPK()."'";
		
		return $this->fromSql($query)->first();
	}
}