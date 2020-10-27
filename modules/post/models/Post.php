<?php

namespace app\modules\post\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use app\modules\user\models\User;
use yii\data\Pagination;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $author_id
 * @property string|null $title
 * @property string|null $body
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $author
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id']],
            [['author_id', 'created_at', 'updated_at'], 'integer'],
            [['anons'], 'string', 'required'],
            [['body'], 'string', 'required'],
            [['title'], 'string', 'max' => 255, 'required'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'title' => 'Заголовок',
            'body' => 'Текст',
            'anons' => 'Анонс',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public static function getAll($pageSize)
    {
        // build a DB query to get all articles
        $query = Post::find();

        // get the total number of articles (but do not fetch the article data yet)
        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>$pageSize]);

        // limit the query using the pagination and retrieve the articles
        $posts = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['posts'] = $posts;
        $data['pagination'] = $pagination;

        return $data;
    }

    public function savePost()
    {
        $this->user_id = Yii::$app->user->id;
        return $this->save(false);
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->created_at);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
