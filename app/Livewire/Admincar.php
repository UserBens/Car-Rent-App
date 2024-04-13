<?php

namespace App\Livewire;

use App\Models\Car as ModelsCar;
use Livewire\Component;

class Admincar extends Component
{
    // public $layout = 'components.layouts.app';

    public $merk_mobil;
    public $kategori_mobil;
    public $plat_nomer;
    public $tahun_mobil;
    public $harga_sewa;

    public $keyword;
    public $sortColumn = 'merk_mobil';
    public $sortDirection = 'asc';

    public function render()
    {
        if ($this->keyword != null) {
            $data = ModelsCar::where('merk_mobil', 'like', '%' . $this->keyword . '%')
                ->orwhere('plat_nomer', 'like', '%' . $this->keyword . '%')
                // ->orwhere('alamat', 'like', '%' . $this->keyword . '%')
                ->orderby($this->sortColumn, $this->sortDirection)->paginate(2);
        } else {
            $data = ModelsCar::orderby($this->sortColumn, $this->sortDirection)->paginate(5);
        }

        return view('livewire.admincar', ['dataCars' => $data]);

        // return view('livewire.admincar');
    }

    public function store()
    {
        $rules = [
            'merk_mobil' => 'required',
            'plat_nomer' => 'required',
            'tahun_mobil' => 'required',
            'kategori_mobil' => 'required',
            'harga_sewa' => 'required',
        ];

        $messageerror = [
            'merk_mobil.required' => 'Merk Mobil Wajib Di isi',
            'kategori_mobil.required' => 'Kategori Mobil Wajib Di isi',
            // 'email.email' => 'Format Email Tidak Sesuai',
            'plat_nomer.required' => 'Plat Nomer Wajib Di isi',
            'tahun_mobil.required' => 'Tahun Mobil Wajib Di isi',
            'harga_sewa.required' => 'Harga Sewa Wajib Di isi',
        ];

        $validated = $this->validate($rules, $messageerror);

        ModelsCar::create($validated);

        session()->flash('message', 'Data Berhasil Dimasukkan');

    }


   
}
