<?php
namespace Acms\Core\Data;

class Filter
{
	public function filterVenueName($venueName)
	{
	    $filteredVenueName = $this->dashToSpace($venueName);
	    $filteredVenueName = $this->removeExtraWhiteSpace($filteredVenueName);
	    $filteredVenueName = ucwords($filteredVenueName);
	    $filteredVenueName = $this->whiteSpaceToDashes($filteredVenueName);

		return $filteredVenueName;
	}

	public function dashToSpace($subject)
	{
	    return preg_replace('/-/', ' ', $subject);
	}

	public function removeExtraWhiteSpace($subject)
	{
		return preg_replace('/^\s+|\s+$/', '', $subject);
	}

	public function whiteSpaceToDashes($subject)
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