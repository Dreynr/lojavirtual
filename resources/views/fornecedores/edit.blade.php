<x-app-layout>
    <x-slot name="header">
        <h3 class="text-center font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Editar fornecedor') }}
        </h3>
    </x-slot>
    <br>
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-md shadow">

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <x-input-error :messages="$error" class="mt-2" />
                @endforeach
            </ul>
        @endif
        <br>

        <form action="{{ url('fornecedores/update') }}" method="POST">
            @csrf
            <!-- campo oculto passando o ID como parâmetro no request -->
            <input type="hidden" name="id" value="{{ $fornecedor->id }}">
            
            <div>
                <x-input-label for="tipo" :value="__('Tipo')" />
                <select id="tipo" name="tipo" 
                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="">Selecione o tipo</option>
                    <option value="F" {{ $fornecedor->tipo == 'F' ? 'selected' : '' }}>Pessoa Física</option>
                    <option value="J" {{ $fornecedor->tipo == 'J' ? 'selected' : '' }}>Pessoa Jurídica</option>
                </select>
            </div>

            <div>
                <x-input-label for="nome_razao" :value="__('Nome/Razão Social')" />
                <x-text-input class="w-full" type="text" name="nome_razao" value="{{ $fornecedor->nome_razao }}" />
            </div>
            
            <div>
                <x-input-label for="cpf_cnpj" :value="__('CPF/CNPJ')" />
                <x-text-input class="w-full" type="text" name="cpf_cnpj" value="{{ $fornecedor->cpf_cnpj }}" />
            </div>

            <div>
                <x-input-label for="telefone" :value="__('Telefone')" />
                <x-text-input class="w-full" type="text" name="telefone" value="{{ $fornecedor->telefone }}" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ url('/fornecedores') }}">
                    <x-secondary-button>Voltar</x-secondary-button>
                </a>

                <x-primary-button class="ms-4" type="submit">
                    {{ __('Salvar') }}
                </x-primary-button>
            </div>

        </form>
    </div>
</x-app-layout>