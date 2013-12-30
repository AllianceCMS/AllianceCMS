<?php
namespace Acms\Core\Data;

class Filter
{
	public function filterVenueLabel($venueLabel)
	{

	    $filteredVenueLabel = ucwords($venueLabel);
	    $filteredVenueLabel = $this->removeWhiteSpace($filteredVenueLabel);
	    $filteredVenueLabel = $this->removeDashes($filteredVenueLabel);

		return $filteredVenueLabel;
	}

	public function removeWhiteSpace($subject)
	{
		return preg_replace('/^\s+|\s+$/', '', $subject);
	}

	public function removeDashes($subject)
	{
		return preg_replace('/\s+/', '-', $subject);
	}

    public function alterRegex($alterFields)
    {
        foreach ($alterFields as $field) {

            if (isset($_POST[$field[0]])) {
                $_POST[$field[0]] = preg_replace($field[1], $field[2], $_POST[$field[0]] );
            }
        }
        return true;
    }
}