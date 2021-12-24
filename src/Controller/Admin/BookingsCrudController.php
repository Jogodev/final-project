<?php

namespace App\Controller\Admin;

use App\Entity\Bookings;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;


class BookingsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bookings::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('start_date'),
            DateTimeField::new('end_date'),
            //TextField::new('title'),
            //TextEditorField::new('description'),

        ];
    }
    
}
