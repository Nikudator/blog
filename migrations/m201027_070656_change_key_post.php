<?php

use yii\db\Migration;

/**
 * Class m201027_070656_change_key_post
 */
class m201027_070656_change_key_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->dropForeignKey(
            '{{%fk-post-author_id}}',
        );

        $this->addForeignKey(
            '{{%fk-post-author_id}}',
            '{{%post}}',
            'author_id',
            '{{%user}}',
            'id'
        );
    }


}
