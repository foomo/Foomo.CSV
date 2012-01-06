<?php
namespace Foomo\CSV\Validation\FieldValidators;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class ValidatedField
{
	/**
	 * the raw input
	 * 
	 * @var string
	 */
	public $raw;
	/**
	 * valid or not
	 * 
	 * @var boolean
	 */
	public $valid;
	/**
	 * corrected value
	 * 
	 * @var mixed
	 */
	public $correctedValue;
	/**
	 * report
	 * 
	 * @var string
	 */
	public $report;
}