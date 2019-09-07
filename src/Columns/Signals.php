<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-09-03
 * Time: 04:44
 */

namespace App\Columns;

class Signals
{
    public function getColumns()
    {
        return [
            'khz' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'khz',
                'float'     =>  true,
                'highlight' =>  false,
                'label'     =>  'KHz',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.khz',
                'td_class'  =>  '',
                'th_class'  =>  '',
                'tooltip'   =>  'Nominal Carrier',
            ],
            'call' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'call',
                'highlight' =>  'call',
                'label'     =>  'ID',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.call',
                'sortLabel' =>  'ID - ',
                'td_class'  =>  '',
                'th_class'  =>  '',
                'tooltip'   =>  'Callsign or other ID',
            ],
            'LSB' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'LSB',
                'highlight' =>  false,
                'label'     =>  'LSB',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.LSB',
                'td_class'  =>  'txt_r',
                'th_class'  =>  '',
                'tooltip'   =>  'Lower sideband offset',
            ],
            'USB' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'USB',
                'highlight' =>  false,
                'label'     =>  'USB',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.USB',
                'td_class'  =>  'txt_r',
                'th_class'  =>  '',
                'tooltip'   =>  'Upper sideband offset',
            ],
            'sec' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'sec',
                'highlight' =>  false,
                'label'     =>  'Sec',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.sec',
                'td_class'  =>  'txt_r',
                'th_class'  =>  '',
                'tooltip'   =>  'Cycle time in seconds',
            ],
            'format' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'format',
                'highlight' =>  false,
                'label'     =>  'Fmt',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.format',
                'td_class'  =>  '',
                'th_class'  =>  '',
                'tooltip'   =>  'Format',
            ],
            'QTH' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'QTH',
                'highlight' =>  false,
                'label'     =>  '\'Name\' and Location',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.QTH',
                'td_class'  =>  '',
                'th_class'  =>  '',
                'tooltip'   =>  '',
            ],
            'SP' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'SP',
                'highlight' =>  'states',
                'label'     =>  'S/P',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.SP',
                'td_class'  =>  '',
                'th_class'  =>  '',
                'tooltip'   =>  'State / Province / Territory',
            ],
            'ITU' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'ITU',
                'highlight' =>  'countries',
                'label'     =>  'ITU',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.ITU',
                'td_class'  =>  '',
                'th_class'  =>  '',
                'tooltip'   =>  'Country',
            ],
            'region' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'region',
                'highlight' =>  false,
                'label'     =>  '<div>Region</div>',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.region',
                'td_class'  =>  'caps',
                'th_class'  =>  'txt_vertical',
                'tooltip'   =>  '',
            ],
            'GSQ' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'GSQ',
                'highlight' =>  'gsq',
                'label'     =>  'GSQ',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.GSQ',
                'td_class'  =>  'txt_r monospace',
                'th_class'  =>  '',
                'tooltip'   =>  'Signal Grid Square',
            ],
            'pwr' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'pwr',
                'highlight' =>  false,
                'label'     =>  'Pwr',
                'labelSort' =>  '',
                'order'     =>  'd',
                'sort'      =>  's.pwr',
                'td_class'  =>  'txt_r',
                'th_class'  =>  '',
                'tooltip'   =>  'Power in Watts',
            ],
            'notes' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'notes',
                'highlight' =>  false,
                'label'     =>  'Notes',
                'labelSort' =>  'Notes',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  's.notes',
                'td_class'  =>  '',
                'th_class'  =>  '',
                'tooltip'   =>  'Notes about this signal',
            ],
            'heard_in' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'heard_in_html',
                'highlight' =>  'heard_in',
                'label'     =>  'Heard In<br /><b>(Daytime Log)</b>',
                'labelSort' =>  'Heard In',
                'order'     =>  'a',
                'sort'      =>  's.heard_in',
                'td_class'  =>  '',
                'th_class'  =>  '',
                'tooltip'   =>  'Places signal has been reported',
            ],
            'logs' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'logs',
                'highlight' =>  false,
                'label'     =>  'Logs',
                'labelSort' =>  '',
                'order'     =>  'd',
                'sort'      =>  's.logs',
                'td_class'  =>  'txt_r',
                'th_class'  =>  '',
                'tooltip'   =>  'Number of times logged',
            ],
            'first_heard' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'first_heard',
                'highlight' =>  false,
                'label'     =>  'First Logged',
                'labelSort' =>  '',
                'order'     =>  'd',
                'sort'      =>  's.first_heard',
                'td_class'  =>  'text-nowrap txt_r monospace',
                'th_class'  =>  '',
                'tooltip'   =>  '',
            ],
            'last_heard' => [
                'admin'     =>  false,
                'arg'       =>  '',
                'field'     =>  'last_heard',
                'highlight' =>  false,
                'label'     =>  'Last Logged',
                'labelSort' =>  '',
                'order'     =>  'd',
                'sort'      =>  's.last_heard',
                'td_class'  =>  'text-nowrap txt_r monospace',
                'th_class'  =>  '',
                'tooltip'   =>  '',
            ],
            'range_km' => [
                'admin'     =>  false,
                'arg'       =>  'range_gsq',
                'field'     =>  'range_km',
                'highlight' =>  false,
                'label'     =>  'KM',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  'range_km',
                'td_class'  =>  'txt_r monospace',
                'th_class'  =>  '',
                'tooltip'   =>  'Kilometers from GSQ',
            ],
            'range_mi' => [
                'admin'     =>  false,
                'arg'       =>  'range_gsq',
                'field'     =>  'range_mi',
                'highlight' =>  false,
                'label'     =>  'Miles',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  'range_mi',
                'td_class'  =>  'txt_r monospace',
                'th_class'  =>  '',
                'tooltip'   =>  'Miles from GSQ',
            ],
            'range_deg' => [
                'admin'     =>  false,
                'arg'       =>  'range_gsq',
                'field'     =>  'range_deg',
                'highlight' =>  false,
                'label'     =>  'Deg',
                'labelSort' =>  '',
                'order'     =>  'a',
                'sort'      =>  'range_deg',
                'td_class'  =>  'txt_r monospace',
                'th_class'  =>  '',
                'tooltip'   =>  'Bearing relative to GSQ',
            ],
//            'admin' => [
//                'admin'     =>  true,
//                'arg'       =>  '',
//                'field'     =>  'formattedDeleteLink',
//                'highlight' =>  false,
//                'label'     =>  'Admin',
//                'order'     =>  '',
//                'sort'      =>  '',
//                'td_class'  =>  '',
//                'th_class'  =>  '',
//                'tooltip'   =>  '',
//            ],
        ];
    }
}
