<?php

namespace Gdv\Livedebug;

use Kint\Kint;
use Kint\Parser\BlacklistPlugin;

class LD
{

  public static string $protocol = 'http';
  public static string $host = 'livedebug';
  public static int $port = 3030;
  public static int $depth_limit = 3;

  public static function dump(...$vars): void
  {
    try {
      if(count($vars) === 1){
        $vars = $vars[0];
      }
      Kint::$mode_default_cli = Kint::$mode_default;
      Kint::$depth_limit = self::$depth_limit;
      Kint::$return = true;
      BlacklistPlugin::$shallow_blacklist[] = 'Psr\Container\ContainerInterface';
      $html = \Kint::dump($vars);

      self::output($html);
    } catch (\Throwable $e) {
    }
  }

  public static function output($string): void
  {
    try {

      $html = (string)$string;

      $url = self::$protocol . "://" . self::$host . ":" . self::$port . "/update";

      $options = [
        'http' => [
          'header' => "Content-type: text/plain\r\n",
          'method' => 'POST',
          'content' => $html
        ],
      ];

      $context = stream_context_create($options);
      file_get_contents($url, false, $context);

    } catch (\Throwable $e) {
    }
  }
}
