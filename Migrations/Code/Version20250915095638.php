<?php
namespace Neos\Flow\Core\Migrations;

/**
 * Adjusts code for package renaming
 */
class Version20250915095638 extends AbstractMigration
{

    public function getIdentifier()
    {
        return 'Oniva.Flow.HealthStatus-20250915095638';
    }

    /**
     * @return void
     */
    public function up()
    {
        $this->searchAndReplace('t3n\Flow\HealthStatus', 'Oniva\Flow\HealthStatus');
        $this->searchAndReplace('t3n.Flow.HealthStatus', 'Oniva.Flow.HealthStatus');
        $this->searchAndReplace('t3n_FlowHealthStatus', 'Oniva_FlowHealthStatus');
    }
}
