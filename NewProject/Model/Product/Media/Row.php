<?php

class Model_Product_Media_Row extends Model_Core_Table_Row
{
	protected $tableName = 'product_media';
	protected $primaryKey = 'media_id';
	protected $tableClass = 'Model_Product_Media';

	
	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE = 2;
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT = 2;

	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
		];
	}
}

?>