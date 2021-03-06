<?php

namespace ParamProcessor;

use DataValues\DataValueObject;
use InvalidArgumentException;
use Title;

/**
 * Class representing a MediaWiki title value.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @since 0.1
 *
 * @file
 * @ingroup DataValue
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class MediaWikiTitleValue extends DataValueObject {

	/**
	 * @since 0.1
	 *
	 * @var Title
	 */
	protected $title;

	/**
	 * @since 0.1
	 *
	 * @param Title $title
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct( Title $title ) {
		$this->title = $title;
	}

	/**
	 * @see Serializable::serialize
	 *
	 * @since 0.1
	 *
	 * @return string
	 */
	public function serialize() {
		return $this->title->getFullText();
	}

	/**
	 * @see Serializable::unserialize
	 *
	 * @since 0.1
	 *
	 * @param string $value
	 *
	 * @return MediaWikiTitleValue
	 */
	public function unserialize( $value ) {
		$this->__construct( Title::newFromText( $value ) );
	}

	/**
	 * @see DataValue::getType
	 *
	 * @since 0.1
	 *
	 * @return string
	 */
	public static function getType() {
		return 'mediawikititle';
	}

	/**
	 * @see DataValue::getSortKey
	 *
	 * @since 0.1
	 *
	 * @return string|float|int
	 */
	public function getSortKey() {
		return $this->title->getCategorySortkey();
	}

	/**
	 * Returns the Title object.
	 * @see DataValue::getValue
	 *
	 * @since 0.1
	 *
	 * @return Title
	 */
	public function getValue() {
		return $this->title;
	}

	/**
	 * Constructs a new instance of the DataValue from the provided data.
	 * This can round-trip with @see getArrayValue
	 *
	 * @since 0.1
	 *
	 * @param mixed $data
	 *
	 * @return MediaWikiTitleValue
	 */
	public static function newFromArray( $data ) {
		return new static( $data );
	}

}