<div>
    <button wire:click="openModal" type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
        Crear
    </button>
    
    <x-jet-dialog-modal wire:model='openModal'>
        <x-slot name="title">
            Nueva Evaluacion
        </x-slot>

        <x-slot name="content">
            <!--actual component start-->
            <div x-data="setup()">
                <div class="w-full text-center mx-auto">
                    <div x-show.transition.in.opacity.duration.1000="activeTab === 0">
                        <div class="flex items-center mb-2">
                            <x-jet-label value="Candidato:" class="w-1/4"/>
                            <select wire:model="employee_id" class="w-3/4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="" selected>Seleecione un candidato</option>
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}">{{ $employee->firstname . ' ' . $employee->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-start text-start mb-2">
                            <x-jet-input-error for="employee_id" class="w-full"/>
                        </div>
            
                        <div class="flex items-center mb-2">
                            <x-jet-label value="Desde:" class="w-1/4"/>
                            <x-jet-input name="datefrom" type="date" class="w-1/4" wire:model="datefrom"/>

                            <x-jet-label value="Hasta:" class="w-1/4"/>
                            <x-jet-input name="dateto" type="date" class="w-1/4" wire:model="dateto"/>
                        </div>

                        <div class="flex items-start mb-2">
                            <x-jet-input-error for="datefrom" class="w-1/2"/>
                            <x-jet-input-error for="dateto" class="w-1/2"/>
                        </div>

                    </div>
                    <div x-show.transition.in.opacity.duration.1000="activeTab === 1">
                        @foreach ($categoriesBoolean as $index => $categoryBoolean)
                            <div wire:key="category-boolean-field-{{ $categoryBoolean->id }}" class="flex mb-4">
                                <x-jet-label value="{{ $categoryBoolean->namecategory }}" class="w-3/4 text-start"/>

                                <label for="toggle-{{$index}}" class="flex items-center cursor-pointer relative w-1/4">
                                    <input 
                                        type="checkbox"
                                        id="toggle-{{$index}}"
                                        wire:model="categoriesBoolean.{{$index}}.valueboolean" 
                                        class="sr-only"
                                    />
                                    <div class="toggle-bg bg-gray-200 border-2 border-gray-200 h-6 w-11 rounded-full">
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div x-show.transition.in.opacity.duration.1000="activeTab === 2">
                        @foreach ($categoriesInteger as $index => $categoryInteger)
                            <div wire:key="category-integer-field-{{ $categoryInteger->id }}" class="flex items-center mb-4">
                                <x-jet-label value="{{ $categoryInteger->namecategory }}" class="w-3/4 text-start"/>
                                <x-jet-input
                                    value="0"
                                    min="0"
                                    type="number"
                                    wire:model="categoriesInteger.{{$index}}.valueinteger"
                                    class="w-1/4"
                                />
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex gap-4 items-center justify-end border-t p-4">
                    <button wire:click="resetFields()" x-on:click.prevent="activeTab = 0" type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                        Cancelar
                    </button>

                    <button @click="activeTab++" x-show="activeTab==0" type="button" class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out">
                        Iniciar
                    </button>

                    <button @click="activeTab--" x-show="activeTab>0" type="button" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">
                        Atras
                    </button>

                    <button @click="activeTab++" x-show="activeTab>0&&activeTab<tabs.length-1" type="button" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">
                        Siguiente
                    </button>

                    <button 
                        wire:loading.remove wire:target="save"
                        wire:click="save"
                        x-on:click.prevent="activeTab = 0"
                        x-show="activeTab==2"
                        type="button" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                        Finalizar
                    </button>

                    <span wire:loading wire:target="save"><i class="fa fa-spin fa-spinner"></i></span>
                </div>
            </div>
            <!--actual component end-->
        </x-slot>

        <x-slot name="footer">
            
        </x-slot>
    </x-jet-dialog-modal>
</div>
