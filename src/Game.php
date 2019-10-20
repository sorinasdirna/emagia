<?php

require_once 'Orderus.php';
require_once 'Beast.php';

class Game 
{
	
	public $turns = 20;
	public $attacker;
	public $defender;
	public $winner;
	public $loser;

	function __construct()
	{
		$this->attacker = new Beast();
		$this->defender = new Orderus();
	}

	public function reload()
	{
		$attacker = new Beast();
		$defender = new Orderus();

		$newAttackerStrength = $attacker->getStats('strength');
		$newDefenderStrength = $defender->getStats('strength');
		$this->attacker->setStats('strength', $newAttackerStrength);
		$this->defender->setStats('strength', $newDefenderStrength);	

		$newAttackerDefence = $attacker->getStats('defence');
		$newDefenderDefence = $defender->getStats('defence');
		$this->attacker->setStats('defence', $newAttackerDefence);
		$this->defender->setStats('defence', $newDefenderDefence);	
	}

	public function checkWhoStarts()
	{
		// check higher speed for the first turn
		if($this->attacker->getStats('speed') < $this->defender->getStats('speed')) {
			$this->switchRoles();
		} else {
			// if both players have the same speed then check highest luck
			if($this->attacker->getStats('speed') == $this->defender->getStats('speed')) {
				if($this->attacker->getStats('luck') < $this->defender->getStats('luck')) {
					$this->switchRoles();
				}
			}
		}
	} 

	public function switchRoles() 
	{
		$temp = $this->attacker;
		$this->attacker = $this->defender;
		$this->defender = $temp;
	}

	public function displayInitialStates()
	{
		echo '<strong>' . $this->attacker->getName() . ' </strong> starts with : ' . $this->attacker->getStats('health') . ' health, ' . $this->attacker->getStats('strength') . ' strength, ' . $this->attacker->getStats('defence') . ' defence, ' . $this->attacker->getStats('speed') . ' speed, ' . $this->attacker->getStats('luck') . ' luck.';
        echo '<br>';
        echo '<strong>' . $this->defender->getName() . ' </strong> starts with : ' . $this->defender->getStats('health') . ' health, ' . $this->defender->getStats('strength') . ' strength, ' . $this->defender->getStats('defence') . ' defence, ' . $this->defender->getStats('speed') . ' speed, ' . $this->defender->getStats('luck') . ' luck.';
        echo '<hr>';   
	}

	public function getDamage() 
	{
	    // Damage = Attacker.strength - Defender.defence
		return $this->attacker->getStats('strength') - $this->defender->getStats('defence');
	}

	public function run() 
	{
		// check who starts the game
		$this->checkWhoStarts();
		$turns = 1;

		// display initial states
        $this->displayInitialStates();
		

		while($turns <= $this->turns) {	
			echo '<h3>Turn: ' . $turns . '</h3>';

            // get curent defender health
	        $curentHealth = $this->defender->getStats('health');

	        // check if attacker has special skills
			$rapidStrike = $this->attacker->getSpecialSkills('rapidStrike');
			$magicShield = $this->defender->getSpecialSkills('magicShield');
			if($rapidStrike > rand(0, 100)) {
				echo $this->attacker->getName() . ' uses Rapid Strike. ';
				$damage = $this->getDamage() * 2;
			} elseif ($magicShield > rand(0, 100)) {
				echo $this->defender->getName() . ' uses Magic Shield. ';
				$damage = $this->getDamage() / 2;
			} else {
				// get normal damage
				$damage = $this->getDamage();
			}

			// set new defender health
			$newHealth = $curentHealth - $damage;
			$this->defender->setStats('health', $newHealth);	
			
			// display what happened this turn
			echo $this->attacker->getName() . ' attacks. ' . $this->defender->getName() . ' lose ' . $damage . ' health.';

			// check if defender remains without life
			if ($this->defender->getStats('health') <= 0) {
				// set winner and loser if defender is out of health
				$this->winner = $this->attacker->getName();
				$this->loser = $this->defender->getName();
				echo '<h2>' . $this->defender->getName() .' remains without health. ' . $this->attacker->getName() . ' wins!</h2>';
				break;
			} 

			// move to next turn
			$turns++;

			// after each attack the player switch roles
			$this->switchRoles();

			// rand values for the next turn (not health, not chances)
			$this->reload();

		}
		if(!isset($this->winner)) {
			echo '<h2> Out of turns. Play again!<h2>';
		}
	}
}