<?php

namespace Concrete\Core\Updater\Migrations\Migrations;

use Concrete\Core\Page\Stack\StackList;
use Concrete\Core\Updater\Migrations\AbstractMigration;
use Concrete\Core\Updater\Migrations\DirectSchemaUpgraderInterface;
use Concrete\Core\Updater\Migrations\RepeatableMigrationInterface;

class Version20150616000000 extends AbstractMigration implements RepeatableMigrationInterface, DirectSchemaUpgraderInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Concrete\Core\Updater\Migrations\DirectSchemaUpgraderInterface::upgradeDatabase()
     */
    public function upgradeDatabase()
    {
        \Concrete\Core\Database\Schema\Schema::refreshCoreXMLSchema([
            'Stacks',
        ]);

        if (\Core::make('multilingual/detector')->isEnabled()) {
            StackList::rescanMultilingualStacks();
        }
    }
}
