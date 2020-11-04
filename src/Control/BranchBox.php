<?php

namespace Phantomea\Autoservis\Control;

use Phantomea\Autoservis\DB\BranchRepository;
use Lqd\Modules\ControlTrait;
use Nette\Application\UI\Control;

class BranchBox extends Control
{
	use ControlTrait;
	
	/**
	 * @var Phantomea\Autoservis\BranchRepository
	 */
	private $branchRepository;
	
	public function __construct(BranchRepository $branchRepository)
	{
		$this->branchRepository = $branchRepository;
	}
	
	public function render(string $uuid, bool $premium = false, ?float $distance = null): void
	{
		$template = $this->setTemplateFile();
		$template->branch = $this->branchRepository->one($uuid);
		$template->distance = $distance;
		$template->premium = $premium;
		
		$baseUrl = $this->getPresenter()->template->baseUrl;
		$template->addFilter('svg', static function (string $iconName) use ($baseUrl): string {
			$link = $baseUrl . '/public/icons/' . $iconName;
			
			return @\file_get_contents($link);
		});
		
		$template->render();
	}
}