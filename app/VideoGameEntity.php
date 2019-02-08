<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoGameEntity extends Model
{
    protected $table = 'video_game_entity';

    protected $primaryKey = 'entity_id';

    private $data = [];

    public function entityInt()
    {
        return $this->hasMany(VideoGameEntityInt::class, 'entity_id');
    }

    public function addAttributeValues($collection)
    {
        $collection = clone $collection;
        foreach ($collection as $item) {
            $this->addItemAttributes($item);
        }
    }

    private function addItemAttributes($item)
    {
        $itemAttributes = [];
        foreach ($item->attributes as $key => $attribute) {
            $sku = $item->attributes['sku'];
            $itemAttributes[$key] = $attribute;
            $attributeSet = $this->prepareAttributeSetFromItem($item);
            $itemAttributes = array_merge($itemAttributes, $attributeSet);
            $this->data[$sku] = $itemAttributes;
        }
    }

    private function prepareAttributeSetFromItem($item)
    {
        $attributeGroup = [];
        foreach ($item->relations as $relation) {
            foreach ($relation as $attributeSet) {
                $attribute = $this->addAttributeLabelsById($attributeSet);
                $attributeGroup = $attributeSet->attributes;
                $attributeGroupInt = $attribute->attributes;
                $attributeGroup = array_merge($attributeGroup, $attributeGroupInt);
            }
        }
        return $attributeGroup;
    }

    private function addAttributeLabelsById($attributeSet)
    {
        return Attributes::where('attribute_id', $attributeSet->attributes['attribute_id'])->first();
    }

    public function getData()
    {
        return $this->data;
    }
}
