<?php


namespace app\models;

use app\service\TwilioSMSVerificationService;
use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $country_code;
    public $number;

    public function rules()
    {
        return [
            [['username', 'password','country_code', 'number'], 'required'],
            ['username', 'string', 'min' => 4, 'max' => 16],
        ];
    }

    public function signup()
    {
        $user = new TemporaryUser();
        $user->username = $this->username;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->country_code = $this->country_code;
        $user->number = $this->number;
        $formattedNumber = '+'.$this->country_code.$this->number;

        if ($user->save()) {
            $verificationService = new TwilioSMSVerificationService($formattedNumber);
            $verificationService->sendVerificationToken();
            $this->storeDataInSession($formattedNumber, $user);
            return true;
        }

        \Yii::error("User was not saved. ". VarDumper::dumpAsString($user->errors));
        return false;
    }

    public function storeDataInSession($phoneNumber, $user)
    {
        $session = \Yii::$app->session;
        $session->set('phoneNumber', $phoneNumber);
        $session->set('user', $user);
    }
}