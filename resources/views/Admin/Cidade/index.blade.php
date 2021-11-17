@extends('Admin.layout.layout')

@section('conteudo-principal')
    <section class="section">
        <table class="highlight">
            <caption>Lista de Cidades</caption>
            <thead>
                <tr>
                    <th>Cidades</th>
                    <th class="right-align">Opções</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($cidades as $cidade)
                    <tr>
                        <td>{{ $cidade->nome }}</td>
                        <td class="right-align">
                            <span><i class="material-icons blue-text text-accent-2">edit</i></span>

                            <form action="{{ route('admin.cidades.destroy', $cidade->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button style="border: 0; background: transparent;" type="submit">
                                    <span style="cursor: pointer;"><i class="material-icons red-text text-accent-3">delete_forever</i></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>Não há cidades cadastradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="fixed-action-btn">
            <a href="{{ route('admin.cidades.create') }}" class="btn-floating btn-large waves-effect waves-light">
                <i class="large material-icons">add</i>
            </a>
        </div>
    </section>
@endsection