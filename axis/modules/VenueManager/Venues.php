<?php
namespace VenueManager;

use Acms\Core\Components\AbstractModule;
use Acms\Core\Templates\Template;
use Acms\Core\Data\Db;
use Acms\Core\Data\Validate;
use Acms\Core\Data\Filter;

class Venues extends AbstractModule
{
    public function venueCreateStart()
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/venue_create_start.tpl.php');

        $validate = new Validate();
        $filter = new Filter();

        $filteredVenueLabel = $filter->filterVenueLabel($this->axisRoute->values['venue_label']);

        if ($validate->isValidVenueLabel($filteredVenueLabel)) {
        	$content->set('requestedVenueLabel', $filteredVenueLabel);
        } else {
        	$content->set('requestedVenueLabel', '');
        }

        $listVenueTypes = $this->listVenueTypes();

        foreach ($listVenueTypes as $key => $type) {
            $venueTypes[$key][] = $type['label'];
            $venueTypes[$key][] = $type['name'];
        }

        $content->set('venueTypeLabel', $this->getVenueLabel());
        $content->set('venueTypes', $venueTypes);
        $content->set('formHelper', $this->formHelper);

        return $content;
    }

    public function venueCreateProcess()
    {
        /*
         * Return Codes
         *     * 1 - Venue Creation Success
         *     * 2 - Venue Creation Failure
         *     * 3 - Venue Exists
         */

        if ($this->venueExists()) {
            // venue exists message

            $returnCode = 3;
        } else {
            // create venue

            $sql = new Db();

            /*
             * Get current users email address
             */
            $sql->dbSelect('users',
                'email_address',
                'id = :id',
                ['id' => $this->currentUser->id]
            );

            $fields = $sql->dbFetch('one');

            $emailAddress = $fields['email_address'];

            /*
             * Get requested venue types ID
            */
            $venueTypeId = $this->getVenueTypeId(strtolower($_POST['venue_type']));

            $tableColumns = [
                'venue_type' => $venueTypeId,
                'name' => strtolower($this->axisRoute->values['venue_label']),
                'label' => $this->axisRoute->values['venue_label'],
                'title' => $this->axisRoute->values['venue_label'],
                'venue_admin' => $this->currentUser->id,
                'venue_email' => $emailAddress,
                'venue_email_name' => $this->axisRoute->values['venue_label'] . ': Admin',
                'active' => 2,
                'created' => $sql->getMysqlTimestamp(),
                'modified' => $sql->getMysqlTimestamp(),
            ];

            try {
                $sql->dbInsert('venues', $tableColumns);

                // Created Successfully
                $returnCode = 1;

            } catch (\PDOException $e) {
                // Could not create venue
                $returnCode = 2;
            }
        }

        header('location:' . $this->basePath . '/venues/create/complete/' . $this->axisRoute->values['venue_label'] . '/' . $returnCode);
        exit;
    }

    public function venueCreateComplete()
    {
        switch($this->axisRoute->values['return_code']) {
        	case 1:
        	    $content = new Template(dirname(__FILE__) . DS . 'views/venue_create_complete.tpl.php');
        	    break;
        	case 2:
        	    $content = new Template(dirname(__FILE__) . DS . 'views/venue_create_error.tpl.php');
        	    break;
        	case 3:
        	    $content = new Template(dirname(__FILE__) . DS . 'views/venue_create_venue_exists.tpl.php');
        	    break;
        }

        /*
        $content->set('zoneAllModules', $zoneAllModules);
        $content->set('zoneSpecificModules', $zoneSpecificModules);
        $content->set('axisModules', $axisModules);
        $content->set('formHelper', $this->formHelper);
        //*/

        return $content;
    }

    public function venueExists()
    {
        // Does a venue already exist?

        $sql = new Db();

        $sql->dbSelect('venues',
            'name',
            'name = :name',
            [
                'name' => strtolower($this->axisRoute->values['venue_label']),
            ]
        );

        $fields = $sql->dbFetch('one');

        if ($fields) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    public function getVenueTypeId($venueTypeName)
    {
        // Get Specific Venue Type ID

        $sql = new Db();

        $sql->dbSelect('venue_types',
            'id',
            'name = :name',
            ['name' => $venueTypeName]
        );

        $fields = $sql->dbFetch('one');

        return $fields['id'];
    }

    public function listVenueTypes()
    {

        // List All Venue Types

        $sql = new Db();

        $sql->dbSelect('venue_types',
            'name, label, description',
            'active = :active',
            ['active' => intval(2)]);

        $fields = $sql->dbFetch();

        return $fields;
    }

    public function getVenueLabel()
    {

        // Get Specific Venue Label

        $sql = new Db();

        $sql->dbSelect('labels',
            'name, label',
            'name = :name AND active = :active',
            [
                'name' => 'Venue',
                'active' => intval(2)
            ]
        );

        $fields = $sql->dbFetch('one');

        return $fields['label'];
    }
}