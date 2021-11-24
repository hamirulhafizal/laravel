<?php 

    $checksum_token = 'skalhfdklasdfieo3qo21r';

    $data = [
        'transaction_amount' => '100.00',
        'status' => 'true',
        'payment_method' => 'fpx',
        'buyer_email' => 'admin@example.net',
        'buyer_name' => 'Gussie Sandorf',
        'checksum' => '78c950efbb78169ccb08e5f08f592625ebbd071ea01c65ae94be95a27f927088',
    ];

    echo "<pre>\n";

    var_dump($data);

    ksort($data);

    $billplz_arr = [];

    foreach($data as $key => $value ) {
        $billplz_arr[] = $key . $value;
    }

    $billplz_str = implode('|', $billplz_arr);

    echo "\n";
    var_dump($data);

    echo "\n";

    $securepay_checksum = $data['checksum'];
    unset($data['checksum']);

    $str = implode('|', $data);

    echo "SECUREPAY STRING: $str\n\n";
    echo "BILLPLZ STRING: $billplz_str\n\n";

    $our_checksum = hash_hmac('sha256', $str, $checksum_token);

    echo "OUR CHECKSUM: $our_checksum\n";
    echo "SECUREPAY CHECKSUM: $securepay_checksum\n";

    echo "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";

    echo "</pre>";