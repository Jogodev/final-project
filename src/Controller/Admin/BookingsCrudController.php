<?php

namespace App\Controller\Admin;

use App\Entity\Bookings;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;


class BookingsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bookings::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Numero de réservation'),
            AssociationField::new('cars', 'Vehicule')->autocomplete(),
            DateTimeField::new('start_date', 'Date de retrait'),
            DateTimeField::new('end_date', 'Date de retour'),
            //TextField::new('title'),
            //TextEditorField::new('description'),

        ];
    }
    
}
