<?php

namespace Phantomea\Autoservis\DB;

use Storm\Model;
use Storm\Rows;

/**
 * @table{"name":"autoservis_branch"}
 */
class Branch extends Model
{
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $name;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $phone;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $address;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $owner;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $latitude;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $longitude;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $web;
	
	/**
	 * @column{"nullable": true}
	 * @var string
	 */
	public $email;
	
	/**
	 * @var int
	 * @column{"type":"int", "default":"0"}
	 */
	public $show = 0;
	
	/**
	 * @var int
	 * @column{"type":"int", "default":"0"}
	 */
	public $view = 0;
	
	/**
	 * @var int
	 * @column{"type":"int", "default":"0"}
	 */
	public $emailSend = 0;
	
	/**
	 * @var int
	 * @column{"type":"int", "default":"0"}
	 */
	public $phoneClicked = 0;
	
	/**
	 * @var bool
	 * @column{"default":"0", "locale":true}
	 */
	public $hidden = false;
	
	/**
	 * @relation{"Company": "fk_company"}
	 * @constraint
	 * @column{"name": "fk_company", "length": 255}
	 * @var \Phantomea\Autoservis\DB\Company
	 */
	public $company;
	
	/**
	 * @relation{"NxN\\BranchCarBrand":":fk_branch", "\Phantomea\Autoservis\DB\CarBrand":"fk_brand"}
	 * @var \Phantomea\Autoservis\DB\CarBrand[]
	 */
	public $carBrands;
	
	/**
	 * @relation{"BranchRating":":fk_branch"}
	 * @var \Phantomea\Autoservis\DB\BranchRating
	 */
	public $ratings;
	
	/**
	 * @relation{"BranchStatistic":":fk_branch"}
	 * @var \Phantomea\Autoservis\DB\BranchStatistic
	 */
	public $statistics;
	
	public function getCompany(): Company
	{
		return $this->company;
	}
	
	public function getAddress(): string
	{
		return $this->address ?? $this->getCompany()->address;
	}
	
	public function getPhoneNumbers()
	{
		return $this->phone ?? $this->getCompany()->getPhone();
	}
	
	public function getCompanyName(): string
	{
		return $this->getCompany()->getName();
	}
	
	public function getName(): string
	{
		return $this->name ?? $this->getClearCompanyName();
	}
	
	public function getWeb(): string
	{
		return $this->web ?? ($this->getCompany()->web ?? '');
	}
	
	private function getClearCompanyName(): string
	{
		$strings = [',', 'spol', 's.r.o.', 's. r. o.', 's r.o.'];
		$name = $this->getCompany()->getName();
		
		foreach ($strings as $string) {
			$name = \str_replace($string, '', $name);
		}
		
		return $name;
	}
	
	public function getClearPhone(): string
	{
		if ($this->phone || $this->getCompany()->getPhone()) {
			$phone = $this->phone ?? $this->getCompany()->getPhone();
			
			if (\strpos($phone, ' ') !== false) {
				$arrayOfPhones = \explode(', ', $this->phone ? $this->phone : $this->getCompany()->getPhone());
				
				return $arrayOfPhones[0];
			}
			
			return $phone;
		}
		
		return '';
	}
	
	public function getEmail(): string
	{
		return $this->email ?? $this->getCompany()->getEmail();
	}
	
	public function getEncodedAddress(): string
	{
		return \urlencode($this->getAddress());
	}
	
	public function getGoogleMapsAddresLink(): string
	{
		return 'https://maps.google.com/?q=' . $this->getEncodedAddress();
	}
	
	public function getRatingScore(): float
	{
		$communication = 0;
		$price = 0;
		$expertise = 0;
		$numberOfRatings = $this->ratings->enum();
		
		foreach ($this->ratings as $rating) {
			$communication += $rating->communication ?? 0;
			$price += $rating->price ?? 0;
			$expertise += $rating->expertise ?? 0;
		}
		
		$communication = $communication > 0 ? ($communication / $numberOfRatings) : 0;
		$price = $price > 0 ? ($price / $numberOfRatings) : 0;
		$expertise = $expertise > 0 ? ($expertise / $numberOfRatings) : 0;
		
		$score = $communication + $price + $expertise;
		
		return \round(($score > 0 ? ($score / 3) : 0), 1);
	}
	
	public function getStatisticsByType(string $type): Rows
	{
		return $this->statistics->where('type', $type);
	}
}