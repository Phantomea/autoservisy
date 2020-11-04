<?php

namespace Phantomea\Autoservis\Control\Factory;

use Phantomea\Autoservis\Control\RatingControl;

interface IRatingControl
{
	public function create(): RatingControl;
}