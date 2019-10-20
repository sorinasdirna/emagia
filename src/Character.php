<?php

class Character 
{

	public $name = "";
	
	public $stats = [];

	public $specialSkills = [];

	public function getName()
	{	
		return $this->name;
	}

	public function setName($name)
	{	
		$this->name = $name;
	}

	public function getStats($key)
	{
		return $this->stats[$key];
	}

	public function setStats($key, $value)
	{
		$this->stats[$key] = $value;
	}

	public function getSpecialSkills($key)
	{
		return $this->specialSkills[$key];
	}

	public function setSpecialSkills($key, $value)
	{
		$this->specialSkills[$key] = $value;
	}
}