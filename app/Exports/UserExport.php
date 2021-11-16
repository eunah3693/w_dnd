<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UserExport implements FromQuery, WithHeadings, WithEvents
{
    use Exportable;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = User::query();
        if($this->request)
        {
            $query = $this->getDynamicQuery($query, $this->request);
        }
        return $query;
    }

    public function headings(): array
    {

        $data = array();

        $tableColumnInfos = DB::select('SHOW FULL COLUMNS FROM user_tbl');
        foreach ($tableColumnInfos as $tableColumnInfo) {
        if($tableColumnInfo->Field != 'password')
        {
            array_push($data, $tableColumnInfo->Field . ' (' . $tableColumnInfo->Comment .')');
        }
        }
        return $data;
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function(BeforeExport $event) {
                $event->writer->getDelegate()->getSecurity()->setLockWindows(true);
                $event->writer->getDelegate()->getSecurity()->setLockStructure(true);
                $event->writer->getDelegate()->getSecurity()->setWorkbookPassword("123");
            }];

    }
    public function getDynamicQuery($query, $request)
    {
        foreach($request as $key => $value)
        {
            if($value)
            {
                switch ( $key )
                {
                    case 'page' :
                        break;
                    case 'date' :
                        if( $request['startdate'] || $request['enddate'])
                        {
                            $query->whereBetween($value, [$request['startdate'], $request['enddate']]);
                        }
                        break;
                    case 'search':
                        $text = '%'.$request['text'].'%';
                        if( $request['text'] )
                        {
                            $query->where($value, 'like' , $text);
                        }
                        break;
                    case 'startdate':
                    case 'enddate':
                    case 'text':
                        break;
                    default :
                        $query->where($key, '=', $value);
                }

            }
        }
        return $query;
    }

}
