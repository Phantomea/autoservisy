<?php

namespace Phantomea\Autoservis\DB;

use Nette\Utils\DateTime;
use Nette\Utils\Random;
use Storm\Repository;

class JobRepository extends Repository
{
	public function createJob(array $jobValues) : Job
	{
		$job = $this->create($jobValues);
		
		$numberOfJobs = $this->many()->where('fk_branch', $jobValues['fk_branch'])->enum();
		$job->setGeneratedNumber($numberOfJobs);
		$this->add($job);
		
		return $job;
	}
}