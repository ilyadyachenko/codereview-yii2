<?php

use yii\db\Migration;

/**
 * Class m210310_050554_add_request_transportation_voyage__table
 */
class m210310_050554_create_request_transportation_voyage__table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {

	    $tableOption = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

	    $this->createTable('request', [
		    'id' => $this->primaryKey(),
		    'sender' => $this->string(255)->notNull(),
		    'tariff' => $this->string(255)->notNull(),
		    'distance' => $this->integer()->notNull(),
		    'address_load' => $this->text()->null(),
		    'address_unload' => $this->text()->null(),
	    ], $tableOption);

	    $this->createTable('transportation', [
		    'id' => $this->primaryKey(),
		    'request_id' => $this->integer()->notNull(),
		    'transporter_id' => $this->integer()->notNull(),
		    'weight' => $this->float()->notNull(),
	    ], $tableOption);

	    $this->createTable('transporter', [
		    'id' => $this->primaryKey(),
		    'name' => $this->string(255)->notNull(),
	    ], $tableOption);

	    $this->createTable('voyage', [
		    'id' => $this->primaryKey(),
		    'transportation_id' => $this->integer()->notNull(),
		    'weight' => $this->float()->notNull(),
		    'date_load' => $this->dateTime()->null(),
		    'date_unload' => $this->dateTime()->null(),
		    'phone' => $this->string(15)->notNull(),
	    ], $tableOption);

	    $this->createIndex(
		    'idx-transportation-transporter_id',
		    'transportation',
		    'transporter_id'
	    );

	    $this->createIndex(
		    'idx-transportation-request_id',
		    'transportation',
		    'request_id'
	    );

	    $this->addForeignKey(
		    'fk-transportation-request_id',
		    'transportation',
		    'request_id',
		    'request',
		    'id',
		    'CASCADE'
	    );

	    $this->addForeignKey(
		    'fk-transportation-transporter_id',
		    'transportation',
		    'transporter_id',
		    'transporter',
		    'id',
		    'CASCADE'
	    );

	    $this->addForeignKey(
		    'fk-voyage-transportation_id',
		    'voyage',
		    'transportation_id',
		    'transportation',
		    'id',
		    'CASCADE'
	    );

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
	    $this->dropForeignKey(
		    'fk-transportation-request_id',
		    'transportation'
	    );

	    $this->dropForeignKey(
		    'fk-transportation-transporter_id',
		    'transportation'
	    );

	    $this->dropForeignKey(
		    'fk-voyage-transportation_id',
		    'voyage'
	    );

	    $this->dropTable('request');
	    $this->dropTable('transportation');
	    $this->dropTable('transporter');
	    $this->dropTable('voyage');

        return true;
    }

}
