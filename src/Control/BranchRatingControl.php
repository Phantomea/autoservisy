<?php

namespace Phantomea\Autoservis\Control;

use Phantomea\Autoservis\DB\Branch;
use Lqd\Modules\ControlTrait;
use Nette\Application\UI\Control;

class BranchRatingControl extends Control
{
	use ControlTrait;
	
	public function render(Branch $branch): void
	{
		$template = $this->setTemplateFile();
		$template->selectedBranch = $branch;
		$template->render();
	}
}