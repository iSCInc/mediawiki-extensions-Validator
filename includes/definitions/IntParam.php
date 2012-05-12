<?php

/**
 * Defines the boolean integer type.
 * Specifies the type specific validation and formatting logic.
 *
 * @since 0.5
 *
 * @file
 * @ingroup Validator
 * @ingroup ParamDefinition
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class IntParam extends NumericParam {

	/**
	 * If negative values should be allowed or not.
	 *
	 * @since 0.5
	 *
	 * @param boolean $allowNegatives
	 */
	protected $allowNegatives = true;

	/**
	 * Returns an identifier for the parameter type.
	 * @since 0.5
	 * @return string
	 */
	public function getType() {
		return 'integer';
	}

	/**
	 * Sets if negative values should be allowed or not.
	 *
	 * @since 0.5
	 *
	 * @param boolean $allowNegatives
	 */
	public function setAllowNegatives( $allowNegatives ) {
		$this->allowNegatives = $allowNegatives;
	}

	/**
	 * Formats the parameter value to it's final result.
	 *
	 * @since 0.5
	 *
	 * @param $value mixed
	 * @param $param iParam
	 * @param $definitions array of iParamDefinition
	 * @param $params array of iParam
	 *
	 * @return boolean
	 */
	protected function validateValue( $value, iParam $param, array $definitions, array $params ) {
		if ( !parent::validateValue( $value, $param, $definitions, $params ) ) {
			return false;
		}

		if ( $this->allowNegatives && strpos( $value, '-' ) === 0 ) {
			$value = substr( $value, 1 );
		}

		return ctype_digit( (string)$value );
	}

	/**
	 * Formats the parameter value to it's final result.
	 *
	 * @since 0.5
	 *
	 * @param $value mixed
	 * @param $param iParam
	 * @param $definitions array of iParamDefinition
	 * @param $params array of iParam
	 *
	 * @return mixed
	 */
	protected function formatValue( $value, iParam $param, array &$definitions, array $params ) {
		return (int)$value;
	}

}