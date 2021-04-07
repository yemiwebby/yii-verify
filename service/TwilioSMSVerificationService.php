<?php

namespace app\service;

use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class TwilioSMSVerificationService
{
    private $phoneNumber;
    private $serviceSid;
    private $twilio;

    public function __construct($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        $sid = TWILIO_ACCOUNT_SID;
        $token = TWILIO_AUTH_TOKEN;
        $this->serviceSid = TWILIO_SERVICE_SID;
        $this->twilio = new Client($sid, $token);
    }


    public function sendVerificationToken()
    {
        try {
            $this
                ->twilio
                ->verify
                ->v2
                ->services($this->serviceSid)
                ->verifications
                ->create($this->phoneNumber, 'sms');
        } catch (TwilioException $e) {
            return $e->getMessage();
        }
    }


    public function isValidToken($token)
    {
        try {
            $verificationResult =
                $this
                    ->twilio
                    ->verify
                    ->v2
                    ->services($this->serviceSid)
                    ->verificationChecks
                    ->create(
                        $token,
                        ['to' => $this->phoneNumber]
                    );
            return $verificationResult->status === 'approved';
        } catch (TwilioException $e) {
            return $e->getMessage();
        }
    }
}