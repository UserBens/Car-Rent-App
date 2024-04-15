<?php

namespace App\Livewire;

use App\Models\Car as ModelsCar;
use Livewire\Component;
use Livewire\WithPagination;


class Admincar extends Component
{
    // public $layout = 'components.layouts.app';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $merk_mobil;
    public $kategori_mobil;
    public $plat_nomer;
    public $tahun_mobil;
    public $harga_sewa;

    public $keyword;
    public $sortColumn = 'merk_mobil';
    public $sortDirection = 'asc';

    public $updateData = false;
    public $cars_id;
    public $cars_selected_id = [];



    public function render()
    {
        if ($this->keyword != null) {
            $data = ModelsCar::where('merk_mobil', 'like', '%' . $this->keyword . '%')
                ->orwhere('plat_nomer', 'like', '%' . $this->keyword . '%')
                ->orwhere('kategori_mobil', 'like', '%' . $this->keyword . '%')
                ->orderby($this->sortColumn, $this->sortDirection)->paginate(2);
        } else {
            $data = ModelsCar::orderby($this->sortColumn, $this->sortDirection)->paginate(5);
        }

        return view('livewire.admincar', ['dataCars' => $data]);
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
            'plat_nomer.required' => 'Plat Nomer Wajib Di isi',
            'tahun_mobil.required' => 'Tahun Mobil Wajib Di isi',
            'harga_sewa.required' => 'Harga Sewa Wajib Di isi',
        ];

        $validated = $this->validate($rules, $messageerror);

        ModelsCar::create($validated);

        session()->flash('message', 'Data Berhasil Dimasukkan');
        $this->clear();
    }

    public function edit($id)
    {
        $data = ModelsCar::find($id);
        $this->merk_mobil = $data->merk_mobil;
        $this->plat_nomer = $data->plat_nomer;
        $this->tahun_mobil = $data->tahun_mobil;
        $this->kategori_mobil = $data->kategori_mobil;
        $this->harga_sewa = $data->harga_sewa;
        $this->updateData = true;
        $this->cars_id = $id;
    }

    public function update()
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
            'plat_nomer.required' => 'Plat Nomer Wajib Di isi',
            'tahun_mobil.required' => 'Tahun Mobil Wajib Di isi',
            'harga_sewa.required' => 'Harga Sewa Wajib Di isi',
        ];

        $validated = $this->validate($rules, $messageerror);

        $data = ModelsCar::find($this->cars_id);

        $data->update($validated);

        session()->flash('message', 'Data Berhasil Diupdate');

        $this->clear();
    }

    public function delete()
    {
        if ($this->cars_id != '') {
            $id = $this->cars_id;
            ModelsCar::find($id)->delete();
        }

        if (count($this->cars_selected_id)) {
            for ($x = 0; $x < count($this->cars_selected_id); $x++) {
                ModelsCar::find($this->cars_selected_id[$x])->delete();
            }
        }

        session()->flash('message', 'Data Berhasil Dihapus');
        // $this->clear();
    }

    public function deleteconfirm($id)
    {
        if ($id != '') {
            $this->cars_id = $id;
        }
    }

    public function clear()
    {
        $this->merk_mobil = '';
        $this->kategori_mobil = '';
        $this->plat_nomer = '';
        $this->tahun_mobil = '';
        $this->harga_sewa = '';
        $this->updateData = false;
        $this->cars_id = '';
        $this->cars_selected_id = [];
    }
}
