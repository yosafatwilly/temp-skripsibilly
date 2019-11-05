<?php
if (!function_exists('daerah')) {
  function daerah()
  {
    $arr = array(
      array(
        "tujuan" => "Kelakik",
        "ongkir" => "20000"
      ),
      array(
        "tujuan" => "Kenual",
        "ongkir" => "10000"
      ),
      array(
        "tujuan" => "Paal",
        "ongkir" => "20000"
      ),
      array(
        "tujuan" => "Sidomulyo",
        "ongkir" => "30000"
      ),
      array(
        "tujuan" => "Tanjung Niaga",
        "ongkir" => "40000"
      ),
      array(
        "tujuan" => "Tanjung Lay",
        "ongkir" => "60000"
      )
    );
    return $arr;
  }
}

if (!function_exists('checkongkir')) {
  function checkongkir($da)
  {
    $daerah = daerah();
    foreach ($daerah as $d) {
      if ($d['tujuan'] === $da) {
        return $d['ongkir'];
      }
    }
    return "";
  }
}
