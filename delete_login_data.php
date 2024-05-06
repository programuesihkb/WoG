<?php
    header('Content-Type: application/json');

    $signed_request = $_POST['signed_request'];
    $data = parse_signed_request($signed_request);
    $user_id = $data['user_id'];

    $status_url = 'https://localhost/deletion?id=abc123'; 
    $confirmation_code = 'abc123'; 

    $data = array(
    'url' => $status_url,
    'confirmation_code' => $confirmation_code
    );
    echo json_encode($data);

    function parse_signed_request($signed_request) {
    list($encoded_sig, $payload) = explode('.', $signed_request, 2);

    $secret = "7cbbea1118b00b3910482bb25c4d367d"; 

    $sig = base64_url_decode($encoded_sig);
    $data = json_decode(base64_url_decode($payload), true);

    $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
    if ($sig !== $expected_sig) {
        error_log('Bad Signed JSON signature!');
        return null;
    }

    return $data;
}

function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}
?>