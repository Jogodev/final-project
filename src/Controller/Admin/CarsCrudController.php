<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CarsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cars::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('title'),
            TextEditorField::new('content'),
            ImageField::new('image')
                ->setUploadDir('/public/uploads')
                ->setRequired(false)
                ->setBasePath('/uploads'),
        ];
    }
    
}
