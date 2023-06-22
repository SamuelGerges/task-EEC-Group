<?php

namespace App\Helpers;

class TransformHelper
{

    public static function getImageFullLinkForObject($object, $imageColumnName)
    {
        $object->{$imageColumnName} = url($object[$imageColumnName]);
        return $object;
    }

    public static function getImageFullLinkForCollection($object, $imageColumnName)
    {
        foreach ($object as $key => $value) {
            $object[$key][$imageColumnName] = url($object[$key][$imageColumnName]);
        }

        return $object;
    }


}
