<?php

namespace App\PipelineObjects;

class PipelineObject
{
    protected $id;

    protected $name;

    protected $fields = [];

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->fromData($data);
        }
    }

    protected function fromData(array $data)
    {
        if (isset($data['id'])) {
            // https://forums.aws.amazon.com/thread.jspa?threadID=215165
            if ($data['id'] === 'Default') {
                $data['type'] = 'Default';
            }

            $this->id = $data['id'];
            unset($data['id']);
        }

        if (isset($data['name'])) {
            $this->name = $data['name'];
            unset($data['name']);
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->fields[] = [
                    'Key' => $key,
                    'RefValue' => current($value),
                ];
            } else {
                $this->fields[] = [
                    'Key' => $key,
                    'StringValue' => $value,
                ];
            }
        }
    }

    public function export()
    {
        return [
            'Id' => $this->id,
            'Name' => $this->name,
            'Fields' => $this->fields,
        ];
    }
}
