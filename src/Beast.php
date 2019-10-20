<?php

require_once 'Character.php';

class Beast extends Character
{

	function __construct()
	{
		$this->name = "Beast";

		$this->stats = [
			"health"   => rand(60, 90),
			"strength" => rand(60, 90),
			"defence"  => rand(40, 60),
			"speed"    => rand(40, 60),
			"luck"     => rand(25, 40)
		];

		$this->specialSkills = [
			"rapidStrike" => 0,
			"magicShield" => 0 
		];
	}

	public function hasSpecialSkils()
	{
		return false;
	}

}