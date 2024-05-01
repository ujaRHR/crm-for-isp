<div class="modal fade" id="editModal" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Edit Customer</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
        <form id="customer-form">
          <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" id="fullname" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" id="phone" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <button onclick="updateCustomer()" type="button" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

@push('other-scripts')
<script>
  function updateCustomer() {
    let fullname = document.getElementById('fullname').value;
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;
    let password = document.getElementById('password').value;

    if (fullname.length < 4 || email.length < 6 || phone.length < 10 || password.length < 6) {
      toastr.error("Please fill the required fields!")
    } else {
      formData = {
        fullname: fullname,
        email: email,
        phone: phone,
        password: password
      }

      let res = axios.post('/customer-signup', formData).then(function (response) {
        if (response.data.status == 'success' && response.status == 200) {
          toastr.success("Customer Created Successfully")
          $('#createModal').modal('hide');
          getCustomer();
        } else {
          toastr.error("Something Went Wrong!")
        }
      });
    }
  }

</script>
@endpush