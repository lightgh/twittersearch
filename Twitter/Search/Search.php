<?php 
	namespace Twitter\Search;

	use \Twitter\Base;


	/**
	* Twitter Search Package
	*/
	class Search extends \Twitter\Base
	{
		
		public function __construct()
		{
			parent::__construct();
		}
		
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

 ?>