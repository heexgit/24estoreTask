<?php
namespace TwentyTwoEstore\Libs;

class View
{
	/**
	 * @var string
	 */
	private $fileName;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var mixed[]
	 */
	private $data;

	public function __construct ($fileName)
	{
		$this->fileName($fileName);
	}

	/**
	 * Set or Get the View fileName
	 * @param string $value
	 * @return string
	 * @throws ExecuteException
	 */
	public function fileName ($value = null)
	{
		if (!empty($value)) {
			if (!is_string($value)){
				throw new ExecuteException("\$value has to be string; provided type: ".gettype($value));
			}
			$this->fileName = $value;
		}
		return $this->fileName;
	}

	/**
	 * Set or Get the View title
	 * @param string $value
	 * @return string
	 * @throws ExecuteException
	 */
	public function title ($value = null)
	{
		if (!empty($value)) {
			if (!is_string($value)){
				throw new ExecuteException("\$value has to be string; provided type: ".gettype($value));
			}
			$this->title = $value;
		}
		return $this->title;
	}

	/**
	 * Set view data
	 * @param string $property
	 * @param mixed $value
	 */
	public function __set ($property, $value)
	{
		$this->data[$property] = $value;
	}

	/**
	 * Get view data
	 * @param string $dataName
	 */
	public function __get ($dataName)
	{
		if ($this->__isset($dataName)) {
			return $this->data[$dataName];
		}
		return null;
	}

	/**
	 * Check if view data exists
	 * @param string $dataName
	 */
	public function __isset ($dataName)
	{
		return isset($this->data[$dataName]);
	}

	/**
	 * Unset view data
	 * @param string $dataName
	 */
	public function __unset ($dataName)
	{
		unset($this->data[$dataName]);
	}
}
