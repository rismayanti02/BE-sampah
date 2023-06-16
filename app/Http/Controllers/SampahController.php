<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\formatAPI;
use App\Models\Sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SampahController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  
   public function index(Request $request)
   {
       $sampah = Sampah::all();
       // Search function
       if ($request->query('search_no_rumah')){ // membuat pencarian berdasarkan no_rumah
           $search = $request->query('search_no_rumah');

           $sampah = Sampah::where('no_rumah', $search)->get();
           if($request->query('limit')); {
               $limit = $request->query('limit');

           $sampah = Sampah::where('no_rumah', $search)->limit($limit)->get();
       }
   }
   // End Search Function

       if($sampah){
           return formatAPI::createAPI(200,'Success',$sampah);
       }else{
           return formatAPI::createAPI(400,'Failed');
       }
   }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
     
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $total = $request->total_karung_sampah;
    $kriteria = 'standar';
    if($total > 3){
        $kriteria = 'collapse';
    }

      $sampah = Sampah::create ([
          'kepala_keluarga' => $request->kepala_keluarga,
          'no_rumah' =>  $request->no_rumah,
          'rt_rw' => $request ->rt_rw,
          'total_karung_sampah' => $request ->total_karung_sampah,
          'kriteria' => $kriteria,
          'tanggal_pengangkutan' => $request ->tanggal_pengangkutan,
      ]);

      if($sampah){
        return formatAPI::createAPI(200,'Success',$sampah);
    }else{
        return formatAPI::createAPI(400,'Failed');
    }
    }
   
  

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Sampah  $sampah
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $response = Sampah::where('id', $id)->get();
    return $response;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Sampah  $sampah
   * @return \Illuminate\Http\Response
   */
  public function edit(Sampah $sampah)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Sampah  $sampah
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request,  $id)
  {
    $sampah = Sampah::where('id', $id);
      $sampah->update($request->all());
      $sampah = $sampah->get();

      if($sampah){
        return formatAPI::createAPI(200,'Success',$sampah);
    }else{
        return formatAPI::createAPI(400,'Failed');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Sampah  $sampah
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $sampah = Sampah::where('id', $id);
      $sampah->delete();
      if($sampah){
        return formatAPI::createAPI(200,'Success',$sampah);
    }else{
        return formatAPI::createAPI(400,'Failed');
    }
  }
  //? Trash function

  public function getTrash()
  {
      try {
          $sampah= Sampah::onlyTrashed()->get(); // mengambil semua sampah

          if($sampah){
              return formatAPI::createAPI(200, 'berhasil', $sampah);
          }else{
              return formatAPI::createAPI(400, 'Failed');
          }
      }catch(Exception $error){
          return formatAPI::createAPI(400, 'gagal', $error);

      }
  }

  public function restore($id)
  {
      try{
          $sampah = Sampah::onlyTrashed()->findorfail($id);
          $sampah = $sampah->restore();
          $sampah= Sampah::where('id', $id)->get();

          if($sampah){
              return formatAPI::createAPI(200, 'berhasil', $sampah);
          }else{
              return formatAPI::createAPI(400, 'Failed');
          }
      }catch(Exception $error){
          return formatAPI::createAPI(400, 'gagal', $error);

      }
  }

  public function deleteTrash($id)
  {
      try{
          $sampah = Sampah::onlyTrashed()->findorfail($id);
          $sampah= $sampah->forceDelete();

          if($sampah){
              return formatAPI::createAPI(200, 'berhasil', 'Berhasil hapus permanent sampah');
          }else{
              return formatAPI::createAPI(400, 'Failed');
          }
      }catch(Exception $error){
          return formatAPI::createAPI(400, 'gagal', $error);

      }
  }
}
