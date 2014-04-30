<?php

namespace Pipes\Concept;

class Value
{
	protected $value;

	function __construct( $value )
	{
		$this->value = $value;
	}
	function getValue()
	{
		return $this->value;
	}
}