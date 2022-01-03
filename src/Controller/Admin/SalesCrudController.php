<?php

namespace App\Controller\Admin;

use App\Entity\Sales;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SalesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sales::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('title'),
            TextEditorField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'),
            ImageField::new('image')
                ->setUploadDir('/public/uploads')
                ->setRequired(true)
                ->setBasePath('/uploads'),
        ];
    }
    
}
