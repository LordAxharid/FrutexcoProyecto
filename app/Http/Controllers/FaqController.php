<?php

namespace App\Http\Controllers;
use App\Faq;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FaqsExport;
use App\Imports\FaqsImport;
class FaqController extends Controller
{
    public function Faq(){


        $date = Faq::get();
        $Faq = Faq::where('status','1')->get();
        return view('faq.indexFaq')->with(compact('Faq'));


        }
        public function viewFaqAdmin(Request $request){

            $Faq = Faq::get();
            return view('admin.faq.view_faq')->with(compact('Faq'));

    }
    public function addFaqs(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
            $Faq = new Faq;
            $Faq->ask = $data['ask'];
			$Faq->answer = $data['answer'];

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }
            $Faq->status = $status;
			$Faq->save();
			return redirect()->back()->with('flash_message_success', 'Pregunta/Respuesta agregada correctamente');

    }
    return view('admin.faq.add_faq');
    }



    public function deleteFaq($id = null){
        Faq::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'La Pregunta/Respuesta ha sido eliminada exitosamente');
    }



    public function editFaqs(Request $request, $id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            if(empty($data['answer'])){
                $data['answer'] = '';
            }

        Faq::where('id',$id)->update(['status'=>$status,'answer'=>$data['answer'],'ask'=>$data['ask']]);
        return redirect()->back()->with('flash_message_success','La Pregunta/Respuesta ha sido editada exitosamente');


}

$FaqDetails = Faq::where('id',$id)->first();
return view('admin.faq.edit_faq')->with(compact('FaqDetails'));
    }


    public function exportFaqs(){
        return Excel::download(new FaqsExport,'PreguntasFrecuentes.xlsx');
    }

    public function importFaqs(Request $request){
      $file = $request->file('file');
      Excel::import(new FaqsImport, $file);

      return redirect()->back()->with('flash_message_success','Las Pregunta/Respuesta Han Sido Importadas Correctamente');
    }


}


