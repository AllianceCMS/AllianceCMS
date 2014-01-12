<?php
namespace VenueManager;

use Acms\Core\Components\AbstractModule;
use Acms\Core\Templates\Template;
use Acms\Core\Data\Db;
use Acms\Core\Data\Validate;
use Acms\Core\Data\Filter;

class Venues extends AbstractModule
{
    /**
     * @todo: Do not allow venue create if client is not logged in
     */
    public function venueCreateStart()
    {
        // Initialize View
        $content = new Template(dirname(__FILE__) . DS . 'views/venue_create_start.tpl.php');

        $filter = new Filter();
        $validate = new Validate();

        // Filter requested Venue Name
        if (isset($this->axisRoute->values['query_string'][0])) {
            $filteredVenueName = $filter->filterVenueName($this->axisRoute->values['query_string'][0]);
        } else {
            $filteredVenueName = '';
        }

        // Make sure it's a valid Venue Name
        // @todo: Is this really needed? The else statement did assign an empty string to 'requestedVenueName' which would leave the 'Venue Name' text field empty when redirected back to form

        if ($validate->isValidVenueName($filteredVenueName)) {
        	$content->set('requestedVenueName', $filteredVenueName);
        } else {
        	$content->set('requestedVenueName', $filteredVenueName);
        }

        // Create array of Venue Types for select input box
        $listVenueTypes = $this->listVenueTypes();

        foreach ($listVenueTypes as $key => $type) {
            $venueTypes[$key][] = $type['name'];
            $venueTypes[$key][] = $type['cryptonym'];
        }

        // If an invalid Venue Name is submitted, create a variable that will trigger error message
        if (isset($this->axisRoute->values['query_string'][1])) {
            if ($this->axisRoute->values['query_string'][1] === "3") {
                $content->set('invalidVenueName', true);
            }

            if ($this->axisRoute->values['query_string'][1] === "4") {
                $content->set('venueNameExists', true);
            }

            if ($this->axisRoute->values['query_string'][1] === "5") {
                $content->set('blankVenueName', true);
                $content->set('requestedVenueName', '');
            }
        }

        // Send variables to view
        $content->set('venueTypeName', VENUE_LABEL);
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
         *     * 5 - Blank Venue Name Submitted
         */

        if (!empty($_POST['venue_name'])) {

            $filter = new Filter();
            $validate = new Validate();

            // Filter requested Venue Name
            $filteredVenueName = $filter->filterVenueName($_POST['venue_name']);

            if ($this->venueExists($filteredVenueName)) {

                /*
                 * If Venue exists then prompt for another Venue Name
                 */

                $returnCode = 4;
            } else {

                if (!$validate->isValidVenueName($filteredVenueName)) {

                    /*
                     * If requested Venue Name is invalid send user back to start of Venue Creation with an error message
                     */

                    $returnCode = 3;
                } else {

                    /*
                     * Create Venue
                     */

                    $sql = new Db();

                    /*
                     * Get current users email address
                     */

                    $sql->dbSelect('users',
                        'email_address',
                        'id = :id',
                        [
                            'id' => $this->currentUser->id,
                        ]
                    );

                    $fields = $sql->dbFetch('one');

                    $emailAddress = $fields['email_address'];

                    /*
                     * Get requested venue type's ID
                    */

                    $venueTypeId = $this->getVenueTypeId($_POST['venue_type']);

                    $tableColumns = [
                        'venue_type' => $venueTypeId,
                        'cryptonym' => strtolower($filteredVenueName),
                        'name' => $filteredVenueName,
                        'title' => $filteredVenueName,
                        'venue_admin' => $this->currentUser->id,
                        'venue_email' => $emailAddress,
                        'venue_email_name' => $filteredVenueName . ': Admin',
                        'active' => 2,
                        'created' => $sql->getMysqlTimestamp(),
                        'modified' => $sql->getMysqlTimestamp(),
                    ];

                    try {
                        $sql->dbInsert('venues', $tableColumns);

                        // Venue Created Successfully
                        $returnCode = 1;

                    } catch (\PDOException $e) {

                        // Could not create venue due to database error
                        $returnCode = 2;
                    }
                }
            }
        } else {
            // Blank Venue Name submitted
            $filteredVenueName = 'blank';
            $returnCode = 5;
        }

        // Redirect user to Venues::venueCreateComplete with return code
        header('location:' . $this->basePath . '/venues/create/complete/' . $filteredVenueName . '/' . $returnCode);
        exit;
    }

    public function venueCreateComplete()
    {
        /*
         * @todo: Pertify views
         */

        switch($this->axisRoute->values['return_code']) {
        	case 1:
        	    // Venue was successfully created

        	    $content = new Template(dirname(__FILE__) . DS . 'views/venue_create_complete.tpl.php');

        	    $content->set('venueTypeName', VENUE_LABEL);
        	    $content->set('venueName', $this->axisRoute->values['venue_name']);

        	    break;
        	case 2:
        	    // There was a database error while attempting to create Venue

        	    $content = new Template(dirname(__FILE__) . DS . 'views/venue_create_error.tpl.php');
        	    break;
        	case 3:
        	    // Invalid Venue Name

        	    header('location:' . $this->basePath . '/venues/create/start/' . $this->axisRoute->values['venue_name'] . '/3');
        	    exit;
        	case 4:
        	    // A Venue with the requested name already exists

        	    header('location:' . $this->basePath . '/venues/create/start/' . $this->axisRoute->values['venue_name'] . '/4');
        	    exit;
        	case 5:
        	    // Invalid Venue Name

        	    header('location:' . $this->basePath . '/venues/create/start/' . $this->axisRoute->values['venue_name'] . '/5');
        	    exit;
        }

        return $content;
    }

    public function venueExists($venueName)
    {
        // Does a venue already exist?

        $sql = new Db();

        $sql->dbSelect('venues',
            'cryptonym',
            'cryptonym = :cryptonym',
            [
                'cryptonym' => strtolower($venueName),
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
        // Get Specific Venue Type's ID

        $venueTypeCryptonym = strtolower($venueType);

        $sql = new Db();

        $sql->dbSelect('venue_types',
            'id',
            'cryptonym = :cryptonym',
            [
                'cryptonym' => $venueTypeCryptonym,
            ]
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
            [
                'active' => intval(2),
            ]
        );

        $fields = $sql->dbFetch();

        return $fields;
    }

    /*
    @todo: Should we keep this. Right now a constant is created on every load page. This would allow us to load the venue name label only when needed.
    public function getVenueLabel()
    {

        // Get Venue Name stored in 'labels' database table

        $sql = new Db();

        $sql->dbSelect('labels',
            'cryptonym, name',
            'cryptonym = :cryptonym AND active = :active',
            [
                'cryptonym' => 'venue',
                'active' => intval(2),
            ]
        );

        $fields = $sql->dbFetch('one');

        return $fields['name'];
    }
    //*/
}