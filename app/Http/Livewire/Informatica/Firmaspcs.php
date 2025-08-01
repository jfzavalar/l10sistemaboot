<?php

namespace App\Http\Livewire\Informatica;

use App\Models\Tbl_firmas_pc;
use App\Models\Tbl_personale;
use App\Models\Tbl_spijweb;
use App\Models\Tbl_tokens_asignado;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Firmaspcs extends Component
{
    use WithFileUploads;

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    //Variables token
    public $idindex;

    //Variables de modal Nuevo-Editar
    public $nuevo_editar="NUEVO",$color_modal_header="bg-primary-subtle",$color_boton="btn-outline-primary";
    public $guardar_actualizar;

    //Variables de modal buscar
    public $searchindex;
    public function updatingsearchindex(){
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
    
    public $idtoken,$codtoken,$operativo,$asignacion,$actaruta,$fecha_expiracion,$observacion,$created_user,$updated_user,$activo;

    public $idpersonal,$dni,$datos,$sede,$dependencia,$despacho,$regimen,$cargo,$correo_personal,$correo_institucional,$cel_personal,$cel_institucional,$activo_per;

    public $pdf;

    public function render()
    {
        $lista_activos = DB::table('tbl_firmas_pcs')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','operativo','asignacion','idtoken','codtoken','operativo','asignacion','actaruta','fecha_expiracion','observacion','activo','created_user','updated_user')
            ->where('activo',"1")
            ->where(function ($query) {$query
                ->where('dni', 'like', '%' . $this->searchindex . '%')
                ->orWhere('datos', 'like', '%' . $this->searchindex . '%');
            })
            ->orderBy('id','desc')
            ->paginate();

        $totales_asignados = DB::table('tbl_firmas_pcs')
            ->select(
                'created_user',
                DB::raw("SUM(CASE WHEN asignacion = 'ASIGNACION' THEN 1 ELSE 0 END) AS total_asignados"),
                DB::raw("SUM(CASE WHEN asignacion = 'DEVOLUCION' THEN 1 ELSE 0 END) AS total_devueltos")
            )
            ->where('activo', "1")
            ->groupBy('created_user')
            ->get();
        
        $lista_inactivos = DB::table('tbl_firmas_pcs')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','operativo','asignacion','idtoken','codtoken','operativo','asignacion','actaruta','fecha_expiracion','observacion','activo','created_user','updated_user')
            ->where('activo',"0")
            ->where(function ($query) {$query
                ->where('dni', 'like', '%' . $this->searchindex . '%')
                ->orWhere('datos', 'like', '%' . $this->searchindex . '%');
            })
            ->orderBy('id','desc')
            ->paginate();

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

        $lista_historial = DB::table('tbl_firmas_pcs')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','operativo','asignacion','idtoken','codtoken','operativo','asignacion','actaruta','fecha_expiracion','observacion','activo','created_user','updated_user')
            // ->where('activo',"0")
            ->where('codtoken',$this->codtoken)
            ->where(function ($query) {$query
                ->where('dni', 'like', '%' . $this->searchindex . '%')
                ->orWhere('datos', 'like', '%' . $this->searchindex . '%');
            })
            ->orderBy('id','desc')
            ->paginate();

        $lista_personal = DB::table('tbl_personales')
            ->select('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo')
            ->where('dni','like','%' .$this->searchpersonal .'%')
            ->orwhere('datos','like','%' .$this->searchpersonal .'%')
            ->paginate(5);

        return view('livewire.informatica.firmaspcs',
            compact('lista_activos','totales_asignados','lista_inactivos','lista_sede','lista_dependencia','lista_historial','lista_personal'));
    }

    public function nuevo(){
        $this->nuevo_editar = "NUEVO";
        $this->color_modal_header = "bg-primary-subtle";
        $this->color_boton = "btn-outline-primary";

        $this->guardar_actualizar="guardar";

    }

    public function guardar(){
        // Contar cuántos registros ya existen con activo = "1"
        $totalActivos = Tbl_firmas_pc::where('activo', '1')->count() + 1;

        Tbl_firmas_pc::create([
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
            //
            'idtoken' => $totalActivos,
            'codtoken' => "token" . $totalActivos,
            'operativo' => "OPERATIVO",
            'asignacion' => "ASIGNACION",
            'fecha_expiracion' => $this->fecha_expiracion,
            'observacion' => $this->observacion,
            //
            'activo' => "1",
            //
            'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
            
        ]);

        //Reiniciar variables
        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo_per','fecha_expiracion','observacion');
    
        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function cargarPDF1(Tbl_firmas_pc $instanciaTbl){
        $this->idindex = $instanciaTbl->id;
        $this->dni = $instanciaTbl->dni;
        $this->asignacion = $instanciaTbl->asignacion;
        $this->codtoken = $instanciaTbl->codtoken;

    }

    public function cargarPDF2(){
        $this->validate([
            'pdf' => 'required|mimes:pdf|max:4096', // Máx. 4MB
        ]);

        // Generar un nombre personalizado con timestamp
        $fileName = $this->dni . '_' . $this->asignacion . '_' . $this->codtoken . '.' . $this->pdf->getClientOriginalExtension();

        // Guardar en la carpeta storage/app/public/pdfs
        $path = $this->pdf->storeAs('public/archivos/informatica/tokens', $fileName);

        //guardar ruta del archivo
        // dd($this->idindex);
        $instanciaTbl = Tbl_firmas_pc::findOrFail($this->idindex);

        $instanciaTbl->update([
            'actaruta' => str_replace( 'public/','storage/',$path),

            'updated_user' => auth()->user()->datos,
        ]);

        // Limpia el archivo de la propiedad Livewire si lo deseas
        $this->reset('pdf');

        // Cerrar el modal en el navegador
        $this->dispatchBrowserEvent('cerrar-modal-pdf');

        // Opcional: mostrar un mensaje flash
        session()->flash('message', 'PDF cargado correctamente.');
    }

    public function exportarPDF($id)
    {
        $instanciaTbl = Tbl_firmas_pc::findOrFail($id);

        $pdf = Pdf::loadView('pdf.informatica.spijweb-acta', compact('instanciaTbl'));

        //Mostrar PDF
        // return $pdf->stream('spijweb_'.$userspijweb->dni.'.pdf');
        
        //Descargar PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'spijweb_'.$instanciaTbl->dni.'.pdf');
    }

    public function cerrar_nuevo(){
        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo_per','fecha_expiracion','observacion');

        // ... algún error
        $this->dispatchBrowserEvent('cancelar-proceso');
    }

    // -----------------------------------------------------------------------------------------------
    
    public function editar(Tbl_firmas_pc $instanciaTbl){
        $this->nuevo_editar = "EDITAR";
        $this->color_modal_header = "bg-success-subtle";
        $this->color_boton = "btn-outline-success";
        $this->guardar_actualizar="actualizar";
        
        // - Editar -
        $this->idindex = $instanciaTbl->id;
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
        //
        $this->idtoken = $instanciaTbl->idtoken;
        $this->codtoken = $instanciaTbl->codtoken;
        $this->operativo = $instanciaTbl->operativo;
        $this->asignacion = $instanciaTbl->asignacion;
        $this->fecha_expiracion = $instanciaTbl->expiracion;
        $this->observacion = $instanciaTbl->observacion;
        //
        $this->activo = $instanciaTbl->activo;
    }

    public function actualizar(){
        $instanciaTbl = Tbl_firmas_pc::findOrFail($this->idindex);

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
            'fecha_expiracion' => $this->fecha_expiracion,
            'activo' => "1",
            //
            //'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
        ]);

        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo_per','fecha_expiracion','observacion');

        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function cerrar_actualizar(){
        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo_per','fecha_expiracion','observacion');
    }

    // -----------------------------------------------------------------------------------------------
    // Modal buscar Personal
    public function personal_agregar(Tbl_personale $ipersonal){
        $this->idpersonal = $ipersonal->id;
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
        $this->activo_per = $ipersonal->activo;

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
    protected $listeners = ['devolver2','eliminar','reactivar'];

    public function reasignar1(Tbl_firmas_pc $instanciaTbl){
        $this->guardar_actualizar = "reasignar2";

        $this->idtoken = $instanciaTbl->id;
    }
    public function reasignar2(){
        $instanciaTbl = Tbl_firmas_pc::findOrFail($this->idtoken);

        $instanciaTbl->update([
            'activo' => "0",
        ]);

        Tbl_firmas_pc::create([
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
            //
            'idtoken' => $instanciaTbl->idtoken,
            'codtoken' => $instanciaTbl->codtoken,
            'operativo' => "OPERATIVO",
            'asignacion' => "ASIGNACION",
            'fecha_expiracion' => $this->fecha_expiracion,
            'observacion' => $this->observacion,
            //
            'activo' => "1",
            //
            'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
            
        ]);

        //Reiniciar variables
        $this->reset('id','dni','datos','sede','dependencia','regimen','cargo','correo_personal','correo_institucional','cel_personal','cel_institucional','activo_per','fecha_expiracion','observacion');
    
        //Emitir evento al frontend
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function devolver1(Tbl_firmas_pc $instanciaTbl){
        $this->idtoken = $instanciaTbl->id;
    }

    public function devolver2($id){
        $instanciaTbl = Tbl_firmas_pc::findOrFail($id);

        $instanciaTbl->update([
            'activo' => "0",
        ]);

        Tbl_firmas_pc::create([
            // 'id',
            'dni' => $instanciaTbl->dni,
            'datos' => $instanciaTbl->datos,
            'sede' => $instanciaTbl->sede,
            'dependencia' => $instanciaTbl->dependencia,
            'regimen' => $instanciaTbl->regimen,
            'cargo' => $instanciaTbl->cargo,
            'correo_personal' => $instanciaTbl->correo_personal,
            'correo_institucional' => $instanciaTbl->correo_institucional,
            'cel_personal' => $instanciaTbl->cel_personal,
            'cel_institucional' => $instanciaTbl->cel_institucional,
            //
            'idtoken' => $instanciaTbl->idtoken,
            'codtoken' => $instanciaTbl->codtoken,
            'operativo' => "OPERATIVO",
            'asignacion' => "DEVOLUCION",
            'fecha_expiracion' => $this->fecha_expiracion,
            'observacion' => $this->observacion,
            //
            'activo' => "1",
            //
            'created_user' => auth()->user()->datos,
            'updated_user' => auth()->user()->datos,
        ]);
    }

    public function eliminar($id)
    {
        $instanciaTbl = Tbl_firmas_pc::findOrFail($id);

        $instanciaTbl->update([
            'activo' => '0',
            'updated_user' => auth()->user()->datos,
        ]);

        // Notificar al navegador que se eliminó
        $this->dispatchBrowserEvent('registroEliminado');
    }

    public function reactivar($id)
    {
        $instanciaTbl = Tbl_firmas_pc::findOrFail($id);

        $instanciaTbl->update([
            'activo' => '1',
            'updated_user' => auth()->user()->datos,
        ]);

        // Notificar al navegador que se eliminó
        $this->dispatchBrowserEvent('registroActivado');
    }
}
