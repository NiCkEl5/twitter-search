<?php
use Abraham\TwitterOAuth\TwitterOAuth;

class apiTwitter
{
    public $connection;

    public function __construct() {
        try{
          $this->$connection = new TwitterOAuth
          (
              $_ENV['KEY'],
              $_ENV['API_SECRET'],
              $_ENV['ACCESS'],
              $_ENV['TKT_SECRET']
          );
          return true;
        } catch(Exception $e) {
          return false;
        }
    }

    public function getConnection(){
      return $this->$connection;
    }

    public function searchTwitter($question, $lang, $rele) {
        $res_tweet=[];
        $search_res = $this->$connection->get("search/tweets",["q" => $question, "lang" => $lang, "result_type" => $rele]);

        return $search_res;
    }
}
?>
