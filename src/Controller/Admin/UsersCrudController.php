<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname'),
            TextField::new('lastname'),
            EmailField::new('email'),
            ChoiceField::new('roles', 'Roles')->allowMultipleChoices()
            ->autocomplete()
            ->setChoices(["Administrateur" => "ROLE_ADMIN", "Utilisateur" => "ROLE_USER", "Collaborateur"=> "ROLE_COLLAB"]),
            
        ];
    }
    
}
