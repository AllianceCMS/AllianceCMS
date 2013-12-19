<?php
namespace Acms\Core\Data;

class Filter
{
	public function filterVenueName($venueName)
	{
		$filteredVenueName = $this->removeWhiteSpace($venueName);
		$filteredVenueName = $this->removeDashes($filteredVenueName);
		
		return $filteredVenueName;
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