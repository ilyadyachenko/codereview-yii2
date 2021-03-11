<?php

namespace common\services;


use yii\db\ActiveRecord;
use yii\db\Query;

abstract class BaseService
{

	abstract protected static function getEntity(): ActiveRecord;

	/**
	 * @return Query
	 */
	public static function getFindQuery(): Query
	{
		return static::getEntity()::find();
	}
	/**
	 * @return array
	 */
	public static function findAll(): array
	{
		return static::getFindQuery()->all();
	}

	/**
	 * @param int $id
	 * @return ActiveRecord|null
	 */
	public static function getById(int $id): ?ActiveRecord
	{
		return static::getEntity()::findOne(['id' => $id]);
	}
}