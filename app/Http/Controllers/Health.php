<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Health as ModelHealth;

class Health extends Controller
{

    protected $date;

    protected $dataType;

    protected $fileContent;

    public function __construct(Request $request)
    {
        $file = $request->file('data_file');
        $without_extersion = str_replace('.txt', '', $file->getClientOriginalName());
        $file_handle = fopen($file->getRealPath(), 'r');
        $this->fileContent = fread($file_handle, $file->getSize());
        $this->date = $this->getDateFromFileName($without_extersion);
        $this->dataType = $this->getDataTypeFromFileName($without_extersion);
    }

    public function save()
    {
        $dataObj = $this->createDataObj();
        ModelHealth::create([
            'data_type' => $this->dataType,
            'data_time' => $this->date,
            'create_time' => time(),
            'data' => serialize($dataObj)
        ]);
        return response('true');
    }

    protected function getDataTypeFromFileName($file_name)
    {
        $file_info = explode('-', $file_name);
        switch ($file_info[2]) {
            case 'xin':
                return '1';
            case 'mai':
                return '2';
        }
    }

    protected function getDateFromFileName($file_name)
    {
        $file_info = explode('-', $file_name);
        return $file_info[0] . $file_info[1];
    }

    protected function createDataObj()
    {
        $data_obj = new \stdClass();
        $data_obj->data = explode(PHP_EOL, $this->fileContent);
        return $data_obj;
    }
}
