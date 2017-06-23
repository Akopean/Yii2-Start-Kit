<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\query\PageQuery;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $author_id
 * @property integer $parent_id
 * @property integer $status
 * @property string $slug
 * @property string $layout
 * @property string $title
 * @property string $content
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Page $pageParent Page parent
 * @property User $author
 */
class Page extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public $date;
    public $parent_name;

    // slug  Prefix
    protected $prefix_slug = 'page';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
      //      [['root', 'lft', 'rgt', 'level', 'title', 'content', ], 'required'],
            [['root', 'lft', 'rgt', 'level', 'author_id', 'parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            ['title', 'trim'],
            ['slug', 'unique'],
            [['slug'], 'string', 'max' => 120],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            [['layout'], 'string', 'max' => 15],
            ['author_id', 'default', 'value' => Yii::$app->user->id],
            ['date', 'date', 'format' => 'php:d.m.Y'],
            [['date'], 'safe'],
            [['title', 'meta_title', 'meta_description', 'meta_keywords'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'root' => Yii::t('app', 'Root'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'level' => Yii::t('app', 'Level'),
            'author_id' => Yii::t('app', 'Author ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app', 'Status'),
            'slug' => Yii::t('app', 'Slug'),
            'layout' => Yii::t('app', 'Layout'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => array(
                    ActiveRecord::EVENT_BEFORE_INSERT => array('created_at', 'updated_at'),
                    ActiveRecord::EVENT_BEFORE_UPDATE => array('updated_at'),
                ),
            ],
            [
                'class' => SluggableBehavior::className(),
                'slugAttribute' => 'slug',
                'attribute' => 'title',
                'immutable' => false,
                'ensureUnique' => true,
            ],
            [
                'class' => 'common\components\DateToTimeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => 'date',
                    ActiveRecord::EVENT_AFTER_FIND => 'date',
                ],
                'timeAttribute' => 'created_at'
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!preg_match("%^/page%iu", $this->slug)) {
                $this->slug = $this->prefix_slug . '/' . $this->slug;
            }
            return true;
        }
            return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return PageQuery
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }

    /**
     * Get menu parent
     * @return \yii\db\ActiveQuery
     */
    public function getPageParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }

    /**
     * @return array
     */
    public static function getPageSource()
    {
        $tableName = static::tableName();
        return (new \yii\db\Query())
          //  ->select(['id', 'name' => 'title', 'route' => 'slug', 'parent_id', 'parent_name' => 'p.name'])
            ->select(['m.id', 'name' => 'm.title', 'route' => 'm.slug', 'parent_name' => 'p.title'])
            ->from(['m' => $tableName])
            ->leftJoin(['p' => $tableName], '[[m.parent_id]]=[[p.id]]')
            ->all(static::getDb());
    }
}
