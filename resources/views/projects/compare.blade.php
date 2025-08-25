@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Compare Projects</h2>

    @if($projects->count())
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Attribute</th>
                    @foreach($projects as $project)
                        <th>{{ $project->title }}
                            <a href="{{ route('projects.compare.remove', $project->id) }}" class="text-danger">&times;</a>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Location</td>
                    @foreach($projects as $project)
                        <td>{{ $project->location }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Price</td>
                    @foreach($projects as $project)
                        <td>{{ number_format($project->price) }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Type</td>
                    @foreach($projects as $project)
                        <td>{{ $project->type }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Amenities</td>
                    @foreach($projects as $project)
                        <td>{{ implode(', ', $project->amenities ?? []) }}</td>
                    @endforeach
                </tr>
                {{-- Add more rows as needed --}}
            </tbody>
        </table>
    </div>
    @else
        <p>No projects selected for comparison.</p>
    @endif
</div>
@endsection
