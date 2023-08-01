<div>
    @if ($contacts->count() > 0)

        <div class="container">
            <div class="row">
                {{-- <div class="col-md-12"> --}}
                @if (session()->has('contact_message'))
                    <div class="alert alert-success">
                        {{ session()->get('contact_message') }}
                    </div>
                @endif

                <h4>All Contacts</h4>
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Eamil </th>
                            <th> Phone </th>
                            <th> Comment </th>
                            <th> Created at </th>
                            {{-- <th> Action </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $key => $contact)
                            <tr>
                                <td> {{ ++$key }} </td>
                                <td> {{ $contact->name }} </td>
                                <td> {{ $contact->email }} </td>
                                <td> ${{ $contact->phone }} </td>
                                <td> ${{ $contact->comment }} </td>
                                <td> {{ $contact->created_at }} </td>
                                <td>
                                    {{-- <div class="d-flex">
                                        <a href="{{ route('admin.contactDetails', ['contact_id' => $contact->id]) }}"
                                            class="btn btn-sm btn-success" title="View contact"><i class="fa fa-eye"
                                                aria-hidden="true"></i></a>
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-sm ml-1 dropdown-toggle" href="#"
                                                role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                status
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item" href="#"
                                                        wire:click.prevent="Updatecontactstatus({{ $contact->id }}, 'delivered')">delivered</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $contacts->links('layouts.pagination') }}
            </div>
        </div>
</div>
@else
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <h1>No Contacts Now</h1>
            </div>
        </div>
    </div>
</div>
@endif
</div>
