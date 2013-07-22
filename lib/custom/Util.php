<?php
class Util
{
	public static function getFormat($date,$format)
	{
		$day = substr($date,8,2);
		$month = substr($date,5,2);
		$year = substr($date,0,4);

		return $week = date($format, mktime(0,0,0,$month,$day,$year));
	}
}