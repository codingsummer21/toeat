<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toit;
use Illuminate\Support\Facades\DB;

class ModeratorController extends Controller
{
    public function viewReported() {
        $context['reported_toits'] = Toit::where('display', 1)->has('reportedBy')->get();

        return view('toeat.reported_toits_list', $context);
    }

    public function acceptReport($toit_id) {
        $toit = Toit::find($toit_id);

        $user = auth()->user();
        $toit->display = 0;
        $toit->moderator_id = $user->id;
        $toit->save();

        $affected = DB::table('user_reports_toits')
            ->where('toit_id', $toit_id)
            ->update(['accepted' => 1]);

        return redirect('/moderate/reported');
    }

    public function rejectReport($toit_id) {
        $toit = Toit::find($toit_id);

        $affected = DB::table('user_reports_toits')
            ->where('toit_id', $toit_id)
            ->update(['accepted' => 0]);

        return redirect('/moderate/reported');
    }
}
