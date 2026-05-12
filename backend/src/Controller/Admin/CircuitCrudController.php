<?php

namespace App\Controller\Admin;

use App\Entity\Circuit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CircuitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Circuit::class;
    }

   public function configureFields(string $pageName): iterable
{
    return [

        IdField::new('id')->hideOnForm(),

        TextField::new('titre'),

        TextEditorField::new('descriptionLongue'),

        TextField::new('itineraire'),

        TextField::new('duree'),

        TextField::new('statut'),
    ];
}
}
