<?php
namespace TwentyTwoEstore\Libs;

interface IContentParser
{
	/**
	 * Return the format of a result
	 * @return string
	 */
	public function getContentFormat ();

	/**
	 * Parsers $input
	 * @param string $input
	 * @return array
	 */
	public function parse ($input);
}
