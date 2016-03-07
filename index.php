<?php 
  require_once 'goutte-v2.0.4.phar';
  use Goutte\Client;

  $client = new Client();
  $client->getClient()->setDefaultOption('config/curl/'.CURLOPT_TIMEOUT, 30);
  $crawler = $client->request('GET', 'http://www.symfony.com/blog/');

  $file = fopen('test.csv', 'w') or die ('cant open file');

  // Get the latest post in this category and display the titles
  $headlines = $crawler->filter('h2 > a')->each(function ($node) {

    return trim((string)$node->text()); 

  });

  fputcsv($file, $headlines);


  fclose($file);

  echo "<h1>Done !</h1>";
?>

