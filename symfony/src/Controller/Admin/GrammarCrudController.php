<?php

namespace App\Controller\Admin;

use App\Entity\Grammar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GrammarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Grammar::class;
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
