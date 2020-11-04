<?php

namespace Phantomea\Autoservis\DB;

use Nette\Database\Connection;
use Storm\Repository;
use Storm\Rows;
use Tracy\Debugger;

class BranchRepository extends Repository
{
	private function getRadiusSelect(float $latitude, float $longitude): string
	{
		return "ROUND(". $this->getBasicRadiusSql($latitude, $longitude).", 0) as distance ";
	}
	
	private function getNameWhereExpression(string $name)
	{
		$baseExpression = "(company_branch.name LIKE '%" . $name ."%' OR company_company.name LIKE '%". $name . "%'";
		
		$array = \explode(' ', $name);
		
		if (\count($array) > 1) {
			foreach ($array as $item) {
				$baseExpression .= " OR company_branch.name LIKE '%" . $item ."%' OR company_company.name LIKE '%". $item . "%'";
			}
		}
		
		return $baseExpression . ")";
	}
	
	public function getBranches(Connection $netteDBConnection, bool $premiumBranches, ?string $name, ?float $latitude, ?float $longitude, int $radius = 15, int $limit = 999): array
	{
		$query = "SELECT company_branch.*";
		$query .= $latitude && $longitude ? (", " . $this->getRadiusSelect($latitude, $longitude)) : "";
		$query .= " FROM company_branch ";
		$query .= $premiumBranches ? "JOIN company_branch_premium ON company_branch.uuid = company_branch_premium.fk_branch " : "";
		$query .= $name ? "JOIN company_company ON company_branch.fk_company = company_company.uuid " : "";
		$query .= $name || ($latitude && $longitude) ? "WHERE " : "";
		$query .= $name ? $this->getNameWhereExpression($name) : "";
		$query .= $latitude && $longitude ? (($name ? "AND " : "") . $this->getBasicWhereRadiusSql($latitude, $longitude) ." <= ".$radius.")) ") : "";
		$query .= $premiumBranches ? " AND (company_branch_premium.start <= NOW() AND company_branch_premium.end >= NOW()) " : "";
		$query .= "AND company_branch.hidden = 0 ";
		$query .= "GROUP BY company_branch.uuid ";
		$query .= "ORDER BY company_branch.view DESC ";
		$query .= ("LIMIT " .$limit );
		
		return $netteDBConnection->query($query)->fetchAll();
	}
	
	public function getPremiumBranchesByName(string $name): array
	{
		return $this->many()->join('company_branch', 'company_company', 'fk_company', 'uuid')
			->where('(company_branch.name LIKE "%'. $name .'%") OR (company_company.name LIKE "%'.$name.'%")')
			->join('company_branch', 'company_branch_premium', 'uuid', 'fk_branch')
			->where('company_branch_premium.start <= NOW() AND company_branch_premium.end >= NOW()')
			->groupBy(['company_branch.uuid'])->toArray();
	}
	
	public function getBranchesByName(string $name, int $limit = 0): array
	{
		$result = $this->many()->join('company_branch', 'company_company', 'fk_company', 'uuid')
			->where('(company_branch.name LIKE "%'. $name .'%") OR (company_company.name LIKE "%'.$name.'%")');
		
		return $limit ? $result->take($limit)->toArray() : $result->toArray();
	}
	
	private function getBasicRadiusSql(float $latitude, float $longitude): string
	{
		return "(6371 * acos( cos( radians(".$latitude.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$longitude.") ) + sin( radians(".$latitude.") ) * sin(radians(latitude )) ) )";
	}
	
	private function getBasicSelectRadiusSql(float $latitude, float $longitude): string
	{
		return "SELECT company_branch.uuid, ROUND(". $this->getBasicRadiusSql($latitude, $longitude).", 0) as distance FROM company_branch ";
	}
	
	private function getBasicWhereRadiusSql(float $latitude, float $longitude): string
	{
		return "(company_branch.uuid IN (SELECT uuid FROM company_branch WHERE ". $this->getBasicRadiusSql($latitude, $longitude)." ";
	}
	
	private function getBranchesInRadiusSql(float $latitude, float $longitude, int $radiusInKm): string
	{
		$query = $this->getBasicSelectRadiusSql($latitude, $longitude);
		$query .= " " . $this->getBasicWhereRadiusSql($latitude, $longitude);
		$query .= " <= ".$radiusInKm.")";
		
		return $query;
	}
	
	public function getPremiumBranchesInRadius(float $latitude, float $longitude, Connection $dbConnection, int $radiusInKm): array
	{
		$query = $this->getBasicSelectRadiusSql($latitude, $longitude);
		$query .= " JOIN company_branch_premium ON company_branch.uuid = company_branch_premium.fk_branch";
		$query .= " " . $this->getBasicWhereRadiusSql($latitude, $longitude);
		$query .= " <= ".$radiusInKm.")";
		$query .= " AND (start <= NOW() AND end >= NOW())";
		$query .= " GROUP BY company_branch.uuid ORDER BY distance ASC";
		
		return $dbConnection->query($query)->fetchAll();
	}
	
	public function getBranchesInRadius(float $latitude, float $longitude, Connection $dbConnection, int $radiusInKm, ?int $limit = null): array
	{
		$query = $this->getBranchesInRadiusSql($latitude, $longitude, $radiusInKm);
		$query .= " GROUP BY company_branch.uuid ORDER BY distance ASC";
		
		if ($limit) {
			$query .= (' LIMIT ' . $limit);
		}
		
		return $dbConnection->query($query)->fetchAll();
	}
	
	public function getBasicBranchesInRadius(float $latitude, float $longitude, Connection $dbConnection, int $radiusInKm, ?int $limit = null): array
	{
		$query = $this->getBasicSelectRadiusSql($latitude, $longitude);
		$query .= " " . $this->getBasicWhereRadiusSql($latitude, $longitude);
		$query .= " <= ".$radiusInKm.")";
		$query .= " AND company_branch.uuid NOT IN ( SELECT uuid FROM company_branch_premium WHERE (start <= NOW() AND end >= NOW()))";
		$query .= " ORDER BY distance ASC";
		
		if ($limit) {
			$query .= (' LIMIT ' . $limit);
		}
		
		
		return $dbConnection->query($query)->fetchAll();
	}
	
	public function getNearestBranchesInRadius(float $latitude, float $longitude, Connection $dbConnection, int $radiusInKm): Rows
	{
		$branches = $this->getBranchesInRadius($latitude, $longitude, $dbConnection, $radiusInKm);
		
		$branchUuids = \array_map(function ($innerArray) {
			return $innerArray['uuid'];
		}, $branches);
		
		$uuidStringArray = '"' . \implode('","', \array_values($branchUuids)) . '"';
		
		return $this->many()->where('company_branch.uuid IN (' . $uuidStringArray. ')');
	}
}