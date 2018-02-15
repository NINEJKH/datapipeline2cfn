<?php

namespace App;

class Converter
{
    public static function convert(array $objects)
    {
        $converted_objects = [];

        foreach ($objects as $object) {
            if ($object['id'] === 'Default') {
                //
            } else {
                //
            }

            $converted_objects[] = new \App\PipelineObjects\PipelineObject($object);
        }


        return $converted_objects;
    }

    public static function export(array $objects)
    {
        $return = [];

        foreach ($objects as $object) {
            $return[] = $object->export();
        }

        return $return;
    }
}
