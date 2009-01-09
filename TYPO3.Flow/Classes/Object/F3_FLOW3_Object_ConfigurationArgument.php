<?php
declare(ENCODING = 'utf-8');
namespace F3\FLOW3\Object;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * @package FLOW3
 * @subpackage Object
 * @version $Id$
 */

/**
 * Injection (constructor-) argument as used in a Object Configuration
 *
 * @package FLOW3
 * @subpackage Object
 * @version $Id$
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser Public License, version 3 or later
 * @scope prototype
 */
class ConfigurationArgument {

	const ARGUMENT_TYPES_STRAIGHTVALUE = 0;
	const ARGUMENT_TYPES_OBJECT = 1;
	const ARGUMENT_TYPES_SETTING = 2;

	/**
	 * The position of the constructor argument. Counting starts at "1".
	 * @var integer
	 */
	protected $index;

	/**
	 * @var mixed The argument's value
	 */
	protected $value;

	/**
	 * Argument type, one of the ARGUMENT_TYPES_* constants
	 * @var integer
	 */
	protected $type;

	/**
	 * Constructor - sets the index, value and type of the argument
	 *
	 * @param string $index Index of the argument
	 * @param mixed $value Value of the argument
	 * @param integer $type Type of the argument - one of the argument_TYPE_* constants
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function __construct($index, $value, $type = self::ARGUMENT_TYPES_STRAIGHTVALUE) {
		$this->set($index, $value, $type);
	}

	/**
	 * Sets the index, value, type of the argument and object configuration
	 *
	 * @param integer $index Index of the argument (counting starts at "1")
	 * @param mixed $value Value of the argument
	 * @param integer $type Type of the argument - one of the ARGUMENT_TYPE_* constants
	 * @return void
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function set($index, $value, $type = self::ARGUMENT_TYPES_STRAIGHTVALUE) {
		if (!is_integer($index)) throw new \InvalidArgumentException('$index must be of type integer', 1168003692);
		if (!is_integer($type) || $type < 0 || $type > 2) throw new \InvalidArgumentException('$type is not valid', 1168003693);
		$this->index = $index;
		$this->value = $value;
		$this->type = $type;
	}

	/**
	 * Returns the index (position) of the argument
	 *
	 * @return string Index of the argument
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getIndex() {
		return $this->index;
	}

	/**
	 * Returns the value of the argument
	 *
	 * @return mixed Value of the argument
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Returns the type of the argument
	 *
	 * @return integer Type of the argument - one of the ARGUMENT_TYPES_* constants
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function getType() {
		return $this->type;
	}
}
?>