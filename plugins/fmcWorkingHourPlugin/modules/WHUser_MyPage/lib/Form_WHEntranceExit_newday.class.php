<?php

class Form_WHEntranceExit_newday extends WorkingHourEntranceExitForm
{
  	public function configure()
  	{
  		unset($this['day_id']);
  		unset($this['type']);
  	}  	
}
