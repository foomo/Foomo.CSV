<?php
namespace Foomo\CSV\Validation;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class ValidatedLine
{
	/**
	 * add a comment
	 * 
	 * @var type 
	 */
	public $report;
	/**
	 * all fields are valid
	 * 
	 * @var boolean
	 */
	public $valid;
	/**
	 * validated fields with validation information
	 * 
	 * @var FieldValidators\ValidatedField[]
	 */
	public $fields = array();
	/**
	 * array or hash of corrected values
	 * 
	 * @var array
	 */
	public $correctedValues = array();
}