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

        $filter = new Filter();
        $validate = new Validate();

        $filteredVenueName = $filter->filterVenueName($this->axisRoute->values['venue_name']);

        if ($validate->isValidVenueName($filteredVenueName)) {
        	$content->set('requestedVenueName', $filteredVenueName);
        } else {
        	$content->set('requestedVenueName', '');
        }

        $listVenueTypes = $this->listVenueTypes();

        foreach ($listVenueTypes as $key => $type) {
            $venueTypes[$key][] = $type['name'];
            $venueTypes[$key][] = $type['cryptonym'];
        }

        if (isset($this->axisRoute->values['return_code'][0])) {
            if ($this->axisRoute->values['return_code'][0] === "3") {
                $content->set('invalidVenueName', true);
            }
        }

        $content->set('venueTypeName', $this->getVenueName());
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
         *     * 3 - Invalid Venue Name
         *     * 4 - Venue Exists
         */

        if ($this->venueExists()) {
            // venue exists message

            $returnCode = 4;
        } else {
            // create venue

            $filter = new Filter();
            $validate = new Validate();

            $filteredVenueName = $filter->filterVenueName($this->axisRoute->values['venue_name']);

            if (!$validate->isValidVenueName($filteredVenueName)) {
                $returnCode = 3;
            } else {

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
                $venueTypeId = $this->getVenueTypeId($_POST['venue_type']);

                $tableColumns = [
                    'venue_type' => $venueTypeId,
                    'cryptonym' => strtolower($this->axisRoute->values['venue_name']),
                    'name' => $this->axisRoute->values['venue_name'],
                    'title' => $this->axisRoute->values['venue_name'],
                    'venue_admin' => $this->currentUser->id,
                    'venue_email' => $emailAddress,
                    'venue_email_name' => $this->axisRoute->values['venue_name'] . ': Admin',
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
        }

        header('location:' . $this->basePath . '/venues/create/complete/' . $this->axisRoute->values['venue_name'] . '/' . $returnCode);
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


        	    header('location:' . $this->basePath . '/venues/create/start/' . $this->axisRoute->values['venue_name'] . '/3');
        	    exit;

        	    /*
        	    $content = new Template(dirname(__FILE__) . DS . 'views/venue_create_invalid_name.tpl.php');

        	    $content->set('venueTypeName', $this->getVenueName());
        	    $content->set('formHelper', $this->formHelper);

        	    $filter = new Filter();
        	    $validate = new Validate();

        	    $filteredVenueName = $filter->filterVenueName($this->axisRoute->values['venue_name']);

        	    if ($validate->isValidVenueName($filteredVenueName)) {
        	        $content->set('requestedVenueName', $filteredVenueName);
        	    } else {
        	        $content->set('requestedVenueName', '');
        	    }

        	    break;
        	    //*/

        	case 4:
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
            'cryptonym',
            'cryptonym = :cryptonym',
            [
                'cryptonym' => strtolower($this->axisRoute->values['venue_name']),
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

    public function getVenueTypeId($venueType)
    {
        // Get Specific Venue Type ID

        $venueTypeCryptonym = strtolower($venueType);

        $sql = new Db();

        $sql->dbSelect('venue_types',
            'id',
            'cryptonym = :cryptonym',
            ['cryptonym' => $venueTypeCryptonym]
        );

        $fields = $sql->dbFetch('one');

        return $fields['id'];
    }

    public function listVenueTypes()
    {

        // List All Venue Types

        $sql = new Db();

        $sql->dbSelect('venue_types',
            'cryptonym, name, description',
            'active = :active',
            ['active' => intval(2)]);

        $fields = $sql->dbFetch();

        return $fields;
    }

    public function getVenueName()
    {

        // Get Specified Venue Name

        $sql = new Db();

        $sql->dbSelect('labels',
            'cryptonym, name',
            'cryptonym = :cryptonym AND active = :active',
            [
                'cryptonym' => 'venue',
                'active' => intval(2)
            ]
        );

        $fields = $sql->dbFetch('one');

        return $fields['name'];
    }
}