<?php

/*
 * DateTimeI18NBehavior
 * Automatically converts date and datetime fields to I18N format
 * 
 * Author: Ricardo Grana <rickgrana@yahoo.com.br>, <ricardo.grana@pmm.am.gov.br>
 */

class DateTimeI18NBehavior  extends CActiveRecordBehavior
{
	public $dateOutcomeFormat = 'Y-m-d';
	public $dateTimeOutcomeFormat = 'Y-m-d H:i:s';

	public $dateIncomeFormat = 'yyyy-MM-dd';
	public $dateTimeIncomeFormat = 'yyyy-MM-dd hh:mm:ss';

	public function beforeSave($event){
		
		//search for date/datetime columns. Convert it to pure PHP date format
		foreach($event->sender->tableSchema->columns as $columnName => $column){
			if ($column->dbType == 'date'){
				$event->sender->$columnName = date($this->dateOutcomeFormat, CDateTimeParser::parse($event->sender->$columnName, Yii::app()->locale->dateFormat));
			}elseif ($column->dbType == 'datetime'){
				$event->sender->$columnName = date($this->dateTimeOutcomeFormat, CDateTimeParser::parse($event->sender->$columnName, Yii::app()->locale->dateFormat));
			}			
			
		}

		return true;
	}
	
	public function afterFind($event){
					
		foreach($event->sender->tableSchema->columns as $columnName => $column){
			
			
			if (!strlen($event->sender->$columnName)) continue; // if empty, ignore everyelse
			
			if ($column->dbType == 'date'){				
				$event->sender->$columnName = Yii::app()->dateFormatter->formatDateTime(
								CDateTimeParser::parse($event->sender->$columnName, $this->dateIncomeFormat),'medium',null);
			}elseif ($column->dbType == 'datetime'){
				$event->sender->$columnName = Yii::app()->dateFormatter->formatDateTime(
								CDateTimeParser::parse($event->sender->$columnName, $this->dateTimeIncomeFormat));
			}
		}
		return true;
	}
}