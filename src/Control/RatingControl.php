<?php

namespace Phantomea\Autoservis\Control;

use Phantomea\Autoservis\DB\BranchRating;
use Lqd\Modules\ControlTrait;
use Nette\Application\UI\Control;

class RatingControl extends Control
{
	use ControlTrait;
	
	public function render(BranchRating $rating): void
	{
		$template = $this->setTemplateFile();
		$template->rating = $rating;
		$template->render();
	}
}