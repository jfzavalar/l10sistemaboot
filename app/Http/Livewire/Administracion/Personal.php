<?php

namespace App\Http\Livewire\Administracion;

use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Personal extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    //Variables spijweb
    // public $idspijweb,$usuariospijweb,$passwordspijweb,$estado_formato,$estado_userpass;
    Public $idpersonal,$dni,$datos,$sede,$dependencia,$regimen,$cargo,$correo_personal,$correo_institucional,$cel_personal,$cel_institucional,$activo;

    //Variables de modal Nuevo-Editar
    public $nuevo_editar="NUEVO",$color_modal_header="bg-primary-subtle",$color_boton="btn-outline-primary";
    public $guardar_actualizar;

    //Variables de modal buscar spijweb
    public $search;
    public function updatingsearch(){
        $this->resetPage();
    }

    //Variables de modal buscar personal
    public $searchpersonal;
    public function updatingsearchpersonal(){
        $this->resetPage();
    }
    //Variables de modal buscar sede_dependencia
    public $searchcargo;
    public function updatingsearchcargo(){
        $this->resetPage();
    }
    public $searchdependencia;
    public function updatingsearchdependencia(){
        $this->resetPage();
    }
    public $searchsede;
    public function updatingsearchsede(){
        $this->resetPage();
    }

    public function render()
    {
        $lista_activos = DB::table('tbl_personales')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo')
            ->where('activo',"1")
            ->where(function ($query) {$query
                ->where('dni', 'like', '%' . $this->search . '%')
                ->orWhere('datos', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id','desc')
            ->paginate(30);
        
        $lista_inactivos = DB::table('tbl_personales')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo')
            ->where('activo',"0")
            ->where(function ($query) {$query
                ->where('dni', 'like', '%' . $this->search . '%')
                ->orWhere('datos', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id','desc')
            ->paginate(30);

        $lista_personal = DB::table('tbl_personales')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo')
            ->where('dni','like','%' .$this->searchpersonal .'%')
            ->orwhere('datos','like','%' .$this->searchpersonal .'%')
            ->paginate(5);

        $lista_cargo = DB::table('tbl_cargos')
            ->select('cargo')
            ->where('activo','1')
            ->where('cargo','like','%' . $this->searchcargo . '%')
            ->orderBy('cargo')
            ->paginate(30);

        $lista_sede = DB::table('tbl_sedes_dependencias')
            ->select('sede')
            ->distinct()
            ->where('sede','like','%' . $this->searchsede . '%')
            ->orderBy('sede')
            ->paginate(30);

        $lista_dependencia = DB::table('tbl_sedes_dependencias')
            ->select('dependencia')
            ->distinct()
            ->where('sede',$this->sede)
            ->orderBy('dependencia')
            ->paginate(30);

        return view('livewire.administracion.personal',
            compact('lista_activos','lista_inactivos','lista_personal','lista_cargo','lista_sede','lista_dependencia'));
    }

    // -----------------------------------------------------------------------------------------------

    public function nuevo(){
        $this->nuevo_editar = "NUEVO";
        $this->color_modal_header = "bg-primary-subtle";
        $this->color_boton = "btn-outline-primary";

        $this->guardar_actualizar="guardar";

    }

    public function cerrar_nuevo(){
        //Reiniciar variables
        // $this->reset('idspijweb','usuariospijweb','passwordspijweb','estado_formato','estado_userpass');
        $this->reset('idpersonal','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');

        // ... algún error
        $this->dispatchBrowserEvent('cancelar-proceso');
    }

    // -----------------------------------------------------------------------------------------------

    public function cargo_agregar($cargo){
        $this->cargo = $cargo;
    }
    public function sede_agregar($sede){
        $this->sede = $sede;
    }
    public function sede_cerrar(){
        $this->reset('searchsede');
    }

    public function dependencia_agregar($dependencia){
        $this->dependencia = $dependencia;
    }
    public function dependencia_cerrar(){
        $this->reset('searchdependencia');
    }

    // -----------------------------------------------------------------------------------------------
    // Alertas
    protected $listeners = ['eliminar','reactivar'];
    public function eliminar($id)
    {
        $instanciaTbl = Tbl_spijweb::findOrFail($id);

        $instanciaTbl->update([
            'activo' => '0',
            'updated_user' => auth()->user()->datos,
        ]);

        // Notificar al navegador que se eliminó
        $this->dispatchBrowserEvent('registroEliminado');
    }

    public function reactivar($id)
    {
        $instanciaTbl = Tbl_spijweb::findOrFail($id);

        $instanciaTbl->update([
            'activo' => '1',
            'updated_user' => auth()->user()->datos,
        ]);

        // Notificar al navegador que se eliminó
        $this->dispatchBrowserEvent('registroActivado');
    }
}
