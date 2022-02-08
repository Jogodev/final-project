<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UpdatePassword
{    
    /**
     *
     */
    private $currentPassword;   

    /**
     *@Assert\Length(min=6, max=40, minMessage="Le mot de passe doit contenir au minimum 6 caractères", maxMessage="Le mot de passe doit contenir au maximum 1000 caractères")
     *@Assert\NotEqualTo(propertyPath="currentPassword", message="Le nouveau mot de passe ne peut pas être idenditique a l'ancien mot de passe")
     */
    private $newPassword;  

    /**
     *@Assert\EqualTo(propertyPath="newPassword", message ="Le mot de passe de confirmation n'est pas identique au nouveau mot de passe")
     */
    private $confirmPassword;

    /**
     * Get currentPassword
     *
     * @return  mixed
     */ 
    public function getCurrentPassword()
    {
        return $this->currentPassword;
    }

    /**
     * Set currentPassword
     *
     * @param  mixed  $currentPassword  currentPassword
     *
     * @return  self
     */ 
    public function setCurrentPassword($currentPassword)
    {
        $this->currentPassword = $currentPassword;

        return $this;
    }

    /**
     * Get newPassword
     *
     * @return  mixed
     */ 
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * Set newPassword
     *
     * @param  mixed  $newPassword  newPassword
     *
     * @return  self
     */ 
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    /**
     * Get confirmPassword
     *
     * @return  mixed
     */ 
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set confirmPassword
     *
     * @param  mixed  $confirmPassword  confirmPassword
     *
     * @return  self
     */ 
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
}