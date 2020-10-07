<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class SeelosPlayers
 * @package Hackathon\PlayerIA
 * @author HADRIEN NAVARRO
 * Ma première strat (qui est commentée) était une analyse de fréquence d'apparition des coups adverses et je jouais le contre du coup le plus joué en face
 * J'ai ensuite changé de stratégie et suis passé à une stratégie plus simple qui consiste à jouer soit le coup contrant le coup précédent de l'adversaire,
 * soit jouer le même pour contrer son anticipation
 * Pour choisir entre les deux stratégies, tous les 5 coups je regarde les scores et si le mien est inférieur à celui de l'adversaire je change
 */
class SeelosPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

	/*$nbRocks = $this->result->getStatsFor($this->opponentSide)['rock'];
	$nbPapers = $this->result->getStatsFor($this->opponentSide)['paper'];
	$nbScissors = $this->result->getStatsFor($this->opponentSide)['scissors'];
	if ($nbRocks > $nbPapers and $nbRocks > $nbScissors){
		return parent::paperChoice();
	}
	elseif ($nbPapers > $nbScissors){
		return parent::scissorsChoice();
	}
	else {
        	return parent::paperChoice();
	}*/
	$strat = 0;
	if ($this->result->getNbRound() % 5 == 0){
		if ($this->result->getStatsFor($this->mySide)['score'] <= $this->result->getStatsFor($this->opponentSide)['score']){
			if($strat = 1){
				$strat = 0;
			}
			else{
				$strat = 1;
			}
		}
	}
	if ($strat == 0)
	{
		if ($this->result->getLastChoiceFor($this->opponentSide) == parent::rockChoice()){
			return parent::paperChoice();
		}
		elseif ($this->result->getLastChoiceFor($this->opponentSide) == parent::paperChoice()){
			return parent::scissorsChoice();
		}
		elseif ($this->result->getLastChoiceFor($this->opponentSide) == parent::scissorsChoice()){
			return parent::rockChoice();
		}
	}
	elseif($strat == 1)
	{
		if ($this->result->getLastChoiceFor($this->opponentSide) == parent::rockChoice()){
			return parent::rockChoice();
		}
		elseif ($this->result->getLastChoiceFor($this->opponentSide) == parent::paperChoice()){
			return parent::paperChoice();
		}
		elseif ($this->result->getLastChoiceFor($this->opponentSide) == parent::scissorsChoice()){
			return parent::scissorsChoice();
		}
	}	
    }
};
