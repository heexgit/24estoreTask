<?php
namespace TwentyTwoEstore\Libs;

class CurlTransfererFacade implements ITransfererFacade
{
	private $host;

	/**
	 * Constructor
	 * @param string $host
	 * @throws ExecuteException, \RuntimeException
	 */
	public function __construct ($host)
	{
		if (!CurlTransfererFacade::isAvailable()){
			throw new \RuntimeException('libcurl library version 7.10.5 or late is required');
		}

		if (empty($host)){
			throw new ExecuteException("\$host can't be empty");
		}
		if (!filter_var($host, \FILTER_VALIDATE_URL, \FILTER_FLAG_PATH_REQUIRED)){
			throw new ExecuteException("\$host must be a valid URL");
		}

		$this->host = $host;
	}

	/**
	 * Check if libcurl library is installed
	 * @return bool
	 */
	public static function isAvailable ()
	{
		if (!function_exists('curl_version')){
			return false;
		}

		$versionInfo = curl_version();
		$versionTab = explode('.', $versionInfo['version']);

		if ($versionTab[0] < 7 || ($versionTab[0] == 7 && $versionTab[1] < 10) || ($versionTab[0] == 7 && $versionTab[1] == 10 && $versionTab[2] < 5)){
			return false;
		}
		return true;
	}

	/**
	 * Get the contect
	 * @param string $query
	 * @param \closure $validateRespnseDelegate
	 * @throws IOException
	 * @return string
	 */
	public function getResponse ($query, \closure $validateRespnseDelegate = null)
	{
		$handler = $this->openHandler($query);

		curl_setopt($handler, \CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($handler, \CURLOPT_RETURNTRANSFER, 1);

		$buffer = curl_exec($handler);
		$this->closeHandler($handler);

		if ($buffer === false){
			throw new IOException("Can't connect to '$this->host$query'");
		}
		elseif (isset($validateRespnseDelegate)){
			$validateRespnseDelegate($buffer);
		}

		return $buffer;
	}

	/**
	 * @param string $query
	 * @return resource
	 */
	private function openHandler ($query)
	{
		// Create a cURL handle
		$handler = curl_init($this->host.$query);
		return $handler;
	}

	private function closeHandler ($handler)
	{
		curl_close($handler);
	}
}
