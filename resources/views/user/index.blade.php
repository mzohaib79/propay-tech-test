@extends('layout.app')
@section('content')
    @push('style')
        <link href="{{ asset('assets/css/apps/user.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    @include('user.add-edit-modal')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing " id="cancel-row" style="justify-content: center">
            <div class="align-middle">
                <button class="btn btn-primary addNewUserBtn">
                    Add New User
                </button>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12 mt-3  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <table id="userTable"  class="table dt-table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>SID Number</th>
                            <th>Mobile </th>
                            <th>Email </th>
                            <th>Birth Date</th>
                            <th>Language</th>
                            <th>Interests</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('script')
<script>
    const userTable = $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: "{{ route('user.index') }}",
        columns: [
            {data: "name", name: "name"},
            {data: "surname", name: "surname"},
            {data: "email", name: "email"},
            {data: "sid_number", name: "sid_number"},
            {data: "mobile_number", name: "mobile_number"},
            {
                data: "date_of_birth",
                name: "date_of_birth",
                render: function (data, type, row) {

                    if (!data) {
                        return "";
                    }
                    // Convert the date from its raw format to the desired format (DD-MM-YY)
                    const date = new Date(data);

                    // Extract day, month, and year
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear().toString();

                    // Return formatted date (DD-MM-YY)
                    return `${day}-${month}-${year}`;
                }
            },
            {data: "language", name: "language"},
            {
                data: "interest",
                name: "interest",
                orderable: false,
                searchable: false,
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ]
    });

    $(document).on('click', '.editUser', function (){
        let url = $(this).data('url');
        $userModalLabel.html('Edit User');
        findUser(url);
    });
    $(document).on('click', '.deleteUser', function (){
        let url = $(this).data('url');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            animation: false,
            customClass: 'animated tada',
        }).then((result) => {
            if (result.value) {
                deleteUser(url)
            }
        });
    })
    const findUser = (url) =>  {
        $.ajax({
            url: url,
            method: "get",
            success: function (response) {
                console.log(response)
                const elementsCache = {};
                $.each(response, function(index, value) {
                    // Cache DOM element references only once
                    if (!(index in elementsCache)) {
                        elementsCache[index] = $("#" + index);
                    }

                    const element = elementsCache[index];
                    if (element) {
                        // Set the value
                        element.val(value);

                        // Trigger change event only if index is 'language' because its select input
                        if (index === 'language') {
                            element.change();
                        }
                    }
                });
                $("#user_id").val(response.id);
                populateUserInterests(response.interests)
                $userModal.modal("show");
            },

        });
    }
    const populateUserInterests = (interests) => {
        // Determine the value to set in the Select2 dropdown
        const interestIds = Array.isArray(interests) && interests.length > 0
            ? interests.map(interest => interest.id)
            : [];

        // Set the selected values or clear the Select2 dropdown
        $("#interests").val(interestIds).trigger('change');
    }

    const deleteUser = (url) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            method: "delete",
            success: function (response) {
                if (response.status === 200) {
                    $('#userTable').DataTable().ajax.reload();
                }
                toast({
                    type: response.type,
                    title: response.message,
                });
            },
        });
    }
</script>
@endpush
