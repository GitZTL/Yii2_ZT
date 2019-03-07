<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $timeStart
 * @property string $timeEnd
 * @property int $use_notification
 * @property int $is_blocked
 * @property int $is_repeated
 * @property string $date_created
 * @property int $user_id
 *
 * @property Users $user
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'timeStart', 'user_id'], 'required'],
            [['description'], 'string'],
            [['timeStart', 'timeEnd', 'date_created'], 'safe'],
            [['use_notification', 'is_blocked', 'is_repeated', 'user_id'], 'integer'],
            [['title'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'timeStart' => Yii::t('app', 'Time Start'),
            'timeEnd' => Yii::t('app', 'Time End'),
            'use_notification' => Yii::t('app', 'Use Notification'),
            'is_blocked' => Yii::t('app', 'Is Blocked'),
            'is_repeated' => Yii::t('app', 'Is Repeated'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}