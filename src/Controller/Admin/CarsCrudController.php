<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

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
            AssociationField::new('categories'),
            TextEditorField::new('content'),
            MoneyField::new('price')->setCurrency('EUR'),
            ImageField::new('image')
                ->setUploadDir('/public/uploads/images')
                ->setRequired(false)
                ->setBasePath('/uploads'),
           
        ];
    }
}
