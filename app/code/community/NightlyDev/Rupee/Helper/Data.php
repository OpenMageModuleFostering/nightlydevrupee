<?php
class NightlyDev_Rupee_Helper_Data extends Mage_Core_Helper_Abstract
{
  const XML_PATH_RUPEE_ENABLED  = 'currency/options/rupee_enabled';
  const FILE_PATH_CURRENCY_ROOT = '/Zend/Locale/Data/root.xml';
  const RUPEE_SYMBOL            = '₹';
  
  public function getToSymbol() {
    $data = Mage::getModel('currencysymbol/system_currencysymbol')->getCurrencySymbolsData();
    if (in_array('INR',array_keys($data))) {
      return $data['INR']['displaySymbol']=='Rs'?self::RUPEE_SYMBOL:'Rs';
    }
  }
  
  public function convertToSymbol() {
    $new_symbol = self::getToSymbol();
    $cur_symbol = $new_symbol=='Rs'?self::RUPEE_SYMBOL:'Rs';
    $pattern = <<<PATTERN
<currency type="INR">
				<symbol>$cur_symbol</symbol>
PATTERN;
    $replacement = <<<PATTERN
<currency type="INR">
				<symbol>$new_symbol</symbol>
PATTERN;
    file_put_contents(Mage::getBaseDir('lib').self::FILE_PATH_CURRENCY_ROOT, str_replace($pattern, $replacement, file_get_contents(Mage::getBaseDir('lib').self::FILE_PATH_CURRENCY_ROOT)));
    return 'Done! but remember to remove var/cache.';
  }
}
