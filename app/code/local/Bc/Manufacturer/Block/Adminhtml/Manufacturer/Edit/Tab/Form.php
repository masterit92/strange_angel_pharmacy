<?php

class Bc_Manufacturer_Block_Adminhtml_Manufacturer_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('manufacturer_form', array('legend' => Mage::helper('manufacturer')->__('Manufacturer information')));
        //get Manufecturer's Attribut options
        //DebugBreak();
        $attribute_code = Mage::getModel('eav/entity_attribute')->getIdByCode('catalog_product', "manufacturer");
        $attributeInfo = Mage::getModel('eav/entity_attribute')->load($attribute_code);
        $attribute_table = Mage::getModel('eav/entity_attribute_source_table')->setAttribute($attributeInfo);
        $attributeOptions = $attribute_table->getAllOptions(false);
        $default = array('value' => '', 'label' => 'Choose Brand');
        $i = 0;
        $manufacturer[$i] = $default;
        foreach ($attributeOptions as $key => $value) {
            $i++;
            $manufacturer[$i] = $value;
        }
        //End
        $fieldset->addField('menufecturer_name', 'select', array(
            'label' => Mage::helper('manufacturer')->__('Select Manufacturer'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'menufecturer_name',
            'values' => $manufacturer,
        ));

        $fieldset->addField('legend', 'text', array(
            'label' => Mage::helper('manufacturer')->__('Legend'),
            'required' => false,
            'name' => 'legend',
        ));


        //At the time of insert of manufacturer the image uploaded is reqired
        //While time of Edit the control can be blank
        if (Mage::registry('manufacturer_data')->getData('filename') != "") {
            $fieldset->addField('filename', 'file', array(
                'label' => Mage::helper('manufacturer/data')->__('Brand Logo'),
                'required' => false,
                'name' => 'filename',
                'after_element_html' => Mage::registry('manufacturer_data')->getData('filename') != "" ? '<span class="hint"><img src="' . Mage::getBaseUrl('media') . "Manufacturer/" . Mage::registry('manufacturer_data')->getData('filename') . '" width="25" height="25" name="manufacturer_image" style="vertical-align: middle;" /></span>' : '',
            ));
        } else {
            $fieldset->addField('filename', 'file', array(
                'label' => Mage::helper('manufacturer/data')->__('Brand Logo'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'filename',
                'after_element_html' => Mage::registry('manufacturer_data')->getData('filename') != "" ? '<span class="hint"><img src="' . Mage::getBaseUrl('media') . "Manufacturer/" . Mage::registry('manufacturer_data')->getData('filename') . '" width="25" height="25" name="manufacturer_image" style="vertical-align: middle;" /></span>' : '',
            ));
        }
        //<br/><input type="checkbox" name="image_chk" id="image_chk"/><label for="image_chk"> Delete Image</label>

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('manufacturer')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('manufacturer')->__('Enabled'),
                ),

                array(
                    'value' => 2,
                    'label' => Mage::helper('manufacturer')->__('Disabled'),
                ),
            ),
        ));

        $fieldset->addField('show_on_homepage', 'select', array(
            'label' => Mage::helper('manufacturer')->__('Show On Homepage'),
            'name' => 'show_on_homepage',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('manufacturer')->__('Yes'),
                ),

                array(
                    'value' => 2,
                    'label' => Mage::helper('manufacturer')->__('No'),
                ),
            ),
        ));

        $fieldset->addField('position', 'text', array(
            'label' => Mage::helper('manufacturer')->__('Position On Slider'),
            'required' => false,
            'name' => 'position',
        ));


        /*$fieldset->addField('content', 'editor', array(
        'name'      => 'content',
        'label'     => Mage::helper('manufacturer')->__('Content'),
        'title'     => Mage::helper('manufacturer')->__('Content'),
        'style'     => 'width:700px; height:500px;',
        'wysiwyg'   => false,
        'required'  => true,
        ));*/

        if (Mage::getSingleton('adminhtml/session')->getManufacturerData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getManufacturerData());
            Mage::getSingleton('adminhtml/session')->setManufacturerData(null);
        } elseif (Mage::registry('manufacturer_data')) {
            $form->setValues(Mage::registry('manufacturer_data')->getData());
        }

        // Add field dependence
        $this->setChild('form_after', $this->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
            ->addFieldMap('show_on_homepage', 'show_on_homepage')
            ->addFieldMap('position', 'position')
            ->addFieldDependence('position', 'show_on_homepage', 1));

        return parent::_prepareForm();
    }
}