<?php

namespace App\Controller\Admin;

use App\Entity\Circuit;
use App\Entity\CoursLangue;
use App\Entity\Photo;
use App\Entity\Prestation;
use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Honey Group CMS');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Gestion des contenus');

        yield MenuItem::linkToUrl(
            'Circuits',
            'fas fa-route',
            $this->adminUrlGenerator
                ->setController(CircuitCrudController::class)
                ->generateUrl()
        );

        yield MenuItem::linkToUrl(
            'Cours de langue',
            'fas fa-language',
            $this->adminUrlGenerator
                ->setController(CoursLangueCrudController::class)
                ->generateUrl()
        );

        yield MenuItem::linkToUrl(
            'Prestations',
            'fas fa-briefcase',
            $this->adminUrlGenerator
                ->setController(PrestationCrudController::class)
                ->generateUrl()
        );

        yield MenuItem::linkToUrl(
            'Photos',
            'fas fa-image',
            $this->adminUrlGenerator
                ->setController(PhotoCrudController::class)
                ->generateUrl()
        );
        yield MenuItem::linkToUrl(
    'Pôles',
    'fas fa-sitemap',
    $this->adminUrlGenerator
        ->setController(PoleCrudController::class)
        ->generateUrl()
);

        yield MenuItem::section('Administration');

        yield MenuItem::linkToUrl(
            'Utilisateurs',
            'fas fa-users',
            $this->adminUrlGenerator
                ->setController(UserCrudController::class)
                ->generateUrl()

        );
        
    }
}