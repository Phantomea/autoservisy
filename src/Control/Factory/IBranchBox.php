<?php

namespace Phantomea\Autoservis\Control\Factory;

use Phantomea\Autoservis\Control\BranchBox;

interface IBranchBox
{
	public function create(): BranchBox;
}