<?php

$data = file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22KRWVND%22%2C%20%22JPYVND%22%2C%22TWDVND%22%2C%22HKDVND%22%2C%22THBVND%22%2C%22SGDVND%22%2C%20%22PHPVND%22%2C%22MYRVND%22%2C%22IDRVND%22%2C%22GBPVND%22%2C%22FRFVND%22%2C%22ESPVND%22%2C%22USDVND%22%2C%22CADVND%22%2C%22AUDVND%22%2C%22WSTVND%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
$data = json_decode($data);

$rate = $data->query->results->rate;

echo '<div class="container"><div class="wrap"><div id="ticker">';
foreach( $rate as $item ) {
	echo '<span class="quote">';
	echo '<span class="currencies">' . $item->Name . '</span>';
	echo '<span class="value">' . $item->Rate . '</span>';
	echo '</span>';
}
echo '</div></div></div>';