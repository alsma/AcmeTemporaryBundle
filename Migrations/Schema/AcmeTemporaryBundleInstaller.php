<?php

namespace Acme\Bundle\TemporaryBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Oro\Bundle\MigrationBundle\Migration\Installation;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class AcmeTemporaryBundleInstaller implements Installation
{
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createAcmeTemporaryOrderTable($schema);
        $this->createAcmeTemporaryOrderItemTable($schema);
        $this->createAcmeTemporaryProductTable($schema);

        /** Foreign keys generation **/
        $this->addAcmeTemporaryOrderItemForeignKeys($schema);
    }

    /**
     * Create acme_temporary_order table
     *
     * @param Schema $schema
     */
    protected function createAcmeTemporaryOrderTable(Schema $schema)
    {
        $table = $schema->createTable('acme_temporary_order');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('label', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
    }

    /**
     * Create acme_temporary_order_item table
     *
     * @param Schema $schema
     */
    protected function createAcmeTemporaryOrderItemTable(Schema $schema)
    {
        $table = $schema->createTable('acme_temporary_order_item');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('product_id', 'integer', ['notnull' => false]);
        $table->addColumn('order_id', 'integer', ['notnull' => false]);
        $table->addColumn('qty', 'integer', []);
        $table->addColumn('product_sku', 'string', ['length' => 50]);
        $table->addColumn('product_name', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['order_id'], 'IDX_3491C0BA8D9F6D38', []);
        $table->addIndex(['product_id'], 'IDX_3491C0BA4584665A', []);
    }

    /**
     * Create acme_temporary_product table
     *
     * @param Schema $schema
     */
    protected function createAcmeTemporaryProductTable(Schema $schema)
    {
        $table = $schema->createTable('acme_temporary_product');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('sku', 'string', ['length' => 50]);
        $table->setPrimaryKey(['id']);
    }

    /**
     * Add acme_temporary_order_item foreign keys.
     *
     * @param Schema $schema
     */
    protected function addAcmeTemporaryOrderItemForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('acme_temporary_order_item');
        $table->addForeignKeyConstraint(
            $schema->getTable('acme_temporary_product'),
            ['product_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('acme_temporary_order'),
            ['order_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
