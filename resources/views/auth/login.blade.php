<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <form class="text-start w-full" method="POST" action="{{ route('login') }}">
        @csrf
                <!-- Validation Errors -->
        <input class="form-control" type="text" name="email" placeholder="E-mail" required>
        <input class="form-control" type="password" name="password" placeholder="Senha" required>
        <a href="{{ url('forgot-password') }}">Recuperar senha</a>
         {!! NoCaptcha::renderJs('pt-BR', false, 'onloadCallback') !!}
         {!! NoCaptcha::display() !!}
        <div class="form-button">
            <button id="submit" type="submit" class=" inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Login</button> 
        </div>

    </form>

    <script>
        var onloadCallback = function() {
            alert('Recaptcha não preenchido');
        }
    </script>
</x-guest-layout>
