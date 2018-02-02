<?php

namespace Concrete\Core\Updater\Migrations\Migrations;

use Concrete\Core\Updater\Migrations\AbstractMigration;
use Concrete\Core\Updater\Migrations\DirectSchemaUpgraderInterface;
use Concrete\Core\Updater\Migrations\RepeatableMigrationInterface;

class Version20170609100000 extends AbstractMigration implements RepeatableMigrationInterface, DirectSchemaUpgraderInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Concrete\Core\Updater\Migrations\DirectSchemaUpgraderInterface::upgradeDatabase()
     */
    public function upgradeDatabase()
    {
        $this->refreshDatabaseTables([
            'FailedLoginAttempts',
            'LoginControlIpRanges',
        ]);
        $this->connection->executeQuery('DROP TABLE IF EXISTS SignupRequests');
        $this->connection->executeQuery('DROP TABLE IF EXISTS UserBannedIPs');

        // Add the new dashboard page to show IP ranges
        $this->createSinglePage('/dashboard/system/permissions/blacklist/range', 'IP Range', ['exclude_nav' => true]);
    }
}
