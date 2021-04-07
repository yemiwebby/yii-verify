<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temporary_user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $country_code
 * @property string|null $number
 */
class TemporaryUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'temporary_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'country_code', 'number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'country_code' => 'Country Code',
            'number' => 'Number',
        ];
    }


    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }
}