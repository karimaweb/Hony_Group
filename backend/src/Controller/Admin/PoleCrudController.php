<?php

namespace App\Controller\Admin;

use App\Entity\Pole;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class PoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pole::class;
    }
public function configureFields(string $pageName): iterable
{
    return [

        IdField::new('id')->hideOnForm(),

        TextField::new('nomPole', 'Nom du pôle'),

        TextEditorField::new('description', 'Description'),

        DateTimeField::new('dateCreation', 'Date de création')
            ->hideOnForm(),
    ];
}
}
