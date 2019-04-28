<?php
  use Abraham\TwitterOAuth\TwitterOAuth;
  $app->get('/', function ($request, $response, $args) {
       #$this->logger->addInfo($this->get('settings')['relevance']);
       return $this->view->render($response,
                                  'twitter.php',
                                  ['relevance' => $this->get('settings')['relevance'],
                                   'languages' => $this->get('settings')['languages'],
                                   'tweetSearch' => []]);

  });

  $app->post('/search', function ($request, $response, $args) {
      $twit = new apiTwitter();

      $tweets = [];
      $twit_search = $twit->searchTwitter($_POST['inputSearch'],$_POST['inputGroupSelectLan'],$_POST['inputGroupSelectRel']);

      if ( sizeof($twit_search->statuses) > 0 ) {
        foreach ($twit_search->statuses as $value){
          array_push($tweets, ["https://twitter.com/".$value->user->name."/status/".$value->id, $value->text]);
        }

        return $this->view->render($response,
                                   'twitter.php',
                                   ['relevance' => $this->get('settings')['relevance'],
                                    'languages' => $this->get('settings')['languages'],
                                    'tweetSearch' => $tweets]);
      } else {
        return $response->withRedirect('/', 204);
      }



  });

?>
