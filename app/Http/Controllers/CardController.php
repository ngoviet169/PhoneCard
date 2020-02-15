<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Card;
use Maatwebsite\Excel\Facades\Excel;

class CardController extends Controller
{
    public function genCard() {
    	$card = Card::where('is_gen', '=', 0)->first();

    	if($card) {
    		$card->is_gen = 1;

	    	$card->save();
    	}

    	return [
    		'card' => $card
    	];
 	
    }

    public function uploadFile(Request $request) {
    	$validatedData = $request->validate([
	        'file' => 'required'
	    ]);
    	$arr_file = Excel::toArray(null, $request->file);
        $arr_file = $arr_file[0];
        if($arr_file[0][0] == 1) {
        	foreach ($arr_file as $key => $value) {
	        	$seri = '';
	        	$code = '';
	        	foreach ($value as $key1 => $value1) {
	        		if(strlen($value1) > 50) {
	        			$arr = explode(' ', $value1);
	        			foreach ($arr as $key2 => $val) {
			        		if(strlen(trim($val)) === 15 && (int) $val > 0) {
			        			$code = trim($val);
			        		}
			        		if(strlen(trim($val)) === 14 && (int) $val > 0) {
			        			$seri = trim($val);
			        		}
			        	}
	        		}
	        	}
	        	if(!empty($seri) && !empty($code)) {
	    			DB::table('card')->insert(
					    array('seri' => $seri,
					          'code' => $code,
					          'is_gen' => 0,
					          'created_at' => date('Y-m-d H:i:s'),
					          'updated_at' => date('Y-m-d H:i:s')
					    	)
					);
	    		}
	        }
        } elseif($arr_file[0][0] == 2) {
        	$seri = '';
        	$code = '';
        	foreach ($arr_file as $key => $value) {
        		if(strlen(trim($value[0])) === 15 && (int) $value[0] > 0) {
        			$code = trim($value[0]);
        		}
        		if(strlen(trim($value[0])) === 14 && (int) $value[0] > 0) {
        			$seri = trim($value[0]);
        		}

        		if(!empty($seri) && !empty($code)) {
	    			DB::table('card')->insert(
					    array('seri' => $seri,
					          'code' => $code,
					          'is_gen' => 0,
					          'created_at' => date('Y-m-d H:i:s'),
					          'updated_at' => date('Y-m-d H:i:s')
					    	)
					);
					$seri = '';
        			$code = '';
	    		}
        	}
        }
        

        return view('welcome');
    }
}
