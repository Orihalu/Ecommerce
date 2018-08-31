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
        $now = Carbon::now();
        $list = [];
        $max_count = count(file($uploaded_file, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES));

        foreach ($file as $row) {

            if($row_count > 1){

            //最初の列をスキップ
            //SJISからUTF-8に変換
            $name = mb_convert_encoding($row[0],'UTF-8','SJIS');
            $price = mb_convert_encoding($row[1],'UTF-8','SJIS');
            $detail = mb_convert_encoding($row[2],'UTF-8','SJIS');
            $description = mb_convert_encoding($row[3],'UTF-8','SJIS');
            $category_id = mb_convert_encoding($row[4],'UTF-8','SJIS');
            $stock = mb_convert_encoding($row[5],'UTF-8','SJIS');

            $list[] = [
              "name" => $name,
              "price" => $price,
              "detail" => $detail,
              "description" =>  $description,
              "category_id" => $category_id,
              "stock" => $stock,
              "created_at" => $now,
              "updated_at" => $now,
            ];

                if (count($list)/100 == 1) {
                    DB::table("products")->insert($list);
                    $list = [];
                }

            }
           $row_count++;
         }
         DB::table("products")->insert($list);
         DB::commit();

      } catch (\Exception $e) {

        DB::rollback();
      }
      return redirect()->back();
      }
}
