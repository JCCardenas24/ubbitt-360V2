<?php

namespace app\models\utils;

/**
 * Dates format helper
 * @author Christian
 *
 */
final class DateHelper
{
	private function __construct()
	{
	}

	/**
	 * Formats a databse format date to human readable numeric date
	 * @param string $date The database date. Example: 2016-06-01
	 * @return string the human readable numeric date. Example: 01/06/2016
	 */
	public static function databaseDateToDDMMYYYY($date)
	{
		$formatedDate = '';
		if ($date != null || strlen($date) > 0) {
			/* @var $date DateTime */
			$date = \DateTime::createFromFormat("Y-m-d", substr($date, 0, 10));
			//utf8_encode encodes an ISO-8859-1 string to UTF-8
			//strftime formats a date to text
			$formatedDate = utf8_encode(strftime("%d/%m/%Y", $date->getTimestamp()));
		}
		return $formatedDate;
	}

	/**
	 * Formats a human readable date to a database format
	 * @param string $date The database date. Example: 2016-06-01
	 * @return string the human readable numeric date. Example: 01/06/2016
	 */
	public static function ddMmYyyyToDatabase($date)
	{
		$formatedDate = '';
		if ($date != null || strlen($date) > 0) {
			/* @var $date DateTime */
			$date = \DateTime::createFromFormat("d/m/Y", substr($date, 0, 10));
			//utf8_encode encodes an ISO-8859-1 string to UTF-8
			//strftime formats a date to text
			$formatedDate = utf8_encode(strftime("%Y-%m-%d", $date->getTimestamp()));
		}
		return $formatedDate;
	}
}