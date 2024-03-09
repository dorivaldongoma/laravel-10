<h1>Listagem dos Suportes</h1>

<a href="{{ route('supports.create') }}">Adicionar Dúvida</a>

<table>
    <caption>Suportes</caption>
    <thead>
        <th>Assunto</th>
        <th>Estado</th>
        <th>Descrição</th>
        <th>
            >
        </th>
    </thead>
    <tbody>
        @foreach($supports as $support)
            <tr>
                <td>{{ $support->subject }}</td>
                <td>{{ $support->status }}</td>
                <td>{{ $support->body }}</td>
                <td>
                    <a href="{{ route('supports.show', $support->id) }}">Ver</a>
                    <a href="{{ route('supports.edit', $support->id) }}">Editar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>