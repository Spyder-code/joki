<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\FreelanceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FreelanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $freelanceRepository;

    public function __construct(FreelanceRepository $freelanceRepository)
    {
        $this->freelanceRepository = $freelanceRepository;
    }

    public function index()
    {
        $freelance = $this->freelanceRepository->getAll();
        return view('admin.freelance.index', compact('freelance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.freelance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['avatar'] = 'default.png';
        $data['phone'] = $this->hp($request->phone);
        $data['password'] = Hash::make($request->password);
        $this->freelanceRepository->save($data);
        return redirect(route('freelance.index'))->with('success','Create Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $freelance)
    {
        $freelance['phone'] = $this->hpToZero($freelance->phone);
        return view('admin.freelance.edit', compact('freelance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $freelance)
    {
        $data = $request->all();
        $data['phone'] = $this->hp($request->phone);
        $this->freelanceRepository->update($data, $freelance->id);
        return redirect(route('freelance.index'))->with('success','Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $freelance)
    {
        $this->freelanceRepository->delete($freelance->id);
        return back()->with('success','Delete user '.$freelance->name.' Success');
    }

    function hp($nohp) {
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 2)=='62'){
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '62'.substr(trim($nohp), 1);
            }
        }
        return $hp;
    }

    public function hpToZero($hp)
    {
        $hp0 = substr_replace($hp,'0',0,2);
        return $hp0;
    }
}
