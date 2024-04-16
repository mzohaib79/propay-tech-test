<div class="modal fade" id="addEditUserModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
               <form id="userForm">
                  <input type="hidden" name="user_id" id="user_id">
                   <div class="row">
                      <div class="col-6">
                          <div class="form-group">
                              <label for="name"> Name</label>
                              <input type="text" class="form-control" id="name" name="name">
                              <span class="text-danger error-message font-weight-bold error_name" id="error_name"></span>
                          </div>
                      </div>
                       <div class="col-6">
                           <div class="form-group">
                               <label for="surname"> Surname</label>
                               <input type="text" class="form-control" id="surname" name="surname">
                               <span class="text-danger error-message font-weight-bold error_surname" id="error_surname"></span>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="form-group">
                               <label for="sid_number"> South African Id Number</label>
                               <input type="text" class="form-control" id="sid_number" name="sid_number">
                               <span class="text-danger error-message font-weight-bold error_sid_number" id="error_sid_number"></span>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="form-group">
                               <label for="mobile_number"> Mobile Number</label>
                               <input type="number" class="form-control" id="mobile_number" name="mobile_number">
                               <span class="text-danger error-message font-weight-bold error_mobile_number" id="error_mobile_number"></span>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="form-group">
                               <label for="mobile_number"> Email Address</label>
                               <input type="text" class="form-control" id="email" name="email">
                               <span class="text-danger error-message font-weight-bold error_email" id="error_email"></span>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="form-group">
                               <label for="date_of_birth"> Birth Date</label>
                               <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                               <span class="text-danger error-message font-weight-bold error_date_of_birth" id="error_date_of_birth"></span>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="form-group">
                               <label for="language">Select Language</label>
                               <select class="form-control" aria-label="Default select example" name="language"
                                       id="language">
                                   <option selected value="">Select Language</option>
                                   <option value="English">English</option>
                                   <option value="Spanish">Spanish</option>
                                   <option value="Arabic">Arabic</option>
                                   <option value="Mandarin">Mandarin</option>
                               </select>
                               <span class="text-danger error-message font-weight-bold error_language" id="error_language"></span>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="form-group">
                               <label for="language">Select Interests</label>
                               <select class="form-control" aria-label="Select interests" name="interests[]"
                                       id="interests" multiple>
                                   @foreach($interests as $interest)
                                     <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                                    @endforeach
                               </select>
                               <span class="text-danger error-message font-weight-bold error_interests" id="error_interests"></span>
                           </div>
                       </div>
                   </div>
               </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal">
                    <i class="flaticon-cancel-12"></i>
                    Discard
                </button>
                <button type="button" class="btn btn-primary" id="saveUserBtn">
                    <span class="indicator-label">
                       Save
                    </span>
                    <span id="indicatorProgress" class="indicator-progress d-none">
                           Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                     </span>
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        let $userModal = $('#addEditUserModal');
        let $userModalLabel = $('#userModalLabel');
        let $userForm = $('#userForm');
        let $saveUserBtn = $('#saveUserBtn');

        let $userIdInput = $('#user_id');
        let $interestsSelect = $('#interests');
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            showCloseButton: true
        });

        $("#interests").select2({
            tags: true,
            placeholder: 'Select your interests',
            allowClear: true,
            dropdownParent: $userModal,
        });

        $('.addNewUserBtn').on('click',function (e) {
            $userModalLabel.html('Add New User');
            $userForm[0].reset();
            $interestsSelect.val(null).change();
            $userIdInput.val('');
            $userModal.modal('show');
        });
        $saveUserBtn.on('click', function (e) {
            dataIndicator($(this), 'on');
            saveUser();
        })

        function saveUser() {
            const data = $userForm.serialize();
            const url = '{{ route('user.store') }}';
            removeFromErrorsByClass($userForm);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: 'post',
                data: data,
                success: function (response) {
                    toast({
                        type: response.type,
                        title: response.message,
                    });
                    dataIndicator($saveUserBtn, 'off');
                    $('#userTable').DataTable().ajax.reload();
                    $userModal.modal('hide')
                },
                error :function( data ) {
                    dataIndicator($saveUserBtn, 'off');
                    let errors = data.responseJSON.errors;
                    showFormErrorsByClass(errors);
                }
            });
        }
    </script>
@endpush
