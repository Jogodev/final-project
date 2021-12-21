<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Entity\Categories;
use App\Entity\Bookings;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Carma Auto');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Categories::class);
        yield MenuItem::linkToCrud('Cars', 'fas fa-list', Cars::class);
        yield MenuItem::linkToCrud('Bookings', 'fas fa-list', Bookings::class);
        yield MenuItem::linkToRoute('Retour au site', 'fas fa-arrow-left', 'main');
    }
}
