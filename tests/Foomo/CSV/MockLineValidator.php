<?php
namespace Foomo\CSV\Validation;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class MockLineValidator extends AbstractLineValidator
{
	public function validateLine(ValidatedLine $line)
	{
		if($line->valid && $line->correctedValues['name'] == 'Peter' && $line->correctedValues['lastname'] == 'Ford') {
			$line->valid = false;
			$line->report = 'Peter Ford may not join the club';
		} else {
			$line->report = 'ok';
		}
	}
}