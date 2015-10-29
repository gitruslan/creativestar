<?php

namespace model\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            // todo delete
            //['verifyCode', 'captcha']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('frontend', 'Your Name:*'),
            'email' => Yii::t('frontend', 'Email address:*'),
            'subject' => Yii::t('frontend', 'Subject:'),
            'body' => Yii::t('frontend', 'Message:'),
            'verifyCode' => Yii::t('frontend', 'Verification Code')
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            return Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(Yii::$app->params['robotEmail'])
                // ->setReplyTo([$this->email => $this->name])// todo temporary disabled
                ->setSubject($this->subject)
                ->setTextBody($this->_prepareTextBody())
                ->send();
        } else {
            return false;
        }
    }

    /**
     * Prepare text body
     * @return string
     */
    protected function _prepareTextBody()
    {
        return "Massage from : ".$this->name."(".$this->email.")\n\nText:\n".$this->body;
    }
}
