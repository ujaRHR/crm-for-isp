<div class="content">
  <div class="container">
    <div class="page-title">
      <h3>Customers
        <a data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-sm btn-outline-primary float-end"><i
            class="fas fa-user-plus"></i>
          Create Customer</a>
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-hover table-bordered" id="dataTables" width="100%">
          <thead>
            <tr>
              <th>PID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Type</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="tableBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('other-scripts')
<script>
  getCustomer();

  async function getCustomer() {
    let res = await axios.get('/customer-list');
    let data = res.data;

    let mainTable = $('#dataTables');
    let tableBody = $('#tableBody');
    let btnClass = ''

    mainTable.DataTable().clear().destroy();

    data.forEach(function (item, index) {
      if (item['status'] == 'active') {
        btnClass = "btn btn-sm btn-success"
      } else {
        btnClass = "btn btn-sm btn-danger"
      }
      let newRow = `<tr>
        <td>${item['personal_id']}</td>
        <td>${item['fullname']}</td>
        <td>${item['email']}</td>
        <td>${item['phone']}</td>
        <td>${item['type']}</td>
        <td><button class='${btnClass}'>${item['status']}</button></td>
        <td>
          <button type="button" class="editBtn btn btn-outline-info btn-rounded" data-id="${item['personal_id']}"><i class="fas fa-pen"></i></button>
          <button type="button" class="deleteBtn btn btn-outline-danger btn-rounded" data-id="${item['personal_id']}"><i class="fas fa-trash"></i></button>
        </td>
      </tr>`
      tableBody.append(newRow);
    });

    mainTable.DataTable();

    $('table tbody').on('click', '.deleteBtn', function () {
      let pid = $(this).data('id');
      $("#deleteModal").modal('show');
      $('#deletePID').val(pid);
    })

    $('table tbody').on('click', '.editBtn', function () {
      let pid = $(this).data('id');
      $("#editModal").modal('show');
      $('#editPID').val(pid);
    })
  }

</script>
@endpush