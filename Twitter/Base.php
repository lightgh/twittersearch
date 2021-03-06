<?php

  namespace Twitter;

  use GuzzleHttp\Client;
  use GuzzleHttp\Exception\RequestExecution;
  use GuzzleHttp\Psr7\Request;

  /**
   * Class Base
   */
   class Base
   {
     const API_URL = "https://api.twitter.com/1.1";
     protected $client;
     protected $token;
     protected $tokensecret;
     protected $accesstoken;

     /**
      * no argument constructor initializes the client
      * using GuzzleHttp Client
      */
     function __construct()
     {
       $this->client = new \GuzzleHttp\Client();
     }

    /**
     * Set Token Description
     * @param [type] $token       [description]
     * @param [type] $tokensecret [description]
     */
    public function setToken($token, $tokensecret)
    {
      $this->token = $token;
      $this->tokensecret = $tokensecret;
    }

    /**
     * This method prepares Access Token
     * To Connect to Twitter 
     * @return [type] [description]
     */
    protected function prepareAccessToken()
    {
      try{
        $url = "https://api.twitter.com/oauth2/token";
        $value = ['grant_type' => "client_credentials"
            ];
            $header = array(
              'Authorization'=>'Basic ' .base64_encode($this->token.":".$this->tokensecret),
            "Content-Type"=>"application/x-www-form-urlencoded;charset=UTF-8"
          );

            $response = $this->client->post($url, ['query' => $value,'headers' => $header]);

            $result = json_decode($response->getBody()->getContents());
            $this->accesstoken = $result->access_token;
      }catch (RequestException $e){
            $response = $this->statusCodeHandling($e);
            return $response;
      }
    }

    protected function callTwitterAPIr($method, $request, $post = [])
    {
      try{
        $this->prepareAccessToken();
        $url = self::API_URL . $request;
        $header = array('Authorization'=>'Bearer '. $this->accesstoken);
        // var_dump($url, $request, $post);
        // die("STIO");
        $response = $this->client->request($method, $url, array('query'=> $post, 'headers'=>$header));
        return json_decode($response->getBody()->getContents());
      }catch(RequestException $e){
        $response = $this->statusCodeHandling($e);
        return $response;
      }
    }

    protected function statusCodeHandling($e)
    {
        $response = array("statuscode" => $e->getResponse()->getStatusCode(),
        "error" => json_decode($e->getResponse()->getBody(true)->getContents()));

        return $response;
    }

   }

   // $base = new Base();

?>
