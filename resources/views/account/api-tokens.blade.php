@section('title', 'API Tokens')

@extends('layouts.master')

@section('breadcrumb')
<div class="col-lg-6">
    <h3>API Tokens</h3>
</div>
<div class="col-lg-6 text-right"></div>
@endsection

@section('content')

@if(Session::has('plainTextToken'))
<div class="col-lg-12">
    <div class="alert alert-warning">
        <strong>Your new API token (copy it now, it won't be shown again):</strong>
        <br>
        <code>{{ Session::get('plainTextToken') }}</code>
    </div>
</div>
@endif

<div class="col-lg-12">
    <form action="{{ route('account.api-tokens.store') }}" method="POST" class="form-inline mb20">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Token name" required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary">Generate new token</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Created</th>
                <th>Last used</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($tokens as $token)
            <tr>
                <td>{{ $token->name }}</td>
                <td>{{ $token->created_at }}</td>
                <td>{{ $token->last_used_at ?? 'Never' }}</td>
                <td>
                    <form action="{{ route('account.api-tokens.destroy', ['id' => $token->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" class="btn btn-xs btn-danger">Revoke</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">No API tokens yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
