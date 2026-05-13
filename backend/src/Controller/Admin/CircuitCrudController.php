<?php

namespace App\Controller\Admin;

use App\Entity\Circuit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

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
            TextField::new('titreCircuit', 'Titre'),
            TextareaField::new('descriptionLongue', 'Description')->hideOnIndex(),
            TextareaField::new('itineraire', 'Itinéraire')->hideOnIndex(),
            TextField::new('duree', 'Durée'),
            ChoiceField::new('statut', 'Statut')->setChoices([
                'Actif' => 'actif',
                'Inactif' => 'inactif',
            ]),
            AssociationField::new('prestation', 'Prestation'),
        ];
    }
}