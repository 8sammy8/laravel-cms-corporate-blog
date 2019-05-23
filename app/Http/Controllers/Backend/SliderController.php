<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SliderRequest;
use App\Repositories\SlidersRepository;

class SliderController extends BackendController
{
    /**
     * SliderController constructor.
     * @param SlidersRepository $slidersRepository
     */
    public function __construct(SlidersRepository $slidersRepository)
    {
        parent::__construct();

        $this->rep = $slidersRepository;

        $this->template .= 'slider.';
        $this->title .= ' Slider';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title .= ' view';
        $this->vars = array_add($this->vars, 'sliders', $this->rep->make());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->title .= ' create';
    }

    /**
     * @param SliderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(SliderRequest $request)
    {
        $result = $this->rep->store($request);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.sliders.index')->with($result);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     */
    public function show($id)
    {
        $this->title .= ' show';
        $this->one($id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function edit($id)
    {
        $this->title .= ' edit';
        $this->one($id);
    }

    /**
     * @param SliderRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(SliderRequest $request, $id)
    {
        $result = $this->rep->update($request, $id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.sliders.index')->with($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->rep->destroy($id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.sliders.index')->with($result);
    }

    /**
     * @param int $id
     */
    private function one($id)
    {
        $slider = $this->rep->one($id);

        if($slider) $this->vars = array_add($this->vars, 'slider', $slider);
        $this->vars = array_add($this->vars, 'sliderLangs', $slider->sliderLangs->keyBy('lang'));
    }
}
