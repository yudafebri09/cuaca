<?php 

require 'vendor/autoload.php';
use Carbon\Carbon;

#date_default_timezone_set('Asia/jakarta');

# $date = Carbon::createFromDate(2020, 2, 29);
# $date = Carbon::now();
# $date = Carbon::createFromDate(1945, 8, 17);

# printf("Tanggal berapakah sekarang? %s\n", $date->diffForHumans());
# printf("Tanggal berapakah sekarang? %s\n", $date);
# printf("Tanggal berapakah indonesia merdeka? %s\n", $date->diffForHumans());

$api = new RestClient([
    'base_url' => "https://ibnux.github.io/BMKG-importer",
    'format'   => "json"
]);

$result = $api ->get("cuaca/051320");
$data = $result->decode_response();

foreach((array) $data as $item) {
    $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                           @$item->jamCuaca);
    printf("Cuaca kota singkawang hari %s tanggal % jam % adalah % derajat celcius.\n",
          @$date->format('l'), @$date->format('d M Y'),
          @$date->format('H:i'), $item->cuaca, $item->itemC);
}