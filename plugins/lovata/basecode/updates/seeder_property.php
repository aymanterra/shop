<?php namespace Lovata\BaseCode\Updates;

use Lovata\BaseCode\Classes\AbstractModelSeeder;

/**
 * Class SeederProperty
 * @package Lovata\BaseCode\Updates
 */
class SeederProperty extends AbstractModelSeeder
{
    protected $sTableName = 'lovata_properties_shopaholic_properties';
    protected $sFilePath = 'lovata/basecode/csv/property_list.csv';

    protected $arFieldList = ['active', 'name', 'type', 'measure_id', 'description', 'sort_order'];

    /** @var \Lovata\PropertiesShopaholic\Models\Property */
    protected $obModel;

    /**
     * @return string
     */
    protected function getModelName()
    {
        return \Lovata\PropertiesShopaholic\Models\Property::class;
    }

    /**
     * Process row from csv file
     */
    protected function process()
    {
        parent::process();

        //Get value list
        $sValueList = array_shift($this->arRowData);
        if(empty($sValueList)) {
            return;
        }

        $arValueList = explode('|', $sValueList);

        $arSettings = ['list' => []];

        //Prepare settings array
        foreach ($arValueList as $sValue) {

            if(empty($sValue)) {
                continue;
            }

            $arSettings['list'][] = ['value' => $sValue];
        }

        $this->obModel->settings = $arSettings;
        $this->obModel->save();
    }
}