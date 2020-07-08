<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 08.07.2020
     * Time: 15:42
     */

    namespace app\models;

    use Yii;
    use yii\base\Model;
    use yii\base\Security;
    use yii\base\CSecurityManager;

    class SignupForm extends Model
    {
        public $username;
        public $email;
        public $password;
        public $fio;
        public $phone;
        public $password_repeat;
        public $verifyCode;

        public function rules()
        {
            return [
                    [['username', 'email', 'password'], 'required'],
                    ['password_repeat', 'required'],
                    [
                            'password_repeat',
                            'compare',
                            'compareAttribute' => 'password',
                            'message' => "Passwords don't match"
                    ],
                    [['email'], 'email'],
                    [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],

            ];
        }

        public function attributes()
        {
            return [
                    'id',
                    'username',
                    'password',
                    'email',
            ];
        }

        /**
         * @return array customized attribute labels
         */
        public function attributeLabels()
        {
            return [
                    'verifyCode' => 'Verification Code',
            ];
        }


        public function signup()
        {
            if ($this->validate()) {
                $user = new User();
                //    $user->attributes = $this->attributes;
                $user->username = $this->username;
                $user->email = $this->email;
               // $hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
                $user->password=$this->password;
                $user->create();
                return $user;
            }
            return null;
        }

    }