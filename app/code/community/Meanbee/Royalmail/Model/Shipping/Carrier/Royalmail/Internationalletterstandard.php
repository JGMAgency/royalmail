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

class Meanbee_Royalmail_Model_Shipping_Carrier_Royalmail_Internationalletterstandard
    extends Meanbee_Royalmail_Model_Shipping_Carrier_Royalmail_Abstract {


    public function getRates() {
        $_helper = Mage::helper('royalmail');
        $country = $this->_getCountry();
        $worldZone = $_helper->getWorldZone($country);


        switch($worldZone) {
            case Meanbee_Royalmail_Helper_Data::WORLD_ZONE_GB:
                return null;
            case Meanbee_Royalmail_Helper_Data::WORLD_ZONE_EU:
                $rates = $this->_getEuropeRates();
                break;
            case Meanbee_Royalmail_Helper_Data::WORLD_ZONE_ONE:
            case Meanbee_Royalmail_Helper_Data::WORLD_ZONE_TWO:
                $rates = $this->_getWzRates();
                break;
            default:
                return null;
        }
        return $rates;
    }

    protected function _getEuropeRates() {
        return $this->_loadCsv('internationalletterstandard_eu');
    }

    protected function _getWzRates() {
        return $this->_loadCsv('internationalletterstandard_wz');
    }

}
