<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auctions;
use Auth;

class AuctionController extends Controller
{

    
    protected $auctions;
    
    public function __construct(Auctions $auctions)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->auctions = $auctions;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userOnline = $this->userOnline();
        $auctions = $this->auctions->all();
        return view('auction.list', compact(['userOnline', 'auctions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate Request
        $this->auctions->validateAuctions();

        // Store & Select the Auctions
        $this->auctions->addAuctions($request);

        return redirect()->route('auction.image');
    }

    /**
     * Show the form for Upload an Image
     * route('auction.image');
     * @return Response
     */
    public function imageUpload()
    {
        $auction = Auth::user()->auctions()->latest()->first();
        return view('auction.imageUpload', compact('auction'));
    }

    /**
     * Store Uploaded image
     * @param Request&id
     * @return Response
     */
    public function imageUploadStore(Request $request, $id)
    {
        $this->auctions->imageUpload($request, $id);

        alert()->success('Updated!', 'The Picture has been Updated.');
        return response()->json(['status'=>true]);
    }
     
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auction = $this->auctions->find($id);
        $comments = $auction->comments;

        // Add Seen value +1
        $auction->seen++;
        $auction->save();

        return view('auction.show', compact(['auction', 'comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auction = $this->auctions->find($id);
        return view('auction.edit', compact('auction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Select the auction
        $auction = $this->auctions->find($id);
        // Validate the Auction
        $auction->validateAuctions();
        // Update Database
        $auction->update(request([
            'name', 'type', 'size', 'age', 
            'opening_price','start_date', 'deadline'
        ]));

        alert()->success('Saved!', 'Auctions has been saved!');

        return redirect()->route('auction.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->auctions->find($id)->delete();
        
        alert()->danger('Deleted!', 'The Auction has Been Deleted!');
        return redirect('auction');
    }
}
