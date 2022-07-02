<div>
    <button wire:click="openModalCandidato" type="button" class="inline-block px-6 py-2.5 mr-2 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
        Agregar Candidato
    </button>

    <x-jet-dialog-modal wire:model='openModalCandidato'>
        <x-slot name="title">
            Nuevo Candidato
        </x-slot>

        <x-slot name="content">
            <!--actual component start-->
            <div>
                <div class="w-full text-center mx-auto">
                    <div>
                        <div class="flex items-center mb-2">
                            <x-jet-label value="Nombre:" class="w-1/4"/>
                            <x-jet-input name="firstname" type="text" class="w-full" wire:model="firstname"/>
                        </div>
                        <div class="flex items-start text-start mb-2">
                            <x-jet-input-error for="firstname" class="w-full"/>
                        </div>
            
                        <div class="flex items-center mb-2">
                            <x-jet-label value="Apellido:" class="w-1/4"/>
                            <x-jet-input name="lastname" type="text" class="w-full" wire:model="lastname"/>
                        </div>

                        <div class="flex items-start mb-2">
                            <x-jet-input-error for="lastname" class="w-full"/>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 items-center justify-end border-t p-4">
                    <button wire:click="resetFields()" type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                        Cancelar
                    </button>

                    <button 
                        wire:loading.remove wire:target="save"
                        wire:click="save"
                        type="button" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                        Guardar
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
