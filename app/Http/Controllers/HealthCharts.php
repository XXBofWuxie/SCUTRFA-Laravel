<?php
namespace App\Http\Controllers;

use App\Health;
use Illuminate\Support\Facades\Input;

class HealthCharts extends Controller
{

    public function getChartsList()
    {
        $data['heartbeat'] = Health::where('data_type', '=', '1')->get(array(
            'data_time',
            'create_time'
        ));
        $data['pulse'] = Health::where('data_type', '=', '2')->get(array(
            'data_time',
            'create_time'
        ));
        return response()->json($data);
    }

    public function getChartData()
    {
        $create_time = Input::get('createTime');
        $serialized = Health::where('create_time', '=', $create_time)->get(array('data'));
        $data = unserialize($serialized[0]['data']);
        return response()->json($data);
    }
}
