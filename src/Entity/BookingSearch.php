<?php
namespace App\Entity;

use App\Entity\Categories;
use Symfony\Component\Validator\Constraints as Assert;

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
private $categories;

/**
 * @var int|null
 * @Assert\GreaterThanOrEqual(20, message="Le prix minimum de nos location est de 20 €")
 * @Assert\LessThanOrEqual(2000, message="Nos location n'excèdes pas 2000 €")
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

/**
 * Get the value of categories
 *
 * @return  string|null
 */ 
public function getCategories()
{
return $this->categories;
}

/**
 * Set the value of categories
 *
 * @param  string|null  $categories
 *
 * @return  self
 */ 
public function setCategories($categories)
{
$this->categories = $categories;

return $this;
}
}