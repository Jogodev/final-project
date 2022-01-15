<?php
namespace App\Entity;

class BookingSearch{

/**
 * @var string|null
 */
private $car;

/**
 * @var string|null
 */
private $energy;

/**
 * @var string|null
 */
private $category;

/**
 * @var int|null
 */
private $maxPrice;




/**
 * Get the value of energy
 *
 * @return  string|null
 */ 
public function getEnergy()
{
return $this->energy;
}

/**
 * Set the value of energy
 *
 * @param  string|null  $energy
 *
 * @return  self
 */ 
public function setEnergy($energy)
{
$this->energy = $energy;

return $this;
}

/**
 * Get the value of category
 *
 * @return  string|null
 */ 
public function getCategory()
{
return $this->category;
}

/**
 * Set the value of category
 *
 * @param  string|null  $category
 *
 * @return  self
 */ 
public function setCategory($category)
{
$this->category = $category;

return $this;
}

/**
 * Get the value of maxPrice
 *
 * @return  int|null
 */ 
public function getMaxPrice()
{
return $this->maxPrice;
}

/**
 * Set the value of maxPrice
 *
 * @param  int|null  $maxPrice
 *
 * @return  self
 */ 
public function setMaxPrice($maxPrice)
{
$this->maxPrice = $maxPrice;

return $this;
}

/**
 * Get the value of car
 *
 * @return  string|null
 */ 
public function getCar()
{
return $this->car;
}

/**
 * Set the value of car
 *
 * @param  string|null  $car
 *
 * @return  self
 */ 
public function setCar($car)
{
$this->car = $car;

return $this;
}
}