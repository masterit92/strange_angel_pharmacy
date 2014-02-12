<?php
/**
 * Strange_Manufacturers_Block_Adminhtml_Catalog_Category_Renderer_Manufacturers
 *
 * @category    Strange
 * @package     Strange_Angel
 * @copyright   Copyright (c) 2014 Strange
 * @author      KhenNT
 */
class Strange_Manufacturers_Block_Adminhtml_Catalog_Category_Renderer_Manufacturers extends Varien_Data_Form_Element_Text
{
    public function toHtml()
    {
        $brandOrderElm = $this;

        // Get selected brands
        $values = array();
        $category = Mage::registry('current_category');
        if ($category) {
            $values = $category->getCatManufacturers();
        }

        $html = '<tr><td class="label">' . $brandOrderElm->getLabel() . '</td><td class="value"><table>';

        // Get all brands
        $manufacturerAttr = Mage::getModel('eav/config')->getAttribute('catalog_product', 'manufacturer');
        $brands = array();
        foreach ($manufacturerAttr->getSource()->getAllOptions(false) as $option) {
            $brands[$option['value']] = $option['label'];
        }

        // Generate form
        foreach ($brands as $brandValue => $brandName) {
            $checked = (array_key_exists($brandValue, $values) && array_key_exists('enabled', $values[$brandValue])
                && $values[$brandValue]['enabled'] == 'on') ? "checked" : "";
            $html .= '<tr>
                <td>
                    <input type="checkbox" name="general[cat_manufacturers][' . $brandValue . '][enabled]" id="cat_manufacturers_' . $brandValue . '" ' . $checked . '/>
                    <label>&nbsp;' . $brandName . '&nbsp; - &nbsp; Position</label>
                    <input type="text" name="general[cat_manufacturers][' . $brandValue . '][position]" id="cat_manufacturers_position_' . $brandValue . '" value="' . $values[$brandValue]['position'] . '"/>
                <td/>
            </tr>';
        }
        $html .= '</table></td></tr>';

        return $html;
    }
}