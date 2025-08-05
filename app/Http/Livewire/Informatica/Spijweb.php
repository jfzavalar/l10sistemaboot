<?php

namespace App\Http\Livewire\Informatica;

use App\Mail\NotificacionInformatica;
use App\Mail\NotificacionInformaticaSpijweb;
use App\Models\Tbl_personale;
use App\Models\Tbl_spijweb;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Spijweb extends Component
{
    use WithFileUploads;

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    //Variables spijweb
    public $idspijweb,$usuariospijweb,$passwordspijweb,$estado_formato,$estado_userpass;
    Public $idpersonal,$dni,$datos,$sede,$dependencia,$regimen,$cargo,$correo_personal,$correo_institucional,$cel_personal,$cel_institucional,$activo;

    //Variables de modal Nuevo-Editar
    public $nuevo_editar="NUEVO",$color_modal_header="bg-primary-subtle",$color_boton="btn-outline-primary";
    public $guardar_actualizar;

    public $pdf,$pdftutorial;

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
        $lista_activos = DB::table('tbl_spijwebs')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','actaruta',
                    'usuariospijweb','passwordspijweb','estado_formato','estado_userpass','activo')
            ->where('activo',"1")
            ->where(function ($query) {$query
                ->where('dni', 'like', '%' . $this->search . '%')
                ->orWhere('datos', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id','desc')
            ->paginate();
        
        $lista_inactivos = DB::table('tbl_spijwebs')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','actaruta',
                    'usuariospijweb','passwordspijweb','estado_formato','estado_userpass','activo')
            ->where('activo',"0")
            ->where(function ($query) {$query
                ->where('dni', 'like', '%' . $this->search . '%')
                ->orWhere('datos', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id','desc')
            ->paginate();
            
        $totales_asignados = DB::table('tbl_spijwebs')
            ->select(
                'created_user',
                DB::raw("SUM(CASE WHEN estado_formato = 'ENVIADO' THEN 1 ELSE 0 END) AS total_enviados"),
                DB::raw("SUM(CASE WHEN estado_formato = 'PENDIENTE' THEN 1 ELSE 0 END) AS total_pendientes"),
                DB::raw("SUM(CASE WHEN estado_userpass = 'ENVIADO' THEN 1 ELSE 0 END) AS total_enviados_u"),
                DB::raw("SUM(CASE WHEN estado_userpass = 'PENDIENTE' THEN 1 ELSE 0 END) AS total_pendientes_u")
            )
            ->where('activo', "1")
            ->groupBy('created_user')
            ->get();

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
            ->where('dependencia','like','%' . $this->searchdependencia . '%')
            ->orderBy('dependencia')
            ->paginate();

        return view('livewire.informatica.spijweb',
            compact('lista_activos','lista_inactivos','totales_asignados','lista_personal','lista_cargo','lista_sede','lista_dependencia'));
    }

    // -----------------------------------------------------------------------------------------------

    public function nuevo(){
        $this->nuevo_editar = "NUEVO";
        $this->color_modal_header = "bg-primary-subtle";
        $this->color_boton = "btn-outline-primary";

        $this->guardar_actualizar="guardar";

    }

    public function guardar(){
        $this->validate([
            'dni' => 'required|digits:8|unique:tbl_personales,dni',
            'regimen' => 'required',
        ], [
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'regimen.required' => 'Debe seleccionar un régimen.',
        ]);

        Tbl_spijweb::create([
            // 'id',
            'dni' => $this->dni,
            'datos' => mb_strtoupper($this->datos),
            'sede' => $this->sede,
            'dependencia' => $this->dependencia,
            'regimen' => $this->regimen,
            'cargo' => $this->cargo,
            'correo_personal' => $this->correo_personal,
            'correo_institucional' => $this->correo_institucional,
            'cel_personal' => $this->cel_personal,
            'cel_institucional' => $this->cel_institucional,

            'usuariospijweb' => $this->usuariospijweb,
            'passwordspijweb' => $this->passwordspijweb,
            'estado_formato' => "PENDIENTE",
            'estado_userpass' => "PENDIENTE",
            'activo' => "1",
            //
            'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
        ]);

        //Reiniciar variables
        $this->reset('idspijweb','usuariospijweb','passwordspijweb','estado_formato','estado_userpass');
        $this->reset('idpersonal','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');
    
        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function cargarPDF1(Tbl_spijweb $instanciaTbl){
        $this->idspijweb = $instanciaTbl->id;
        $this->dni = $instanciaTbl->dni;
        // $this->asignacion = $instanciaTbl->asignacion;
        // $this->codtoken = $instanciaTbl->codtoken;

    }

    public function cargarPDF2(){
        $this->validate([
            'pdf' => 'required|mimes:pdf|max:4096', // Máx. 4MB
        ]);

        // Generar un nombre personalizado con timestamp
        $fileName = $this->dni . '.' . $this->pdf->getClientOriginalExtension();

        // Guardar en la carpeta storage/app/public/pdfs
        $path = $this->pdf->storeAs('public/archivos/informatica/spijweb', $fileName);

        //guardar ruta del archivo
        // dd($this->idspijweb);
        $instanciaTbl = Tbl_spijweb::findOrFail($this->idspijweb);

        $instanciaTbl->update([
            'actaruta' => str_replace( 'public/','storage/',$path),

            'updated_user' => auth()->user()->datos,
        ]);

        // Limpia el archivo de la propiedad Livewire si lo deseas
        // $this->reset('pdf');
        $this->dispatchBrowserEvent('reset-pdf-input');

        // Cerrar el modal en el navegador
        $this->dispatchBrowserEvent('cerrar-modal-pdf');

        // Opcional: mostrar un mensaje flash
        session()->flash('message', 'PDF cargado correctamente.');
    }

    public function exportarPDF($id)
    {
        $instanciaTbl = Tbl_spijweb::findOrFail($id);

        $pdf = Pdf::loadView('pdf.informatica.spijweb-acta', compact('instanciaTbl'));

        //Mostrar PDF
        // return $pdf->stream('spijweb_'.$instanciaTbl->dni.'.pdf');
        
        //Descargar PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'spijweb_'.$instanciaTbl->dni.'.pdf');
    }

    public function cerrar_nuevo(){
        //Reiniciar variables
        $this->reset('idspijweb','usuariospijweb','passwordspijweb','estado_formato','estado_userpass');
        $this->reset('idpersonal','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');

        // ... algún error
        $this->dispatchBrowserEvent('cancelar-proceso');
    }

    // -----------------------------------------------------------------------------------------------
    
    public function editar(Tbl_spijweb $instanciaTbl){
        $this->nuevo_editar = "EDITAR";
        $this->color_modal_header = "bg-success-subtle";
        $this->color_boton = "btn-outline-success";
        $this->guardar_actualizar="actualizar";
        
        // - Editar -
        $this->idspijweb = $instanciaTbl->id;
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

        $this->usuariospijweb = $instanciaTbl->usuariospijweb;
        $this->passwordspijweb = $instanciaTbl->passwordspijweb;
        $this->estado_formato = $instanciaTbl->estado_formato;
        $this->estado_userpass = $instanciaTbl->estado_userpass;

        $this->activo = $instanciaTbl->activo;
    }

    public function actualizar(){
        $instanciaTbl = Tbl_spijweb::findOrFail($this->idspijweb);

        $instanciaTbl->update([
            // 'id',
            'dni' => $this->dni,
            'datos' => mb_strtoupper($this->datos),
            'sede' => $this->sede,
            'dependencia' => $this->dependencia,
            'regimen' => $this->regimen,
            'cargo' => $this->cargo,
            'correo_personal' => mb_strtolower($this->correo_personal),
            'correo_institucional' => ($this->correo_institucional),
            'cel_personal' => $this->cel_personal,
            'cel_institucional' => $this->cel_institucional,

            'usuariospijweb' => $this->usuariospijweb,
            'passwordspijweb' => $this->passwordspijweb,
            'estado_formato' => $this->estado_formato,
            'estado_userpass' => $this->estado_userpass,

            'activo' => "1",
            //
            //'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
        ]);

        //Reiniciar variables
        $this->reset('idspijweb','usuariospijweb','passwordspijweb','estado_formato','estado_userpass');
        $this->reset('idpersonal','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');

        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function cerrar_actualizar(){
        //Reiniciar variables
        $this->reset('idspijweb','usuariospijweb','passwordspijweb','estado_formato','estado_userpass');
        $this->reset('idpersonal','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');
    }

    // -----------------------------------------------------------------------------------------------
    // Modal enviar Correo
    public function enviar_correo1(Tbl_spijweb $instanciaTbl){
        // $this->nuevo_editar = "EDITAR";
        // $this->color_modal_header = "bg-success-subtle";
        // $this->color_boton = "btn-outline-success";
        // $this->guardar_actualizar="actualizar";
        
        // - Editar -
        $this->idspijweb = $instanciaTbl->id;
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

        $this->usuariospijweb = $instanciaTbl->usuariospijweb;
        $this->passwordspijweb = $instanciaTbl->passwordspijweb;

        $this->activo = $instanciaTbl->activo;
    }
    public function enviar_correo2(){
        //Actualizar estado_formato
        $instanciaTbl = Tbl_spijweb::findOrFail($this->idspijweb);
        $instanciaTbl->update([
            //'id',
            //'dni' => $this->dni,
            //'datos' => $this->datos,
            //'sede' => $this->sede,
            //'dependencia' => $this->dependencia,
            //'regimen' => $this->regimen,
            //'cargo' => $this->cargo,
            //'correo_personal' => $this->correo_personal,
            //'correo_institucional' => $this->correo_institucional,
            //'cel_personal' => $this->cel_personal,
            //'cel_institucional' => $this->cel_institucional,

            //'usuariospijweb' => $this->usuariospijweb,
            //'passwordspijweb' => $this->passwordspijweb,
            'estado_formato' => "ENVIADO",
            //'estado_userpass' => $this->estado_userpass,

            //'activo' => "1",
            //
            //'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
        ]);

        // 1. Generar el PDF como contenido binario
        $pdf = Pdf::loadView('pdf.informatica.spijweb-acta', [
            'dni' => $this->dni,
            'datos' => $this->datos,
            'cargo' => $this->cargo,
            'sede' => $this->sede,
            'dependencia' => $this->dependencia,
        ])->output();

        $pdftutorial = public_path('tutoriales/2025_manual_firma_spijweb.pdf');

        // Verificación opcional
        if (!file_exists($pdftutorial)) {
            session()->flash('error', "Uno o ambos archivos no existen.");
            return;
        }

        Mail::to($this->correo_institucional)->send(
            new NotificacionInformatica(
                $this->dni,
                $this->datos,
                $this->cargo,
                $this->sede,
                $this->dependencia,
                $pdf,
                $pdftutorial
            )
        );

        //Reiniciar variables
        $this->reset('idspijweb','usuariospijweb','passwordspijweb','estado_formato','estado_userpass');
        $this->reset('idpersonal','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');

        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-enviar-modal');

        session()->flash('success', "Correo enviado a {$this->correo_institucional} correctamente.");
    }

    public function enviar_correo3(){
        //Actualizar estado_formato
        $instanciaTbl = Tbl_spijweb::findOrFail($this->idspijweb);
        $instanciaTbl->update([
            //'id',
            //'dni' => $this->dni,
            //'datos' => $this->datos,
            //'sede' => $this->sede,
            //'dependencia' => $this->dependencia,
            //'regimen' => $this->regimen,
            //'cargo' => $this->cargo,
            //'correo_personal' => $this->correo_personal,
            //'correo_institucional' => $this->correo_institucional,
            //'cel_personal' => $this->cel_personal,
            //'cel_institucional' => $this->cel_institucional,

            //'usuariospijweb' => $this->usuariospijweb,
            //'passwordspijweb' => $this->passwordspijweb,
            //'estado_formato' => "ENVIADO",
            'estado_userpass' => "ENVIADO",

            //'activo' => "1",
            //
            //'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
        ]);
        
        Mail::to($this->correo_institucional)->send(
            new NotificacionInformaticaSpijweb(
                $this->dni,
                $this->datos,
                $this->cargo,
                $this->sede,
                $this->dependencia,
                $this->usuariospijweb,
                $this->passwordspijweb,
            )
        );

        //Reiniciar variables
        $this->reset('idspijweb','usuariospijweb','passwordspijweb','estado_formato','estado_userpass');
        $this->reset('idpersonal','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo');

        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-enviar-modal');

        session()->flash('success', "Correo enviado a {$this->correo_institucional} correctamente.");
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
