<?php

require_once 'Character.php';

class Orderus extends Character
{

	function __construct()
	{
		$this->name = "Orderus";
		
		$this->stats = [
			"health"   => rand(70, 100),
			"strength" => rand(70, 80),
			"defence"  => rand(45, 55),
			"speed"    => rand(40, 50),
			"luck"     => rand(10, 30)
		];

		$this->specialSkills = [
			"rapidStrike" => rand(0, 10),
			"magicShield" => rand(0, 20)
		];
	}

	public function hasSpecialSkils()
	{
		return true;
	}
}