<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class CsvController extends Controller
{
    public function storeCsv(Request $request) {

      DB::beginTransaction();
      try{

        setlocale(LC_ALL, 'ja_JP.UTF-8');

        $uploaded_file = $request->file('csv_file');

        $file_path = $request->file('csv_file')->path($uploaded_file);

        $file = new \SplFileObject($file_path);
        $file->setFlags(\SplFileObject::READ_CSV|
                        \SplFileObject::READ_AHEAD|
                        \SplFileObject::SKIP_EMPTY|
                        \SplFileObject::DROP_NEW_LINE
                      );

        $row_count = 1;
        $list = [];
        $now = Carbon::now();
        foreach ($file as $row) {
          var_dump($row);

          //最初の列をスキップ
          if ($row_count > 1) {
            $name = mb_convert_encoding($row[0],'UTF-8','SJIS');
            $price = mb_convert_encoding($row[1],'UTF-8','SJIS');
            $detail = mb_convert_encoding($row[2],'UTF-8','SJIS');
            $description = mb_convert_encoding($row[3],'UTF-8','SJIS');
            $category_id = mb_convert_encoding($row[4],'UTF-8','SJIS');
            $stock = mb_convert_encoding($row[5],'UTF-8','SJIS');

            DB::table("products")->insert([
              "name" => $name,
              "price" => $price,
              "detail" => $detail,
              "description" =>  $description,
              "category_id" => $category_id,
              "stock" => $stock,
              "created_at" => $now,
              "updated_at" => $now,
            ]);
           }
          $row_count++;
         }
         DB::commit();

      } catch (\Exception $e) {
        
        DB::rollback();
      }
      return redirect()->back();
      }
}
