<?php 
	namespace Twitter\Search;


	/**
	* Twitter Search Package
	*/
	class Search extends \Twitter\Base
	{
		
		function __construct(argument)
		{
			public function search($value)
			{
				try {
					$url = "/search/tweets.json";
					$response = $this->callTwitterAPIr("get", $url, $value);
					return $response;
				} catch (RequestException $e) {
					$response = $this->statusCodeHandling($e);
					return $response;
				}
			}
		}
	}
	
 ?>