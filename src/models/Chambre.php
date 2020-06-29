<?php
class Chambre
{
	private $numChambre;
	private $numBatiment;
	private $type;

	public function __construct($row = null)
	{
		if ($row != null) {
			$this->hydrate($row);
		}
	}

	public function getNumchambre()
	{
		return $this->numChambre;
	}

	public function setNumchambre($numChambre)
	{
		$this->numChambre = $numChambre;
	}
	public function getNumbatiment()
	{
		return $this->numBatiment;
	}

	public function setNumbatiment($numBatiment)
	{
		$this->numBatiment = $numBatiment;
	}
	public function getType()
	{
		return $this->type;
	}
	public function setType($type)
	{
		$this->type = $type;
	}
	public function hydrate($row)
	{
		$this->numChambre = $row['numChambre'];
		$this->numBatiment = $row['numBatiment'];
		$this->type = $row['type'];
	}
}