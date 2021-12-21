<?php

namespace App\Controller\Admin;

use App\Entity\Bookings;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookingsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bookings::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
