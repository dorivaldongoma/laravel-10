<h1>Adicionar Dúvida</h1>

<x-alert></x-alert>

<form action="{{ route('supports.store') }}" method="POST">
    @include('admin.supports.partials.form')
</form>
