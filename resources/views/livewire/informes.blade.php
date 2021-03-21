<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Informes') }}
    </h2>
</x-slot>
<div>
    <div class="px-4 py-4">
        <a href="{{url('dashboard')}}" class="a_volver">< Volver</a>
    </div>
    <div>
        @if (!$existeInforme)
        {{-- Formulario --}}   
        <div class="container mx-auto bg-white rounded-xl overflow-hidden">
            <div class="px-2 py-2 w-100">
                <h3 class="font-bold text-md text-gray-700 uppercase">Genera un {{$titulo}}</h3>
            </div>       
            <div class="flex flex-wrap justify-center py-4">
                <!-- Fecha desde-->
                <div class="px-2 py-2 w-80">
                    <label for="fechaDesde" class="label">Fecha Inicio</label>
                    <input wire:model="dateFrom" id="fechaDesde" type="date" class=" input my-2 block w-full"/>
                    @error('dateFrom')
                        <p class="error">{{$message}}</p>
                    @enderror
                    @error('comprobarFechas')
                        <p class="error">{{$message}}</p>    
                    @enderror
                </div>
                <!-- Fecha hasta-->
                <div class="px-2 py-2 w-80">
                    <label for="fechaHasta" class="label">Fecha Final</label>
                    <input wire:model="dateTo" id="fechaHasta" type="date" class=" input my-2 block w-full"/>
                    @error('dateTo')
                        <p class="error">{{$message}}</p>
                    @enderror
                    @error('comprobarFechas')
                        <p class="error">{{$message}}</p>    
                    @enderror
                </div>
                {{-- Guía --}}
                <div class="px-2 py-2 w-80">
                    <label for="guia" class="label">Guía</label>
                    <select wire:model="guide" name="guide" id="guide" class="option my-2 block w-full">
                        <option value="0">Elige un trabajador</option>
                        @foreach ($trabajadores as $trabajador)
                            <option value="{{$trabajador->id}}">{{$trabajador->name . " " . $trabajador->surname}}</option>
                        @endforeach
                    </select>
                    @error('guide')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                {{-- Perro --}}
                <div class="px-2 py-2 w-80">
                    <label for="perro" class="label">Perro</label>
                    <select wire:model="dog_id" name="dog" id="perro" class="option my-2 block w-full">
                        <option value="0">Elige un perro</option>
                        @foreach ($perros as $perro)
                            <option value="{{$perro->id}}">{{$perro->name}}</option>
                        @endforeach
                    </select>
                    @error('dog_id')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
            </div>
                
            {{-- Botones --}}
            <div class="flex items-center justify-end px-4 py-3 bg-gray-600 text-right sm:px-6">
                    {{-- <a href="{{url('informePDF')}}"> --}}<button wire:click="{{$action}}" class="button-actualizar">Crear Informe</button>{{-- </a> --}}
            </div>    
        </div>
        @endif
        {{-- Tablas --}}
        @if ($existeInforme)
            <button wire:click="{{$action}}" class="button-edit mr-2">Crear PDF</button>
            <button wire:click="resetear" class="button-delete">Resetear</button>
            <div class="container mx-auto my-4 bg-white  rounded-xl overflow-hidden">
                <div class="w-full rounded-lg shadow overflow-hidden mb-6">
                    {{-- Tabla diarios --}}
                    <table class="w-full">
                        <thead class="bg-gray-600">
                            <tr class="text-xs font-medium text-white uppercase text-center tracking-wider">
                                <th colspan="11" class="px-8 py-3 text-center">Diarios</th>
                            </tr>
                            <tr class="bg-gray-300 border-gray-400 text-xs font-medium uppercase text-center tracking-wider">
                                <th class="px-8 py-3">Tipo</th>
                                <th class="px-8 py-3">Tiempo (Minutos)</th>                           
                                <th class="px-3 py-3">Kilometros</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($tipos as $tipo)
                            <tr class="text-sm text-gray-500 text-center">
                                <td class="px-2 py-4">{{$tipo->name}}</td>
                                @foreach ($totalesDiarios["$tipo->name"] as $item)
                                    <td class="px-3 py-4">{{$item != null ? $item : 0}}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-sm font-bold px-6 py-4 bg-gray-600 border-t border-gray-600">

                    </div>
                </div>

                <div class="w-full rounded-lg shadow overflow-hidden mb-6">
                    {{-- Tabla obediencia --}}
                    <table class="w-full">
                        <thead class="bg-gray-600">
                            <tr class="text-xs font-medium text-white uppercase text-center tracking-wider">
                                <th colspan="11" class="px-8 py-3 text-center">Obediencia</th>
                            </tr>
                            <tr class="bg-gray-300 border-gray-400 text-xs font-medium uppercase text-center tracking-wider">
                                <th class="px-8 py-3">Orden</th>
                                <th class="px-8 py-3">Porcentaje de aciertos</th>                           
                                <th class="px-3 py-3">Porcentaje de fallos</th>
                                <th class="px-3 py-3">Tiempo (Minutos)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($ordenes as $orden)
                            <tr class="text-sm text-gray-500 text-center">
                                <td class="px-2 py-4">{{$orden->name}}</td>
                                @foreach ($totalesObediencia["$orden->name"] as $item)
                                    <td class="px-3 py-4">{{$item != null ? $item : 0}}</td>
                                @endforeach
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                    <div class="text-sm font-bold px-6 py-4 bg-gray-600 border-t border-gray-600">

                    </div>
                </div>

                <div class="w-full rounded-lg shadow overflow-hidden">
                    {{-- Tabla busqueda --}}
                    <table class="w-full">
                        <thead class="bg-gray-600">
                            <tr class="text-xs font-medium text-white uppercase text-center tracking-wider">
                                <th colspan="11" class="px-8 py-3 text-center">Búsqueda</th>
                            </tr>
                            <tr class="bg-gray-300 border-gray-400 text-xs font-medium uppercase text-center tracking-wider">
                                <th class="px-8 py-3">Sustancias</th>
                                <th class="px-8 py-3">Pocentaje aciertos</th>                           
                                <th class="px-3 py-3">Porcentaje fallos</th>
                                <th class="px-3 py-3">Tiempo (Minutos)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                         @foreach ($sustancias as $sustancia)
                            <tr class="text-sm text-gray-500 text-center">
                                <td class="px-2 py-4">{{$sustancia->name}}</td>
                                @foreach ($totalesBusqueda["$sustancia->name"] as $item)
                                    <td class="px-3 py-4">{{$item != null ? $item : 0}}</td>
                                @endforeach
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                    <div class="text-sm font-bold px-6 py-4 bg-gray-600 border-t border-gray-600">

                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

