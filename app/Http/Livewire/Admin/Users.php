<?php

namespace App\Http\Livewire\Admin;

use App\Mail\NotificacionInformatica;
use App\Models\Tbl_personale;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    //Variables user
    public $iduser;
    public $password1,$password2;
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
    public $searchsede;
    public function updatingsearchsede(){
        $this->resetPage();
    }
    public $searchdependencia;
    public function updatingsearchdependencia(){
        $this->resetPage();
    }

    public function render()
    {
        $lista_activos = User::with('roles')
            ->where('activo',"1")
            ->where('id','!=',1)
            ->where(function ($query) {$query
                ->where('dni', 'like', '%' . $this->search . '%')
                ->orWhere('datos', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id','desc')
            ->paginate(10);
        
        $lista_inactivos = User::with('roles')
            ->where('activo',"0")
            ->where('id','!=',1)
            ->where(function ($query) {$query
                ->where('dni', 'like', '%' . $this->search . '%')
                ->orWhere('datos', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id','desc')
            ->paginate(10);

        $lista_personal = DB::table('tbl_personales')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo')
            ->where('dni','like','%' .$this->searchpersonal .'%')
            ->orwhere('datos','like','%' .$this->searchpersonal .'%')
            ->paginate(5);

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
            ->paginate();

        // $users = User::with('roles')->paginate();
        return view('livewire.admin.users',
            compact('lista_activos','lista_inactivos','lista_personal','lista_sede','lista_dependencia'));
    }

    public function nuevo(){
        $this->nuevo_editar = "NUEVO";
        $this->color_modal_header = "bg-primary-subtle";
        $this->color_boton = "btn-outline-primary";

        $this->guardar_actualizar="guardar";

    }

    public function guardar(){
        $this->validate([
            'dni' => 'required|unique:users,dni',
        ]);

        User::create([
            // 'id',
            'dni' => $this->dni,
            'datos' => $this->datos,
            'sede' => $this->sede,
            'dependencia' => $this->dependencia,
            'regimen' => $this->regimen,
            'cargo' => $this->cargo,
            'correo_personal' => $this->correo_personal,
            'correo_institucional' => $this->correo_institucional,
            'cel_personal' => $this->cel_personal,
            'cel_institucional' => $this->cel_institucional,
            'password' => bcrypt($this->dni),
            'activo' => "1",
            //
            'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
        ]);

        //Reiniciar variables
        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');
    
        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function cargarPDF(){
        $this->validate([
            'pdf' => 'required|mimes:pdf|max:4096', // Máx. 4MB
        ]);

        // Generar un nombre personalizado con timestamp
        $fileName = $this->dni . '_' . '.' . $this->pdf->getClientOriginalExtension();

        // Guardar en la carpeta storage/app/public/pdfs
        $path = $this->pdf->storeAs('public/archivos/informatica/tokens', $fileName);

        //guardar ruta del archivo
        $instanciaTbl= User::find($this->iduser);

        $instanciaTbl->update([
            'actaruta' =>str_replace( 'public/','storage/',$path),

            'updated_user' => auth()->user()->datos,
        ]);
    }

    public function exportarPDF($id)
    {
        $instanciaTbl = User::findOrFail($id);

        $pdf = Pdf::loadView('pdf.informatica.spijweb-acta', compact('instanciaTbl'));

        //Mostrar PDF
        // return $pdf->stream('spijweb_'.$instanciaTbl->dni.'.pdf');
        
        //Descargar PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'spijweb_'.$instanciaTbl->dni.'.pdf');
    }

    public function cerrar_nuevo(){
        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');

        // ... algún error
        $this->dispatchBrowserEvent('cancelar-proceso');
    }

    // -----------------------------------------------------------------------------------------------
    
    public function editar(User $instanciaTbl){
        $this->nuevo_editar = "EDITAR";
        $this->color_modal_header = "bg-success-subtle";
        $this->color_boton = "btn-outline-success";
        $this->guardar_actualizar="actualizar";
        
        // - Editar -
        $this->iduser = $instanciaTbl->id;
        $this->dni = $instanciaTbl->dni;
        $this->datos = $instanciaTbl->datos;
        $this->sede = $instanciaTbl->sede;
        $this->dependencia = $instanciaTbl->dependencia;
        $this->regimen = $instanciaTbl->regimen;
        $this->cargo = $instanciaTbl->cargo;
        $this->correo_personal = $instanciaTbl->correo_personal;
        $this->correo_institucional = $instanciaTbl->correo_institucional;
        $this->cel_personal = $instanciaTbl->cel_personal;
        $this->cel_institucional = $instanciaTbl->cel_institucional;
        $this->activo = $instanciaTbl->activo;
    }

    public function actualizar(){
        $instanciaTbl = User::findOrFail($this->iduser);

        $instanciaTbl->update([
            // 'id',
            'dni' => $this->dni,
            'datos' => $this->datos,
            'sede' => $this->sede,
            'dependencia' => $this->dependencia,
            'regimen' => $this->regimen,
            'cargo' => $this->cargo,
            'correo_personal' => $this->correo_personal,
            'correo_institucional' => $this->correo_institucional,
            'cel_personal' => $this->cel_personal,
            'cel_institucional' => $this->cel_institucional,
            'password' => bcrypt($this->dni),
            'activo' => "1",
            //
            // 'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
        ]);

        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');

        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function cerrar_actualizar(){
        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');
    }

    public function guardar_actualizar_password(){
        $this->validate([
            'password1' => 'required|min:6',
            'password2' => 'required|same:password1',
        ]);

        $instanciaTbl = User::findOrFail($this->iduser);
        $instanciaTbl->update([
            // 'id',
            // 'dni' => $this->dni,
            // 'datos' => $this->datos,
            // 'sede' => $this->sede,
            // 'dependencia' => $this->dependencia,
            // 'regimen' => $this->regimen,
            // 'cargo' => $this->cargo,
            // 'correo_personal' => $this->correo_personal,
            // 'correo_institucional' => $this->correo_institucional,
            // 'cel_personal' => $this->cel_personal,
            // 'cel_institucional' => $this->cel_institucional,
            'password' => bcrypt($this->password1),
            // 'activo' => "1",
            //
            // 'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
        ]);

        $this->reset('password1','password2');
        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');

        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-modal-password');
    }

    // -----------------------------------------------------------------------------------------------
    // Modal enviar Correo
    public function enviar_correo1(User $instanciaTbl){
        // $this->nuevo_editar = "EDITAR";
        // $this->color_modal_header = "bg-success-subtle";
        // $this->color_boton = "btn-outline-success";
        // $this->guardar_actualizar="actualizar";
        
        // - Editar -
        $this->iduser = $instanciaTbl->id;
        $this->dni = $instanciaTbl->dni;
        $this->datos = $instanciaTbl->datos;
        $this->sede = $instanciaTbl->sede;
        $this->dependencia = $instanciaTbl->dependencia;
        $this->regimen = $instanciaTbl->regimen;
        $this->cargo = $instanciaTbl->cargo;
        $this->correo_personal = $instanciaTbl->correo_personal;
        $this->correo_institucional = $instanciaTbl->correo_institucional;
        $this->cel_personal = $instanciaTbl->cel_personal;
        $this->cel_institucional = $instanciaTbl->cel_institucional;
        $this->activo = $instanciaTbl->activo;
    }
    // -----------------------------------------------------------------------------------------------
    // Modal buscar Personal
    public function personal_agregar(Tbl_personale $ipersonal){
        $this->idpersonal = $ipersonal->idpersonal;
        $this->dni = $ipersonal->dni;
        $this->datos = $ipersonal->datos;
        $this->sede = $ipersonal->sede;
        $this->dependencia = $ipersonal->dependencia;
        $this->regimen = $ipersonal->regimen;
        $this->cargo = $ipersonal->cargo;
        $this->correo_personal = $ipersonal->correo_personal;
        $this->correo_institucional = $ipersonal->correo_institucional;
        $this->cel_personal = $ipersonal->cel_personal;
        $this->cel_institucional = $ipersonal->cel_institucional;
        $this->activo = $ipersonal->activo;

        $this->reset('searchpersonal');
    }

    public function personal_cerrar(){
        $this->reset('searchpersonal');
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
        $instanciaTbl = User::findOrFail($id);

        $instanciaTbl->update([
            'activo' => '0',
            'updated_user' => auth()->user()->datos,
        ]);

        // Notificar al navegador que se eliminó
        $this->dispatchBrowserEvent('registroEliminado');
    }

    public function reactivar($id)
    {
        $instanciaTbl = User::findOrFail($id);

        $instanciaTbl->update([
            'activo' => '1',
            'updated_user' => auth()->user()->datos,
        ]);

        // Notificar al navegador que se eliminó
        $this->dispatchBrowserEvent('registroActivado');
    }
}
