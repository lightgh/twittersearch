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
			$hastag_check = mb_substr($value['q'], 0, 1);

			if($hastag_check != "#"){
				$value['q'] = '#'.$value['q'];
			}

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