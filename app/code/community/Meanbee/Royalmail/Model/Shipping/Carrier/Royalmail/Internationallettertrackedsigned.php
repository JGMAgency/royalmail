<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@meanbee.com so we can send you a copy immediately.
 *
 * @category   Meanbee
 * @package    Meanbee_Royalmail
 * @copyright  Copyright (c) 2014 Meanbee Internet Solutions (http://www.meanbee.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Meanbee_Royalmail_Model_Shipping_Carrier_Royalmail_Internationallettertrackedsigned
    extends Meanbee_Royalmail_Model_Shipping_Carrier_Royalmail_Abstract {

    protected $insureOver = 50;
    protected $additionalInsuranceChargeEu = 2.50;
    protected $additionalInsuranceChargeWz = 2.50;

    public function getRates() {
        $_helper = Mage::helper('royalmail');
        $country = $this->_getCountry();
        $worldZone = $_helper->getWorldZone($country);


        if (!$_helper->isCountryAvailableForInternationalTrackedAndSigned($country)) {
            return null;
        }

        switch($worldZone) {
            case 'gb':
                return null;
            case 'eu':
                $rates = $_helper->addInsuranceCharges(
                    $this->_getEuRates(),
                    $this->additionalInsuranceChargeEu,
                    $this->getCartTotal(),
                    $this->insureOver
                );
                break;
            case 'wz1':
                $rates = $_helper->addInsuranceCharges(
                    $this->_getWzRates(),
                    $this->additionalInsuranceChargeWz,
                    $this->getCartTotal(),
                    $this->insureOver
                );
                break;
            case 'wz2':
                $rates = $_helper->addInsuranceCharges(
                    $this->_getWzRates(),
                    $this->additionalInsuranceChargeWz,
                    $this->getCartTotal(),
                    $this->insureOver
                );
                break;
            default:
                return null;
        }
        return $rates;
    }

    protected function _getEuRates() {
        return $this->_loadCsv('internationallettertrackedsigned_eu');
    }

    protected function _getWzRates() {
        return $this->_loadCsv('internationallettertrackedsigned_wz');
    }

}