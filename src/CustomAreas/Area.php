<?php

namespace CustomAreas;

use pocketmine\player\Player;
use pocketmine\world\Position;

class Area{

	public $plugin, $min, $max, $level, $owner, $whiteList;

	public function __construct(Main $plugin, array $pos1, array $pos2, string $levelName, string $owner, array $whiteList = []){
		$this->plugin = $plugin;
		$this->min = [min($pos1[0], $pos2[0]), min($pos1[1], $pos2[1]), min($pos1[2], $pos2[2])];
		$this->max = [max($pos1[0], $pos2[0]), max($pos1[1], $pos2[1]), max($pos1[2], $pos2[2])];
		$this->level = strtolower($levelName);
		$this->owner = strtolower($owner);
		$this->whiteList = array_map('strtolower', $whiteList);
	}

	public function isInside(Position $p) : bool{
		return strtolower($p->getWorld()->getFolderName()) === $this->level && $p->x >= $this->min[0] && $p->x <= $this->max[0] && $p->y >= $this->min[1] && $p->y <= $this->max[1] && $p->z >= $this->min[2] && $p->z <= $this->max[2];
	}

	public function canBuild(Player $player) : bool{
		return strtolower($player->getName()) === $this->owner || in_array(strtolower($player->getName()), $this->whiteList, true);
	}

}