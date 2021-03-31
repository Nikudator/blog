<?php

namespace app\modules\post\models;
use app\modules\post\models\Tags;
use app\modules\post\models\TagPost;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use app\modules\user\models\User;
use yii\data\Pagination;
use yii\behaviors\BlameableBehavior;

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
            //[['author_id'], 'required'],
            [['author_id', 'created_at', 'updated_at', tags], 'integer'],
            [['anons'], 'string'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
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
        return Yii::$app->formatter->asDatetime($this->created_at, 'short');
    }
    public function getUpdate()
    {
        return Yii::$app->formatter->asDatetime($this->updated_at, 'short');
    }

    /**
     * @return ActiveQuery
     */
    public function getTagPosts()
    {
        return $this->hasMany(TagPost::className(), ['post_id' => 'id']);
    }

    /**
     * Список тэгов, закреплённых за постом.
     * @var array
     */
    protected $tags = [];

    /**
     * Устанавлиает тэги поста.
     * @param $tagsId
     */
    public function setTags($tagsId)
    {
        $this->tags = (array) $tagsId;
    }

    /**
     * Возвращает массив идентификаторов тэгов.
     */
    public function getTags()
    {
        return ArrayHelper::getColumn(
            $this->getTagPost()->all(), 'tag_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        TagPost::deleteAll(['post_id' => $this->id]);
        $values = [];
        foreach ($this->tags as $id) {
            $values[] = [$this->id, $id];
        }
        self::getDb()->createCommand()
            ->batchInsert(TagPost::tableName(), ['post_id', 'tag_id'], $values)->execute();

        parent::afterSave($insert, $changedAttributes);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => 'author_id',
            ],
        ];
    }
}
