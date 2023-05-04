<?php

namespace App\CT275\Labs;

class Point2D
{
	private $x;
	private $y;

	function __construct($x = 0, $y = 0)
	{
		$this->x = $x;
		$this->y = $y;
	}

	function __toString()
	{
		return "({$this->x}, {$this->y})";
	}

	function distance(Point2D $point = new Point2D())
	{
		return sqrt(
			($this->x - $point->x) ** 2 +
				($this->y - $point->y) ** 2
		);
	}
}
