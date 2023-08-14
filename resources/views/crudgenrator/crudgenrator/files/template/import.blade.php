<{{ $data['wildcard'] }}php

namespace App\Imports;

use App\Models\{{ $data['model'] }};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str; @foreach($data['fields']['name'] as $index => $item) @if(array_key_exists('import_'.$index,$data['fields']['options'])) @if($data['fields']['input'][$index] == 'select_via_table')

use App\Models\{{ $data['model']}}; @endif @endif @endforeach


class {{ $data['model'] }}Import implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        {{ $variable }} = {{ $data['model'] }}::whereId(ltrim(str_replace('#'.preg_replace('~[^A-Z]~', '', '{{ $data['model'] }}'),'',$row[0]), '0'))->first();
        @foreach($data['fields']['name'] as $index => $item) @if(array_key_exists('import_'.$index,$data['fields']['options'])) @if($data['fields']['input'][$index] == 'select_via_table') @if($data['fields']['table'][$index] == "User")

        ${{ str_replace('_id','',$item) }} = {{ $data['fields']['table'][$index] }}::where(\DB::raw('CONCAT_WS(" ", `first_name`, `last_name`)'), 'like', '%' . $row[{{ $index + 1 }}] . '%')->first(); @else

        ${{ str_replace('_id','',$item) }} = {{ $data['fields']['table'][$index] }}::where('name',$row[{{ $index + 1 }}])->first(); @endif @endif @endif @endforeach
        {{ commentOutStart() }}  $user = User::where(\DB::raw('CONCAT_WS(" ", `first_name`, `last_name`)'), 'like', '%' . $row[1] . '%')->first();    {{ commentOutEnd() }}
        
        if({{ $variable }}){
            {{ $variable }}->update([
                @foreach($data['fields']['name'] as $index => $item) @if(array_key_exists('import_'.$index,$data['fields']['options'])) @if($data['fields']['input'][$index] == 'select_via_table')

                '{{ $item }}' => @${{ str_replace('_id','',$item) }}->id??0, @else

                '{{ $item }}' => $row[{{ $index + 1}}], @endif @endif @endforeach

            ]);
        }else{
            return new {{ $data['model'] }}([
                @foreach($data['fields']['name'] as $index => $item) @if(array_key_exists('import_'.$index,$data['fields']['options'])) @if($data['fields']['input'][$index] == 'select_via_table')

                '{{ $item }}' => @${{ str_replace('_id','',$item) }}->id??0, @else

                '{{ $item }}' => $row[{{ $index + 1}}], @endif @endif @endforeach

            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
