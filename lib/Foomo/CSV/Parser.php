<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\CSV;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author Jan Halfar <jan@foomo.org>
 */
class Parser implements \Iterator
{
	
	/**
	 * my parse mode @see self::PARSE_MODE_
	 * 
	 * @var type 
	 */
	public $parseMode = self::PARSE_MODE_HASH;
	
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------
	
	/**
	 * use the first line as keys for each line 
	 */
	const PARSE_MODE_HASH = 'hash';
	/**
	 * numbered columns 
	 */
	const PARSE_MODE_ARRAY = 'array';
	
	//---------------------------------------------------------------------------------------------
	// ~ private props
	//---------------------------------------------------------------------------------------------
	/**
	 * csv file handle
	 * 
	 * @var resource
	 */
	private $fh;
	/**
	 * csv file
	 * 
	 * @var string
	 */
	private $filename;
	/**
	 * csv delimiter
	 * 
	 * @var type 
	 */
	private $delimiter = ',';
	/**
	 * csv text/cell enclosure
	 * 
	 * @var type 
	 */
	private $enclosure = '"';
	/**
	 * csv text escape
	 * 
	 * @var type 
	 */
	private $escape = '\\';
	private $i = 0;
	/**
	 * current line
	 * 
	 * @var string
	 */
	private $current;
	private $header;
	
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------
	
	private function __construct($filename, $delimiter, $enclosure, $escape)
	{
		$this->filename = $filename;
		$this->fh = fopen($this->filename, 'r');
		$this->delimiter = $delimiter;
		$this->enclosure = $enclosure;
		$this->escape = $escape;
	}

	//---------------------------------------------------------------------------------------------
	// ~ public interface
	//---------------------------------------------------------------------------------------------
	
	/**
	 * array or hash
	 * 
	 * @param type $parseMode 
	 * 
	 * @return Parser
	 */
	public function setParseMode($parseMode)
	{
		if(in_array($parseMode, array(self::PARSE_MODE_HASH, self::PARSE_MODE_ARRAY))) {
			$this->parseMode = $parseMode;
		} else {
			throw new \InvalidArgumentException('invalid parse mode', 1);
		}
		return $this;
	}

	/**
	 *
	 * @param type $filename
	 * @param type $delimiter
	 * @param type $enclosure
	 * @param type $escape 
	 * 
	 * @return Parser
	 */
	public static function create($filename, $delimiter = ',', $enclosure = '"', $escape = '\\')
	{
		return new self($filename, $delimiter, $enclosure, $escape);
	}
	public function __destruct()
	{
		if(is_resource($this->fh)) {
			fclose($this->fh);
		}
	}
	/**
	 * the array keys / column names of the table
	 * 
	 * @return array 
	 */
	public function getHeader()
	{
		if(is_null($this->header)) {
			foreach($this as $line) {
				if(!is_null($this->header)) {
					break;
				}
			}
			$this->valid();
			$this->rewind();
		}
		return $this->header;
	}
	//---------------------------------------------------------------------------------------------
	// ~ Iterator
	//---------------------------------------------------------------------------------------------

	public function current()
	{
		
		return $this->current;
	}

	public function next()
	{
		$this->i++;
	}
	public function key()
	{
		return $this->i;
	}
	
	public function valid()
	{
		if(!is_resource($this->fh) && file_exists($this->filename)) {
			$this->fh = fopen($this->filename, 'r');
		}
		$this->current = '';
		while(empty($this->current) && !feof($this->fh)) {
			$line = fgets($this->fh);
			$trimmed =trim($line) ;
			if(!empty($trimmed)) {
				$this->current = str_getcsv($line, $this->delimiter, $this->enclosure, $this->escape);
			} else {
				$this->current = null;
			}
		}
		if($this->parseMode == self::PARSE_MODE_HASH) {
			if(empty($this->header) && !empty($this->current)) {
				$this->header = $this->current;
				$this->valid();
			} else if(!empty($this->header) && !empty($this->current)) {
				$currentHash = array();
				for($i = 0;$i<count($this->header);$i++) {
					$currentHash[$this->header[$i]] = $this->current[$i];
				}
				$this->current = $currentHash;
			}
		}
		return !feof($this->fh) || !empty($this->current);
	}

	public function rewind()
	{
		$this->i = 0;
		if(is_resource($this->fh)) {
			rewind($this->fh);
		}
	}

}