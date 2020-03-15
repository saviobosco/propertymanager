<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/19/18
 * Time: 10:51 AM
 */

namespace App;


use GuzzleHttp\Client;

class SMSGateWay
{
    protected $host;
    protected $url = null;
    protected $username = null;
    protected $password = null;
    protected $sender = null;
    protected $request = null;
    public $response = null;

    public function __construct()
    {
        $this->host = env('SMS_HOST');
        $this->username = env('SMS_USERNAME');
        $this->password = env('SMS_PASSWORD');
        $this->sender = env('SMS_SENDER_NAME');
    }

    public function sendMessage($phone_number, $message)
    {
        $queryParameters = [
            'email' => $this->username,
            'password' => $this->password,
            'sender_name' => $this->sender,
            'message' => $message,
            'recipients' => $phone_number,
            'forcednd' => 1
        ];
        $this->request = $queryParameters;
        return $this;
    }

    /**
     * @return bool|\Psr\Http\Message\StreamInterface
     */
    public function sendRequestToSMSServer()
    {
        $client = new Client();
        try {
            $this->response = $client->request('POST', $this->host.'/v2/app/sms', [
                'json' => $this->request,
                'verify' => false,
                'headers' => [
                    'User-Agent' => 'HTTPie/0.9.8',
                    'Accepts'     => '*/*',
                ]
            ]);
            return $this->response->getBody()->read($this->response->getBody()->getSize());
        } catch ( \Exception $exception) {
            dd($exception->getMessage());
            return false;
        }
    }

    public function checkBalance()
    {
        $queryParameters = http_build_query([
            'username' => $this->username,
            'password' => $this->password,
        ]);
        $this->request = "$this->host/tools/command.php?$queryParameters";
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
